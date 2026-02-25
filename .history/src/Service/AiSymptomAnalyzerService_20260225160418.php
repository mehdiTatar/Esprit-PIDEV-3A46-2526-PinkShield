<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class AiSymptomAnalyzerService
{
    private HttpClientInterface $httpClient;
    private string $apiKey;
    private string $apiProvider; // 'openai' or 'gemini'
    private string $model;

    public function __construct(
        HttpClientInterface $httpClient,
        string $aiApiKey,
        string $aiProvider = 'openai',
        string $aiModel = 'gpt-3.5-turbo'
    ) {
        $this->httpClient = $httpClient;
        $this->apiKey = $aiApiKey;
        $this->apiProvider = $aiProvider;
        $this->model = $aiModel;
    }

    /**
     * Analyze medical notes and suggest parapharmacy products
     *
     * @param string $notes The consultation notes from the appointment
     * @return array An array containing 'success' (bool) and 'suggestions' (string) or 'error' (string)
     */
    public function analyzeNotes(string $notes): array
    {
        // Don't process empty notes
        if (empty(trim($notes))) {
            return [
                'success' => false,
                'error' => 'No notes provided for analysis',
            ];
        }

        try {
            if ($this->apiProvider === 'gemini') {
                return $this->analyzeWithGemini($notes);
            } else {
                return $this->analyzeWithOpenAi($notes);
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'AI analysis failed: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Analyze notes using OpenAI API
     *
     * @param string $notes The consultation notes
     * @return array The analysis result
     */
    private function analyzeWithOpenAi(string $notes): array
    {
        // Ask for 3-4 short, comma-separated parapharmacy suggestions
        $prompt = "Act as a pharmacist. Read these consultation notes: {$notes}. Suggest 3 to 4 relevant over-the-counter parapharmacy products or generic product types that could help (e.g., thermometer, cooling patches, vitamin C). Return ONLY a comma-separated list of the items, nothing else. Keep items short and do not include extra explanation.";

        $response = $this->httpClient->request('POST', 'https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => $this->model,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'temperature' => 0.7,
                'max_tokens' => 100,
            ],
            'timeout' => 30,
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode !== 200) {
            $error = $response->toArray(false);
            throw new \Exception('OpenAI API error: ' . ($error['error']['message'] ?? 'Unknown error'));
        }

        $data = $response->toArray();
        $suggestions = $data['choices'][0]['message']['content'] ?? '';

        // Normalize AI output: convert newlines and bullets to commas, remove extra text
        $normalized = preg_replace('/[\r\n]+/', ',', trim($suggestions));
        // Replace multiple commas or comma-space combinations with single comma
        $normalized = preg_replace('/\s*,\s*/', ',', $normalized);
        $normalized = preg_replace('/,{2,}/', ',', $normalized);
        $normalized = trim($normalized, ", ");

        if (empty($normalized)) {
            // fallback to simple keyword mapping
            $fallback = $this->generateFallbackSuggestions($notes);
            return [
                'success' => true,
                'suggestions' => $fallback,
            ];
        }

        return [
            'success' => true,
            'suggestions' => $normalized,
        ];
    }

    /**
     * Analyze notes using Google Gemini API
     *
     * @param string $notes The consultation notes
     * @return array The analysis result
     */
    private function analyzeWithGemini(string $notes): array
    {
        $prompt = "Act as a pharmacist. Read these consultation notes: {$notes}. Suggest 3 to 4 relevant over-the-counter parapharmacy products or generic product types that could help (e.g., thermometer, cooling patches, vitamin C). Return ONLY a comma-separated list of the items, nothing else. Keep items short and do not include extra explanation.";

        $response = $this->httpClient->request('POST', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent', [
            'query' => [
                'key' => $this->apiKey,
            ],
            'json' => [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $prompt,
                            ],
                        ],
                    ],
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 100,
                ],
            ],
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode !== 200) {
            throw new \Exception('Gemini API error: Status ' . $statusCode);
        }

        $data = $response->toArray();

        // Extract text from Gemini response
        $suggestions = '';
        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            $suggestions = $data['candidates'][0]['content']['parts'][0]['text'];
        }

        // Normalize similar to OpenAI path
        $normalized = preg_replace('/[\r\n]+/', ',', trim($suggestions));
        $normalized = preg_replace('/\s*,\s*/', ',', $normalized);
        $normalized = preg_replace('/,{2,}/', ',', $normalized);
        $normalized = trim($normalized, ", ");

        if (empty($normalized)) {
            // fallback to keyword-based suggestions
            $fallback = $this->generateFallbackSuggestions($notes);
            return [
                'success' => true,
                'suggestions' => $fallback,
            ];
        }

        return [
            'success' => true,
            'suggestions' => $normalized,
        ];
    }

    /**
     * Simple keyword-based fallback when AI is unavailable or returns unexpected output.
     * Returns a comma-separated list of up to 4 suggestions.
     */
    private function generateFallbackSuggestions(string $notes): string
    {
        $notesLower = strtolower($notes);
        $suggestions = [];

        // Symptom -> suggestions mapping (generic/parapharmacy items)
        $mappings = [
            ['keywords' => ['fever', 'temperature'], 'items' => ['Thermometer', 'Cooling patches', 'Oral rehydration salts', 'Paracetamol']],
            ['keywords' => ['headache', 'migraine'], 'items' => ['Pain reliever', 'Cooling patches', 'Hydration salts', 'Magnesium supplements']],
            ['keywords' => ['cough', 'sore throat'], 'items' => ['Cough drops', 'Throat lozenges', 'Saline nasal spray', 'Honey & lemon soothing syrup']],
            ['keywords' => ['cold', 'congestion', 'runny nose'], 'items' => ['Nasal saline', 'Decongestant spray', 'Cough drops', 'Vitamin C']],
            ['keywords' => ['skin', 'rash', 'itch'], 'items' => ['Antiseptic wipes', 'Hydrocortisone cream', 'Soothing emollient', 'Calamine lotion']],
            ['keywords' => ['pain', 'injury', 'sprain'], 'items' => ['Pain reliever', 'Topical analgesic gel', 'Elastic bandage', 'Cold pack']],
            ['keywords' => ['diarrhea', 'vomit', 'nausea'], 'items' => ['Oral rehydration salts', 'Probiotics', 'Antiseptic wipes', 'BRAT diet guidance']]
        ];

        foreach ($mappings as $map) {
            foreach ($map['keywords'] as $kw) {
                if (strpos($notesLower, $kw) !== false) {
                    foreach ($map['items'] as $it) {
                        if (!in_array($it, $suggestions)) {
                            $suggestions[] = $it;
                            if (count($suggestions) >= 4) break 3;
                        }
                    }
                }
            }
        }

        // If still empty, provide very generic helpful items
        if (empty($suggestions)) {
            $suggestions = ['Thermometer', 'Vitamin C', 'Pain reliever', 'Antiseptic wipes'];
        }

        return implode(', ', array_slice($suggestions, 0, 4));
    }
}

<?php
namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;
class AiPharmacistService
{
    private HttpClientInterface $httpClient;
    private string $apiKey;
    private string $apiProvider;
    private string $model;
    public function __construct(HttpClientInterface $httpClient, string $aiApiKey, string $aiProvider = 'openai', string $aiModel = 'gpt-3.5-turbo')
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $aiApiKey;
        $this->apiProvider = $aiProvider;
        $this->model = $aiModel;
    }
    public function suggestProducts(string $notes): array
    {
        if (trim($notes) === '') {
            throw new \InvalidArgumentException('Notes cannot be empty');
        }
        
        try {
            if ($this->apiProvider === 'gemini') {
                return $this->analyzeWithGemini($notes);
            }
            return $this->analyzeWithOpenAi($notes);
        } catch (\Exception $e) {
            // Fallback to keyword-based suggestions when API fails
            error_log('AI API failed: ' . $e->getMessage() . ' - Using fallback');
            return $this->generateFallbackSuggestions($notes);
        }
    }
    private function analyzeWithOpenAi(string $notes): array
    {
        $prompt = "You are an AI Pharmacist advising a patient. Read the consultation notes exactly as provided: \"{$notes}\". Based on symptoms and treatments mentioned, return a JSON array containing exactly 3 objects. Each object must contain the keys: name, reason, usage. Example output format: [{\"name\":\"Product A\",\"reason\":\"Why it helps\",\"usage\":\"How to use\"},{\"name\":\"Product B\",\"reason\":\"...\",\"usage\":\"...\"},{\"name\":\"Product C\",\"reason\":\"...\",\"usage\":\"...\"}]. Return ONLY the JSON array and nothing else.";
        $response = $this->httpClient->request('POST', 'https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiKey,
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.2,
                'max_tokens' => 400
            ],
            'timeout' => 30
        ]);
        $status = $response->getStatusCode();
        $body = $response->getContent(false);
        if ($status !== 200) {
            throw new \RuntimeException('OpenAI API error: HTTP '.$status.' - '.$body);
        }
        $data = json_decode($body, true);
        if (!isset($data['choices'][0]['message']['content'])) {
            throw new \RuntimeException('OpenAI response missing content');
        }
        $text = $data['choices'][0]['message']['content'];
        $json = $this->extractJsonArray($text);
        $arr = json_decode($json, true);
        if (!is_array($arr)) {
            throw new \RuntimeException('Failed to decode JSON from AI response');
        }
        return $arr;
    }
    private function analyzeWithGemini(string $notes): array
    {
        $prompt = "You are an AI Pharmacist advising a patient. Read the consultation notes exactly as provided: \"{$notes}\". Based on symptoms and treatments mentioned, return a JSON array containing exactly 3 objects. Each object must contain the keys: name, reason, usage. Example output format: [{\"name\":\"Product A\",\"reason\":\"Why it helps\",\"usage\":\"How to use\"},{\"name\":\"Product B\",\"reason\":\"...\",\"usage\":\"...\"},{\"name\":\"Product C\",\"reason\":\"...\",\"usage\":\"...\"}]. Return ONLY the JSON array and nothing else.";
        $response = $this->httpClient->request('POST', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent', [
            'query' => ['key' => $this->apiKey],
            'json' => [
                'contents' => [['parts' => [['text' => $prompt]]]],
                'generationConfig' => ['temperature' => 0.2, 'maxOutputTokens' => 400]
            ],
            'timeout' => 30
        ]);
        $status = $response->getStatusCode();
        $body = $response->getContent(false);
        if ($status !== 200) {
            throw new \RuntimeException('Gemini API error: HTTP '.$status.' - '.$body);
        }
        $data = json_decode($body, true);
        if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            throw new \RuntimeException('Gemini response missing content');
        }
        $text = $data['candidates'][0]['content']['parts'][0]['text'];
        $json = $this->extractJsonArray($text);
        $arr = json_decode($json, true);
        if (!is_array($arr)) {
            throw new \RuntimeException('Failed to decode JSON from AI response');
        }
        return $arr;
    }
    private function extractJsonArray(string $text): string
    {
        $start = strpos($text, '[');
        $end = strrpos($text, ']');
        if ($start === false || $end === false || $end < $start) {
            throw new \RuntimeException('No JSON array found in AI response');
        }
        $json = substr($text, $start, $end - $start + 1);
        return $json;
    }

    private function generateFallbackSuggestions(string $notes): array
    {
        $notes_lower = strtolower($notes);
        $suggestions = [];

        // Keyword-based suggestions
        $keywords = [
            'fever' => ['name' => 'Antipyretic (Paracetamol/Ibuprofen)', 'reason' => 'Reduces fever and body temperature', 'usage' => 'Take as directed, usually every 4-6 hours'],
            'headache' => ['name' => 'Pain Reliever (Aspirin/Ibuprofen)', 'reason' => 'Alleviates headache and pain', 'usage' => 'Take with water, follow dosage instructions'],
            'cough' => ['name' => 'Cough Syrup (DXM/Honey-based)', 'reason' => 'Suppresses cough and soothes throat', 'usage' => 'Take 5-10ml 2-3 times daily'],
            'cold' => ['name' => 'Vitamin C Supplement', 'reason' => 'Boosts immune system for cold relief', 'usage' => 'Take 1000-2000mg daily'],
            'sore throat' => ['name' => 'Throat Lozenges/Spray', 'reason' => 'Soothes throat irritation and pain', 'usage' => 'Use lozenges as needed, follow spray instructions'],
            'congestion' => ['name' => 'Nasal Decongestant', 'reason' => 'Clears nasal passages and improves breathing', 'usage' => 'Use nasal spray 2-3 times daily or tablets as directed'],
            'pain' => ['name' => 'Pain Reliever (Ibuprofen/Paracetamol)', 'reason' => 'Reduces pain and inflammation', 'usage' => 'Take every 6-8 hours with food'],
            'inflammation' => ['name' => 'Anti-inflammatory (Ibuprofen)', 'reason' => 'Reduces inflammation and related pain', 'usage' => 'Take with food, 2-3 times daily'],
            'diarrhea' => ['name' => 'Anti-diarrheal (Loperamide)', 'reason' => 'Controls diarrhea symptoms', 'usage' => 'Take after each loose stool, max 2-3 per day'],
            'nausea' => ['name' => 'Anti-nausea Tablet (Meclizine)', 'reason' => 'Relieves nausea and vomiting', 'usage' => 'Take 25-50mg, repeat every 4-6 hours if needed'],
            'allergy' => ['name' => 'Antihistamine (Cetirizine/Loratadine)', 'reason' => 'Controls allergy symptoms and itching', 'usage' => 'Take 1 tablet daily'],
            'itching' => ['name' => 'Antihistamine Cream', 'reason' => 'Soothes skin itching and irritation', 'usage' => 'Apply topically 2-3 times daily'],
            'heartburn' => ['name' => 'Antacid (Omeprazole)', 'reason' => 'Neutralizes stomach acid', 'usage' => 'Take 1-2 tablets 30 minutes before meals'],
            'sleep' => ['name' => 'Sleep Aid (Melatonin)', 'reason' => 'Promotes natural sleep and relaxation', 'usage' => 'Take 5-10mg 30 minutes before bed'],
            'anxiety' => ['name' => 'Herbal Supplement (Chamomile/Passionflower)', 'reason' => 'Calms nerves and reduces anxiety', 'usage' => 'Take as tea or supplement 2-3 times daily'],
            'digestion' => ['name' => 'Digestive Enzyme', 'reason' => 'Aids digestion and reduces bloating', 'usage' => 'Take with heavy meals'],
            'vitamin' => ['name' => 'Multivitamin Supplement', 'reason' => 'Supports overall health and immunity', 'usage' => 'Take 1 tablet daily with breakfast'],
        ];

        // Check for matching keywords
        foreach ($keywords as $keyword => $product) {
            if (strpos($notes_lower, $keyword) !== false) {
                $suggestions[] = $product;
                if (count($suggestions) >= 3) {
                    break;
                }
            }
        }

        // If less than 3 suggestions, add general recommendations
        if (count($suggestions) < 3) {
            $general = [
                ['name' => 'Vitamin C & Zinc', 'reason' => 'Boosting immunity and promoting recovery', 'usage' => 'Take daily as directed on packaging'],
                ['name' => 'Hydration Salts (ORS)', 'reason' => 'Maintaining proper electrolyte balance', 'usage' => 'Mix with water and drink throughout the day'],
                ['name' => 'First Aid Kit Essentials', 'reason' => 'Basic wound care and minor injury treatment', 'usage' => 'Keep handy for emergencies'],
            ];

            foreach ($general as $item) {
                if (count($suggestions) < 3) {
                    $suggestions[] = $item;
                }
            }
        }

        return array_slice($suggestions, 0, 3);
    }
}

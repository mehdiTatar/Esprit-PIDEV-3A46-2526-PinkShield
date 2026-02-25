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
}

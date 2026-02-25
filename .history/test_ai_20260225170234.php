<?php
require 'vendor/autoload.php';

use App\Service\AiPharmacistService;
use Symfony\Component\HttpClient\HttpClient;
use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$httpClient = HttpClient::create();
$apiKey = $_ENV['AI_API_KEY'] ?? '';
$provider = $_ENV['AI_PROVIDER'] ?? 'openai';
$model = $_ENV['AI_MODEL'] ?? 'gpt-3.5-turbo';

echo "Testing AI Pharmacist Service\n";
echo "API Key present: " . (empty($apiKey) ? "NO" : "YES (length: " . strlen($apiKey) . ")") . "\n";
echo "Provider: $provider\n";
echo "Model: $model\n\n";

if (empty($apiKey)) {
    echo "ERROR: AI_API_KEY not set!\n";
    exit(1);
}

try {
    $service = new AiPharmacistService($httpClient, $apiKey, $provider, $model);
    $notes = "Patient complains of headache and fever for 3 days. Prescribed paracetamol. Recommended rest and hydration.";
    
    echo "Calling suggestProducts with notes...\n";
    $result = $service->suggestProducts($notes);
    
    echo "SUCCESS!\n";
    echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
    exit(1);
}

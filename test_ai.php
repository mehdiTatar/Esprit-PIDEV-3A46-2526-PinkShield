<?php
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

require_once dirname(__FILE__) . '/vendor/autoload_runtime.php';

return function (array $context) {
    return new class($context) {
        private $context;
        public function __construct(array $context) { $this->context = $context; }
        public function __invoke() {
            // Direct test - manually instantiate and test
            $httpClient = new \Symfony\Component\HttpClient\HttpClient();
            $apiKey = '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';
            $provider = 'openai';
            $model = 'gpt-3.5-turbo';
            
            echo "Testing AI Pharmacist Service\n";
            echo "API Key (length): " . strlen($apiKey) . "\n";
            echo "Provider: $provider\n";
            echo "Model: $model\n\n";
            
            try {
                $service = new \App\Service\AiPharmacistService($httpClient, $apiKey, $provider, $model);
                $notes = "Patient complains of headache and fever for 3 days.";
                
                echo "Calling suggestProducts...\n";
                $result = $service->suggestProducts($notes);
                
                echo "SUCCESS!\n";
                echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
                return 0;
            } catch (\Exception $e) {
                echo "ERROR: " . $e->getMessage() . "\n";
                return 1;
            }
        }
    };
};

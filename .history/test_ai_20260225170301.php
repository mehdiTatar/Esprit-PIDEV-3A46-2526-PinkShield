<?php
require 'vendor/autoload_runtime.php';

use App\Kernel;
use App\Service\AiPharmacistService;
use Symfony\Component\HttpClient\HttpClient;

return function (array $context) {
    $kernel = new Kernel($context['APP_ENV'], (bool)$context['APP_DEBUG']);
    $kernel->boot();
    
    $container = $kernel->getContainer();
    
    echo "Testing AI Pharmacist Service\n";
    
    try {
        $service = $container->get(AiPharmacistService::class);
        $notes = "Patient complains of headache and fever for 3 days. Prescribed paracetamol. Recommended rest and hydration.";
        
        echo "Calling suggestProducts...\n";
        $result = $service->suggestProducts($notes);
        
        echo "SUCCESS!\n";
        echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
    } catch (Exception $e) {
        echo "ERROR: " . $e->getMessage() . "\n";
        exit(1);
    }
    
    return 0;
};

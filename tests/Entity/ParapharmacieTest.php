<?php

namespace App\Tests\Entity;

use App\Entity\Parapharmacie;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class ParapharmacieTest extends TestCase
{
    private function createValidator()
    {
        return Validation::createValidatorBuilder()
            ->enableAttributeMapping()
            ->getValidator();
    }

    public function testPriceCanBePositiveOrZero(): void
    {
        $validator = $this->createValidator();
        $product = new Parapharmacie();

        // setting a valid price should not produce violations
        $product->setName('Test Product');
        $product->setPrice('25.00');

        // validate only the price property to avoid unrelated constraints
        $violations = $validator->validateProperty($product, 'price');
        $this->assertCount(0, $violations, "Expected no validation errors for non-negative price");
    }

    public function testPriceCannotBeNegative(): void
    {
        $validator = $this->createValidator();
        $product = new Parapharmacie();

        // negative price is against business rule
        $product->setName('Test Product');
        $product->setPrice('-3.00');

        // validate just the price field
        $violations = $validator->validateProperty($product, 'price');
        $this->assertGreaterThan(0, $violations->count(), "Expected at least one violation for negative price");
    }
}

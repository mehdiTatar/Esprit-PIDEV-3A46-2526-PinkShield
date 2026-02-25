<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\RequestStack;

// Temporarily disabled - keeping the file for future use in production
// #[AsEventListener(event: CheckPassportEvent::class)]
class LoginCaptchaListener
{
    private const RECAPTCHA_VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    public function __construct(
        private HttpClientInterface $httpClient,
        private RequestStack $requestStack,
        private string $recaptchaSecretKey,
    ) {
    }

    public function __invoke(CheckPassportEvent $event): void
    {
        // CAPTCHA VERIFICATION DISABLED FOR DEVELOPMENT
        // Re-enable in production by uncommenting the #[AsEventListener] attribute above
        return;
    }
}

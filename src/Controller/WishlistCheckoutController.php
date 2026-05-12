<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\WishlistCheckoutService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/wishlist/checkout')]
class WishlistCheckoutController extends AbstractController
{
    public function __construct(
        private readonly WishlistCheckoutService $checkoutService,
    ) {
    }

    #[Route('/', name: 'wishlist_checkout', methods: ['GET'])]
    public function checkout(): Response
    {
        $user = $this->getCurrentUser();
        $data = $this->checkoutService->getCheckoutData($user);

        return $this->render('wishlist/checkout.html.twig', [
            'wishlistItems' => $data['items'],
            'transactions' => $data['transactions'],
            'total' => $data['total'],
            'itemCount' => $data['count'],
        ]);
    }

    #[Route('/pay', name: 'wishlist_checkout_pay', methods: ['POST'])]
    public function pay(Request $request): Response
    {
        $user = $this->getCurrentUser();

        try {
            $transactionId = $this->checkoutService->processMockPayment($user, [
                'cardholder_name' => $request->request->get('cardholder_name'),
                'card_number' => $request->request->get('card_number'),
                'expiry_date' => $request->request->get('expiry_date'),
                'cvv' => $request->request->get('cvv'),
            ]);

            $this->addFlash('success', 'Payment successful. Transaction ID: ' . $transactionId);

            return $this->redirectToRoute('wishlist_checkout_receipt', [
                'transactionId' => $transactionId,
            ]);
        } catch (\InvalidArgumentException $e) {
            $this->addFlash('danger', $e->getMessage());
        } catch (\Throwable $e) {
            $this->addFlash('danger', 'Payment could not be processed. Please try again.');
        }

        return $this->redirectToRoute('wishlist_checkout');
    }

    #[Route('/receipt/{transactionId}', name: 'wishlist_checkout_receipt', methods: ['GET'])]
    public function receipt(string $transactionId): Response
    {
        $user = $this->getCurrentUser();
        $transaction = $this->checkoutService->getTransactionForUser($user, $transactionId);

        if (!$transaction) {
            throw $this->createNotFoundException('Receipt not found.');
        }

        $pdfContent = $this->checkoutService->generateReceiptPdf($user, $transaction);
        $filename = $transaction['receipt_file_name'] ?: sprintf('receipt_%s.pdf', $transactionId);

        return new Response($pdfContent, Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    private function getCurrentUser(): User
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('Wishlist checkout is available for patient accounts.');
        }

        return $user;
    }
}

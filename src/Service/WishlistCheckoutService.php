<?php

namespace App\Service;

use App\Entity\Notification;
use App\Entity\User;
use App\Repository\WishlistRepository;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use TCPDF;

class WishlistCheckoutService
{
    public function __construct(
        private readonly WishlistRepository $wishlistRepository,
        private readonly EntityManagerInterface $entityManager,
        private readonly Connection $connection,
    ) {
    }

    public function getCheckoutData(User $user): array
    {
        $items = $this->wishlistRepository->findByUser($user);
        $total = 0.0;

        foreach ($items as $item) {
            $product = $item->getProduct();
            if ($product) {
                $total += (float) $product->getPrice();
            }
        }

        return [
            'items' => $items,
            'total' => round($total, 2),
            'count' => count($items),
            'transactions' => $this->getTransactionsForUser($user),
        ];
    }

    public function processMockPayment(User $user, array $paymentData): string
    {
        $items = $this->wishlistRepository->findByUser($user);
        if (count($items) === 0) {
            throw new \InvalidArgumentException('Your wishlist is empty.');
        }

        $cardholderName = trim((string) ($paymentData['cardholder_name'] ?? ''));
        $cardNumber = preg_replace('/\D+/', '', (string) ($paymentData['card_number'] ?? ''));
        $expiryDate = trim((string) ($paymentData['expiry_date'] ?? ''));
        $cvv = preg_replace('/\D+/', '', (string) ($paymentData['cvv'] ?? ''));

        $this->validatePayment($cardholderName, $cardNumber, $expiryDate, $cvv);

        $total = 0.0;
        $serializedItems = [];
        foreach ($items as $item) {
            $product = $item->getProduct();
            if (!$product) {
                continue;
            }

            $price = (float) $product->getPrice();
            $total += $price;
            $serializedItems[] = sprintf('%s | %.2f TND', $product->getName(), $price);
        }

        $transactionId = $this->generateTransactionId();
        $receiptFileName = sprintf('receipt_%s.pdf', $transactionId);
        $cardLastFour = substr($cardNumber, -4);

        $this->connection->beginTransaction();
        try {
            $this->connection->insert('transactions', [
                'user_id' => $user->getId(),
                'transaction_id' => $transactionId,
                'cardholder_name' => $cardholderName,
                'card_last_four' => $cardLastFour,
                'total_amount' => round($total, 2),
                'item_count' => count($items),
                'status' => 'SUCCESSFUL',
                'receipt_file_name' => $receiptFileName,
                'items' => implode("\n", $serializedItems),
            ]);

            foreach ($items as $item) {
                $this->entityManager->remove($item);
            }

            $notification = new Notification();
            $notification->setUser($user);
            $notification->setTitle('Transaction successful');
            $notification->setMessage(sprintf('Your payment of %.2f TND succeeded. Transaction ID: %s.', $total, $transactionId));
            $notification->setType('success');
            $notification->setIcon('fas fa-receipt');
            $this->entityManager->persist($notification);
            $this->entityManager->flush();

            $this->connection->commit();
        } catch (\Throwable $e) {
            $this->connection->rollBack();
            throw $e;
        }

        return $transactionId;
    }

    public function getTransactionsForUser(User $user): array
    {
        return $this->connection->fetchAllAssociative(
            'SELECT * FROM transactions WHERE user_id = :user_id ORDER BY created_at DESC',
            ['user_id' => $user->getId()]
        );
    }

    public function getTransactionForUser(User $user, string $transactionId): ?array
    {
        $transaction = $this->connection->fetchAssociative(
            'SELECT * FROM transactions WHERE user_id = :user_id AND transaction_id = :transaction_id',
            [
                'user_id' => $user->getId(),
                'transaction_id' => $transactionId,
            ]
        );

        return $transaction ?: null;
    }

    public function generateReceiptPdf(User $user, array $transaction): string
    {
        $pdf = new TCPDF();
        $pdf->SetCreator('PinkShield');
        $pdf->SetAuthor('PinkShield');
        $pdf->SetTitle('Receipt ' . $transaction['transaction_id']);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->AddPage();

        $pdf->SetFont('helvetica', 'B', 20);
        $pdf->SetTextColor(192, 57, 107);
        $pdf->Cell(0, 12, 'PinkShield Payment Receipt', 0, 1);

        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetTextColor(80, 80, 80);
        $pdf->Cell(0, 6, 'Transaction ID: ' . $transaction['transaction_id'], 0, 1);
        $pdf->Cell(0, 6, 'Date: ' . $transaction['created_at'], 0, 1);
        $pdf->Cell(0, 6, 'User: ' . $user->getEmail(), 0, 1);
        $pdf->Cell(0, 6, 'Cardholder: ' . $transaction['cardholder_name'], 0, 1);
        $pdf->Cell(0, 6, 'Card: **** **** **** ' . $transaction['card_last_four'], 0, 1);
        $pdf->Ln(6);

        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->SetFillColor(192, 57, 107);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(130, 8, 'Item', 1, 0, 'L', true);
        $pdf->Cell(35, 8, 'Amount', 1, 1, 'R', true);

        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetTextColor(30, 30, 30);
        foreach (preg_split('/\R/', (string) $transaction['items']) as $line) {
            if (trim($line) === '') {
                continue;
            }

            [$name, $amount] = array_pad(explode(' | ', $line, 2), 2, '');
            $pdf->Cell(130, 7, mb_substr($name, 0, 70), 1);
            $pdf->Cell(35, 7, $amount, 1, 1, 'R');
        }

        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(130, 9, 'Total', 1, 0, 'R');
        $pdf->Cell(35, 9, number_format((float) $transaction['total_amount'], 2) . ' TND', 1, 1, 'R');
        $pdf->Ln(6);
        $pdf->Cell(0, 7, 'Status: ' . $transaction['status'], 0, 1);

        return $pdf->Output('', 'S');
    }

    private function validatePayment(string $cardholderName, string $cardNumber, string $expiryDate, string $cvv): void
    {
        if ($cardholderName === '') {
            throw new \InvalidArgumentException('Please enter the cardholder name.');
        }
        if (strlen($cardNumber) < 13 || strlen($cardNumber) > 19) {
            throw new \InvalidArgumentException('Card number must be between 13 and 19 digits.');
        }
        if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $expiryDate)) {
            throw new \InvalidArgumentException('Expiry date must use MM/YY format.');
        }
        if (strlen($cvv) < 3 || strlen($cvv) > 4) {
            throw new \InvalidArgumentException('CVV must be 3 or 4 digits.');
        }
    }

    private function generateTransactionId(): string
    {
        return sprintf('TRX%d_%04d', (int) (microtime(true) * 1000), random_int(0, 9999));
    }
}

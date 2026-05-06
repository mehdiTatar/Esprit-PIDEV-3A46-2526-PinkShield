package tn.esprit.services;

import javafx.scene.control.Alert;

import java.util.ArrayList;
import java.util.List;

/**
 * Mock Payment Service for PinkShield Application
 * Handles payment processing simulation without real payment gateway integration
 */
public class PaymentService {

    public static class PaymentItem {
        private int id;
        private String name;
        private double price;
        private int quantity;

        public PaymentItem(int id, String name, double price, int quantity) {
            this.id = id;
            this.name = name;
            this.price = price;
            this.quantity = quantity;
        }

        public int getId() { return id; }
        public String getName() { return name; }
        public double getPrice() { return price; }
        public int getQuantity() { return quantity; }
        public double getTotal() { return price * quantity; }
    }

    public static class PaymentDetails {
        private String cardholderName;
        private String cardNumber;
        private String expiryDate;
        private String cvv;
        private List<PaymentItem> items;
        private double totalAmount;

        public PaymentDetails(String cardholderName, String cardNumber, String expiryDate, String cvv) {
            this.cardholderName = cardholderName;
            this.cardNumber = cardNumber;
            this.expiryDate = expiryDate;
            this.cvv = cvv;
            this.items = new ArrayList<>();
            this.totalAmount = 0.0;
        }

        public String getCardholderName() { return cardholderName; }
        public String getCardNumber() { return cardNumber; }
        public String getExpiryDate() { return expiryDate; }
        public String getCvv() { return cvv; }
        public List<PaymentItem> getItems() { return items; }
        public double getTotalAmount() { return totalAmount; }

        public void addItem(PaymentItem item) {
            items.add(item);
            totalAmount += item.getTotal();
        }

        public void clearItems() {
            items.clear();
            totalAmount = 0.0;
        }
    }

    /**
     * Validate payment form
     */
    public boolean validatePaymentForm(String cardholderName, String cardNumber, String expiryDate, String cvv) {
        if (cardholderName == null || cardholderName.trim().isEmpty()) {
            showAlert("Validation Error", "Please enter the cardholder name.", Alert.AlertType.WARNING);
            return false;
        }

        if (cardNumber == null || cardNumber.trim().isEmpty()) {
            showAlert("Validation Error", "Please enter a valid card number.", Alert.AlertType.WARNING);
            return false;
        }

        String cleanedCardNumber = cardNumber.replaceAll("\\D", "");
        if (cleanedCardNumber.length() < 13 || cleanedCardNumber.length() > 19) {
            showAlert("Validation Error", "Card number must be between 13 and 19 digits.", Alert.AlertType.WARNING);
            return false;
        }

        if (expiryDate == null || expiryDate.trim().isEmpty()) {
            showAlert("Validation Error", "Please enter the expiry date (MM/YY).", Alert.AlertType.WARNING);
            return false;
        }

        if (cvv == null || cvv.trim().isEmpty() || cvv.length() < 3) {
            showAlert("Validation Error", "Please enter a valid CVV (3-4 digits).", Alert.AlertType.WARNING);
            return false;
        }

        return true;
    }

    /**
     * Process payment (mock implementation)
     */
    public boolean processPayment(PaymentDetails paymentDetails) {
        if (paymentDetails == null || paymentDetails.getItems().isEmpty()) {
            showAlert("Error", "No items to process in payment.", Alert.AlertType.ERROR);
            return false;
        }

        // Validate payment details
        if (!validatePaymentForm(paymentDetails.getCardholderName(), paymentDetails.getCardNumber(),
                paymentDetails.getExpiryDate(), paymentDetails.getCvv())) {
            return false;
        }

        // Simulate payment processing
        double total = paymentDetails.getTotalAmount();
        showAlert("Payment Processing", 
                "Processing payment of " + String.format("%.2f", total) + " TND...", 
                Alert.AlertType.INFORMATION);

        return true;
    }

    /**
     * Get confirmation message after successful payment
     */
    public String getSuccessMessage(double totalAmount) {
        return "Your payment has been processed successfully!\n\n" +
               "Total: " + String.format("%.2f", totalAmount) + " TND\n\n" +
               "Your medicines are being prepared and will be delivered soon.";
    }

    /**
     * Mock order confirmation notification
     */
    public String getOrderConfirmationNotification(double totalAmount) {
        return String.format("✅ Payment of %.2f TND successful. Your medicines are being prepared!", totalAmount);
    }

    /**
     * Validate if payment can be processed
     */
    public boolean canProcessPayment(List<PaymentItem> items) {
        if (items == null || items.isEmpty()) {
            showAlert("Empty Order", "Please add items to your order before proceeding to payment.", Alert.AlertType.WARNING);
            return false;
        }
        return true;
    }

    /**
     * Calculate total amount from items
     */
    public double calculateTotal(List<PaymentItem> items) {
        double total = 0.0;
        if (items != null) {
            for (PaymentItem item : items) {
                total += item.getTotal();
            }
        }
        return total;
    }

    /**
     * Format currency
     */
    public String formatCurrency(double amount) {
        return String.format("%.2f TND", amount);
    }

    /**
     * Show alert dialog
     */
    private void showAlert(String title, String content, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    /**
     * Get mock transaction ID
     */
    public String generateTransactionId() {
        return "TRX" + System.currentTimeMillis() + "_" + (int)(Math.random() * 10000);
    }

    /**
     * Get mock receipt text
     */
    public String generateReceipt(String transactionId, PaymentDetails paymentDetails) {
        StringBuilder receipt = new StringBuilder();
        receipt.append("===== PinkShield Payment Receipt =====\n");
        receipt.append("Transaction ID: ").append(transactionId).append("\n");
        receipt.append("Cardholder: ").append(paymentDetails.getCardholderName()).append("\n");
        receipt.append("Card: **** **** **** ").append(paymentDetails.getCardNumber().substring(Math.max(0, paymentDetails.getCardNumber().length() - 4))).append("\n");
        receipt.append("\n--- Items ---\n");

        for (PaymentItem item : paymentDetails.getItems()) {
            receipt.append(item.getName())
                    .append(" x").append(item.getQuantity())
                    .append(" = ").append(String.format("%.2f", item.getTotal())).append(" TND\n");
        }

        receipt.append("\n--- Summary ---\n");
        receipt.append("Total Amount: ").append(formatCurrency(paymentDetails.getTotalAmount())).append("\n");
        receipt.append("Transaction Time: ").append(java.time.LocalDateTime.now()).append("\n");
        receipt.append("Status: ✅ SUCCESSFUL\n");
        receipt.append("=====================================\n");

        return receipt.toString();
    }
}


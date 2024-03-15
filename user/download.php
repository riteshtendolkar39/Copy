<?php
// Generate and download payment report

require_once('../include/connect.php'); // Include your database connection file here
require_once('../vendor/autoload.php'); // Include Composer autoload.php

use Dompdf\Dompdf;

// Get order details
if (isset($_GET['order_id']) && !empty($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $select_query = "SELECT up.*, ump.quantity, ump.product_id FROM user_payments up JOIN user_myproducts ump ON up.order_id = ump.order_id WHERE up.order_id = $order_id";
    $result = mysqli_query($con, $select_query);
    $payments = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Fetch general details (amount, invoice number, order date, payment mode)
    $first_payment = reset($payments);
    $amount = $first_payment['amount'];
    $invoice_number = $first_payment['invoice_number'];
    $order_date = $first_payment['date'];
    $payment_mode = $first_payment['payment_mode'];

    // Create a new DOMPDF instance
    $dompdf = new Dompdf();

    // HTML content for the payment report
    $num=1;
    $html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment Report</title>
        <style>
            /* Add your custom styles here */
            body {
                font-family: sans-serif;
                margin: 0;
                padding: 0;
            }
            .invoice {
                width: 100%;
                max-width: 800px;
                margin: auto;
                padding: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            }
            .invoice h2,
            .invoice h3 {
                margin-bottom: 15px;
                text-align: center;
            }
            .invoice table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            .invoice th,
            .invoice td {
                padding: 8px;
                border: 1px solid #eee;
                text-align: left;
            }
            .invoice th {
                background-color: #f8f8f8;
            }
        </style>
    </head>
    <body>
        <div class="invoice">
            <h2>Payment Report</h2>
            <p><strong>Invoice Number:</strong> ' . $invoice_number . '</p>
            <p><strong>Amount:</strong> ' . $amount . '</p>
            <p><strong>Payment Mode:</strong> ' . $payment_mode . '</p>
            <p><strong>Order Date:</strong> ' . $order_date . '</p>
            <table>
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Product Total Price</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($payments as $payment) {
        // Fetch product title from products table
        $product_id = $payment['product_id'];
        $product_query = "SELECT product_title FROM products WHERE product_id = $product_id";
        $product_result = mysqli_query($con, $product_query);
        $product_row = mysqli_fetch_assoc($product_result);
        $product_title = $product_row['product_title'];

        // Fetch total price for each product from user_myproducts table
        $total_price_query = "SELECT total_price FROM user_myproducts WHERE order_id = $order_id AND product_id = $product_id";
        $total_price_result = mysqli_query($con, $total_price_query);
        $total_price_row = mysqli_fetch_assoc($total_price_result);
        $total_price = $total_price_row['total_price'];

        $html .= '<tr>';
        $html .= '<td>' . $num++ . '</td>';
        $html .= '<td>' . $product_title . '</td>';
        $html .= '<td>' . $payment['quantity'] . '</td>'; // Display quantity
        $html .= '<td>' . $total_price . '</td>'; // Display total price
        $html .= '</tr>';
    }

    $html .= '</tbody>
        </table>
    </body>
    </html>';

    // Load HTML content into DOMPDF
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF (generate)
    $dompdf->render();

    // Output the generated PDF (force download)
    $dompdf->stream('payment_report.pdf', array('Attachment' => 1));
} else {
    // No order ID provided
    echo 'Error: Order ID not provided.';
}
?>

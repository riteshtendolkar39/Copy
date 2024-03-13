<?php
// Generate and download payment report

require_once('../include/connect.php'); // Include your database connection file here
require_once('../vendor/autoload.php'); // Include Composer autoload.php

use Dompdf\Dompdf;

// Get order details
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $select_query = "SELECT * FROM user_payments WHERE order_id = $order_id";
    $result = mysqli_query($con, $select_query);
    $payments = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                font-family: Arial, sans-serif;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <h2>Payment Report</h2>
        <table>
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Invoice Number</th>
                    <th>Amount</th>
                    <th>Payment Mode</th>
                    <th>Order Status</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($payments as $payment) {
        $html .= '<tr>';
        $html .= '<td>' . $num++ . '</td>';
        $html .= '<td>' . $payment['invoice_number'] . '</td>';
        $html .= '<td>' . $payment['amount'] . '</td>';
        $html .= '<td>' . $payment['payment_mode'] . '</td>';
        $html .= '<td>' . $payment['date'] . '</td>';
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

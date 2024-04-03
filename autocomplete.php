<?php
include('include/connect.php');
if (isset($_GET['query'])) {
    $search_query = $_GET['query'];
    $search_query = mysqli_real_escape_string($con, $search_query);
    $search_query = '%' . $search_query . '%';

    $query = "SELECT product_keywords FROM products WHERE product_keywords LIKE ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $search_query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $product_keywords);

    $results = array();
    while (mysqli_stmt_fetch($stmt)) {
        $keywords_array = explode(',', $product_keywords); // Split keywords by comma
        foreach ($keywords_array as $keyword) {
            $results[] = trim($keyword); // Trim whitespace and add each keyword to results
        }
    }

    mysqli_stmt_close($stmt);

    // Output each keyword as a list item
    foreach ($results as $keyword) {
        echo '<li>' . $keyword . '</li>';
    }
}

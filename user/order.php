<?php


include('../include/connect.php'); 
include('../functions/common_function.php'); 
if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
}

//get total items and total price of all items
$get_ip_address=getIPAddress();
$total_price=0;
$cart_query_price="select * from `cart_details` where ip_address='$get_ip_address'";
$result_cart_price=mysqli_query($con,$cart_query_price);
$invoice_number=mt_rand();  
$status='pending';
$count_products=mysqli_num_rows($result_cart_price);

// Initializing variables to store quantities and product IDs for an order
$product_quantities = array();
$product_ids = array();

while($row_price=mysqli_fetch_array($result_cart_price)){
    $product_id=$row_price['product_id'];
    $product_ids[] = $product_id; // Store product IDs for this order
    
    $quantity = $row_price['quantity'];
    $product_quantities[$product_id] = $quantity; // Store quantity for each product
    
    $select_product="select * from `products` where product_id=$product_id";
    $run_price=mysqli_query($con,$select_product);
    while($row_product_price=mysqli_fetch_array($run_price)){
        // $product_price=array($row_product_price['product_price']);
        // $product_value=array_sum($product_price);
        $product_price=$row_product_price['product_price'];
        $total_price+=$product_price*$quantity;

        $product_value = $product_price * $quantity;
        $product_values[$product_id] = $product_value;
    }    
}


// Inserting user orders
$insert_orders="insert into `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status, quantity) values ($user_id,$total_price,$invoice_number,$count_products,NOW(),'$status', '" . implode(",", $product_quantities) . "')";
$result_query=mysqli_query($con,$insert_orders);
if($result_query){
    echo "<script>alert('Orders are submitted successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";

    // Get the newly inserted order ID
    $order_id = mysqli_insert_id($con);

    // Insert into user_myproducts table simultaneously
    foreach ($product_ids as $product_id) {
        $quantity = $product_quantities[$product_id];
        // $product_value=$product_price*$quantity;
        $insert_my_products = "INSERT INTO `user_myproducts` (order_id, user_id, product_id, quantity,total_price) VALUES ($order_id, $user_id, $product_id, $quantity, " . $product_values[$product_id] . ")";
        mysqli_query($con, $insert_my_products);
    }
}

// Insert pending orders
foreach ($product_ids as $product_id) {
    $quantity = $product_quantities[$product_id];
    $insert_pending_orders="insert into `orders_pending` (user_id,invoice_number,product_id,quantity,order_status) values ($user_id,$invoice_number,$product_id,$quantity,'$status')";
    $result_pending_orders=mysqli_query($con,$insert_pending_orders);
}

//delete items from cart
$empty_cart="delete from `cart_details` where ip_address='$get_ip_address'";
$result_delete=mysqli_query($con,$empty_cart);

?>
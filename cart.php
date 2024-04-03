<?php
include('include/connect.php');
include('functions/common_function.php');
session_start();
?>
<?php
// Check if the form is submitted for updating quantities
if (isset($_POST['update_cart'])) {
    // Loop through the posted quantities and update the cart
    foreach ($_POST['qty'] as $update_id => $quantity) {
        // Ensure quantity is a valid positive integer
        $quantity = (int)$quantity;
        if ($quantity > 0) {
            // Update the cart for the specific product
            $update_cart = "UPDATE cart_details SET quantity = $quantity WHERE product_id = $update_id";
            $result_update = mysqli_query($con, $update_cart);
            // if ($result_update) {
            //     // Quantity updated successfully
            //     echo "Quantity for Product ID $update_id updated successfully.<br>";
            // } else {
            //     // Error updating quantity
            //     echo "Error updating quantity for Product ID $update_id.<br>";
            // }
        }
        // else {
        //     // Invalid quantity
        //     echo "Invalid quantity for Product ID $update_id.<br>";
        // }
    }
}

// Rest of your HTML and PHP code...

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Book Shopping Ecommerce Website</title>

    <!-- bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--css files-->
      <link rel="stylesheet" href="./css/style2.css">

    <style>
        .cart_img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .logo {
            width: 3%;
            height: 3%;
            border-radius: 25px;
        }
    </style>
</head>

<body>
    <!-- navbar-->
    <div class="container-fluid p-0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg bg-info ">
    <div class="container-fluid">
        <img src="./images/logo2.jpeg" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item ">
                    <a class="nav-link"></a>
                </li>
                <li class="nav-item click">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item click">
                    <a class="nav-link" aria-current="page" href="display_all.php">All Products</a>
                </li>
                <li class="nav-item click">
                    <a class="nav-link" aria-current="page" href="about.php">About</a>
                </li>
                <li class="nav-item click">
                    <a class="nav-link" href="contact.php" aria-current="page">Contact</a>
                </li>
                <?php
                if (isset($_SESSION['user_email'])) {
                    echo "<li class='nav-item click'>
                            <a class='nav-link' href='./user/Profile.php'>My Profile</a>
                        </li>";
                } else {
                    echo "<li class='nav-item click'>
                            <a class='nav-link' aria-current='page' href='./user/user_registration.php'>Register</a>
                        </li>";
                }
                if (isset($_SESSION['user_email'])) {
                    echo "<li class='nav-item ms-2'>
                             <a href='./user/logout.php' class='nav-link'>Logout</a>
                         </li>";
                } else {
                    echo "<li class='nav-item click'>
                              <a class='nav-link' href='./user/user_login.php'>Login</a>
                            </li>";
                }
                ?>
                <li class="nav-item click">
                    <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                </li>
                <li class="nav-item click">
                    <a class="nav-link" href="#">Total Price:<?php total_cart_price(); ?>/-</a>
                </li>
            </ul>
            <ul class="navbar-nav pe-3 mb-2 mb-lg-0">
                <?php
                $user_ip = getIPAddress();
                $select_query_name = "select * from `user_table` where user_ip='$user_ip'";
                $result_name = mysqli_query($con, $select_query_name);
                $row_name = mysqli_fetch_assoc($result_name);
                $username = $row_name['username'];
                 if (isset($_SESSION['user_email'])) {
                    echo "<li class='nav-item  click'>
                    <a href='#' class='nav-link'>Welcome " . $username . "</a>
                </li>";
                } else {
                    echo "<li class='nav-item  click'>
                    <a href='#' class='nav-link'>Welcome Guest</a>
                </li>";
                }
                ?></ul>
    </div>
</nav>

        <!-- calling cart function -->
        <?php cart(); ?>


        <!--second child-->
        <div class="text-center bg-light mt-5 text-primary">
            <h1>Online Book Shop</h1>
        </div>


        <!-- third child cart-table -->
        <div class="container mt-5">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">
                        <!-- php code to display dynamic data  -->
                        <?php
                        $get_ip_address = getIPAddress();
                        $total_price = 0;
                        $cart_query = "Select * from `cart_details` where ip_address='$get_ip_address'";
                        $result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result);
                        if ($result_count > 0) {
                            echo "                        <thead>
                                <tr>
                                    <th>Book Title</th>
                                    <th>Book Image</th>
                                    <th>Quantity</th>
                                    <th>Product Price</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                             </thead> <tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                $product_id = $row['product_id'];
                                $qty = $row['quantity'];
                                $select_products = "Select * from `products` where product_id=$product_id";
                                $result_products = mysqli_query($con, $select_products);
                                while ($row_product = mysqli_fetch_array($result_products)) {
                                    $product_price = array($row_product['product_price']);
                                    $product_title = $row_product['product_title'];
                                    $price_table = $row_product['product_price'];
                                    $product_image = $row_product['product_image'];
                                    // $product_value = array_sum($product_price);
                                    // $total_price += $product_value;



                        ?>
                                    <tr>
                                        <td> <?php echo "$product_title"; ?></td>
                                        <td><img src="./admin/product_images/<?php echo "$product_image"; ?>" alt="" class="cart_img"></td>
                                        <td><input type="number" min="1" value="<?php echo $qty ?>" name="qty[<?php echo $product_id; ?>]" class="form-input w-10 border border-2"> <input type="submit" value="Update" class="bg-info mx-3 px-3 py-2 border-0 rounded-3" name="update_cart"></td>
                                        <td><?php echo "$price_table"; ?></td>
                                        <td>
                                            <?php echo $subtotal = number_format($price_table * $qty);
                                            // if(isset($_POST['update_cart'])){
                                            // $grand_total=0;
                                            // $total_price=$grand_total+$subtotal;
                                            // }
                                            $total_price += ($price_table * $qty);
                                            ?>
                                        </td>
                                        <td>
                                            <a href="cart.php?remove=<?php echo $product_id ?>" onclick="return confirm('Are you sure you want to delete this item')">
                                                <h3 class="mt-2"><i class="fas fa-trash"></i></h3>
                                            </a>
                                        </td>
                                    </tr>

                        <?php
                                }
                            
                            }
                            echo "<tr>
                            <td colspan='4'><h4>SubTotal</h4></td>
                            <td><h5>₹ $total_price</h5></td>
                            <td></td>
                    </tr>";
                        } else {
                            echo "<h2 class='text-center text-danger'>Cart is Empty</h2>";
                        }
                        ?>


                        </tbody>
                    </table>
                    <!-- subtotal  -->
                    <div class="d-flex mb-5">

                        <?php
                        $get_ip_address = getIPAddress();
                        // $total_price = 0;
                        $cart_query = "Select * from `cart_details` where ip_address='$get_ip_address'";
                        $result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result);
                        if ($result_count > 0) {
                            echo "
                                <input type='submit' value='Continue Shopping' class='bg-info px-3 mx-3 py-2 border-0 rounded-3' name='continue_shopping'>                                
                                <button class='bg-secondary p-3 py-2 border-0 rounded-3'><a href='./user/checkout.php' class='text-light text-decoration-none '>Checkout</a></button>'";
                        } else {
                            echo "<input type='submit' value='Continue Shopping' class='bg-info px-3 mx-3 py-2 border-0 rounded-3' name='continue_shopping'>";
                        }
                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                        ?>
                    </div>
            </div>
        </div>
        </form>

        <!-- function to remove items -->
        <?php
        if (isset($_GET['remove'])) {
            $remove_id = $_GET['remove'];
            $delete_query = "Delete from `cart_details` where product_id=$remove_id";
            $result_delete = mysqli_query($con, $delete_query);
            echo "<script>window.open('cart.php','_self')</script>";
        }
        ?>

        <!--last child-->
        <?php include('./footer/footer.php') ?>



        <!-- bootstrap js link-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
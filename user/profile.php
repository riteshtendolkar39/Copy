<?php
include('../include/connect.php');
include('../functions/common_function.php');
session_start();

$user_email = $_SESSION['user_email'];
$user_image_query = "select * from `user_table` where user_email='$user_email'";
$result_image = mysqli_query($con, $user_image_query);
$row_image = mysqli_fetch_array($result_image);
$user_image = $row_image['user_image'];
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
    <link rel="stylesheet" href="../style.css">
    <style>
        .logo {
            width: 3%;
            height: 3%;
            border-radius: 25px;
        }

        body {
            overflow-x: hidden;
        }

        .profile_img {
            width: 90%;
            margin: auto;
            display: block;
            /* height:100%; */
            object-fit: contain;
        }

        .edit_image {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <!-- navbar-->
    <div class="container-fluid p-0">
        <!--first child-->
        <?php
include('../include/header.php');
?>

        <!-- calling cart function -->
        <?php cart(); ?>


        <!--second child-->

        <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a href="#" class="nav-link">Welcome Guest</a>
        </li>
        <li class="nav-item">
          <a href="user_login.php/logout.php" class="nav-link">Logout</a>
        </li>
      </ul>
    </nav> -->

        <div class="text-center bg-light mt-5 text-primary">
            <h1>Online Book Shop</h1>
        </div>


        <!-- third child -->
        <div class="row">
            <div class="col-md-10 text-center">
                <?php get_user_order_details();
                if (isset($_GET['edit_account'])) {
                    include('./edit_account.php');
                }
                if (isset($_GET['my_orders'])) {
                    include('./my_order.php');
                }
                if (isset($_GET['delete_account'])) {
                    include('./delete_account.php');
                }
                if(isset($_GET['my_products'])){
                    include('./my_products.php');
                }
                ?>
            </div>
            <div class="col-md-2">
                <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
                    <li class="nav-item bg-info">
                        <a class="nav-link text-light" href="#">
                            <h4>Your Profile</h4>
                            <?php echo "<li class='nav-item'>
<img src='./user_images/$user_image' class='profile_img my-4'>
</li>"; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php">
                            Pending Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?edit_account">
                            Edit Acount
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?my_orders">
                            My Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?my_products">
                        Product History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?delete_account">
                            Delete Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="logout.php">
                            Logout
                    </li>
                </ul>
            </div>
        </div>


        <!--last child-->
        <?php include('../footer/footer.php') ?>



        <!-- bootstrap js link-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
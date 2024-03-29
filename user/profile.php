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
    <link rel="stylesheet" href="../css/style2.css">
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

        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="../images/logo2.jpeg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item click">
                            <a class="nav-link"></a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link" aria-current="page" href="../display_all.php">All Products</a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link" aria-current="page" href="../about.php">About</a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link" href="../contact.php" aria-current="page">Contact</a>
                        </li>
                        <?php
                        if (isset($_SESSION['user_email'])) {
                            echo "            <li class='nav-item click'>
                            <a class='nav-link' href='../user/profile.php'>My Profile</a>
                          </li>";
                        } else {
                            echo "            <li class='nav-item click'>
                            <a class='nav-link' aria-current='page' href='./user/user_registration.php'>Register</a>
                          </li>";
                        }
                        ?>
                        <li class="nav-item click">
                            <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link" href="#">Total Price:<?php total_cart_price(); ?>/-</a>
                        </li>

                    </ul>
                    <?php
                    // $username = substr($_SESSION["user_email"], 0, strpos($_SESSION["user_email"], '@'));

                    //username


                    if (!isset($_SESSION['user_email'])) {
                        echo "
                            </ul>
                        </div>
                    </div>
                </nav>
                            <nav class='navbar navbar-expand-lg navbar-dark bg-secondary'>
                            <ul class='navbar-nav me-auto d-flex'>
                              <li class='nav-item click1'>
                                <a href='#' class='nav-link'>Welcome Guest</a>
                                </li>
                                <li class='nav-item click1'>
                                <a class='nav-link' href='./user/user_login.php'>Login</a>
                              </li>
                            </ul>
                          </nav>";
                    } else {
                        $user_ip = getIPAddress();
                        $select_query_name = "select * from `user_table` where user_ip='$user_ip'";
                        $result_name = mysqli_query($con, $select_query_name);
                        $row_name = mysqli_fetch_assoc($result_name);
                        $username = $row_name['username'];
                        echo "
                            </form>
                            </ul>
                        </div>
                    </div>
                </nav>
                            <nav class='navbar navbar-expand-lg navbar-dark bg-secondary'>
                            <ul class='navbar-nav me-auto'>
                              <li class='nav-item'>
                                <a href='#' class='nav-link'>Welcome " . $username . "</a>
                              </li>
                              <li class='nav-item ms-2'>
                                <a href='./user/logout.php' class='nav-link'>Logout</a>
                              </li>
                            </ul>
                          </nav>";
                    }

                    ?>
                    </form>
                    </ul>
                </div>
            </div>
        </nav>


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
                if (isset($_GET['my_products'])) {
                    include('./my_products.php');
                }
                if (isset($_GET['my_products'])) {
                    include('./my_products.php');
                }
                ?>
            </div>
            <div class="col-md-2">
                <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
                    <li class="nav-item bg-info click1">
                        <a class="nav-link text-light" href="#">
                            <h4>Your Profile</h4>
                            <?php echo "<li class='nav-item'>
<img src='./user_images/$user_image' class='profile_img my-4'>
</li>"; ?>
                        </a>
                    </li>
                    <li class="nav-item click1">
                        <a class="nav-link text-light" href="profile.php">
                            Pending Orders
                        </a>
                    </li>
                    <li class="nav-item click1">
                        <a class="nav-link text-light" href="profile.php?edit_account">
                            Edit Acount
                        </a>
                    </li>
                    <li class="nav-item click1">
                        <a class="nav-link text-light" href="profile.php?my_orders">
                            My Orders
                        </a>
                    </li>
                    <li class="nav-item click1">
                        <a class="nav-link text-light" href="profile.php?my_products">
                            Product History
                        </a>
                    </li>
                    <li class="nav-item click1">
                        <a class="nav-link text-light" href="profile.php?delete_account">
                            Delete Account
                        </a>
                    </li>
                    <li class="nav-item click1">
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
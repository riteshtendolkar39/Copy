<?php
include('../include/connect.php');
function getip()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--css files-->
    <link rel="stylesheet" href="../css/style2.css">
</head>

<body>
    <div class="container-fluid p-0">
        <!--first child-->
        <!-- navbar-->
        <nav class="navbar navbar-expand-lg bg-info ">
            <div class="container-fluid">
                <img src="../images/logo2.jpeg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item ">
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
                            echo "<li class='nav-item click'>
                            <a class='nav-link' href='../user/profile.php'>My Profile</a>
                        </li>";
                        } else {
                            echo "<li class='nav-item click'>
                            <a class='nav-link' aria-current='page' href='../user/user_registration.php'>Register</a>
                        </li>";
                        }
                        if (isset($_SESSION['user_email'])) {
                            echo "<li class='nav-item ms-2'>
                             <a href='../user/logout.php' class='nav-link'>Logout</a>
                         </li>";
                        } else {
                            echo "<li class='nav-item click'>
                              <a class='nav-link' href='../user/user_login.php'>Login</a>
                            </li>";
                        }
                        ?>
                    </ul>
                    <ul class="navbar-nav pe-3 mb-2 mb-lg-0">
                        <?php
                        $user_ip = getip();
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


        <!--second child-->
        <!--products-->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="row">
                    <?php
                    if (!isset($_SESSION['user_email'])) {
                        include('./user_login.php');
                    } else {
                        include('payment.php');
                    }
                    ?>
                </div>
            </div>
        </div>

        <!--last child-->
        <?php include('../footer/footer.php') ?>
    </div>

    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
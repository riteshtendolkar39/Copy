<?php
include('include/connect.php');
include('functions/common_function.php');
session_start();
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./css/style2.css">
<style>
      .title {
   height: 25vw;
   background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('./book.jpg');
   text-align: center;
   color: white;
   padding: 10vw;
 }
</style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#search_data').keyup(function() {
                var query = $(this).val();
                if (query != '') {
                    $.ajax({
                        url: "autocomplete.php",
                        method: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            $('#search_data_list').fadeIn();
                            $('#search_data_list').html(data);
                        }
                    });
                }
            });

            // Modify this part to handle clicks on autocomplete items
            $(document).on('click', '#search_data_list li', function() {
                var keyword = $(this).text().trim(); // Get the clicked keyword
                $('#search_data').val(keyword); // Populate the search box with the clicked keyword
                $('#search_data_list').fadeOut();
            });
        });
    </script>
</head>

<body>
    <!-- navbar-->
    <div class="container-fluid p-0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="./images/logo.jpg" alt="" class="logo">
                <a class="navbar-brand ms-2 text-secondary" href="index.php">Books</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <form class="d-flex" action="search_product.php" method="get">
                            <div class="autocomplete">
                                <input type="text" id="search_data" name="search_data" class="mr-2" placeholder="Search products...">
                                <ul id="search_data_list"></ul>
                            </div>
                            <button type="submit" class="btn btn-outline-success" name="search_data_product">
                                <i class="fas fa-search"></i> <!-- Search icon -->
                            </button>
                        </form>

                        <li class="nav-item click">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link active" aria-current="page" href="display_all.php">All Products</a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link active" aria-current="page" href="about.php">About</a>
                        </li>
                        <li class="nav-item click">
                            <a class="nav-link active" href="contact.php" aria-current="page">Contact</a>
                        </li>
                        <?php
                        if (isset($_SESSION['user_email'])) {
                            echo "            <li class='nav-item click'>
                            <a class='nav-link' href='./user/Profile.php'>My Profile</a>
                          </li>";
                        } else {
                            echo "            <li class='nav-item click'>
                            <a class='nav-link active' aria-current='page' href='./user/user_registration.php'>Register</a>
                          </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price:<?php total_cart_price(); ?>/-</a>
                        </li>

                    </ul>
                    <form class="d-flex" role="login">
                        <?php


                        if (!isset($_SESSION['user_email'])) {
                            echo " <button type='submit' class='btn btn-outline-success'><a class='nav-link' href='./user/user_login.php'>Login</a></button>
                            
                            </form>
                            </ul>
                        </div>
                    </div>
                </nav>
                            <nav class='navbar navbar-expand-lg navbar-dark bg-secondary'>
                            <ul class='navbar-nav me-auto'>
                              <li class='nav-item'>
                                <a href='#' class='nav-link'>Welcome Guest</a>
                              </li>
                            </ul>
                          </nav>";
                        } else {
                            //username
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
                              <li class='nav-item'>
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


        <!--second child-->
        <div class="title">
            <h1>If you want to make intelligent, get books from here</h1>
            <p>Shop now!</p>
        </div>


        <!--third child-->
        <!--products-->
        <div class="row mt-5">
            <div class="col-md-2 bg-secondary  p-0">
                <!-- category -->
                <ul class="navbar-nav  me-auto text-center ">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light ">
                            <h4>Categories</h4>
                        </a>
                    </li>
                    <?php
                    // calling function
                    getcategories();
                    ?>
                </ul>
                <!-- sub-categories -->
                <ul class="navbar-nav  me-auto text-center ">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light ">
                            <h4>Sub Categories</h4>
                        </a>
                    </li>
                    <?php
                    // calling function
                    getsubcategories();
                    ?>
                </ul>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <!-- fetching products -->
                    <?php
                    // calling function
                    get_all_products();
                    get_unqiue_category();
                    get_unqiue_subcategory();
                    ?>
                </div>
            </div>
        </div>


        <!--last child-->
        <?php include('./footer/footer.php') ?>



        <!-- bootstrap js link-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
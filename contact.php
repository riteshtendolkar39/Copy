<?php
include('include/connect.php');
include('functions/common_function.php');
session_start();
if(isset($_POST['send'])){

  $name = $_POST['name'];
  $email = $_POST['email'];
  $number = $_POST['number'];
  $msg = $_POST['message'];
  $get_ip_address=getIPAddress();
  $select_message = mysqli_query($con,"SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'");

  if(mysqli_num_rows($select_message) > 0){
     $message[] = 'message sent already!';
  }else{
     mysqli_query($con, "INSERT INTO `message`(ip_address, name, email, number, message) VALUES('$get_ip_address', '$name', '$email', '$number', '$msg')") or die('query failed');
     $message[] = 'message sent successfully!';
  }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Online Book Shopping Ecommerce Website</title>

  <!-- bootstrap css link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <!-- font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--css files-->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="./css/style1.css">

  <style>
    .logo {
      width: 100%;
      max-width: 50px;
      /* Adjust the max-width as needed */
      height: auto;
      border-radius: 25px;
    }


    body {
      margin-top: 56px;
      /* Height of the fixed navbar */
      overflow-x: hidden;
    }

    .title {
      height: 25vw;
      background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('./book.jpg');
      text-align: center;
      color: white;
      padding: 10vw;
    }

    /* Add responsive styles */
    @media screen and (max-width: 768px) {
      .title {
        height: auto;
        /* Adjust height as needed */
        padding: 5vw;
        /* Reduce padding for smaller screens */
      }
    }

    .autocomplete {
      position: relative;
    }

    #search_data {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    #search_data_list {
      position: absolute;
      width: 100%;
      z-index: 99;
      background-color: #fff;
      list-style: none;
      padding: 0;
      margin: 0;
      border: 1px solid #ccc;
      border-top: none;
      border-radius: 0 0 5px 5px;
      display: none;
    }

    #search_data_list li {
      padding: 10px;
      cursor: pointer;
    }

    #search_data_list li:hover {
      background-color: #f4f4f4;
    }

    .click:hover {
      font-weight: 900;
      /* font-size:17px; */
    }

    .click1:hover {
      background-color: rgb(128, 128, 128, 1);
      font-size: 17px;
      font-weight: 600;
    }

    .click2:hover {
      background-color: rgb(0, 183, 249, 1);
      font-size: 17px;
      font-weight: 600;
    }

    .footer {
      background-color: rgb(0, 183, 249, 1);
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
    <nav class="navbar navbar-expand-lg bg-info fixed-top fs-4">
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
              <button type="submit" class="btn btn-outline-success m-1 p-1" name="search_data_product">
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
              <a class="nav-link active" href="#" aria-current="page">Contact</a>
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
              <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
            </li>
          </ul>
          <form class="d-flex" role="login">
            <?php
            // $username = substr($_SESSION["user_email"], 0, strpos($_SESSION["user_email"], '@'));

            //username


            if (!isset($_SESSION['user_email'])) {
              echo " <button type='submit' class='btn btn-outline-success fs-4'><a class='nav-link' href='./user/user_login.php'>Logins</a></button>
              
              </form>
                            </ul>
                        </div>
                    </div>
                </nav>
                            <nav class='navbar navbar-expand-lg navbar-dark bg-light'>
                            <ul class='navbar-nav me-auto'>
                              <li class='nav-item'>
                                <a href='#' class='nav-link text-dark fs-4'>Welcome Guest</a>
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
                            <nav class='navbar navbar-expand-lg navbar-dark bg-light'>
                            <ul class='navbar-nav me-auto'>
                              <li class='nav-item'>
                                <a href='#' class='nav-link text-dark fs-4'>Welcome " . $username . "</a>
                              </li>
                              <li class='nav-item ms-2'>
                                <a href='./user/logout.php' class='nav-link text-dark fs-4'>Logout</a>
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
    <div class="heading">
      <h3>Contact Us</h3>
      <p> <a href="index.php">home</a> / about </p>
    </div>
    <section class="contact">

   <form action="" method="post">
      <h3>say something!</h3>
      <input type="text" name="name" required placeholder="enter your name" class="box">
      <input type="email" name="email" required placeholder="enter your email" class="box">
      <input type="number" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>



    <!--last child-->
    <?php include('./footer/footer.php') ?>



    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
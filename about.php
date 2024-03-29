<?php
include('include/connect.php');
include('functions/common_function.php');
session_start();
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
  <!-- <link rel="stylesheet" href="./css/style2.css"> -->
  <link rel="stylesheet" href="./css/style2.css">
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
    <?php
    include('include/header.php');
    ?>

    <div class="title2">
      <h3>about us</h3>
      <p> <a href="index.php">home</a> / about </p>
    </div>
    <section class="about d-flex justify-content-center">
      <div class="row">
        <div class="flex">

          <div class="image">
            <img src="images/about-img.jpg" alt="">
          </div>

          <div class="content">
            <h3>why choose us?</h3>
            <p>Our mission is to provide customers with a convenient, affordable, and accessible way to purchase books.We believe that everyone should have access to a wide selection of titles at affordable prices.</p>
            <p>We offer features like friendly user interface, wide selection of books, selection based on search and categories & sub-categories</p>
            <a href="contact.php" class="btn1">contact us</a>
          </div>
        </div>
      </div>

    </section>



    <!--last child-->
    <?php include('./footer/footer.php') ?>



    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
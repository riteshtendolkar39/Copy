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
    <!-- calling cart function -->
    <?php cart(); ?>

    <section>
      <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active title1">
            <img src="./images/title1.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>If you want to be intelligent, get books from here</h1>
              <p>Shop now!</p>
            </div>
          </div>
          <div class="carousel-item title1">
            <img src="./images/title2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <p>Shop now!</p>
            </div>
          </div>
          <div class="carousel-item title1">
            <img src="./images/title3.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <p>Shop now!</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>



    <!--third child-->
    <!--products-->
    <div class="mt-5 container">
      <div class="row">
        <!-- fetching products -->
        <?php
        // calling function
        getproducts();
        ?>
      </div>
    </div>
    <div style="margin-top: 2rem; text-align:center">
      <a href="display_all.php" class="option-btn">load more</a>
    </div>

    <section class="about mt-5">

      <div class="flex">

        <div class="image">
          <img src="./images/about-img.jpg" alt="">
        </div>

        <div class="content">
          <h3>about us</h3>
          <p>Our mission is to provide customers with a convenient, affordable, and accessible way to purchase books.We believe that everyone should have access to a wide selection of titles at affordable prices.</p>
          <a href="about.php" class="btn1">read more</a>
        </div>

      </div>

    </section>

    <!--last child-->
    <?php include('./footer/footer.php') ?>



    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
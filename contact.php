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
      /* Height of the fixed navbar */
      overflow-x: hidden;
    }

    .title2 {
      min-height: 30vh;
      display: flex;
      flex-flow: column;
      align-items: center;
      justify-content: center;
      gap: 1rem;
      background: url('./images/heading-bg.webp') no-repeat;
      background-size: cover;
      background-position: center;
      text-align: center;
    }

    /* Add responsive styles */
    @media screen and (max-width: 768px) {
      .title2 {
        height: auto;
        /* Adjust height as needed */
        padding: 5vw;
        /* Reduce padding for smaller screens */
      }
    }

.contact {
  margin: 50px auto;
  max-width: 600px;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border:1px solid black;
}

.box {
  width: 100%;
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid black;
  border-radius: 5px;
  font-size: 16px;
}

.box:focus {
  outline: none;
  border-color: #007bff; /* change to your preferred focus color */
}

.box::placeholder {
  color: black;
}

textarea.box {
  resize: vertical;
  min-height: 100px;
}

.button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-left:40%;
}

.button:hover {
  background-color: #0056b3; /* darker shade of primary color */
}
@media screen and (max-width: 768px) {
  .contact {
    margin: 20px;
    padding: 10px;
  }
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
    <?php
    include('include/header.php');
    ?>
    <div class="title2">
      <h3>about us</h3>
      <p> <a href="index.php">home</a> / about </p>
    </div>
      <section class="contact">
   <form action="" method="post">
      <h3 class="text-center">say something!</h3>
      <input type="text" name="name" required placeholder="enter your name" class="box">
      <input type="email" name="email" required placeholder="enter your email" class="box">
      <input type="number" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn bg-primary button">
   </form>
</section>



    <!--last child-->
    <?php include('./footer/footer.php') ?>



    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
<?php
include('../include/connect.php');
if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $keyword = $_POST['keyword'];
    $author = $_POST['author'];
    $product_category = $_POST['product_category'];
    $product_subcategory = $_POST['product_subcategory'];
    $price = $_POST['price'];
    $product_status = 'true';

    // accessing images
    $product_image = $_FILES['product_image']['name'];

    //accessing image temporary name
    $temp_image = $_FILES['product_image']['tmp_name'];

    //checking empty condition
    if ($product_title == '' or $description == '' or $keyword == '' or $author == '' or $product_category == '' or $product_subcategory == '' or $price == '' or $product_status == '' or $product_image == '') {
        echo "<script>alert('Please fill all the available fields')</script>";
    } else {
        move_uploaded_file($temp_image, "./product_images/$product_image");
        //insert query
        $insert_query = "insert into `products` (product_title,product_description,product_keywords,product_author,category_id,subcat_id,product_image,product_price,date,status) values ('$product_title','$description','$keyword','$author','$product_category','$product_subcategory','$product_image','$price',NOW(),'$product_status')";
        $result_query = mysqli_query($con, $insert_query);
        if ($result_query) {
            echo "<script>alert('Successfully inserted the products')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product </title>
    <!-- bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--css files-->
  </head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Enter product title" autocomplete="off" required="required">
            </div>
            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product description</label>
                <input type="text" class="form-control" name="description" id="description" placeholder="Enter product description" autocomplete="off" required="required">
            </div>

            <!-- keyword -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="keyword" class="form-label">Product keyword</label>
                <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Enter product keyword " autocomplete="off" required="required">
            </div>

            <!-- author -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="author" class="form-label">Product author</label>
                <input type="text" class="form-control" name="author" id="author" placeholder="Enter author" autocomplete="off" required="required">
            </div>

            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Select a Category</option>
                    <?php
                    $select_query = "select * from `categories`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- sub-categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_subcategory" id="" class="form-select">
                    <option value="">Select a Sub-Category</option>
                    <?php
                    $select_query = "select * from `subcat`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $subcat_title = $row['subcat_title'];
                        $subcat_id = $row['subcat_id'];
                        echo "<option value='$subcat_id'>$subcat_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- images -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image" class="form-label">Product image</label>
                <input type="file" class="form-control" name="product_image" id="product_image" required="required">
            </div>

            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="price" class="form-label">Product price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Enter product price " autocomplete="off" required="required">
            </div>

            <!-- submit -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" class="btn btn-info mb-3 px-3" name="insert_product" value="Insert Products">
            </div>
        </form>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>
</head>

<body>
    <?php
    if (isset($_GET['edit_products'])) {
        $edit_id = $_GET['edit_products'];
        $get_data = "select * from `products` where product_id=$edit_id";
        $result = mysqli_query($con, $get_data);
        $row = mysqli_fetch_assoc($result);
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_keywords = $row['product_keywords'];
        $product_author = $row['product_author'];
        $category_id = $row['category_id'];
        $subcat_id = $row['subcat_id'];
        $product_image = $row['product_image'];
        $product_price = $row['product_price'];
    }
    //categories
    $select_category = "select * from `categories` where category_id=$category_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $category_title = $row_category['category_title'];

    //sub-categories
    $select_subcategory = "select * from `subcat` where subcat_id=$subcat_id";
    $result_subcategory = mysqli_query($con, $select_subcategory);
    $row_subcategory = mysqli_fetch_assoc($result_subcategory);
    $subcat_title = $row_subcategory['subcat_title'];
    ?>
    <div class="container mt-5">
        <h1 class="text-center text-danger">Edit Products</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline m-auto w-50 mb-4">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" id="product_title" name="product_title" class="form-control" required="required" value="<?php echo $product_title ?>">
            </div>
            <div class="form-outline m-auto w-50 mb-4">
                <label for="product_desc" class="form-label">Product Description</label>
                <input type="text" id="product_desc" name="product_desc" class="form-control" required="required" value="<?php echo $product_description ?>">
            </div>
            <div class="form-outline m-auto w-50 mb-4">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" id="product_keywords" name="product_keywords" class="form-control" required="required" value="<?php echo $product_keywords ?>">
            </div>
            <div class="form-outline m-auto w-50 mb-4">
                <label for="product_author" class="form-label">Product Author</label>
                <input type="text" id="product_author" name="product_author" class="form-control" required="required" value="<?php echo $product_author ?>">
            </div>
            <div class="form-outline m-auto w-50 mb-4">
                <label for="product_category" class="form-label">Product Categories</label>
                <select name="product_category" class="form-select">
                    <option value="<?php echo $category_title ?>"><?php echo $category_title ?></option>
                    <?php
                    //categories all
                    $select_category_all = "select * from `categories`";
                    $result_category_all = mysqli_query($con, $select_category_all);
                    while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                        $cat_title = $row_category_all['category_title'];
                        $cat_id = $row_category_all['category_id'];
                        echo "<option value='$cat_id'>$cat_title</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-outline m-auto w-50 mb-4">
                <label for="product_subcategory" class="form-label">Product Sub-Categories</label>
                <select name="product_subcategory" class="form-select">
                    <option value="<?php echo $subcat_title ?>"><?php echo $subcat_title ?></option>
                    <?php
                    //sub-categories all
                    $select_subcategory_all = "select * from `subcat`";
                    $result_subcategory_all = mysqli_query($con, $select_subcategory_all);
                    while ($row_subcategory_all = mysqli_fetch_assoc($result_subcategory_all)) {
                        $subcat_title = $row_subcategory_all['subcat_title'];
                        $subcat_id = $row_subcategory_all['subcat_id'];
                        echo "<option value='$subcat_id'>$subcat_title</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-outline m-auto w-50 mb-4">
                <label for="product_image" class="form-label">Product Image</label>
                <div class="d-flex">
                    <input type="file" id="product_image" name="product_image" class="form-control w-90 m-auto" required="required">
                    <img src="./product_images/<?php echo $product_image ?>" alt="" class="product_img">
                </div>
            </div>
            <div class="form-outline m-auto w-50 mb-4">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" id="product_price" name="product_price" class="form-control" required="required" value="<?php echo $product_price ?>">
            </div>
            <div class="m-auto w-50">
                <input type="submit" name="edit_product" class="btn btn-info px-3 mb-3" value="Update Product">
            </div>
        </form>
    </div>


    <!-- editing products -->
    <?php
    if (isset($_POST['edit_product'])) {
        $product_title = $_POST['product_title'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];
        $product_author = $_POST['product_author'];
        $product_category = $_POST['product_category'];
        $product_subcategory = $_POST['product_subcategory'];
        $product_price = $_POST['product_price'];
        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name'];


        move_uploaded_file($product_image_tmp, "./product_images/$product_image");

        //query to update products
        $update_products = "update `products` set product_title='$product_title',product_description='$product_description',product_keywords='$product_keywords',product_author='$product_author',category_id='$product_category',subcat_id='$product_subcategory',product_image='$product_image',product_price='$product_price',date=NOW() where product_id=$edit_id";
        $result_update = mysqli_query($con, $update_products);
        if ($result_update) {
            echo "<script>alert('Product updated successfully')</script>";
            echo "<script>window.open('./insert_product.php','_self')</script>";
        }
    }
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete products</title>
</head>
<body>
<?php
if(isset($_GET['delete_products'])){
    $delete_id=$_GET['delete_products'];
    // echo $delete_id;
    //delete query


    $delete_query="delete from `products` where product_id=$delete_id";
    $result_product=mysqli_query($con,$delete_query);
    if($result_product){
        echo "<script>alert('Product deleted successfully')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    }
}
?>
</body>
</html>
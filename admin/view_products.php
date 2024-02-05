<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 class="text-center text-success">All Products</h3>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th class="bg-info text-light">Product ID</th>
                <th class="bg-info text-light">Product Ttitle</th>
                <th class="bg-info text-light">Product Image</th>
                <th class="bg-info text-light">Product Price</th>
                <th class="bg-info text-light">Total Sold</th>
                <th class="bg-info text-light">Status</th>
                <th class="bg-info text-light">Edit</th>
                <th class="bg-info text-light">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $get_products="select * from `products`";
            $result=mysqli_query($con,$get_products);
            $num=0;
            while($row=mysqli_fetch_assoc($result)){
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_image=$row['product_image'];
                $product_price=$row['product_price'];
                $status=$row['status'];
                $num++;
                ?>
                <tr class='text-center'>
                <td class='bg-secondary text-light'><?php echo $num ?></td>
                <td class='bg-secondary text-light'><?php echo $product_title ?></td>
                <td class='bg-secondary text-light'><img src='./product_images/<?php echo $product_image ?>' class='product_img'/></td>
                <td class='bg-secondary text-light'><?php echo $product_price ?></td>
                <td class='bg-secondary text-light'>
                <?php 
                $get_count="select * from `orders_pending` where product_id=$product_id";
                $result_count=mysqli_query($con,$get_count);
                $rows_count=mysqli_num_rows($result_count);
                echo $rows_count
                ?>
                </td>
                <td class='bg-secondary text-light'><?php echo $status ?></td>
                <td class='bg-secondary text-light'><a href='' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td class='bg-secondary text-light'><a href='' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products</title>
</head>

<body>
    <?php
    $user_email = $_SESSION['user_email'];
    $get_user = "select * from `user_table` where user_email='$user_email'";
    $result = mysqli_query($con, $get_user);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    ?>
    <h3 class="text-success">All my products</h3>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th class="bg-info">Sr no</th>
                <th class="bg-info">Order Id</th>
                <th class="bg-info">Product Title</th>
                <th class="bg-info">Product Image</th>
                <th class="bg-info">Product Price</th>
            </tr>
        </thead>
        <tbody class="bg-info">
            <?php
            $get_order = "select * from `user_myproducts` where user_id=$user_id";
            $result_order = mysqli_query($con, $get_order);
            // $order_id=$row_products['order_id'];
            $num = 1;
            while ($row_order = mysqli_fetch_assoc($result_order)) {
                $order_id = $row_order['order_id'];
                $product_id = $row_order['product_id'];

                $get_products = "select * from `products` where product_id=$product_id";
                $result_products = mysqli_query($con, $get_products);

                while ($row_data = mysqli_fetch_assoc($result_products)) {
                    $product_title = $row_data['product_title'];
                    $product_image = $row_data['product_image'];
                    $product_price = $row_data['product_price'];
                    echo "<tr>
                                <td class='bg-secondary text-light'>$num</td>
                                <td class='bg-secondary text-light'>$order_id</td>
                                <td class='bg-secondary text-light'>$product_title</td>
                                <td class='bg-secondary text-light'><img src='../images/$product_image' class='edit_image'></td>
                                <td class='bg-secondary text-light'>$product_price</td>";
                    $num++;
                }
            }
            ?>

        </tbody>
    </table>
</body>

</html>
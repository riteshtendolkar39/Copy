<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my orders</title>
</head>

<body>
    <h3 class="text-success">All my Orders</h3>
    <br>
    <!-- filter -->
    <section>
        <form method="post" action="" id="orderForm">
            <div class="form-group row mx-2">
                <label for="start_date" class="col-sm-1 col-form-label">Start Date:</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" id="start_date" name="start_date">
                </div>
                <label for="end_date" class="col-sm-1 col-form-label">End Date:</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" id="end_date" name="end_date">
                </div>
                <div class="col-sm-1 ">
                    <input type="submit" class="btn btn-danger" name="submit" value="Fetch Orders" onclick="validateForm()">
                </div>
                <div class="col-sm-2">
                    <input type="submit" class="btn btn-danger" name="submit1" value="All Orders">
                </div>
            </div>
        </form>
        <script>
            function validateForm() {
                var startDate = document.getElementById('start_date').value;
                var endDate = document.getElementById('end_date').value;

                if (startDate === "" || endDate === "") {
                    alert("Please select both start and end dates.");
                    event.preventDefault(); // Prevent form submission
                }
            }
        </script>
    </section>

    
    <?php
    $user_email = $_SESSION['user_email'];
    $get_user = "select * from `user_table` where user_email='$user_email'";
    $result = mysqli_query($con, $get_user);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    ?>
    <table class="table table-bordered mt-5 mx-2">
        <thead>
            <tr>
                <th class="bg-info">Order Id</th>
                <th class="bg-info">Amount Due</th>
                <th class="bg-info">Total products</th>
                <th class="bg-info">Invoice number</th>
                <th class="bg-info">Date</th>
                <th class="bg-info">Complete/Incomplete</th>
                <th class="bg-info">Status</th>
                <th class="bg-info">Download</th>
            </tr>
        </thead>
        <tbody class="bg-info">
            <?php
            if (isset($_POST['submit'])) {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $get_order = "select * from `user_orders` where user_id=$user_id AND order_date BETWEEN '$start_date' AND '$end_date'";
            } else {
                $get_order = "select * from `user_orders` where user_id=$user_id";
            }
            $result_order = mysqli_query($con, $get_order);
            $num = 1;
            while ($row_order = mysqli_fetch_assoc($result_order)) {
                $order_id = $row_order['order_id'];
                $amount_due = $row_order['amount_due'];
                $total_products = $row_order['total_products'];
                $invoice_number = $row_order['invoice_number'];
                $order_status = $row_order['order_status'];
                if ($order_status == 'pending') {
                    $order_status = 'Incomplete';
                } else {
                    $order_status = 'Complete';
                }
                $order_date = $row_order['order_date'];
                echo "<tr>
                                <td class='bg-secondary text-light'>$num</td>
                                <td class='bg-secondary text-light'>$amount_due</td>
                                <td class='bg-secondary text-light'>$total_products</td>
                                <td class='bg-secondary text-light'>$invoice_number</td>
                                <td class='bg-secondary text-light'>$order_date</td>
                                <td class='bg-secondary text-light'>$order_status</td>";
            ?>
            <?php
                if ($order_status == 'Complete') {
                    echo "<td class='bg-secondary text-light'>Paid</td>";
                    echo "<td class='bg-danger text-light'><a href='download.php?order_id=$order_id' class='text-light'>Download Receipt</a></td>";
                } else {
                    echo "  <td class='bg-secondary'><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td>";
                    echo "<td class='bg-secondary text-light'>Download Receipt</td></tr>";
                }
                $num = $num + 1;
            }

            ?>

        </tbody>
    </table>
</body>

</html>
<h3 class="text-center text-success">ALl orders</h3>
<br>
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
        <div class="col-sm-2 ">
            <input type="submit" class="btn btn-danger" name="submit" value="Fetch Orders" onclick="validateForm()">
        </div>
        <div class="col-sm-1">
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

<table class="table table-bordered mt-5">
    <thead>
        <?php
        if (isset($_POST['submit'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $get_order = "select * from `user_orders` where order_date BETWEEN '$start_date' AND '$end_date'";
        } else {
            $get_order = "select * from `user_orders`";
        }
        $result = mysqli_query($con, $get_order);
        $row_count = mysqli_num_rows($result);
        if ($row_count == 0) {
            echo "<h2 class='text-center mt-5 text-danger'>No orders yet </h2>";
        } else {
            echo "        <tr class='text-center'>
                <th class='bg-info text-light'>Sr no</th>
                <th class='bg-info text-light'>Amount Due</th>
                <th class='bg-info text-light'>Invoice number</th>
                <th class='bg-info text-light'>Total Products</th>
                <th class='bg-info text-light'>Order Date</th>
                <th class='bg-info text-light'>Status</th>
                <th class='bg-info text-light'>Delete</th>
            </tr>
        </thead>
        <tbody>";
            $num = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $user_id = $row_data['user_id'];
                $amount_due = $row_data['amount_due'];
                $invoice_number = $row_data['invoice_number'];
                $total_products = $row_data['total_products'];
                $order_date = $row_data['order_date'];
                $order_status = $row_data['order_status'];
                $num++;
                echo "                <tr class='text-center'>
                    <td class='bg-secondary text-light'>$num</td>
                    <td class='bg-secondary text-light'>$amount_due</td>
                    <td class='bg-secondary text-light'>$invoice_number</td>
                    <td class='bg-secondary text-light'>$total_products</td>
                    <td class='bg-secondary text-light'>$order_date</td>
                    <td class='bg-secondary text-light'>$order_status</td>
                    <td class='bg-secondary text-light'><a href='index.php?delete_orders=$order_id' type='button' class='text-light' data-toggle='modal' data-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
                                    </tr>";
            }
        }
        ?>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Are you sure you want to delete this?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"><a href='index.php?delete_orders=<?php echo $order_id; ?>' class="text-light text-decoration-none">Yes</a></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="./index.php?lit_orders" class="text-light text-decoration-none">No</a></button>
            </div>
        </div>
    </div>
</div>
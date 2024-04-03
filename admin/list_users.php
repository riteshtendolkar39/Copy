<h3 class="text-center text-success">All Users</h3>
<table class="table table-bordered mt-5">
  <thead>
    <?php
    $get_user = "select * from `user_table`";
    $result = mysqli_query($con, $get_user);
    $row_count = mysqli_num_rows($result);
    if ($row_count == 0) {
      echo "<h2 class='text-center mt-5 text-danger'>No Users  yet </h2>";
    } else {
      echo "        <tr class='text-center'>
                <th class='bg-info text-light'>Sr no</th>
                <th class='bg-info text-light'>Username</th>
                <th class='bg-info text-light'>User Email</th>
                <th class='bg-info text-light'>User Image</th>
                <th class='bg-info text-light'>User Address</th>
                <th class='bg-info text-light'>User Mobile</th>
                <th class='bg-info text-light'>Delete</th>
            </tr>
        </thead>
        <tbody>";
      $num = 0;
      while ($row_data = mysqli_fetch_assoc($result)) {
        $user_id = $row_data['user_id'];
        $username = $row_data['username'];
        $user_email = $row_data['user_email'];
        $user_image = $row_data['user_image'];
        $user_address = $row_data['user_address'];
        $user_mobile = $row_data['user_mobile'];
        $num++;
        echo "                <tr class='text-center'>
                    <td class='bg-secondary text-light'>$num</td>
                    <td class='bg-secondary text-light'>$username</td>
                    <td class='bg-secondary text-light'>$user_email</td>
                    <td class='bg-secondary text-light'><img src='../user/user_images/$user_image' class='admin_image'></td>
                    <td class='bg-secondary text-light'>$user_address</td>
                    <td class='bg-secondary text-light'>$user_mobile</td>
                    <td class='bg-secondary text-light'><a href='index.php?delete_user=$user_id' type='button' class='text-light' data-toggle='modal' data-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
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
        <button type="button" class="btn btn-primary"><a href='index.php?delete_user=<?php echo $user_id; ?>' class="text-light text-decoration-none">Yes</a></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="./index.php?lit_users" class="text-light text-decoration-none">No</a></button>
      </div>
    </div>
  </div>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h3 class="text-danger mb-4">Delete Account</h3>
    <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input type="submit" value="Delete Account" class="form-control m-auto w-50" name="delete">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" value="Don't Delete Account" class="form-control m-auto w-50" name="dont_delete">
        </div>
    </form>
</body>
</html>

<?php
$user_email_session=$_SESSION['user_email'];
if(isset($_POST['delete'])){
    $delete_query="delete from `user_table` where user_email='$user_email_session'";
    $result=mysqli_query($con,$delete_query);
    if($result){
        session_destroy();
        echo "<script>alert('Account Deleted successfully')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
if(isset($_POST['dont_delete'])){
    echo "<script>window.open('profile.php','_self')</script>";
}
?>
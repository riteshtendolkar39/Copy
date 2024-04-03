<?php
if(isset($_GET['edit_subcategory'])){
    $edit_subcategory=$_GET['edit_subcategory'];
    // echo $edit_category;
    
    $get_subcategory="select * from `subcat` where subcat_id=$edit_subcategory";
    $result=mysqli_query($con,$get_subcategory);
    $row=mysqli_fetch_assoc($result);
    $subcategory_title=$row['subcat_title'];
}
if(isset($_POST['update_cat'])){
    $subcat_title=$_POST['subcategory_title'];
    $update_query="update `subcat` set subcat_title='$subcat_title' where subcat_id=$edit_subcategory";
    $result_cat=mysqli_query($con,$update_query);
    if($result_cat){
        echo "<script>alert('Sub-Category is been updated successfully')</script>";
        echo "<script>window.open('./index.php?view_subcat','_self')</script>";
    }
}
?>
<div class="container mt-3">
    <h1 class="text-center">Edit Sub-Category</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="subcategory_title" class="form-label">Sub-Category Title</label>
            <input type="text" name="subcategory_title" id="subcategory_title" class="form-control" required="required" value="<?php echo $subcategory_title ?>">
        </div>
        <input type="submit" value="Update Category" name="update_cat" class="btn btn-info px-3 mb-3">
    </form>
</div>
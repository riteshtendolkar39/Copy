<?php
// include('./include/connect.php');
//displaying products
function getproducts()
{
  global $con;

  // condition to check isset or not
  if (!isset($_GET['category'])) {
    if (!isset($_GET['sub-category'])) {
      $select_query = "select * from `products` order by rand() limit 0,3";
      $result_query = mysqli_query($con, $select_query);
      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_author = $row['product_author'];
        $product_image = $row['product_image'];
        $product_price = $row['product_price'];
        $category_id = $row['category_id'];
        $subcat_id = $row['subcat_id'];
        echo "        <div class='col-md-3 mb-2'>
      <div class='card' style='width: 18rem;'>
        <img src='./admin/product_images/$product_image' class='card-img-top' alt'...'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text'>Price: $product_price</p>
          <p class='card-text'>By: $product_author</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info click2'>Add to cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-secondary click1'>View more</a>
        </div>
      </div>
    </div>";
      }
    }
  }
}


//getting all products
function get_all_products()
{
  global $con;

  // condition to check isset or not
  if (!isset($_GET['category'])) {
    if (!isset($_GET['sub-category'])) {
      $select_query = "select * from `products` order by rand()";
      $result_query = mysqli_query($con, $select_query);
      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_author = $row['product_author'];
        $product_image = $row['product_image'];
        $product_price = $row['product_price'];
        $category_id = $row['category_id'];
        $subcat_id = $row['subcat_id'];
        echo "        <div class='col-md-3 mb-2'>
      <div class='card' style='width: 18rem;'>
        <img src='./admin/product_images/$product_image' class='card-img-top' alt'...'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text'>Price: $product_price</p>
          <p class='card-text'>By: $product_author</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
        </div>
      </div>
    </div>";
      }
    }
  }
}

//getting unique categories
function get_unqiue_category()
{
  global $con;

  // condition to check isset or not
  if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
    $select_query = "select * from `products` where category_id=$category_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
    }

    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_author = $row['product_author'];
      $product_image = $row['product_image'];
      $product_price = $row['product_price'];
      $category_id = $row['category_id'];
      $subcat_id = $row['subcat_id'];
      echo "        <div class='col-md-3 mb-2'>
      <div class='card' style='width: 18rem;'>
        <img src='./admin/product_images/$product_image' class='card-img-top' alt'...'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text'>Price: $product_price</p>
          <p class='card-text'>By: $product_author</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
        </div>
      </div>
    </div>";
    }
  }
}

//getting unique sub-categories
function get_unqiue_subcategory()
{
  global $con;

  // condition to check isset or not
  if (isset($_GET['sub-category'])) {
    $category_id = $_GET['sub-category'];
    $select_query = "select * from `products` where subcat_id=$category_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='text-center text-danger'>No stock available for this sub-category</h2>";
    }

    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_author = $row['product_author'];
      $product_image = $row['product_image'];
      $product_price = $row['product_price'];
      $category_id = $row['category_id'];
      $subcat_id = $row['subcat_id'];
      echo "        <div class='col-md-3 mb-2'>
      <div class='card' style='width: 18rem;'>
        <img src='./admin/product_images/$product_image' class='card-img-top' alt'...'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text'>Price: $product_price</p>
          <p class='card-text'>By: $product_author</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
        </div>
      </div>
    </div>";
    }
  }
}

//display categories in sidenav
function getcategories()
{
  global $con;
  $select_category = "select * from `categories`";
  $result_category = mysqli_query($con, $select_category);
  while ($row_data = mysqli_fetch_assoc($result_category)) {
    $category_title = $row_data['category_title'];
    $category_id = $row_data['category_id'];
    echo "<li class='nav-item click1'>
          <a href='display_all.php?category=$category_id' class='nav-link text-light '>$category_title</a>
            </li>";
  }
}

//display subcategories in sidenav
function getsubcategories()
{
  global $con;
  $select_subcat = "select * from `subcat`";
  $result_subcat = mysqli_query($con, $select_subcat);
  while ($row_data = mysqli_fetch_assoc($result_subcat)) {
    $subcat_title = $row_data['subcat_title'];
    $subcat_id = $row_data['subcat_id'];
    echo "<li class='nav-item click1'>
          <a href='display_all.php?sub-category=$subcat_id' class='nav-link text-light '>$subcat_title</a>
          </li>";
  }
}

//searching products
function search_products()
{
  global $con;
  if (isset($_GET['search_data_product'])) {
    $search_data_value = $_GET['search_data'];
    $search_query = "Select * from `products` where product_keywords like '%$search_data_value%'";
    $result_query = mysqli_query($con, $search_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='text-center text-danger'>No results match<br>No products found on this category!</h2>";
    }
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_author = $row['product_author'];
      $product_image = $row['product_image'];
      $product_price = $row['product_price'];
      $category_id = $row['category_id'];
      $subcat_id = $row['subcat_id'];
      echo "        <div class='col-md-3 mb-2'>
    <div class='card' style='width: 18rem;'>
      <img src='./admin/product_images/$product_image' class='card-img-top' alt'...'>
      <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>$product_description</p>
        <p class='card-text'>Price: $product_price</p>
        <p class='card-text'>By: $product_author</p>
        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
        </div>
    </div>
  </div>";
    }
  }
}


function view_detail()
{
  global $con;
  // condition to check isset or not
  if (isset($_GET['product_id'])) {
    if (!isset($_GET['category'])) {
      if (!isset($_GET['subcategory'])) {
        $product_id = $_GET['product_id'];
        $select_query = "select * from `products` where product_id=$product_id";
        $result_query = mysqli_query($con, $select_query);
        while ($row = mysqli_fetch_assoc($result_query)) {
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $product_description = $row['product_description'];
          $product_author = $row['product_author'];
          $product_image = $row['product_image'];
          $product_price = $row['product_price'];
          $category_id = $row['category_id'];
          $subcat_id = $row['subcat_id'];
          echo "                <div class='row'>
            <div class='col-md-4'>
                <!-- card -->
                <div class='row g-0 bg-body-secondary position-relative'>
                    <div class='col-md-6 mb-md-0 p-md-4 '>
                        <img src='./admin/product_images/$product_image' class='w-100' alt='...'>
                    </div>
                    <div class='col-md-6 p-4 ps-md-0'>
                        <h5 class='mt-0'>$product_title</h5>
                        <p>$product_description</p>
                        <p>Price: $product_price</p>
                        <p>By: $product_author</p>
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                        <a href='index.php' class='btn btn-secondary'>Go Home</a>
                    </div>
                </div>
            </div>";

          echo "<div class='col-md-7'>
            <!-- related card -->
            <div class='row'>
                <div class='col-md-12'>
                    <h4 class='text-center mt-1 text-info mb-5'>Related Products</h4>
                </div>";
          if (isset($_GET['product_id'])) {
            $product_id = intval($_GET['product_id']);
            $select_query = "select category_id,subcat_id from `products` where product_id=$product_id ";
            $result_query = mysqli_query($con, $select_query);
            $num_of_rows = mysqli_num_rows($result_query);
            // echo " <h4 class='text-center mt-1 text-info'>Related Products</h4>";
            if ($num_of_rows > 0) {
              $row = mysqli_fetch_assoc($result_query);
              $category_id = $row['category_id'];
              $subcategory_id = $row['subcat_id'];

              //related products
              $select_query = "select * from `products` where (category_id=$category_id OR subcat_id=$subcategory_id ) AND product_id!=$product_id order by rand() limit 0,2 ";
              $result_query = mysqli_query($con, $select_query);

              if ($num_of_rows > 0) {
                while ($row = mysqli_fetch_assoc($result_query)) {
                  $product_id = $row['product_id'];
                  $product_title = $row['product_title'];
                  $product_author = $row['product_author'];
                  $product_image = $row['product_image'];
                  $product_price = $row['product_price'];
                  $category_id = $row['category_id'];
                  $subcategory_id = $row['subcat_id'];
                  echo "
                        <div class='col-md-6 mb-3'>
                        <div class='card' style='width: 18rem;' >
                          <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_title'>
                          <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_author</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                          </div>
                        </div>
                      </div>";
                }
              }
            }
          }
          echo "</div></div>";
        }
      }
    }
  }
}

//getting ip address

function getIPAddress()
{
  //whether ip is from the share internet  
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip; 


//cart function
function cart()
{
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $get_ip_address = getIPAddress();
    $get_product_id = $_GET['add_to_cart'];
    $select_query = "Select * from `cart_details` where ip_address='$get_ip_address' and product_id=$get_product_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows > 0) {
      echo "<script>alert('This item is already is present inside cart')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    } else {
      $insert_query = "insert into `cart_details` (product_id,ip_address,quantity) values ($get_product_id,'$get_ip_address',1)";
      $result_query = mysqli_query($con, $insert_query);
      echo "<script>alert('Item is added to cart')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    }
  }
}

//function to get cart item numbers
function cart_item()
{
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $get_ip_address = getIPAddress();
    $select_query = "Select * from `cart_details` where ip_address='$get_ip_address'";
    $result_query = mysqli_query($con, $select_query);
    $cart_items = mysqli_num_rows($result_query);
  } else {
    global $con;
    $get_ip_address = getIPAddress();
    $select_query = "Select * from `cart_details` where ip_address='$get_ip_address'";
    $result_query = mysqli_query($con, $select_query);
    $cart_items = mysqli_num_rows($result_query);
  }
  echo "$cart_items";
}


//total price function
function total_cart_price()
{
  global $con;
  $get_ip_address = getIPAddress();
  $total_price = 0;
  $cart_query = "Select * from `cart_details` where ip_address='$get_ip_address'";
  $result = mysqli_query($con, $cart_query);
  while ($row = mysqli_fetch_array($result)) {
    $product_id = $row['product_id'];
    $select_products = "Select * from `products` where product_id=$product_id";
    $result_products = mysqli_query($con, $select_products);
    while ($row_product = mysqli_fetch_array($result_products)) {
      $product_price = array($row_product['product_price']);
      $product_value = array_sum($product_price);
      $total_price += $product_value;
    }
  }
  echo $total_price;
}

//get user order details
function get_user_order_details()
{
  global $con;
  $user_email = $_SESSION['user_email'];
  $get_details = "select * from `user_table` where user_email='$user_email'";
  $result_query = mysqli_query($con, $get_details);
  while ($row_query = mysqli_fetch_array($result_query)) {
    $user_id = $row_query['user_id'];
    if (!isset($_GET['my_products'])) {
      if (!isset($_GET['edit_account'])) {
        if (!isset($_GET['my_orders'])) {
          if (!isset($_GET['delete_account'])) {
            $get_orders = "select * from `user_orders` where user_id=$user_id and order_status='pending'";
            $result_orders_query = mysqli_query($con, $get_orders);
            $row_count = mysqli_num_rows($result_orders_query);
            if ($row_count > 0) {
              echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
              <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
            } else {
              echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>
              <p class='text-center'><a href='../index.php' class='text-dark'>Explore Products</a></p>";
            }
          }
        }
      }
    }
  }
}

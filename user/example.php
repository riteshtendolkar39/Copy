<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .product-image {
      max-width: 100%;
      height: auto;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="row">
    <!-- Product Image -->
    <div class="col-md-4">
      <img src="product-image.jpg" alt="Product Image" class="product-image">
    </div>
    <!-- Product Details -->
    <div class="col-md-8">
      <h2>Product Name</h2>
      <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      <p>Price: $XX.XX</p>
      <p>Availability: In stock</p>
      <button class="btn btn-primary">Add to Cart</button>
    </div>
  </div>
  
  <!-- Related Products -->
  <div class="row mt-5">
    <div class="col">
      <h3>Related Products</h3>
      <div class="card-deck">
        <!-- Related Product 1 -->
        <div class="card">
          <img src="related-product1.jpg" class="card-img-top" alt="Related Product 1">
          <div class="card-body">
            <h5 class="card-title">Related Product 1</h5>
            <p class="card-text">Description: Lorem ipsum dolor sit amet.</p>
            <p class="card-text">Price: $XX.XX</p>
            <a href="#" class="btn btn-primary">View Product</a>
          </div>
        </div>
        <!-- Related Product 2 -->
        <div class="card">
          <img src="related-product2.jpg" class="card-img-top" alt="Related Product 2">
          <div class="card-body">
            <h5 class="card-title">Related Product 2</h5>
            <p class="card-text">Description: Lorem ipsum dolor sit amet.</p>
            <p class="card-text">Price: $XX.XX</p>
            <a href="#" class="btn btn-primary">View Product</a>
          </div>
        </div>
        <!-- Add more related products here -->
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies (optional, for certain Bootstrap components) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

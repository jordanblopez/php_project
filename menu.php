<?php
include 'db.php';
include 'auth.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Menu Items</title>
    <script src="https://use.fontawesome.com/4f50358355.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" ></script>
  </head>
  <body>
    <div class="container">
      <!-- NavBar -->
      <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="cust_home.php"></a><i class="fa fa-star fa-2x" aria-hidden="true"></i>Tsarbucks</a>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="cust_home.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="menu.php"><i class="fa fa-list" aria-hidden="true"></i> Menu<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="myOrders.php"><i class="fa fa-coffee" aria-hidden="true"></i> My Orders</a>
          </li>
                </ul>
        <ul class="navbar-nav">
          <span class="navbar-text">
            <?php echo $_SESSION['username'] ?>
          </span>
          <li class="nav-item">
            <a class="nav-link" href="viewCart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
          </li>
        </ul>
      </nav>

      <!-- Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="display-1 text-center"> Menu</h1>
        </div>
      </div>

      <!--Product Table-->
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thread>
              <tr>
                <th><h2>Product Name</h2></th>
                <th><h2>Size</h2></th>
                <th><h2>Price</h2></th>
                <th> </th>
              </tr>
            </thread>
            <tbody>
              <?php
             $query = $con->query("SELECT * FROM `products` ORDER BY `product_id` DESC LIMIT 10");
              if ($query->num_rows > 0) {
                while($row = $query->fetch_assoc()){
              ?>
              <tr>
                <td class="align-middle">
                   <h5 class=""><?php echo $row["display_name"]; ?></h5>
                </td>
                <td class="align-middle">
                   <p class=""><?php echo  $row["size"].'oz'; ?></p>
                </td>
                <td class="align-middle">
                   <p class="lead"><?php echo '$'.$row["price"]; ?></p>
                </td>
                <td>
                  <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?php echo $row["product_id"]; ?>">Add to cart <i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i></a>
                </td>
              </tr>
            </tbody>
        </div>
      </div>

       <?php } }else{ ?>
       <p>Product(s) not found.....</p>
       <?php } ?>

    </div>
  </body>
</html>

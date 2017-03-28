<?php
include 'db.php';
include 'auth.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Success</title>
    <script src="https://use.fontawesome.com/4f50358355.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
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
          <li class="nav-item">
            <a class="nav-link" href="menu.php"><i class="fa fa-list" aria-hidden="true"></i> Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="myOrders.php"><i class="fa fa-coffee" aria-hidden="true"></i> My Orders</a>
          </li>
                </ul>
        <ul class="navbar-nav">
          <span class="navbar-text">
            <?php echo $_SESSION['username'] ?>
          </span>
          <li class="nav-item active">
            <a class="nav-link" href="viewCart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Cart<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
          </li>
        </ul>
      </nav>

      <!-- Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="display-1 text-center"> Order Placed!</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 text-center">
          <a href="myOrders.php" class="btn btn-info"><i class="fa fa-coffee" aria-hidden="true"></i> View My Orders</a>
          <a href="menu.php" class="btn btn-secondary"><i class="fa fa-list" aria-hidden="true"></i> View Item Menu</a>
        </div>
      </div>
    </div>
  </body>
</html>

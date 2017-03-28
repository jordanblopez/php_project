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
      <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Tsarbucks</a>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="cust_home.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="menu.php">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="myOrders.php">My Orders</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="viewCart.php">My Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </nav>

      <!--Heading-->
      <div class="row justify-content-center">
        <div class="col-md-9">
          <h1 class="display-3" id="displayTitle">Order Placed!</h1>
        </div>
      </div>

        <a href="menu.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Place Another Order</a>
        <a href="myOrders.php" class="btn btn-primary"></i> View Orders</a>

    </div>

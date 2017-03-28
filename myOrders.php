<?php
// include database configuration file
include 'db.php';
include 'auth.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Orders</title>
    <meta charset="utf-8">
    <script src="https://use.fontawesome.com/4f50358355.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
          <a class="nav-link" href="cust_home.php"><i class="fa fa-home" aria-hidden="true"></i>Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu.php"><i class="fa fa-list" aria-hidden="true"></i> Menu</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="myOrders.php"><i class="fa fa-coffee" aria-hidden="true"></i> My Orders<span class="sr-only">(current)</span></a>
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
        <h1 class="display-1 text-center"> My Orders <br /></h1>
      </div>
    </div>

  <?php $query = $con->query("SELECT a.display_name, a.price, a.size, b.quantity, b.completed, b.order_id FROM products a JOIN orders b ON a.product_id = b.product_id WHERE b.user_id = '".$_SESSION['sessCustomerID']."'ORDER BY b.order_id DESC");

   $previous = NULL;
   $total =0;


    while ($row = $query->fetch_assoc()) {

      $current = $row['order_id'];
      $subtotalUnformated = $row['price'] * $row['quantity'];
      $subtotal = number_format($subtotalUnformated, 2);

      if ($current != $previous) {
        ?>
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thread>
                <tr>
                  <th>  <h3>Order <?php echo " $current"; ?> </h3></th>

                </tr>
                <tr>
                  <th><h2 class="display-7">Product Name</h2></th>
                  <th><h2 class="display-7">Size</h2></th>
                  <th><h2 class="display-7">Price</h2></th>
                  <th><h2 class="display-7">Qty</h2></th>
                  <th><h2 class="display-7">Status</h2></th>
                  <th><h2 class="display-7">Subtotal</h2></th>
                </tr>
              </thread>
              <tfoot>
                <tr>
              
                  <th colspan="4"> </th>
                  <th><h2 class="display-7">Total: </h2></th>
                  <th><h2 class="display-7"><?php
                  $orderTotals = $con->query("SELECT SUM(a.price * b.quantity) AS total, b.order_id, b.user_id,b.product_id FROM products a JOIN orders b ON a.product_id = b.product_id GROUP BY
                  	b.order_id, b.user_id HAVING user_id ='".$_SESSION['sessCustomerID']."' ORDER BY b.user_id DESC ");

                  while($orderRow=$orderTotals->fetch_assoc()){
                    if ($orderRow['order_id'] == $current) {
                      echo "$".$orderRow['total'];
                    }


                  } ?></h2></th>
                </tr>
              </tfoot>


      <?php
      $previous = $current;

      };?>
              <tbody>
                <tr>
                  <td class="align-middle">
                     <h5><?php echo $row["display_name"]; ?></h5>
                  </td>
                  <td class="align-middle">
                     <p class=""><?php echo  $row["size"]; ?></p>
                  </td>
                  <td class="align-middle">
                     <p class="lead"><?php echo '$'.$row["price"]; ?></p>
                  </td>
                  <td class="align-middle">
                     <p class=""><?php echo  $row["quantity"]; ?></p>
                  </td>
                  <td class="align-middle">
                     <p class=""><?php
                        $status = $row["completed"];
                        if ($status == 0) {
                          echo "<span class='badge badge-warning'>Pending</span>";
                        } else {
                          echo "<span class='badge badge-success'>Complete</span>";
                        };
                     ?></p>
                  </td>
                  <td>
                    <p class="lead"><?php echo '$'.$subtotal; ?></p>
                  </td>
                </tr>
                <tr>
              </tbody>


<?php }?>

      </table>

</div>

</div>


</div>
</body>
</html>

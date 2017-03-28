<!-- This page shows the pending orders from customers, it allows the
    barista to mark the orders as complete, they will then be removed from
    the page -->
<?php
// Include both the db and auth pages to get the connection
// info and make sure they are logged in
require('db.php');
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pending Orders</title>
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
      <a class="navbar-brand" href="bar_home.php"></a><i class="fa fa-star fa-2x" aria-hidden="true"></i> Tsarbucks </a>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="bar_home.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="orders.php"><i class="fa fa-coffee" aria-hidden="true"></i> Pending Orders<span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        </li>
      </ul>
    </nav>

    <?php
      // The query to select all the info needed to display the order information
      // it only displays orders that are pending
      $query = $con->query("SELECT a.display_name as productDescription, a.price, a.size, a.product_id, b.quantity, b.completed, b.order_id, c.user_id, c.display_name, c.username FROM products a JOIN orders b ON a.product_id = b.product_id JOIN users c ON b.user_id = c.user_id WHERE b.completed = 0");

      //The previous order_id, used to break up the orders
      $previous = NULL;
      //Loop through the tables
      if ($query->num_rows > 0) {
        # code...

      while ($row = $query->fetch_assoc()) {
       $current = $row["order_id"];
       // The Subtotal formatted for decimals
       $subtotal = number_format($row['price'] * $row['quantity'], 2);

       // If the current order_id doesn't match the previous then it will display
       // the order number, customer username and the table headers
       if ($current != $previous) { ?>
         <!-- Table Headings -->
         <div class="row">
           <div class="col-md-12">
             <table class="table">
               <thread>
                 <tr>
                   <th><h3 class="display-4"><?php echo "Order ".$current." For ".$row['username'] ; ?> </h3></th>
                 </tr>
                 <tr>
                   <th><h4 >Product Name</h4></th>
                   <th><h4 >Price</h4></th>
                   <th><h4 >Size</h4></th>
                   <th><h4 >Qty</h4></th>
                   <th><h4 >Status</h4></th>

                 </tr>
               </thread>

       <?php
       $previous = $current;

       };?>
               <tbody>
                 <tr>
                   <td class="align-middle">
                      <h5 class=""><?php echo $row["productDescription"]; ?></h5>
                   </td>
                   <td class="align-middle">
                      <p class="lead"><?php echo '$'.$row["price"]; ?></p>
                   </td>
                   <td class="align-middle">
                      <p class=""><?php echo  $row["size"]; ?></p>
                   </td>
                   <td class="align-middle">
                      <p class=""><?php echo  $row["quantity"]; ?></p>
                   </td>
                   <td class="align-middle">
                      <p class=""><?php
                         $status = $row["completed"];
                         if ($status == 0) {?>
                           <a href="bar_action.php?action=completeOrder&pid=<?php echo $row["product_id"]; ?>&uid=<?php echo $row["user_id"]?>&oid=<?php echo $row["order_id"]?>" class="btn btn-success" onclick=""><i class="fa fa-check" aria-hidden="true">Mark Complete</i></a>
                        <?php   } else {
                           echo "<span class='badge badge-success'>Complete</span>";
                         };
                      ?></p>
                   </td>
  <br />
                 </tr>
                 <tr>
               </tbody>


  <?php }
} else {?>
  <div class="row">
    <div class="col-12 text-center">
      <h1 class="display-2">No Pending Orders <br />
        Go Clean Something</h1>
    </div>
    <div class="col-12 text-center">
      <a href="bar_home.php" class="btn btn-primary">Home</a>
    </div>

  </div>
<?php }?>

       </table>

  </div>

</div>
</div>
</body>
</html>

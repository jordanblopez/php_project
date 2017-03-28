<?php
include 'db.php';
include 'auth.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Testing</title>
    <script src="https://use.fontawesome.com/4f50358355.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">


    <?php $query = $con->query("SELECT a.display_name, a.price, a.size, b.quantity, b.completed, b.order_id FROM products a JOIN orders b ON a.product_id = b.product_id WHERE b.user_id = ".$_SESSION['sessCustomerID']);

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
                    <th><h2 class="display-7">Price</h2></th>
                    <th><h2 class="display-7">Size</h2></th>
                    <th><h2 class="display-7">Qty</h2></th>
                    <th><h2 class="display-7">Status</h2></th>
                    <th><h2 class="display-7">Subtotal</h2></th>
                  </tr>
                </thread>
                <tfoot>
                  <tr>
                    <th> </th>
                    <th>Total: </th>
                    <th><h2><?php echo $total; ?></h2></th>
                  </tr>
                </tfoot>


        <?php
        $previous = $current;

        };?>
                <tbody>
                  <tr>
                    <td class="align-middle">
                       <h5 class=""><?php echo $row["display_name"]; ?></h5>
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

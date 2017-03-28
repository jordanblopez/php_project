<?php
// initializ shopping cart class
include 'Cart.php';
$cart = new Cart;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Cart - PHP Shopping Cart Tutorial</title>
    <meta charset="utf-8">
    <script src="https://use.fontawesome.com/4f50358355.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" ></script>
    <style>
    input[type="number"]{width: 20%;}
    </style>
    <script>
    function updateCartItem(obj,id){
        $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    </script>
</head>
<body>
  <div class="container">
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
          <h1 class="display-1 text-center"> Cart</h1>
        </div>
      </div>




      <table class="table">
      <thead>
          <tr>
              <th><h2>Product</h2></th>
              <th><h2>Size</h2></th>
              <th><h2>Price</h2></th>
              <th><h2>Quantity</h2></th>
              <th><h2>Subtotal</h2></th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
          </tr>
      </thead>
      <tbody>
          <?php
          if($cart->total_items() > 0){
              //get cart items from session
              $cartItems = $cart->contents();
              foreach($cartItems as $item){
          ?>
          <tr class="text-center">
              <td>
                <?php echo $item["display_name"]; ?>
              </td>
              <td>
                <?php echo $item["size"]; ?>
              </td>
              <td>
                <?php echo '$'.$item["price"]; ?>
              </td>
              <td class="form-group col-1">
                <input type="number" class="form-control" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')">
              </td>
              <td>
                <?php echo '$'.$item["subtotal"]; ?>
              </td>
              <td></td>
              <td class=" text-right">
                  <a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
              </td>
          </tr>
          <?php } }else{ ?>
          <tr><td colspan="5"><p>Your cart is empty.....</p></td>
          <?php } ?>
      </tbody>
      <tfoot>
          <tr>
              <td>
                <a href="menu.php" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Continue Shopping</a></td>
              <td colspan="3"></td>
              <?php if($cart->total_items() > 0){ ?>
                <th class="text-right">
                  <h2>Total: </h2>
                </th>
              <th>
                <h2><?php echo '$'.$cart->total(); ?></h2>
              </th>
              <td><a href="checkout.php" class="btn btn-primary btn-block">Submit Order </a></td>
              <?php } ?>
          </tr>
      </tfoot>
      </table>

  </div>
</body>
</html>

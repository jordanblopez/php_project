<?php
include 'Cart.php';
$cart = new Cart;

include 'db.php';


if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
  if ($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])) {
    $productID = $_REQUEST['id'];
       // get product details
       $query = $con->query("SELECT * FROM products WHERE product_id = ".$productID);
       $row = $query->fetch_assoc();
       $itemData = array(
           'product_id' => $row['product_id'],
           'display_name' => $row['display_name'],
           'size' => $row['size'],
           'price' => $row['price'],
           'qty' => 1
       );


       $insertItem = $cart->insert_item($itemData);
       $redirectLoc = $insertItem?'viewCart.php':'cust_home.php';

       header("Location: ".$redirectLoc);
  }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );

        $updateItem = $cart->update_cart($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove_item($_REQUEST['id']);
        header("Location: viewCart.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])){
        // insert order details into database
        $query = $con->query("SELECT order_id FROM orders WHERE user_id = '".$_SESSION['sessCustomerID']."' ORDER BY order_id DESC");
        $row = $query->fetch_assoc();
        $orderID = $row['order_id'];
        $orderID+=1;
          $sql = '';

          // get cart items
          $cartItems = $cart->contents();

          foreach($cartItems as $item){
              $sql .= "INSERT INTO orders (order_id, user_id, product_id, quantity) VALUES ('".$orderID."', '".$_SESSION['sessCustomerID']."',  '".$item['product_id']."', '".$item['qty']."');";
          }
          //$orderID = $con->insert_id;
          // insert order items into database
          $insertOrderItems = $con->multi_query($sql);

          if($insertOrderItems){
              $cart->destroy_cart();
              header("Location: orderSuccess.php?id=$orderID");
          }else{
            var_dump($cartItems);
            echo $orderID;
            echo $_SESSION['sessCustomerID'];
              //header("Location: checkout.php");
          }

    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}

 ?>

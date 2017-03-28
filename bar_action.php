<!--This page handles the action of the signed in barista.
    Used to update the database-->
<?php
// Include both the db and auth pages to get the connection
// info and make sure they are logged in
include 'db.php';
include 'auth.php';

// If the there is and and action and it isn't empty proceed
if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
  // Checks what kind of action and makes sure there is a product_id.
  // Bothe the if statements are used as a safty net
  if ($_REQUEST['action'] == 'completeOrder' && !empty($_REQUEST['pid'])) {
    // Assign the data to variables
    $pid = $_REQUEST['pid'];
    $uid = $_REQUEST['uid'];
    $oid = $_REQUEST['oid'];

    // The sql query to update the DB
    // It sets comleted to 1 which will indicated it has been completed
    $sql = "UPDATE orders SET completed = 1 WHERE user_id = '$uid' AND product_id = '$pid' AND order_id = '$oid'";

    // Actually use the sql query to query the DB
    $result = $con->query($sql);
    // If the query is successfull it load the order page and the order should be gone
    if($result){
      header("Location: orders.php");
    } else {
      // If it is false redirect to homepage if anything isn't right
      header("Location: bar_home.php");
    }
  } else{
    header("Location: bar_home.php");
  }
} else{
  // if no action set
  header("Location: bar_home.php");
}
 ?>


<?php
//Start the session and if there is no username set send the user back to the
//homepage
session_start();
if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }

?>

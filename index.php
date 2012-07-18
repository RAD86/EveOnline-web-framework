<?php
session_start();
if(@$charID = $_SESSION['charID']){
define('LOGGED_IN',TRUE);
include_once("functions/user_details_class.php");
$character = new userDetails($charID);
}
?>
<!DOCTYPE html>
<head>
<title>Index page</title>
<style>
</style>
</head>
<body>


<?php if(defined('LOGGED_IN')){
echo "<img src='http://image.eveonline.com/character/".$character->ID."_32.jpg' /> | ".$character->name." | ISK Balance: ".number_format($character->balance,2)." isk ( <a href='logout' title='logout'>Logout</a> )";
}else{
print '<a href="login" title="Login">Login</a>
<a href="register" title="Register">Register</a>';
}
?>
<hr/>




</body>
</html>
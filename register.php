<?php 
session_start();
include_once("database/db.class.php");
$db = new db;
if(@$_SERVER['HTTP_EVE_CHARID']){
	if($db->numRows('users',array('charID'=>$_SERVER['HTTP_EVE_CHARID'])))die(header('location:index'));
}
if($_POST){
$password = $_POST['password'];
$rpassword = $_POST['rpassword'];
if($password && $rpassword){
	if($password == $rpassword){
		include_once('functions/regProccess.php');
	}else{
	$notice = "Your passwords do not match..";
	}
}else{
$notice = "Please fill in both password fields..";
}
}?>
<!DOCTYPE html>
<head>
<title>Registration</title>
<style>
#register{
width:400px;
margin:50px auto 0px auto;
display:hidden;
}
#register label{
display:block;
}
#register input[type=text], input[type=password]{
width:200px;
}
#register form fieldset img{
display:block;
margin:30px auto 0px auto;
}
#register form fieldset p{
text-align:center;
color:grey;
}
</style>
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="javascripts/regScript.js"></script>
</head>
<body onload="CCPEVE.requestTrust('http://*.<?php echo $_SERVER['HTTP_HOST']; ?>');waitingForTrust();">


<div id="register">
<form method="POST" action="">
<fieldset>
<legend>Registration</legend>
<div id="notice"><?php echo @$notice ?></div>
<div id="formContent">
<img width="220px" height="33px" src="images/loader.gif" title="Please trust the site in the ingame browser" alt="Please trust the site in the ingame browser"/>
<p>Waiting for website trust to be accepted ingame..</p>
</div>
</form>
</fieldset>
</div>


</body>
</html>
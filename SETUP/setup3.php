<?php
if(@$_POST['keyID'] && $_POST['vcode'] && $_POST['characterID']){
	include_once('../functions/api_class.php');
	$api = new api;
	$xml = $api->checkIfApiIsFullAccess($_POST);
	if($xml){
		include_once('../database/db.class.php');
		$db = new db;
		$db->insertData('apikey',array('characterID'=>$_POST['characterID'],'keyID'=>$_POST['keyID'],'vcode'=>$_POST['vcode'],'lastRefUpdate'=>0));
		die(header('location:complete.php'));
	}else{
		$notice = "Your API key is either invalid or is not setup for corporation wallet journal access..";
	}
}else{
$notice = "Please fill in all the fields..";
}
?>
<!DOCTYPE html>
<head>
<title>Setup</title>
<style>
body{
font-family:helvetica;
}
form{
width:300px;
margin:50px auto 0px auto;
display:hidden;
}
label{
display:block;
color:#444;
}
input[type=text], input[type=password], input[type=submit]{
display:bock;
width:300px;
height:30px;
font-size:1.2em;
color:#333;
margin-bottom:20px;
}
input[type=submit]{
padding:5px;
height:50px;
}
.author{
font-size:0.7em;
text-align:center;
}
</style>
<body>
<form method="POST" action="">
<fieldset>
<legend>API key setup</legend>
<div id="notice"><?php echo @$notice ?></div>
<label for="keyID">ID</label>
<input type="text" name="keyID" />
<label for="vcode">Verification Code</label>
<input type="text" name="vcode" />
<label for="characterID">Access Mask</label>
<input type="text" name="characterID" />
<input type="submit" value="Submit API key" />
<p class="author">Coded by NickyYo</p>
</fieldset>
</form>
</body>
</html>
<?php
session_start();
if(@$_SESSION['charID'])die(header('location:index'));
if($_POST)include_once('functions/loginProccess.php');
?>
<!DOCTYPE html>
<head>
<title>Login</title>
<style>
#login{
width:200px;
margin:50px auto 0px auto;
display:hidden;
}
#login label{
display:block;
}
#login input[type=text], input[type=password]{
width:200px;
}
#login form fieldset p{
text-align:center;
color:grey;
}
</style>
</head>
<body>

<div id="login">
<form method="POST" action="">
<fieldset>
<legend>Login</legend>
<div id="notice"><?php echo @$notice ?></div>
<label for="username">Username</label>
<input type="text" name="username" />
<label for="username">Password</label>
<input type="password" name="password" />
<input type="submit" value="Login" />
</fieldset>
</form>

</div>


</body>
</html>
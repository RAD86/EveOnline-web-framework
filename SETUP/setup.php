<?php
ini_set( "display_errors", 0);
if($_POST){
	if($_POST['host'] && $_POST['username'] && $_POST['dbname']){
		if($con = mysql_connect($_POST['host'],$_POST['username'],$_POST['password'])){
		$notice="Database connection success!<br/><br/>";
			#if(mysql_query("CREATE DATABASE ".$_POST['dbname'],$con)){
				#$notice .= "Database ".$_POST['dbname']." Created!<br/><br/>";
				include_once('setup2.php');
			#}else{
				#$notice .= "Could not create database ".$_POST['dbname'].", the database may already exist..<br/><br/>";
			#}
		}else{
			$notice ="Database connection failed..";
		}
	}else{
		$notice = "Please fill in all the fields";
	}
}


$createTables = <<<SQL

SQL;

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
	<form method="post" action="">
	<fieldset>
	<p><?php echo @$notice ?></p>
	<legend>Please input your MySQL details</legend>
	<label for="host">Host</label>
	<input type="text" name="host" value="<?php echo $_POST['host']; ?>" />
	<label for="username">Username</label>
	<input type="text" name="username" value="<?php echo $_POST['username']; ?>" />
	<label for="password">Password</label>
	<input type="password" name="password" value="<?php echo $_POST['password']; ?>" />
	<label for="dbname">Enter a name for your database</label>
	<input type="text" name="dbname" value="<?php echo $_POST['dbname']; ?>" />
	<input type="submit" value="Setup Database" />
	<p class="author">Coded by NickyYo</p>
	</fieldset>
	</form>
</body>
</html>
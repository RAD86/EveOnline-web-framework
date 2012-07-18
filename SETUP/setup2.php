<?php
$fh = fopen('../database/connection.php','w');
$content = <<<CONTENT
<?php
mysql_connect('{$_POST['host']}','{$_POST['username']}','{$_POST['password']}');
mysql_select_db('{$_POST['dbname']}');
?>
CONTENT;
if(fwrite($fh,$content)){
$notice .= "Database connection file created!<br/><br/>";
}else{
$notice .= "Failed to create database connection file, there maybee a problem with your directory write rights..<br/><br/>";
}

$createUserTable = <<<SQL
CREATE TABLE users(
charID INT NOT NULL,
PRIMARY KEY(charID),
charName VARCHAR(50),
charCorp VARCHAR(100),
password VARCHAR(150),
balance INT
)
SQL;

$createAdminTable = <<<SQL
CREATE TABLE apikey(
characterID INT NOT NULL,
PRIMARY KEY(characterID),
keyID INT,
vcode VARCHAR(100),
lastRefUpdate BIGINT
)
SQL;

mysql_select_db($_POST['dbname']);
if(mysql_query($createUserTable)){
	$notice .="User table created..<br/><br/>";
	if(mysql_query($createAdminTable )){
		die(header('location:setup3.php'));
	}else{
	$notice .="Failed to create admin table..<br/><br/>";
	}
}else{
$notice .="Failed to create user table..<br/><br/>";
}








?>
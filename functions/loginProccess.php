<?php
include_once("database/db.class.php");
$db = new db;
$details = $db->pullData('charID','users',FALSE,FALSE,array('charName'=>$_POST['username'],'password'=>sha1($_POST['password'])));
if($details){
$_SESSION['charID'] = $details[0]['charID'];
die(header('location:index'));
}else{
@$notice = "Incorrect username or password..";
}
?>
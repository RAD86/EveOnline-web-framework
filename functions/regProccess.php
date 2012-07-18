<?php
if($_SERVER['HTTP_EVE_TRUSTED']!="Yes") die(header('register'));

$details = array('charID'=>$_SERVER['HTTP_EVE_CHARID'],'charName'=>$_SERVER['HTTP_EVE_CHARNAME'],'charCorp'=>$_SERVER['HTTP_EVE_CORPNAME'],'password'=>sha1($_POST['password']),'balance'=>0);

$insert = $db->insertData('users',$details);

if($insert){
$_SESSION['charID'] = $_SERVER['HTTP_EVE_CHARID'];
die(header('location:index'));
}else{
die(header('location:register'));
}
?>
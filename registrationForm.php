<?php 
if($_SERVER['HTTP_EVE_TRUSTED']!="Yes") die('noTrust');

@$charName = $_SERVER['HTTP_EVE_CHARNAME'];
@$charID = $_SERVER['HTTP_EVE_CHARID'];

$return = <<<HTML
	<h2>Welcome {$charName}</h2>
	<div class="charImage"><img height="128px" width="128px" src="http://image.eveonline.com/character/{$charID}_128.jpg" title="{$charName}"/></div> 
	<label for="username">Username</label>
	<input type="text" name="username" value="{$charName}" DISABLED/>
	<label for="password" class='password'>Password</label>
	<input type="password" name="password" />
	<label for="rpassword" class='rpassword'>Repeat password</label>
	<input type="password" name="rpassword" />
	<input type="submit" value="register" />
HTML;
print($return);
?>
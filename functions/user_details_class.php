<?php

class userDetails{
	
	private $db;
	public $ID;
	public $name;
	public $corp;
	public $balance;
	
	
	function __construct($charID){
		include_once("database/db.class.php");
		$this->db = new db;
		$details = $this->db->pullData('*','users',FALSE,FALSE,array('charID'=>$charID));
		$this->ID = $details[0]['charID'];
		$this->name = stripslashes($details[0]['charName']);
		$this->corp = stripslashes($details[0]['charCorp']);
		$this->balance = $details[0]['balance'];
	}
	
}

?>
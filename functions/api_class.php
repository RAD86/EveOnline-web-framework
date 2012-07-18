<?php
class api{

	private $db;
	
	function __construct(){
		include_once('../database/db.class.php');
		$this->db = new db;
	}
	
	#Pulls the xml file from and URL
	private function getXML($url){
		$file = file_get_contents($url);	
		$xml=simplexml_load_string($file);
		return($xml);
	}
	
	#Retrieves admin API details from the database
	private function getAdminApiDetails(){
		$details = $this->db->pullData('*','apikey',null,null,null);
		return($details);
	}
	
	#Update chacters balance with the paramaters character ID and the amount to add onto the existing amount
	private function updateCharBalance($charID,$amount){
		#Get existing balance associated with the character ID
		$details = $this->db->pullData('balance','users',FALSE,FALSE,array('charID'=>$charID));
		#If user exists, update the balance
		if($details){
			#Add new amount onto existing balance
			$newBalance = ($details[0]['balance'] + $amount);
			#Update new amount in the database associated with the chacater ID
			$this->db->modifyData('users',array('balance'=>$newBalance),array('charID'=>$charID));
			print "<br/>Balance Updated!<br/><hr/>";
		}
	}
	
	private function getWalletJournal($details){
		$url = "http://api.eveonline.com/corp/WalletJournal.xml.aspx?keyID=".$details[0]['keyID']."&vcode=".$details[0]['vcode']."&characterID=".$details[0]['characterID'];
		$xml = $this->getXML($url);
		return($xml);
	}	
	
	public function checkIfApiIsFullAccess($details){
		$url = "http://api.eveonline.com/corp/WalletJournal.xml.aspx?keyID=".$details['keyID']."&vcode=".$details['vcode']."&characterID=".$details['characterID'];
		$xml = $this->getXML($url);
		if($xml->error){
			return(FALSE);
		}else{
			return(TRUE);
		};
	}
	
	public function updateBalances(){
		#Pull administration API details
		$details = $this->getAdminApiDetails();
		#Pull wallet journal data associated with the admin API key details
		$xml = $this->getWalletJournal($details);
		#The first call to the XML file is NOT in order, so I have to make sure the highest refID is the last to be put into the databsae to stop duplicate data
		#The below highestRefId will store the highest refID
		$highestRefID = $details[0]['lastRefUpdate'];
		
		#Now looping through all the data, filtering out what we don't need
		
		foreach($xml->result->rowset->children() as $field){
			#print "if(".$field['refID']." > ".$details[0]['lastRefUpdate'].")continue<br/>";
			
			if($field['refID'] > $details[0]['lastRefUpdate']){
			
				if($field['refTypeID'] == 10){
				
					#Call private method to update balances
					$this->updateCharBalance($field['ownerID1'],$field['amount']);
					
					#Sets a marker in the database so the same XML file data will not be read on the next API pull
					if($highestRefID < $field['refID']){
						$highestRefID = $field['refID'];
					}
				
				}
				
			}
			
		}
		#Insert RefID into database
		$this->db->modifyData('apikey',array('lastRefUpdate'=>$highestRefID),array('characterID'=>$details[0]['characterID']));
	}
	
	
}
?>
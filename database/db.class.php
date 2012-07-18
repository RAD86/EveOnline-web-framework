<?php

/*
	Database class
	To proccess basic database queries securely
	Library created by NickyYo
	17th December 2011
	
	This class has minimal error checking and commenting
	Please check the '(README)syntax-for-db.class.php' for the syntax to call the database methods
	
*/

class db{
	
	#Construct to connect to database on class load
	public function __construct(){
	include_once('connection.php');
	}
	
	#Private method for parsing a string into a secure one :)
	private function prepareString($string){
	if(is_string($string))$string=addslashes(htmlspecialchars(trim($string)));
	return $string;
	}
	
	#Private method to convert an array of WHERE clauses into one sql string
	private function whereClause($whereClause){
		if(isset($whereClause)){
			$keys=@array_keys($whereClause);
			$values=@array_values($whereClause);
			$whereClause=array();
			for($i=count($keys)-1;$i>=0;$i--){
				if(is_string($values[$i])){$a="='";$b="' ";}else{$a="=";$b=" ";}
				if($i!=0)$c="AND"; else $c="";
				$whereClause[]=$keys[$i].$a.$this->prepareString($values[$i]).$b.$c;
			}
		return $whereClause="WHERE ".implode(" ",$whereClause);
		}
	}
	
	#Private method to join tables
	private function tableJoins($joinTable,$onColumns){
	$i=0;
		foreach($onColumns as $table1=>$table2){
			@$joins.=$joins."LEFT JOIN ".$joinTable[$i]." ON ".$table1."=".$table2;
			$i++;
		}
		return $joins;
	}
	
	#Method for pulling database data 3 paramaters required
	public function pullData($select,$tableName,$joinTable,$onTables,$whereClause){
		if($onTables)$joins=$this->tableJoins($joinTable,$onTables);
		$sql=sprintf("SELECT %s FROM %s %s %s ;",$select,$tableName,@$joins,$this->whereClause($whereClause));
		
		if($query=mysql_query($sql)){
			$data=array();
			while($row=mysql_fetch_array($query,MYSQL_ASSOC)){
			$data[]=$row;
			}
		return $data;
		}else{
		return(FALSE);
		}
	}
	
	#Method to insert new data
	public function insertData($table,$data){
		$sql="INSERT INTO ".$table." (";
			$keys=@array_keys($data);
			$values=@array_values($data);
			for($i=0;$i<count($data);$i++){
				if($i<count($data)-1){$a=",";}else{$a=")VALUES(";}
				$sql.=$keys[$i].$a;
			}
			for($i=0;$i<count($data);$i++){
				if($i<count($data)-1){$a=",";}else{$a=");";}
				$sql.="'".$this->prepareString($values[$i])."'".$a;
			}
		if(mysql_query($sql)){return(TRUE);}else{return(FALSE);}
	}
	
	#Method to modify existing data
	public function modifyData($table,$values,$whereClause){
		$sql="UPDATE ".$table." SET ";
		foreach($values as $field=>$value){
			$sql.=$field."='".$value."' ";
		}
		$whereClause=$this->whereClause($whereClause);
		$sql.=$whereClause.";";
		if(mysql_query($sql)){return(TRUE);}else{return(FALSE);}
	}
	
	#Method numrows
	public function numRows($table,$whereClause){
		$sql="SELECT * FROM ".$table." ".$this->whereClause($whereClause);
		if($rows=mysql_num_rows(mysql_query($sql))){return($rows);}#else{print("Could not query rows with the following sql query <pre>$sql</pre>");}
	}
	
	#Method to delete existing data
	public function deleteData($table,$whereClause){
		$sql="DELETE FROM ".$table." ".$this->whereClause($whereClause).";";
		if(mysql_query($sql)){return(TRUE);}else{return(FALSE);}
	}
}
?>
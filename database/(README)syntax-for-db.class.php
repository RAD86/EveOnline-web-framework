<?php

	/*
	
	METHOD pullData()
	
	Required paramaters with * being optional
	
	pullData("1","2","3","4","*5")
	
	1) What to select either use a * to select all or write the columns out each seperated with a comma,
	2) The table name we want to work on
	3) An array of tables you want to join in order with parmatar 4
	4) An array of columns we want to join with our table on paramatar 3 eg. array("tableName.ColumnName"=>"tableName.ColumnName")
	*5) An array for a WHERE clause simply provide an array("name"=>"tom")
	
	print_r($db->pullData("*","user",array("withdrawals"),array("user.charID"=>"withdrawals.charID"),array("user.charName"=>"NickyYo","user.access"=>3)));

	*/

	/*
	
	METHOD insertData()
	
	insertData("1","2")
	
	1) The table name to where you want to insert data
	2) An array of data you would like to insert in the format of array("table name"=>"data to be inserted")
	
	print_r($db->insertData("user",array("charID"=>32465,"username"=>"Nick","password"=>"password","charName"=>"NickyYo","charCorp"=>"StarHug","balance"=>999999999999,"access"=>3)));

	*/

	/*
	
	METHOD modifyData()
	
	modifyData("1","2","3")
	
	1) The table you wish to modify data in
	2) An array of data you wish to modify in the format of aray("column name"=>"the new value")
	3) An array of data for an WHERE clause in the format of array("column name"=>"existing value")
	print_r($db->modifyData("user",array("username"=>"NickyYo IS AWESOME!!"),array("charID"=>32465)));
	
	*/

	/*
	
	METHOD deleteData()
	
	deleteData("1","2")
	
	1) The table you wish to delete data in
	2) An array of data for an WHERE clause to DELETE in the format of array("column name"=>"existing value")
	
	print_r($db->deleteData("user",array("charID"=>	2879569)));
	
	*/
	
	/*
	
	METHOD nomRows()
	
	numRows("1","2")
	
	1) The table name you wish to query
	2) 2) An array of data for an WHERE clause to DELETE in the format of array("column name"=>"existing value")
	
	print_r($db->numRows("table name",array("column name"=>"column value")))
	
	*/
	
	/*
	
	METHOD closeConnection()
	
	Just simply call this method to close the database connection to save computer resources and increase security :)
	
	*/
	
?>
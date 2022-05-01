<?php
function OpenCon()
 {
	try{
		$dbhost = "localhost";
		 $dbuser = "------";
		 $dbpass = "------";
		 $db = "productionDB";
		 $conn = new PDO("mysql:host=localhost;dbname=$db", $dbuser, $dbpass);


    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	return $conn;
  		
	}catch (PDOException $e) {
   		print "Error!: " . $e->getMessage() . "<br/>";
   	 die();
	}
 }
 
function CloseCon($conn)
 {
 	$conn -> close();
 }
   
?>
<?php

	include 'con_config_admin.php';

	$conn = OpenCon();

   
    if(!isset($_COOKIE['idP']) || !isset($_COOKIE['idJ'])) {
        http_response_code(400);
        exit(); 
    }
	if(isset($_POST['BaseOrigen'])){
		$BO = $_POST["BaseOrigen"];
    	
	}
	if(isset($_POST['BaseDesti'])){
		$BD = $_POST["BaseDesti"];
    	
	}
	if(isset($_POST['Quantitat'])){
		$Quant = $_POST["Quantitat"];

	}
    
    $idP = $_COOKIE['idP'];
    $idJ = $_COOKIE['idJ'];

    try{
    	$gsent = $conn->prepare('INSERT INTO Movimientos(codigo, idJugador,BaseOrigen,BaseDesti,Quantitat) VALUES (:idPartida,:idJugador,:bo,:bd,:Quant)');

		$gsent->execute(array(':idPartida' => $idP, ':idJugador' => $idJ,':bo' => $BO,':bd' => $BD,':Quant' => $Quant));

    }catch (PDOException $e) {
   		print "Error!: " . $e->getMessage() . "<br/>";
   	 	http_response_code(400); 
   	 	exit();
	}
	exit();


?>

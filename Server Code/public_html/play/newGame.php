<?php

	include 'con_config_admin.php';

	$conn = OpenCon();
      
    if(isset($_POST['codi'])){ 
    	$codi = $_POST['codi'];
    
    
	$gsent = $conn->prepare('INSERT INTO Partida(codigo,numJugadors) VALUES (:codigo,:numJ)');

	$gsent->execute(array('codigo' => $codi, 'numJ' => '0'));

	}else{
		http_response_code(400);
	}
	exit();

?>
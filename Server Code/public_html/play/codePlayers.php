<?php
	
	include "con_config_admin.php";
     
    $conn = OpenCon();

    if(isset($_POST['codi'])){ 
    	$codi = $_POST['codi'];
    }else{
    	echo "codi partida not set";
		http_response_code(400);
		exit();
    }
	
	$query = $conn->prepare("SELECT idJugador,nom FROM Jugador WHERE codigo = :codiP");
	$query->execute(array(':codiP' => $codi));

    foreach ($query as $row) {

		echo ($row['idJugador']. ";" .$row['nom']. ";");	
	}	
	
	exit();

?>
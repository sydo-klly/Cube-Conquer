<?php

	include 'con_config_admin.php';

	$conn = OpenCon();
      
    if(isset($_POST['codi'])){ 
    	$codi = $_POST['codi'];
    }else{
    	echo "codi partida not set";
		http_response_code(400); 
    }
		

	$stmt = $conn->prepare("SELECT * FROM Partida WHERE codigo = :codigo");
	$stmt->execute([':codigo' => $codi]);
	
	$count = $stmt->rowCount();

	if($count>0){
		$partida = $stmt->fetch();
		echo($partida['numJugadors']);

	}else{
		echo "ninguna partida con este id";
		http_response_code(400); 

	}

		
	exit();

?>
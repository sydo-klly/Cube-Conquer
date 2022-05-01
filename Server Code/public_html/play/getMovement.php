<?php
	include 'con_config_admin.php';

	$conn = OpenCon();
      
    if(isset($_POST['codiJ'])){ 
    	$codiJ = $_POST['codiJ'];
    }else{
    	http_response_code(400); 
    	exit();
    }
    if(isset($_POST['codiP'])){ 
    	$codiP = $_POST['codiP'];
    }else{
    	http_response_code(400); 
    	exit();
    }
	

    try{   
        $query = $conn->prepare("SELECT * FROM Movimientos WHERE codigo = :codiP and idJugador = :codiJ ORDER BY idMoviment DESC LIMIT 1");

        $query->execute(array(':codiP' => $codiP, ':codiJ' => $codiJ));

        $row = $query->fetch();

         echo($row['BaseOrigen']. "-" .$row['BaseDesti']. "-" .$row['Quantitat']."-" .$row['idMoviment']);

    }catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        http_response_code(400); 
        exit();
    }



	exit();
?>
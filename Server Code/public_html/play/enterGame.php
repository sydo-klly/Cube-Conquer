<?php



	  include 'con_config_admin.php';

	  $conn = OpenCon();


    if(isset($_POST['gameCode'])){
    	$GC = $_POST['gameCode'];
    }
    if(isset($_POST['name'])){ 
    	$name = $_POST['name'];
    }

	
    try {
    	

  	  	$stmt = $conn->prepare("SELECT * FROM Partida WHERE codigo = :codigo");
		$stmt->execute([':codigo' => $GC]);
		
		$count = $stmt->rowCount();

		if($count==1){
			$partida = $stmt->fetch();


			$idP = $partida['codigo'];
			$numJugadors = $partida['numJugadors'];



			$query = $conn->prepare('SELECT * FROM Jugador WHERE codigo = :codigo AND nom = :nom');

			 $query->execute(array(':codigo' => $idP, ':nom' => $name));

			if ($query->rowCount()==0){


				if ($numJugadors>3){
					echo "too much players";
					http_response_code(400);
                	exit();
				}else{


					$numJugadors++;
					
					setcookie("idP", $idP);

					

					$gsent = $conn->prepare('UPDATE Partida SET numJugadors = :nJug WHERE codigo = :idPartida');

					$gsent->execute(array(':nJug' => $numJugadors, ':idPartida' => $idP));
					
					$gsent = $conn->prepare('INSERT INTO Jugador(codigo,nom) VALUES (:idPartida,:nom)');

					$gsent->execute(array(':idPartida' => $idP, ':nom' => $name));
				
					$stmt = $conn->prepare("SELECT idJugador FROM Jugador WHERE codigo=:codigo and nom = :nom");
					$stmt->execute([':codigo' => $idP, ':nom' => $name]);
				    
				    $row1 = $stmt->fetch();

			    
	    		    $idJ = $row1['idJugador'];
	    		    setcookie("idJ", $idJ);

	    		    // header("Location:http://cubeconquer.com/play/index.html");

	    		    http_response_code(200);
                	exit();

				    
				}
			
			}else{
				echo "already a player with this name";
				http_response_code(400);
                	exit();
			}

		}else{
			echo "partida no en sistema";
			http_response_code(400);
             exit();
		}
		 
	} catch (PDOException $e) {
    	print "Error!: " . $e->getMessage() . "<br/>";
    	http_response_code(400);
        exit();
	}
	

	// CloseCon($conn);
		
?>

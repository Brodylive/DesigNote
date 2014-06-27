<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=jenniferdenis', 'jenniferdenis', 'blabla');
}

catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
}


    session_start();


		$reponserandom = $bdd->query("SELECT * FROM notes ORDER BY RAND() LIMIT 1");
		
		$donneesrandom = $reponserandom->fetch();
		
		$id = $donneesrandom['id'];
		$img = $donneesrandom['img'];

		echo "displaynoterandom('$img', '$id');";


?>

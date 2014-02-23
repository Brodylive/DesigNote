<?php

try {
    $bdd = new PDO('mysql:host=mysql51-99.perso;dbname=mathieugmmod1', 'mathieugmmod1', 'nJhJ7q2EbksX');
}

catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
}


    session_start();


		$reponserandom = $bdd->query("SELECT * FROM notes ORDER BY RAND() LIMIT 1");
		
		$donneesrandom = $reponserandom->fetch();

		$img = $donneesrandom['img'];

		echo "displaynoterandom('$img');";


?>

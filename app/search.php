<?php



    session_start();

    $bdd = new PDO('mysql:host=mysql51-99.perso;dbname=mathieugmmod1', 'mathieugmmod1', 'nJhJ7q2EbksX');

    $pattern = $_GET['pattern'];



		$reponsepattern = $bdd->query("SELECT img FROM notes WHERE title LIKE '%$pattern%'");
		$resultatspattern = $reponsepattern->rowCount();

		if($resultatspattern != 0) {

			echo "var displaysearch = '';";

			while( $row=$reponsepattern->fetch(PDO::FETCH_ASSOC) )       
			{
				$hello=$row['img'];
				echo "
					displaysearch +='<img src=\'$hello\'>';

				";
			}

			echo "findnotes(displaysearch);";
				
		} else {
			echo "findnotes('<p>Not result found</p>');";
		}

?>

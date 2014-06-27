<?php



    session_start();

    $bdd = new PDO('mysql:host=localhost;dbname=jenniferdenis', 'jenniferdenis', 'blabla');

    $pattern = $_GET['pattern'];



		$reponsepattern = $bdd->query("SELECT id, img FROM notes WHERE title LIKE '%$pattern%'");
		$resultatspattern = $reponsepattern->rowCount();

		if($resultatspattern != 0) {

			echo "var displaysearch = '';";

			while( $row=$reponsepattern->fetch(PDO::FETCH_ASSOC) )       
			{
				$img=$row['img'];
				$id=$row['id'];
				echo "
					displaysearch +='<a href=\"javascript:FavoriteIt($id);\"><img src=\'$img\'></a>';

				";
			}

			echo "findnotes(displaysearch);";
				
		} else {
			echo "findnotes('<p>Not result found</p>');";
		}

?>

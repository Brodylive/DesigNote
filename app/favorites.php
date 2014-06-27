<?php
    
   

    $bdd = new PDO('mysql:host=localhost;dbname=jenniferdenis', 'jenniferdenis', 'blabla');
    
        session_start();
    

    $id = $_GET['id'];
   

		$reponsefavorites = $bdd->query("SELECT favoris FROM notes WHERE id='$id'"); 
		
		while($donneesfavorites = $reponsefavorites->fetch()){
			$updatefavoris=$donneesfavorites['favoris']+1;
			
			$updatefavorites = $bdd->query("UPDATE notes SET favoris=$updatefavoris WHERE id='$id'");
		}
		

		/*

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
*/

?>

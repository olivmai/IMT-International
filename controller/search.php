<?php

	if(isset($_GET['term'])) {
		
        // Connexion à la base de données
        require '../method/manager.class.php';
				$manager = new Manager();

				// Récupération du mot tapé par l'utilisateur
        $q = htmlentities($_GET['term']);

				$suggestions = $manager->autocomplete($q);

				/*
				//péparation de la requète
				$request = "SELECT main_prof_area_name, rome_complete_code
										FROM rome
										WHERE main_prof_area_name LIKE '%".$q."%'
										OR rome_complete_code LIKE '%".$q."%'
										AND rome_complete_code !=''
										ORDER BY rome_complete_code";
		
				//execution de la requète
				$req = $bdd->query($request);
		
        // décompte du nombre de résultat de la requète
				$nbResultat = $req->rowCount();

        if ($nbResultat > 0) {//si il y à des résultats dans la requète
							
					$suggestions = array(); // on créé le tableau
					
					while($donnee = $req->fetch()) // on effectue une boucle pour obtenir les données
					{
							array_push($suggestions, $donnee['rome_complete_code']." - ".$donnee['main_prof_area_name']); // et on ajoute celles-ci à notre tableau
					}
        	
        }
				$req->closeCursor();
*/
        // On renvoie les données au format JSON pour le plugin
				echo json_encode($suggestions);
				
    }
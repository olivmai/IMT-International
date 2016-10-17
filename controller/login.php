<?php
session_start();
	
	require '../method/manager.class.php';

	if (isset($_POST['pseudo']) AND isset($_POST['mdp'])) {

		$mdp = $_POST['mdp'];
		$pseudo = $_POST['pseudo'];
		
		$manager = new Manager();
		
		if($manager->login($pseudo, $mdp)) {
			$_SESSION['user'] = $pseudo;
			$_SESSION['admin'] = "connected";
			header('Location: ../admin/index.php');
		}
		else{
			echo "Erreur de connexion, les identifiants et mots de passe sont incorrects. Merci de réessayer en retournant sur le <a href=\"../admin/index.php\">formulaire de connexion</a>";
		}
		
	}//end if isset()

	else{
		echo "Erreur de connexion, merci de réessayer en retournant sur le <a href=\"../admin/index.php\">formulaire de connexion</a>";
	}

?>
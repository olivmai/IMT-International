<?php

  session_start();
  if(isset($_SESSION['liste_pays'])) {
    unset($_SESSION['liste_pays']);
    unset($_SESSION['requete']);
  }
  if(isset($_SESSION['noShortageResult'])) {
    unset($_SESSION['noShortageResult']);  
  }
  if(isset($_SESSION['noCountryResult'])) {
    unset($_SESSION['noCountryResult']);
  }

  if(isset($_POST['metier'])){
    
    $requete_metier = htmlspecialchars($_POST['metier']);
    $codeRome = substr($requete_metier, 0, 5);
        
    require '../method/manager.class.php';
    
    $manager = new Manager();
    
    if($manager->searchByShortage($codeRome) !== false) {// SearchByShortage() récupère la liste des pays par rapport au ROME. Si la liste contient des résultats, on enregistre tout le nécessaire en session et on retourne à la page d'accueil
      
      $_SESSION['liste_pays'] = $manager->searchByShortage($codeRome);
      
      $_SESSION['requete'] = $requete_metier;
      
      header('Location: ../index.php');
    
    }
    
    else {//Sinon, on enregistre l'info en session et on retourne à la page d'accueil
      
      $_SESSION['noShortageResult'] = 1;
      
      header('Location: ../index.php');
      
    }
    
  }

?>
<?php

  session_start();

  if(isset($_SESSION['noShortageResult'])) {
    unset($_SESSION['noShortageResult']);  
  }
  if(isset($_SESSION['noCountryResult'])) {
    unset($_SESSION['noCountryResult']);
  }

  if(isset($_POST['pays'])){
    
    require '../method/manager.class.php';
    
    $pays = htmlspecialchars($_POST['pays']);
    
    $manager = new Manager();
    
    $_SESSION['listeMetiers'] = $manager->searchByCountry($pays);
    
    if(empty($_SESSION['listeMetiers'])){
      $_SESSION['noCountryResult'] = 1;
    }
    
    header('Location: ../index.php');
    
  }

?>
<?php

  session_start();

  if(isset($_SESSION['admin']) AND $_SESSION['admin'] = "connected"){

    if(isset($_GET['country']) AND isset($_GET['job'])){

      require '../../method/manager.class.php';

      $country = $_GET['country'];
      $job = $_GET['job'];

      $manager = new Manager();

      if($manager->deleteOpportunity($country, $job)){
        $_GET['delete'] = "ok";
        header('Location: ../index.php?country='.$country.'&delete='.$_GET['delete']);
      }
      else{
        $_GET['delete'] = "ok";
        header('Location: ../index.php?country='.$country.'&delete='.$_GET['delete']);
      }

    }

    else{
      header('Location: ../index.php?delete=errorFromGET');
    }
    
  }

  else{
    ?>
    <p class="alert alert-danger text-center">Cette action requiert d'être connecté en tant qu'admin. Merci de vous connecter et réessayez.</p>
    <?php
  }

?>
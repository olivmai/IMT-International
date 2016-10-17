<?php

  session_start();

  if(isset($_SESSION['admin']) AND $_SESSION['admin'] = "connected"){

    if(isset($_SESSION['opportunity_r'])){
      unset($_SESSION['opportunity_r']);
    }
    if(isset($_SESSION['opportunity_nr'])){
      unset($_SESSION['opportunity_nr']);
    }

    if(isset($_POST['pays']) AND isset($_POST['metier'])){
      require '../../method/manager.class.php';

      $requete_metier = htmlspecialchars($_POST['metier']);
      $requete_pays = htmlspecialchars($_POST['pays']);
      $codeRome = substr($requete_metier, 0, 5);

      $manager = new Manager();

      //Compter le nombre de résultats pour la requete $_POST['metier']. Vérifie l'existence du metier dans la base de données
      if($manager->metierExists($codeRome)){//Si le metier entré existe déjà en base de données
        //On récupère l'id corespondant au ROME renseigné
        $job_id = $manager->getRomeId($codeRome);
        
        //'ID du pays est celui récupéré par le formulaire $_POST['pays']
        $country_id = $requete_pays;

        if($manager->opportunityVerify($job_id, $country_id)){//Si le couple pays/metier existe déjà dans la table opportunity
          //On enregistre le couple dans un tableau $_SESSION mais on enregistre rien en base de données
          
          $_SESSION['opportunity_nr'][] = array('id_pays' => $country_id, 'id_metier' => $job_id);
          header('Location: ../index.php');
        }

        else {//Si le couple pays/metier n'existe pas, on enregistre en BDD
          $_SESSION['opportunity_r'][] = array('id_pays' => $country_id, 'id_metier' => $job_id);
          if($manager->addNewOpportunity($job_id, $country_id)){
            header('Location: ../index.php');
          }

        }

      }//endIf metier existe
      else {
        echo "Ce que vous avez mentionné comme ROME n'existe pas. Merci de <a href=\"../index.php\">réessayer</a>.";
      }

    }//endIf isset $_POST

    header('Location: ../index.php');
    
  }

?>
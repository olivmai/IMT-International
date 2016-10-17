<?php

  session_start();

  unset($_SESSION['pays']);
  unset($_SESSION['listeMetiers']);
  unset($_SESSION['noCountryResult']);
  unset($_SESSION['liste_pays']);
  unset($_SESSION['requete']);
  unset($_SESSION['opportunity_r']);
  unset($_SESSION['opportunity_nr']);

  header('Location: index.php?page=admin');

?>
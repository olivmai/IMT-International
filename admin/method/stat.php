<?php

  function countryStat() {
    
    require '../method/config/connect.php';
      
    $getCountryStat = $bdd->query('SELECT search_count, nom_fr_fr FROM pays ORDER BY search_count DESC LIMIT 0, 5');

    $stat = $getCountryStat->fetchAll(PDO::FETCH_ASSOC);

    $getCountryStat->closeCursor();
    
    return $stat;
    
  }

  
  function countryStatOfTheMonth() {
    
    require '../method/config/connect.php';
      
    $getCountryStat = $bdd->query('SELECT search_count, nom_fr_fr FROM pays WHERE id IN(SELECT id_pays FROM stat WHERE MONTH(date_search) >= MONTH(now())-1) ORDER BY search_count DESC LIMIT 0, 5');

    $stat = $getCountryStat->fetchAll(PDO::FETCH_ASSOC);

    $getCountryStat->closeCursor();
    
    return $stat;
    
  }

  function shortageStat() {
    
    require '../method/config/connect.php';
      
    $getShortageStat = $bdd->query('SELECT search_count, rome_complete_code, main_prof_area_name FROM rome ORDER BY search_count DESC LIMIT 0, 5');

    $stat = $getShortageStat->fetchAll(PDO::FETCH_ASSOC);

    $getShortageStat->closeCursor();
    
    return $stat;
    
  }

  function totalStat() {
    
    require '../method/config/connect.php';
    
    $shortageTotalStat = $bdd->query('SELECT SUM(search_count) AS totalShortage FROM rome');
    $countryTotalStat = $bdd->query('SELECT SUM(search_count) AS totalCountry FROM pays');
    
    $totalShortage = $shortageTotalStat->fetch();
    $totalCountry = $countryTotalStat->fetch();
    
    $totalStat = $totalCountry['totalCountry'] + $totalShortage['totalShortage'];
    
    return $totalStat;
    
  }


?>
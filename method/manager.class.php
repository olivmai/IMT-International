<?php

  session_start();

  class Manager{
    
    private $config;
    private $bdd;
    
    public function __construct(){
      
      $config = $this->getConfig();
      
      try
      {
        $this->bdd = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbName'].';charset=utf8', $config['dbUser'], $config['dbPass']);
      }
      catch (Exception $e)
      {
        die('Erreur : ' . $e->getMessage());
      }
      
    }
    
    public function getConfig(){

      $config = array(
        'host' => '***',
        'dbName' => '***',
        'dbUser' => '***',
        'dbPass' => '***');
      
      return $config;
      
    }
    
    public function searchByCountry($country){
      
      //recupération ID pays
      $req = $this->bdd->prepare('SELECT * FROM pays WHERE id = :id ');
      $req->bindValue('id', $country, PDO::PARAM_STR);
      $req->execute();

      while($result = $req->fetch()){
        $id_pays = $result['id'];
        $_SESSION['pays'] = $result['nom_fr_fr'];
        $_SESSION['pays_alpha2'] = $result['alpha2'];
        $_SESSION['country'] = $result['nom_en_gb'];
        $_SESSION['eu'] = $result['eu'];
      }
      $req->closeCursor();
      
      // ENREGISTREMENT STAT RECHERCHE //
      $fromStat = $this->bdd->prepare('SELECT search_count FROM pays WHERE id = :id_pays');
      $fromStat->bindValue('id_pays', $id_pays, PDO::PARAM_INT);
      $fromStat->execute();
      $originStat = $fromStat->fetch();

      $newStat = $originStat['search_count'] + 1;

      $recStat = $this->bdd->prepare('UPDATE pays SET search_count = :search_count WHERE id = :id_pays');
      $recStat->bindValue('search_count', $newStat, PDO::PARAM_INT);
      $recStat->bindValue('id_pays', $id_pays, PDO::PARAM_INT);
      $recStat->execute();

      $fromStat->closeCursor();
      $recStat->closeCursor();
      
      //récupération ID métier dans la table de correspondance pays/métiers/secteurs
      $req = $this->bdd->prepare('SELECT id_metier FROM opportunity WHERE id_pays = :id_pays');
      $req->bindValue('id_pays', $country, PDO::PARAM_INT);
      $req->execute();

      //récupération de l'intitulé du métier
      $req2 = $this->bdd->prepare('SELECT rome_complete_code, main_prof_area_name FROM rome WHERE id = :id AND rome_complete_code != "" ORDER BY rome_complete_code');

      while($opportunity = $req->fetch()){
        $id_metier = $opportunity['id_metier'];
        $req2->bindParam('id', $id_metier, PDO::PARAM_INT);
        $req2->execute();
        $listeMetiers[] = $req2->fetch(PDO::FETCH_ASSOC);
      }
      
      $req2->closeCursor();
      $req->closeCursor();
      
      return $listeMetiers;
      
    }
    
    public function searchByShortage($codeRome){
      
      // ENREGISTREMENT STAT RECHERCHE //
      $fromStat = $this->bdd->prepare('SELECT search_count FROM rome WHERE rome_complete_code = :code');
      $fromStat->bindValue('code', $codeRome, PDO::PARAM_INT);
      $fromStat->execute();
      $originStat = $fromStat->fetch();

      $newStat = $originStat['search_count'] + 1;

      $recStat = $this->bdd->prepare('UPDATE rome SET search_count = :search_count WHERE rome_complete_code = :code');
      $recStat->bindValue('search_count', $newStat, PDO::PARAM_INT);
      $recStat->bindValue('code', $codeRome, PDO::PARAM_INT);
      $recStat->execute();

      $fromStat->closeCursor();
      $recStat->closeCursor();
      // fin enregistrement stat

      // RECUPERATION LISTE PAYS POUR LE METIER RECHERCHE
      $req_liste_pays = $this->bdd->prepare('SELECT nom_fr_fr, nom_en_gb, alpha2, eu FROM pays WHERE id IN(SELECT id_pays FROM opportunity WHERE id_metier IN(SELECT id FROM rome WHERE rome_complete_code = :code))');
      $req_liste_pays->bindValue('code', $codeRome, PDO::PARAM_STR);
      $req_liste_pays->execute();

      $nbResultat = $req_liste_pays->rowCount();
      
      if($nbResultat > 0){
        return $req_liste_pays->fetchAll();
      }
      else{
        return false;
      }
      
    }
    
    public function login($user, $password){

      $req = $this->bdd->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
      $req->bindParam('pseudo', $user, PDO::PARAM_STR);
      $req->execute();

      while ($user = $req->fetch()) {
        if (password_verify($password, $user['mdp'])) {
          return true;
        }
        else{
          return false;
        }
      }
      
    }

    public function addNewOpportunity($job_id, $country_id){

      $addNewOpportunity = $this->bdd->prepare('INSERT INTO opportunity(id_pays, id_metier) VALUES(:id_pays, :id_metier)');
      
      $addNewOpportunity->bindValue('id_pays', $country_id, PDO::PARAM_INT);
      $addNewOpportunity->bindValue('id_metier', $job_id, PDO::PARAM_INT);
      
      if($addNewOpportunity->execute()){
        return true;
      }
      else{
        return false;
      }
      
    }

    public function metierExists($codeRome){

      $compter = $this->bdd->prepare('SELECT COUNT(*) as total FROM rome WHERE rome_complete_code = :code');
      $compter->bindValue('code', $codeRome, PDO::PARAM_STR);
      $compter->execute();

      $nbLigne = $compter->fetch();
      $compter->closeCursor();

      if($nbLigne['total'] != 0){
        return true;
      }
      else{
        return false;
      }

    }

    public function getCountriesList(){

      $req = $this->bdd->query('SELECT * FROM pays ORDER BY nom_fr_fr ');
	    $list = $req->fetchAll(PDO::FETCH_ASSOC);
      $req->closeCursor();

      return $list;

    }

    public function getRomeId($codeRome){

      $getId = $this->bdd->prepare('SELECT id FROM rome WHERE rome_complete_code = :rome');
      $getId->bindValue('rome', $codeRome, PDO::PARAM_STR);
      $getId->execute();

      $romeId = $getId->fetch();

      return $romeId['id']; 
    }

    public function getCountry($id){

      $getCountry = $this->bdd->prepare('SELECT * FROM pays WHERE id = :id');
      $getCountry->bindValue('id', $id, PDO::PARAM_INT);
      $getCountry->execute();

      $country = $getCountry->fetchAll(PDO::FETCH_ASSOC);
      $getCountry->closeCursor();

      return $country;
    }

    public function getJob($id){

      $getJob = $this->bdd->prepare('SELECT rome_complete_code, main_prof_area_name FROM rome WHERE id = :id');
      $getJob->bindValue('id', $id, PDO::PARAM_INT);
      $getJob->execute();

      $job = $getJob->fetchAll(PDO::FETCH_ASSOC);
      $getJob->closeCursor();

      return $job; 
    }

    public function opportunityVerify($rome, $country){

      $verifyOpportunityExist = $this->bdd->prepare('SELECT COUNT(id_pays) AS nbr_doublon, id_pays FROM opportunity WHERE id_metier = :id_metier AND id_pays = :id_pays GROUP BY id_pays HAVING COUNT(id_pays) >= 1');
      $verifyOpportunityExist->bindValue('id_metier', $rome, PDO::PARAM_INT);
      $verifyOpportunityExist->bindValue('id_pays', $country, PDO::PARAM_INT);
      $verifyOpportunityExist->execute();

      $nbDoublon = $verifyOpportunityExist->fetch();

      if($nbDoublon['nbr_doublon'] >= 1){
        return true;
      }
      else{
        return false;
      }
    }

    public function getCountryFromOpportunity(){

      $getCountryListFromOpportunity = $this->bdd->query('SELECT id, nom_fr_fr FROM pays WHERE id IN(SELECT DISTINCT id_pays FROM opportunity) ORDER BY nom_fr_fr');

      $listePays = $getCountryListFromOpportunity->fetchAll(PDO::FETCH_ASSOC);

      $getCountryListFromOpportunity->closeCursor();

      return $listePays;
    }

    public function getListOfOpportunity($country_id){
      
      $getList = $this->bdd->prepare('SELECT id, rome_complete_code, main_prof_area_name FROM rome WHERE id IN(SELECT id_metier FROM opportunity WHERE id_pays = :id)');
      $getList->bindValue('id', $country_id, PDO::PARAM_INT);
      $getList->execute();

      $list = $getList->fetchAll(PDO::FETCH_ASSOC);

      $getList->closeCursor();

      return $list;
    }
    
    public function deleteOpportunity($country, $job){

      $deleteOpportunity = $this->bdd->prepare('DELETE FROM opportunity WHERE id_pays = :country AND id_metier = :job');
      $deleteOpportunity->bindValue('country', $country, PDO::PARAM_INT);
      $deleteOpportunity->bindValue('job', $job, PDO::PARAM_INT);

      if($deleteOpportunity->execute()){
        return true;
      }
      else{
        return false;
      }
    }

    public function autocomplete($q){

        //péparation de la requète
				$request = "SELECT main_prof_area_name, rome_complete_code
										FROM rome
										WHERE main_prof_area_name LIKE '%".$q."%'
										OR rome_complete_code LIKE '%".$q."%'
										AND rome_complete_code !=''
										ORDER BY rome_complete_code";
		
				//execution de la requète
				$req = $this->bdd->query($request);
		
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

        return $suggestions;

    }

    public function countryStat() {
        
      $getCountryStat = $this->bdd->query('SELECT search_count, nom_fr_fr FROM pays ORDER BY search_count DESC LIMIT 0, 5');

      $stat = $getCountryStat->fetchAll(PDO::FETCH_ASSOC);

      $getCountryStat->closeCursor();
      
      return $stat;
      
    }
    
    public function countryStatOfTheMonth() {
        
      $getCountryStat = $this->bdd->query('SELECT search_count, nom_fr_fr FROM pays WHERE id IN(SELECT id_pays FROM stat WHERE MONTH(date_search) >= MONTH(now())-1) ORDER BY search_count DESC LIMIT 0, 5');

      $stat = $getCountryStat->fetchAll(PDO::FETCH_ASSOC);

      $getCountryStat->closeCursor();
      
      return $stat;
      
    }

    public function shortageStat() {
        
      $getShortageStat = $this->bdd->query('SELECT search_count, rome_complete_code, main_prof_area_name FROM rome ORDER BY search_count DESC LIMIT 0, 5');

      $stat = $getShortageStat->fetchAll(PDO::FETCH_ASSOC);

      $getShortageStat->closeCursor();
      
      return $stat;
      
    }

    public function totalStat() {
      
      $shortageTotalStat = $this->bdd->query('SELECT SUM(search_count) AS totalShortage FROM rome');
      $countryTotalStat = $this->bdd->query('SELECT SUM(search_count) AS totalCountry FROM pays');
      
      $totalShortage = $shortageTotalStat->fetch();
      $totalCountry = $countryTotalStat->fetch();
      
      $totalStat = $totalCountry['totalCountry'] + $totalShortage['totalShortage'];
      
      return $totalStat;
      
    }

  }//end of class

?>
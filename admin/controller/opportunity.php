<div class="flex flex-column-space-around">
  <div class="flex-column-space-around form-container">

    <h3 class="form-title text-center">Gérer les opportunités</h3>

    <h4>Lister les opportunités par Pays</h4>
    <?php
    
    $manager = new Manager();

    $listePays = $manager->getCountryFromOpportunity();
    
    foreach($listePays as $pays){
      ?>
      <a class="btn btn-default btn-country <?php if(isset($_GET['country']) AND $pays['id'] == $_GET['country']){echo "active";}?>" href="?country=<?php echo $pays['id']; ?>">
        <?php echo $pays['nom_fr_fr']; ?></a>
      <?php
    }
    
    if(isset($_GET['country'])){
        unset($_SESSION['opportunity_r']);
        unset($_SESSION['opportunity_nr']);
    }

    if(isset($_GET['country']) AND !isset($_GET['list'])){

      //include 'method/getListOfOpportunity.php';
      $country = $_GET['country'];

      $listOfOpportunity = $manager->getListOfOpportunity($country);

      if(isset($_GET['delete'])){
        switch($_GET['delete']){
            case "ok":
            include 'view/alert/opportunityDeleted.php';
            break;
            
            case "error":
            include 'view/alert/opportunityNonDeleted.php';
            break;
        }
      }
      include 'view/listOfOpportunity.php';

    }

    ?>
    
  </div>
</div>
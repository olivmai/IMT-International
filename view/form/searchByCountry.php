<div class="flex-column form-container">
  <h3 class="form-title">Par pays <br><small>Retrouver la liste des ROMEs "porteurs" dans le pays selectionné</small></h3>
  <form action="controller/searchByCountry.php" method="post" class="form">
    <div class="form-group">
      <select name="pays" id="pays" class="form-control">
        <option value="#">Selectionner un pays</option>
        <?php
          require $_SESSION['app_root'].'/method/manager.class.php';
          $manager = new Manager();
          $list = $manager->getCountriesList();
          
          foreach ($list as $country)
          {?>
            <option value="<?php echo $country['id']; ?>"><?php echo $country['nom_fr_fr']; ?></option>
          <?php
          }
        ?>
      </select>
    </div>
    <input type="submit" value="Rechercher" class="btn btn-primary">
    <?php
    if(isset($_SESSION['noCountryResult']) AND $_SESSION['noCountryResult'] == 1){
      echo "<p class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button> <i class=\"fa fa-info-circle\"></i> Il n'y à pas encore d'informations disponibles pour le pays sélectionné</p>";
    }
    ?>
  </form>
</div>
<div class="flex flex-column-space-around">
  <div class="flex-column-space-around form-container">
    
    <h3 class="form-title text-center">Ajouter une opportunité</h3>

    <form action="controller/addNewOpportunity.php" method="post" class="form-horizontal" id="addForm">
      
      <div class="form-group">

        <div class="flex flex-center">

          <select name="pays" id="pays" class="form-control login-form-element">
            <option value="#">Selectionner un pays</option>
            <?php
            
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
        
        <div class="flex flex-center">

          <input id="rome_admin" name="metier" type="text" class="form-control" placeholder="Taper un code rome" data-toggle="tooltip" data-placement="left" title="Taper les trois premiers caractères (exemple : 'm18') pour afficher la liste et trouver un code ROME">
          
        </div>        
        
      </div>

      <div class="flex flex-center">

        <input type="submit" value="Enregistrer" class="btn btn-primary btn-lg btn-block login-form-element">

      </div>
       
    </form>     
    
  </div><!-- /end of main flex container -->		
</div>

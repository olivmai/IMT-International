<div class="flex flex-column-space-around stat">
  <div class="flex-column-space-around form-container">
    
    <h3 class="form-title text-center stat-main-title" data-toggle="collapse" href="#stat-block" aria-expanded="false" aria-controls="stat-block"><i class="fa fa-bar-chart"></i> Statistiques de recherche <span class="fa fa-angle-double-down pull-right"></span></h3>
    
    <div class="collapse" id="stat-block">
      
      <h4>Nombre total de recherches effectuées sur l'outil  <span class="badge"><?php echo $totalStat; ?></span></h4>
      
      <div class="flex flex-space-around">
    
        <div>
          <h4>Les pays les plus recherchés</h4>

          <div class="flex flex-column-space-around">

            <ul class="list-group">
              <?php
                $ia = 0;
                foreach ($countrystatAllTime as $country) {
                  ?>
                  <li class="list-group-item"><?php echo $country['nom_fr_fr']; ?> <span class="badge pull-right"><?php echo $country['search_count']; ?></span></li>
                  <?php
                  if (++$ia == 5) break;
                }
              ?>
            </ul>

          </div>
        </div>

        <div>
          <h4 class="text-center">Les ROMEs les plus recherchés</h4>

          <div class="flex flex-column-space-around">

            <ul class="list-group">
              <?php
                $ib = 0;
                foreach ($shortagestatAllTime as $shortage) {
                  ?>
                  <li class="list-group-item"><?php echo $shortage['rome_complete_code']." - ".$shortage['main_prof_area_name']; ?> <span class="badge pull-right"><?php echo $shortage['search_count']; ?></span></li>
                  <?php
                  if (++$ib == 5) break;
                }
              ?>
            </ul>

          </div>
        </div>
        
      </div>

    </div>
      
      
  </div>

</div>
<p class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <i class="fa fa-check"></i> 
  Nouvelle opportunité enregistrée avec succés. Vous la retrouverez désormais dans les résultats de recherche (par pays ou par métier)<br>
  <?php
  foreach($_SESSION[opportunity_r] as $opportunity){

    $country = $opportunity['id_pays'];
    $job = $opportunity['id_metier'];

    $manager = new Manager();

    $country = $manager->getcountry($country);
    $job = $manager->getJob($job);

    ?>
    <strong><?php echo $country[0]['nom_fr_fr']; ?></strong> < avec > <strong><?php echo $job[0]['rome_complete_code']." - ".$job[0]['main_prof_area_name']; ?></strong>
    <?php

  }
  ?>
</p>
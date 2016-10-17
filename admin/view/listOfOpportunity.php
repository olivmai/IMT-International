<ul class="list-unstyled listOfOpportunity">
<?php
  asort($listOfOpportunity);
  foreach($listOfOpportunity as $opportunity){
    ?>
    <li>
      <?php echo $opportunity['rome_complete_code']." - ".$opportunity['main_prof_area_name']; ?>
      <a class="pull-right delete" href="controller/deleteOpportunity.php?country=<?php echo $_GET['country']; ?>&job=<?php echo $opportunity['id']; ?>" data-toggle="tooltip" data-placement="top" title="Supprimer cette opportunité"><span class="fa fa-times" aria-hidden="true"></span>Supprimer</a>
    </li>
    <?php
  }
?>
</ul>

<a class="btn btn-danger" href="?list=hidden"><i class="fa fa-times"></i> Fermer la liste</a>
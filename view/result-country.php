<div class="flex-column-space-around form-container">
  <h3 class="result-title"><a href="controller/backToHome.php"><i class="fa fa-undo" data-toggle="tooltip" data-placement="top" title="Retour à l'accueil"></i></a> Métiers / secteurs porteurs pour : <strong><?php echo $_SESSION['pays']; ?> </strong></h3>
  <?php
  asort($_SESSION['listeMetiers']);
  foreach($_SESSION['listeMetiers'] as $metier){
    ?>
    <p class="metierResult"><i class="fa fa-dot-circle-o"></i> <?php echo $metier['rome_complete_code']." - ".$metier['main_prof_area_name']; ?> <a target="_blank" href="http://candidat.pole-emploi.fr/marche-du-travail/fichemetierrome?codeRome=<?php echo $metier['rome_complete_code'] ?>" class="label label-primary pull-right">Fiche ROME</a> </p>
    <?php
  }
  ?>
  <div class="flex flex-space-around btn-container">
    <a href="controller/backToHome.php" class="btn btn-primary"><i class="fa fa-search"></i> Nouvelle recherche</a>
    <a target="_blank" href="asset/file/<?php echo $_SESSION['pays']; ?>_Fiche-DG.pdf" class="btn btn-info" disabled="disabled"><i class="fa fa-file-text-o"></i> Voir la fiche <?php echo $_SESSION['pays']; ?></a>
    <?php if(isset($_SESSION['eu']) AND $_SESSION['eu'] == 1): ?>
    <a target="_blank" href="https://ec.europa.eu/eures/main.jsp?countryId=<?php echo $_SESSION['pays_alpha2']; ?>&acro=lw&parentId=0&catId=0&regionIdForAdvisor=&regionIdForSE=&regionString=PL0|%20:&lang=fr&app=0.8.1-build-2&pageCode=<?php echo strtolower($_SESSION['country']); ?>" class="btn btn-warning"><i class="fa fa-globe"></i> Page EURES <?php echo $_SESSION['pays'] ?></a>
    <?php endif; ?>
  </div>
</div>
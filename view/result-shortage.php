<div class="form-container">
  <h3 class="result-title"><a href="controller/backToHome.php"><i class="fa fa-undo" data-toggle="tooltip" data-placement="top" title="Retour à l'accueil"></i></a> Les pays à potentiel pour votre requète : <br>"<strong><?php echo $_SESSION['requete']; ?> </strong>"</h3>
  <?php
  foreach($_SESSION['liste_pays'] as $pays){
    ?>
    <p class="metierResult">
        <span class="result-item country-item">
          <span><strong><?php echo $pays['nom_fr_fr']; ?></strong></span>
        </span>
        <span class="result-item">
          <a target="_blank" href="asset/file/<?php echo $_SESSION['pays']; ?>_Fiche-DG.pdf" class="btn btn-info" disabled="disabled"><i class="fa fa-file-text-o"></i> Voir la fiche <?php echo $_SESSION['pays']; ?></a>
        </span>
        <span class="result-item">
          <?php if(isset($pays['eu']) AND $pays['eu'] == 1): ?>
          <a target="_blank" href="https://ec.europa.eu/eures/main.jsp?countryId=<?php echo $pays['alpha2']; ?>&acro=lw&parentId=0&catId=0&regionIdForAdvisor=&regionIdForSE=&regionString=PL0|%20:&lang=fr&app=0.8.1-build-2&pageCode=<?php echo $pays['nom_en_gb'] ?>" class="btn btn-warning"><i class="fa fa-globe"></i> Page EURES <?php echo $pays['nom_fr_fr'] ?></a>
          <?php endif; ?>
        </span>
    </p>
    <?php
  }
  ?>
  <a href="controller/backToHome.php" class="btn btn-primary btn-block btn-lg btn-back-pays"><i class="fa fa-search"></i> Nouvelle recherche</a>
</div>
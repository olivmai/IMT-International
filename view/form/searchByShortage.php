<div class="flex-column form-container">
  <h3 class="form-title">Par ROME <small><a target="_blank" href="http://www.pole-emploi.fr/candidat/les-fiches-metiers-@/index.jspz?id=681"><i class="fa fa-question-circle"></i> Rechercher un code ROME</a></small><br><small>Retrouvez la liste des pays ayant un potentiel de recrutement pour le ROME sélectionné</small></h3>
  <form action="controller/searchByShortage.php" method="post" class="form">
    <div class="form-group">
      <input id="rome" name="metier" type="text" class="form-control" placeholder="Taper un code rome" data-toggle="tooltip" data-placement="left" title="Taper les trois premiers caractères (exemple : 'm18') pour afficher la liste et trouver un code ROME">
    </div>
    <input type="submit" value="Rechercher" class="btn btn-primary">
    <?php
    if(isset($_SESSION['noShortageResult']) AND $_SESSION['noShortageResult'] == 1){
      echo "<p class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button><i class=\"fa fa-info-circle\"></i> Il n'y à pas (encore) d'informations disponibles pour le ROME sélectionné</p>";
    }
    ?>
  </form>
</div>
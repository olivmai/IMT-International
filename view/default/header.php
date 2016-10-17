<header class="flex flex-center">
  <div class="flex flex-align-center">
    <div class="img-container flex flex-center flex-align-center flex-wrap"><img src="http://www.imt-international.xyz/asset/img/logo-pole-emploi.jpg" alt="Logo Pôle emploi"></div>
    <?php
    if(preg_match("#admin#", $_SERVER['PHP_SELF'])) {
      ?>
      <h2>Espace administration</h2>
      <?php
    }
    else {
      ?>
      <h2>Rechercher des opportunités à l'international</h2>
      <?php
    }
    ?>
  </div>
</header>
<div class="flex-column form-container" id="login-form">
  
  <h3 class="form-title">Espace admin - Connexion</h3>
  
  <form action="../controller/login.php" method="post" class="form">
    
    <div class="input-group login-form-element">
      <span class="input-group-addon" id="user-addon"><i class="fa fa-user fa-2x"></i></span>
      <input type="text" name="pseudo" class="form-control input-lg" placeholder="Identifiant" aria-describedby="user-addon">
    </div>
    
    <div class="input-group login-form-element">
      <span class="input-group-addon" id="password-addon"><i class="fa fa-lock fa-2x"></i></span>
      <input type="password" name="mdp" class="form-control input-lg" placeholder="Mot de passe" aria-describedby="password-addon">
    </div>
    
    <div class="flex flex-center">
    
      <input type="submit" value="Connexion" class="btn btn-primary btn-lg btn-block login-form-element">
      
    </div>
    
  </form>
  
</div>
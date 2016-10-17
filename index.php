<?php

	session_start();

	$_SESSION['app_root'] = __DIR__;

	include $_SESSION['app_root'].'/asset/analyticstracking.php';
	include $_SESSION['app_root'].'/view/default/template_start.php';
	include $_SESSION['app_root'].'/view/default/btn-admin.php';
	include $_SESSION['app_root'].'/view/default/header.php';

?>

<section class="flex flex-column-center">
	<div class="flex flex-column-space-around"><!-- ROW -->
	<?php
		if(isset($_SESSION['listeMetiers']) OR isset($_SESSION['liste_pays'])) {
			
			echo "<h2>Resultats de votre recherche</h2>";
			
			if(isset($_SESSION['listeMetiers'])) {
				include $_SESSION['app_root'].'/view/result-country.php';	
			}
			
			elseif(isset($_SESSION['liste_pays'])){
				include $_SESSION['app_root'].'/view/result-shortage.php';
			}
			
		}
		else{
			
			include $_SESSION['app_root'].'/view/form/searchByCountry.php';
			include $_SESSION['app_root'].'/view/form/searchByShortage.php';
								
		}
	?>
	</div><!-- /endROW -->

</section>

<?php include $_SESSION['app_root'].'/view/default/template_end.php'; ?>
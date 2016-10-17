<?php
	session_start();

	include $_SESSION['app_root'].'/view/default/template_start.php';
	include $_SESSION['app_root'].'/view/default/btn-home.php';
	include $_SESSION['app_root'].'/view/default/header.php';

	require_once $_SESSION['app_root'].'/method/manager.class.php';	

	if(isset($_SESSION['opportunity_r'])){
		include $_SESSION['app_root'].'/admin/view/alert/opportunityRegistered.php';
	}
	
	if(isset($_SESSION['opportunity_nr'])){
		include $_SESSION['app_root'].'/admin/view/alert/opportunityNonRegistered.php';	
	}
?>
	<section class="flex flex-column-center">
	<?php
		if(!empty($_SESSION['admin'])){
			
			include $_SESSION['app_root'].'/admin/controller/stat.php';

			include $_SESSION['app_root'].'/admin/view/form/addForm.php';
			include $_SESSION['app_root'].'/admin/controller/opportunity.php';
		
		}

		else{
			
			include $_SESSION['app_root'].'/admin/view/form/login.php';
			
		}
		?>			
	</section>
<?php
  include $_SESSION['app_root'].'/view/default/template_end.php';
?>
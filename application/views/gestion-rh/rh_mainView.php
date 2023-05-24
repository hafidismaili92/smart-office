<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html style="width:100%;height:100%">
<head>
	<meta set="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>GEOSOLUTION RH MANAGEMENT</title>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/fontawesome-free-5.12.0-web/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/DataTables/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/DataTables/Responsive-2.2.3/css/responsive.bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/chart-js/chart.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/dropify-master/css/dropify.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/datatables-style.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/rh-sections/rh_MainView.css">
	<style>
	
:root {
  --level-1: #8dccad;
  --level-2: #f5cc7f;
  --level-3: #7b9fe0;
  --level-4: #f27c8d;
  --black: black;
}


	</style>
</head>
<body style="width:100%;height:100%;position: relative;padding: 0;margin:0 ">
	<div id="loader-container" class="loaderDialog hidden">
		<div>
			<div class="loader">

			</div>
			<div class="loader">
				
			</div>

		</div>
	</div>
	<div id="wrraper" style="display: flex;flex-direction: row;min-height: 100%">
		<div id="left-SideBar" class="hidden">
			<div id="toggle-sidebar"><i class="fas fa-bars"></i></div>
			<div id="sidebar-content">
			<div>
			<div id="user-avatar">
				<img src="data:<?php echo $profil['photoMime']?>;base64, <?php echo $profil['photo64']?>">
			</div>
			<div id="user-info" style="margin-bottom: 50px;">
				<p id="nom"><?php echo  $this->session->userPrenom.' '.$this->session->userNom.' ('.$this->session->char_matricule.' )'; ?></p>
				<p id="fonction"><?php echo$this->session->libelle_fonction; ?></p>
				<p id="etablissement"><?php echo$this->session->libelle_etablissement; ?></p>
			</div>
			</div>
			<div id="menus-container">
				<div class="principal-items active" id="liste-employe">
					<i class="fas fa-list fa-2x"></i>
					<h6>Liste du Personnel</h6>
				</div>
				<div class="principal-items" id="ajouter-employe">
					<i class="fas fa-plus fa-2x"></i>
					<h6>Nouvel Recrue</h6>
				</div>
				<div class="principal-items" id="gestion-employee">
					<i class="fas fa-user-cog fa-2x"></i>
					<h6>Gestion du Personnel</h6>
				</div>
				<div class="principal-items" id="gestion-fonction">
					<i class="fas fa-briefcase fa-2x"></i>
					<h6>Gestion des fonctions</h6>
				</div>
			</div>
			<div style="width: 100%;text-align: center;margin-top: 30px;">
				<a href="Login/logout"><i class="fas fa-power-off fa-lg" style="color:#dcf3ff;" id="taches-bell"></i></a>
			</div> 
			</div>
			<!-- <div id="toggle-sidebar"><i class="fas fa-bars"></i></div>
			<div id="user-avatar">
				<img src="data:<?php echo $profil['photoMime']?>;base64, <?php echo $profil['photo64']?>">
			</div>
			<div id="user-info" style="margin-bottom: 50px;">
				<p id="nom"><?php echo  $this->session->userPrenom.' '.$this->session->userNom.' ('.$this->session->char_matricule.' )'; ?></p>
				<p id="fonction"><?php echo$this->session->libelle_fonction; ?></p>
				<p id="etablissement"><?php echo$this->session->libelle_etablissement; ?></p>
			</div>
			<div>
				<div class="principal-items" id="liste-employe">
					
					Liste du Personnel
					
				</div>
			</div>
			<div>
				<div class="principal-items" id="ajouter-employe">
					
					Créer Nouvel Recrue
					
				</div>
			</div>
			<div>
				<div class="principal-items" id="gestion-employee">
					
					Gestion du Personnel
					
				</div>
			</div>
			<div>
				<div class="principal-items" id="gestion-fonction">
					
					Gestion des fonctions
					
				</div>
			</div>
			<div style="width: 100%;text-align: center;margin-top: 30px;">
				<a href="Login/logout"><i class="fas fa-power-off fa-2x" style="color:white;" id="taches-bell"></i></a>
			</div> -->
		</div>
		<div id="main-container" style="min-height: 100%;background-color:#f6f6f6;" class="addMargeL">
			<?php echo $gestionEmployee ?>
			<?php echo $listEmploye ?>
			<?php echo $nouveauEmploye ?>
			<?php echo $gestionFonctions ?>
		</div>
	</div>
	<div class="modal" tabindex="-1" role="dialog" id="modal-dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Confirmation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p id="dialog-msg"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="confirm-dialog-btn">confirmer</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-dialog-btn">Quitter</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url()?>assets/libraries/jquery/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/libraries/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/DataTables/datatables.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/jszip.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/buttons.html5.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/chart-js/chart.bundle.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/chart-js/plugins/chartjs-plugin-datalabels.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/DataTables/Responsive-2.2.3/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/moment/moment.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/dropify-master/js/dropify.min.js"></script>
	
	<script src="<?php echo base_url()?>assets/libraries/dom-to-img/dom-to-img.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <!--  <script src="<?php echo base_url()?>assets/libraries/fabric/fabric.js"></script> -->
	<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/rh-sections/rh_mainScript.js"></script>

	<script type="text/javascript">
		BaseUrl = "<?php echo base_url();?>";
		configuration = {
			'heure_debut_travail':moment('<?php echo heure_debut_travail; ?>','HH:mm'),
			'heure_fin_travail':moment('<?php echo heure_fin_travail; ?>','HH:mm'),
			'congee_annee':'<?php echo congee_annee; ?>',
			'h_travail_jour':'<?php echo h_travail_jour; ?>',
			'h_travail_semaine':'<?php echo h_travail_semaine; ?>',
			'nbrJ_travail_semaine':'<?php echo nbrJ_travail_semaine; ?>',
			'h_travail_mois':'<?php echo h_travail_mois; ?>',
			'nbrJ_travail_mois':'<?php echo nbrJ_travail_mois; ?>',
			'h_travail_annee':'<?php echo h_travail_annee; ?>',
			'nbrJ_travail_annee':'<?php echo nbrJ_travail_annee; ?>'
		}
	
	</script>
</body>
</html>
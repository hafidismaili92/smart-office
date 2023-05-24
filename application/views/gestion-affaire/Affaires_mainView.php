<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html style="width:100%;height:100%">
<head>
	<meta set="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Smart-desk</title>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/fontawesome-free-5.12.0-web/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/jstree-master/themes/default/style.min.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/DataTables/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/DataTables/Responsive-2.2.3/css/responsive.bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/dropify-master/css/dropify.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/chart-js/chart.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/datatables-style.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/affaire-sections/affaire_MainView.css">
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
			<div id="user-info-container">
				<div id="user-avatar">

					<img src="data:<?php echo $profil['photoMime']?>;base64, <?php echo $profil['photo64']?>">
				</div>
				<div id="user-info">
					<p id="nom"><?php echo  $this->session->userPrenom.' '.$this->session->userNom.' ('.$this->session->char_matricule.' )'; ?></p>
					<p id="fonction"><?php echo$this->session->libelle_fonction; ?></p>
					<p id="etablissement"><?php echo$this->session->libelle_etablissement; ?></p>
				</div>
			</div>
			<div id="menu">
				<div class="principal-items active" id="mesaffaires">
					<i class="fas fa-list menu-icons fa-lg"></i>
					<span>Mes Affaires</span>
					
				</div>
				
				<div class="second-items">
					<i class="fas fa-info menu-icons fa-lg"></i>
					Informations
				</div>
				<div>
					<ul>
						<li id="details-items" class="sub-menu">
							<i class="fas fa-list menu-icons fa-md"></i>
							<span>Détails</span>
						</li>
						<li id="affaire-missions-items" class="sub-menu"><i class="fas fa-bullseye menu-icons fa-md"></i>
							<span>Missions</span></li>

						</ul>
					</div>
					<div class="principal-items" id="taches-items">
						<i class="fas fa-bell fa-lg" id="taches-bell"></i> Mes Tâches (<span id="countUnconselted-tache">0</span>)
					</div>
					
					<div class="principal-items" id="global-affaires">
						<i class="fas fa-eye menu-icons "></i>
						Vue d'ensemble

					</div>
					<div class="principal-items" id="e-Documents">
						<i class="fas fa-file-pdf menu-icons fa-lg"></i>
						E-Documents

					</div>

				</div>
				<div style="width: 100%;text-align: center;margin-top: 15px;">
					<a href="Login/logout"><i class="fas fa-power-off fa-2x" style="color:white;" id="taches-bell"></i></a>
				</div>
			</div>
			<div id="main-container" class="addMargeL">
				<?php

				echo $affairesSection;
				echo $detailsSection;
				echo $eDocumentsSection;
				echo $affaireMissionsSection;
				echo $mesTachesSection;
				echo $tache_StacheSection;
				echo $globalAffaires;

				?>
			</div>
		</div>

		<div class="modal fade" id="add-rangee-modal" tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false">

			<!--AJOUTER DES RANGEE-->
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ajouter un endroit de Classement</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" style="height: 500px;">
						<div class="row">
							<input type="text" name="nouveau-rangee" id="nouveau-rangee" class="col-8">
							<button type="button" class="btn btn-info btn-sm btn-block col-3 ml-auto mr-auto" id="create-rangee"><i class="fas fa-plus"></i> Ajouter</button>
							<small id="rangee-error" style="color: red;display: none;">Veuillez donner un nom à l'endroit de classement</small>
						</div>
						<div style="max-height: 400px;overflow-y: auto;" id="rangee-container">
							<?php


							foreach ($listRangee as $value) {
								echo '<li style="list-style-type: none;border-bottom:1px solid rgba(0,0,0,0.2)">'.$value['rangee'].'</li>';
							}

							?>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="modal fade "  tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false" id="add-emplacement-modal">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modal-emplacement-label">Emplacement Géographique de l'Affaire</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" style="height: 500px;display: flex;flex-direction: column;">
						<div style="width: 100%;border: 1px solid red;" class="row">
							<div class="col-8">
								<label class="radio-inline"><input type="radio" name="geomType" value="Point" checked>POINT</label>
								<label class="radio-inline"><input type="radio" name="geomType" value="Polygon">POLYGONE</label>
								<label class="radio-inline"><input type="radio" name="geomType" value="LineString">LIGNE</label>
							</div>
							<div class="col-2" style="padding:0;">
								<button type="button" class="btn btn-outline-success btn-sm btn-block" id="valider-emplacement"><i class="fas fa-map-marked-alt"></i>Valider</button>

							</div>
							<div class="col-2" style="padding:0;">

								<button type="button" class="btn btn-outline-danger btn-sm btn-block" id="reset-emplacement"><i class="fas fa-map-marked-alt"></i>Supprimer</button>
							</div>

						</div>
						<div id="affaire-map" class="map" style="width: 100%;flex-grow: 1;">

						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="modal fade" id="employees-modal" tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false">

			<!--AJOUTER DES RANGEE-->
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="employees-modal">Liste des employées</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" style="height: 500px;">
						<table id="employees-table" class="compact display responsive compact-style" style="width: 90%;padding-right: 10px;">
							<thead>
								<tr>
									<th>Matricule</th>
									<th>Nom et Prénom</th>
									<th>Fonction</th>	
									<th>Etablissement</th>
								</tr>
							</thead>
						</table>

						<div class="row">

							<input type="text" readonly id="selected-responsable" class="col-7 ml-auto">
							<button class="btn  btn-sm btn-danger" class="col-4 ml-auto" id="select-responsable">Selectionner</button>
						</div>

					</div>

				</div>
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
		<script src="<?php echo base_url()?>assets/libraries/moment/moment.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/DataTables/datatables.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/jszip.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/DataTables/Responsive-2.2.3/js/dataTables.responsive.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/chart-js/chart.bundle.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/chart-js/plugins/chartjs-plugin-datalabels.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/dropify-master/js/dropify.min.js"></script>
		<script type="text/javascript">
			BaseUrl = "<?php echo base_url();?>";

			actualUser="<?php echo $this->session->userdata('numeric_matricule');?>";
			selectedAffaire="<?php echo $this->session->userdata('first-affaire');?>";
			selectedTache="";
			selectedAffaireTache="";
		</script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/affaire-sections/affaires_mainScript.js"></script>

	</body>
	</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="CRMS - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>SMART-DESK</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>images/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/font-awesome.min.css">

        <!-- Feathericon CSS -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/feather.css">

        <!--font style-->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/jquery-steps/jquery.steps.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/dropify-master/css/dropify.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.css">
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/style.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/inscription.css">
		
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content container-fluid">
				
				<div class="row d-flex justify-content-center align-items-center" style="padding: 20px;">
					<div class="col-12 col-md-9 " >
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index.html"><img src="<?php echo base_url()?>images/entreprise_logo.png" alt="SMART-DESK"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box" style="width: 100%;">
						<div class="account-wrapper">
							<h3 class="account-title">Nouvelle Entreprise</h3>
							<p class="account-subtitle">Ajouter Votre Entreprise</p>
							
							<!-- Account Form -->
							<form id="inscription-form" action="Entreprise/inscription" method="post">
					

					<h3>Entreprise</h3>
					<fieldset>
						<div class="form-row d-flex justify-content-center">
							<div class="form-group col-12 col-sm-6 col-md-4">
								<label for="employe-photo">Photos</label>
								<div class="input-group input-group-sm">
									<input type="file" class="form-control" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="5M" id="entreprise-logo" name="entreprise-logo" data-height="100" />

								</div>

							</div>
						</div>
						<div class="form-row d-flex justify-content-around">
							<div class="form-group col-12 col-sm-6 col-md-5">
								<label for="entreprise-nom">Nom Entreprise<span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control" id="entreprise-nom" name="entreprise-nom" placeholder="Le nom de l'entreprise"  required>
								</div>

							</div>
							<div class="form-group col-12 col-sm-6 col-md-5 ">
								<label for="entreprise-domaine">Domaine d'activité<span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group">
									<select class="custom-select" id="entreprise-domaine" name="entreprise-domaine" style="font-size: 12px;" required>
									<option value=""><span style="color: rgba(0,0,0,0.2);">Selectionner</span></option>
									<?php
									foreach ($domaines as $value) {
										echo '<option value="'.$value['code'].'">'.$value['libelle'].'</option>';
									}

									?>

								</select>
								</div>
								
							</div>
						</div>
						<div class="form-row d-flex justify-content-around">
							<div class="form-group col-12 col-sm-6 col-md-5 ">
								<label for="entreprise-email">Email <span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									
									<input type="email" class="form-control" id="entreprise-email" name="entreprise-email" placeholder="votre Email ici" required>
								</div>

							</div>
							<div class="form-group col-12 col-sm-6 col-md-5 ">
								<label for="entreprise-tel">Tèl :</label>
								<div class="input-group input-group-sm">
									
									<input type="text" class="form-control" id="entreprise-tel" name="entreprise-tel" placeholder="0625325478">
								</div>

							</div>
						</div>	
						<div class="form-row d-flex justify-content-around">

							<div class="form-group col-12 col-sm-6 col-md-5 ">
								<label for="entreprise-fax">Fax :</label>
								<div class="input-group input-group-sm">
									
									<input type="text" class="form-control" id="entreprise-fax" name="entreprise-fax" placeholder="0625325478">
								</div>

							</div>
							<div class="form-group col-12 col-sm-6 col-md-5 ">
								<label for="entreprise-ice">ICE :</label>
								<div class="input-group input-group-sm">
									
									<input type="number" class="form-control" id="entreprise-ice" name="entreprise-ice" placeholder="">
								</div>
								<small id="client-aide" class="form-text text-muted">Identifiant Commun de l’Entreprise (15 chiffres)</small>
							</div>
						</div>
						<div class="form-row d-flex justify-content-around">
							<div class="form-group col-12 col-sm-6 col-md-5 ">
								<label for="entreprise-ville">Ville <span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									
									<div class="input-group">
									<select class="custom-select" id="entreprise-ville" name="entreprise-ville" required>
										<?php
										foreach ($villes as $value) {
											echo '<option value="'.$value['ville'].'">'.$value['ville'].'</option>';
										}

										?>
									</select>
								</div>
								</div>

							</div>
							<div class="form-group col-12 col-sm-6 col-md-5 ">
								<label for="entreprise-adresse">Adresse</label>
								<div class="input-group input-group-sm">
									
									<input type="text" class="form-control" id="entreprise-adresse" name="entreprise-adresse" placeholder="adresse">

								</div>

							</div>

						</div>
					</fieldset>
					<h3>Profil Directeur</h3>
					<fieldset>

						<div class="form-row d-flex justify-content-around">

							<div class="form-group col-12 col-sm-6 col-md-5 ">
								<label for="employe-prenom">Prénom<span style="font-weight: bold;">*</span></label>
								<div class="input-group input-group-sm">
									
									<input type="text" class="form-control" id="employe-prenom" name="employe-prenom" placeholder="Prenom"  required>
								</div>

							</div>
							<div class="form-group col-12 col-sm-6 col-md-5 ">
								<label for="employe-nom">Nom<span style="font-weight: bold;">*</span></label>
								<div class="input-group input-group-sm">
									
									<input  type="text" class="form-control" id="employe-nom" placeholder="Nom" required name="employe-nom">
								</div>

							</div>
						</div>
						<div class="form-row d-flex justify-content-around">

							<div class="form-group col-12 col-sm-6 col-md-5 ">
								<label for="employe-email">Email <span style="font-weight: bold;">*</span></label>
								<div class="input-group input-group-sm">
									
									<input type="email" class="form-control" id="employe-email" name="employe-email" placeholder="votre Email ici" required>
								</div>

							</div>
							<div class="form-group col-12 col-sm-6 col-md-5 ">
								<label for="employe-tel">Tèl :</label>
								<div class="input-group input-group-sm">
									
									<input type="text" class="form-control" id="employe-tel" name="employe-tel" placeholder="0625325478">
								</div>

							</div>

						</div>
						
					</fieldset>
				</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		<div class="modal fade" id="success-nouvel-entreprise" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nouvelle Entreprise</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
		<!-- jQuery -->
        <script src="<?php echo base_url()?>assets/template/js/jquery-3.5.0.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/jquery-validation/jquery.validate.min.js"></script>
		<!-- Bootstrap Core JS -->
        <script src="<?php echo base_url()?>assets/template/js/popper.min.js"></script>
        <script src="<?php echo base_url()?>assets/template/js/bootstrap.min.js"></script>
		
		<script src="<?php echo base_url()?>assets/libraries/dropify-master/js/dropify.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/jquery-validation/jquery.validate.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/jquery-steps/jquery.steps.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.js"></script>
		<!-- Custom JS -->
		<script src="<?php echo base_url()?>assets/template/js/app.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/inscription.js"></script>
		
    </body>
</html>
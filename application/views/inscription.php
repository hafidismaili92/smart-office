<!DOCTYPE html>
<html>
<head>
	<title>COMPANY SOLUTIONS</title>
	<meta set="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/jquery-steps/jquery.steps.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/dropify-master/css/dropify.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/fontawesome-free-5.12.0-web/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/dropify-master/css/dropify.min.css">
	<style type="text/css">
		html,body
		{
			height: 100%;
			width: 100%;
		}
		.btn
		{
			width: 45%;
			border-radius: 25px 0 25px 0;
		}
		ul
		{
			list-style-type: circle;
		}
		#inscription-container .wizard .content {
			min-height: 100px;
			background-color: white !important;
			width: 100%;
		}
		#inscription-container .wizard .content > .body {
			width: 100%;
			height: auto;
			padding: 15px;
			position: absolute;
		}
		#inscription-container .wizard .content .body.current {
			position: relative;
		}

		#inscription-container .wizard > .steps a, #inscription-container .wizard > .steps a:hover, .wizard > .steps a:active
		{
			padding: 0.5em !important;
			font-size: 12px;
		}

		#inscription-container .wizard > .steps .current a
		{
			background: #1e3c72;  /* fallback for old browsers */
			background: -webkit-linear-gradient(to right, #2a5298, #1e3c72);  /* Chrome 10-25, Safari 5.1-6 */
			background: linear-gradient(to right, #2a5298, #1e3c72); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

			color: #fff;
			cursor: default;
			font-size: 0.8em;
		}
		#inscription-container .wizard > .steps .error a, #inscription-container .wizard > .steps .error a:hover, #inscription-container .wizard > .steps .error a:active {
			background: #E44D26;  /* fallback for old browsers */
			background: -webkit-linear-gradient(to right, #F16529, #E44D26);  /* Chrome 10-25, Safari 5.1-6 */
			background: linear-gradient(to right, #F16529, #E44D26); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

		}

		#inscription-container .wizard > .actions a, .wizard > .actions a:hover, #inscription-container .wizard > .actions a:active {
			background: #1e3c72;  /* fallback for old browsers */
			background: -webkit-linear-gradient(to right, #2a5298, #1e3c72);  /* Chrome 10-25, Safari 5.1-6 */
			background: linear-gradient(to right, #2a5298, #1e3c72); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

			color: #fff;
			cursor: default;
			font-size: 0.8em;
		}
		#inscription-container .wizard > .actions .disabled a, #inscription-container .wizard > .actions .disabled a:hover, #inscription-container .wizard > .actions .disabled a:active {
			background: #eee;
			color: #aaa;
		}
	</style>
</head>
<body>
	<div class="container" id="inscription-container" style="height: 100%;display: flex;flex-direction: column;justify-content: top;padding-top: 1%;">
		<div class="row justify-content-center" style="max-height: 50px;">
			<div class="col-7 col-sm-7 col-md-3 my-auto mx-auto">

				<?php
				$image_properties = array('src' => $img,'width' => '80%');
				echo img($image_properties); 


				?>

			</div>
			<div class="col-12 col-sm-12 col-md-9 mx-auto">
				<form id="inscription-form" action="Entreprise/inscription" method="post">
					

					<h3>Entreprise</h3>
					<fieldset>
						<div class="form-row">
							<div class="form-group col-3">
								<label for="employe-photo">Photos</label>
								<div class="input-group input-group-sm">
									<input type="file" class="form-control" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="1M" id="entreprise-logo" name="entreprise-logo" data-height="100" />

								</div>

							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-6">
								<label for="entreprise-nom">Nom Entreprise<span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control" id="entreprise-nom" name="entreprise-nom" placeholder="Le nom de l'entreprise"  required>
								</div>

							</div>
							<div class="form-group col-6">
								<label for="entreprise-domaine">Domaine d'activité<span style="font-weight: bold;color:red;">*</span></label>

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
						<div class="form-row">
							<div class="form-group col-6">
								<label for="entreprise-email">Email <span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text">@</span>
									</div>
									<input type="email" class="form-control" id="entreprise-email" name="entreprise-email" placeholder="votre Email ici" required>
								</div>

							</div>
							<div class="form-group col-6">
								<label for="entreprise-tel">Tèl :</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
									</div>
									<input type="text" class="form-control" id="entreprise-tel" name="entreprise-tel" placeholder="0625325478">
								</div>

							</div>
						</div>	
						<div class="form-row">

							<div class="form-group col-6">
								<label for="entreprise-fax">Fax :</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
									</div>
									<input type="text" class="form-control" id="entreprise-fax" name="entreprise-fax" placeholder="0625325478">
								</div>

							</div>
							<div class="form-group col-6">
								<label for="entreprise-ice">ICE :</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
									</div>
									<input type="number" class="form-control" id="entreprise-ice" name="entreprise-ice" placeholder="">
								</div>
								<small id="client-aide" class="form-text text-muted">Identifiant Commun de l’Entreprise (15 chiffres)</small>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-6">
								<label for="entreprise-ville">Ville <span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
									</div>
									<select class="custom-select" id="entreprise-ville" name="entreprise-ville" required>
										<?php
										foreach ($villes as $value) {
											echo '<option value="'.$value['ville'].'">'.$value['ville'].'</option>';
										}

										?>
									</select>
								</div>

							</div>
							<div class="form-group col-6">
								<label for="entreprise-adresse">Adresse</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
									</div>
									<input type="text" class="form-control" id="entreprise-adresse" name="entreprise-adresse" placeholder="adresse">

								</div>

							</div>

						</div>
					</fieldset>
					<h3>Profil Directeur</h3>
					<fieldset>

						<div class="form-row">

							<div class="form-group col-6">
								<label for="employe-prenom">Prénom<span style="font-weight: bold;">*</span></label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input type="text" class="form-control" id="employe-prenom" name="employe-prenom" placeholder="Prenom"  required>
								</div>

							</div>
							<div class="form-group col-6">
								<label for="employe-nom">Nom<span style="font-weight: bold;">*</span></label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input  type="text" class="form-control" id="employe-nom" placeholder="Nom" required name="employe-nom">
								</div>

							</div>
						</div>
						<div class="form-row">

							<div class="form-group col-6">
								<label for="employe-email">Email <span style="font-weight: bold;">*</span></label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text">@</span>
									</div>
									<input type="email" class="form-control" id="employe-email" name="employe-email" placeholder="votre Email ici" required>
								</div>

							</div>
							<div class="form-group col-6">
								<label for="employe-tel">Tèl :</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
									</div>
									<input type="text" class="form-control" id="employe-tel" name="employe-tel" placeholder="0625325478">
								</div>

							</div>

						</div>
						
					</fieldset>
				</form>
			</div>
		</div>
	</div>
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
	<script type="text/javascript" src="<?php echo base_url()?>assets/libraries/jquery/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/libraries/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/dropify-master/js/dropify.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/jquery-validation/jquery.validate.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/jquery-steps/jquery.steps.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.js"></script>
	
</body>
</html>
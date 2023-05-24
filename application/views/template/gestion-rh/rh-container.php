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
        <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/dropify-master/css/dropify.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/chart-js/chart.css">
        <!-- Feathericon CSS -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/feather.css">

        <!--font style-->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/line-awesome.min.css">

        <!-- Select2 CSS -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/select2.min.css">

        <!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/bootstrap-datetimepicker.min.css">

        <!-- Datatable CSS -->
        
		<link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/dataTables.bootstrap4.min.css">

		<!-- loadingCSS -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.css">

		<!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/theme-settings.css">

		<!-- Main template CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/style.css">
        <!-- Custom CSS-->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/rh-sections/rh_MainView.css">

    </head>
    <body id="skin-color" class="inter">
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
             <?php echo $header;?>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <?php echo $sideBarre; ?>
			<!-- /Sidebar -->
			<!-- /Main Wrapper -->
			<?php

				echo $listEmploye;
				echo $gestionEmployee;
				?>
			
        </div>
	
		<!-- /Main Wrapper -->

		<!--modal section starts here-->
		<!-- Modal -->
			<div class="modal right fade" id="edit-recrue-modal" tabindex="-1" role="dialog" aria-modal="true">
				<div class="modal-dialog" role="document">
					<button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<div class="modal-content">

						<div class="modal-header">
		                    <h4 class="modal-title text-center">Modifier Employé: <span id="employe-editMatricule" class="text-info"></span></h4>
		                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
		                  </div>

						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									
						        	
								<form action="<?php echo base_url()?>Employes/editEmploye" method="post" id="edit-employe-form">
									<h4 class="form-section-header">Photo</h4>
								<div class="row justify-content-center d-flex" style="padding-bottom: 15px;">
									
						<input type="file" class="form-control dropify" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="5M" id="employe-editphoto" name="employe-photo" data-height="100" />
					</div>
					<h4 class="form-section-header">Informations Employés</h4>
									<div class="form-group row">

					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Prénom<span class="text-danger">*</span></label>
	                            					<input type="text" class="form-control" id="employe-editprenom" name="employe-prenom" placeholder="Prenom"  required>
					                            </div>
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Nom<span class="text-danger">*</span></label>
	                            					<input  type="text" class="form-control" id="employe-editnom" placeholder="Nom" required name="employe-nom">
					                            </div>
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">C.I.N<span class="text-danger">*</span></label>
	                            					<input  type="text" class="form-control" id="employe-editcin" placeholder="CIN" name="employe-cin" required>
					                            </div>
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Résidence<span class="text-danger">*</span></label>
	                            					<select class="custom-select" id="employe-editresidence" name="employe-residence">
										<?php
										foreach ($villes as $value) {
											echo '<option value="'.$value['ville'].'">'.$value['ville'].'</option>';
										}

										?>

									</select>
					                            </div>
					                           
					                        <!-- </div>
					                        <div class="form-group row"> -->
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Genre<span class="text-danger">*</span></label>
	                            					<select class="custom-select" id="employe-editsexe" name="employe-sexe">
										<option selected value="M">M</option>
										<option value="F">F</option>

									</select>
					                            </div>
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Date Naissance<span class="text-danger">*</span></label>
	                            					<input type="date" class="form-control" id="employe-editdate-naissance" placeholder="23/05/1999" required  name="employe-date-naissance">
					                            </div>
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Date recrutement<span class="text-danger">*</span></label>
	                            					<input type="date" class="form-control" id="employe-editdate-recrutement" name="employe-date-recrutement" placeholder="23/05/2016" required >
					                            </div>
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Lieu naissance<span class="text-danger">*</span></label>
	                            					<select class="custom-select" id="employe-editlieu-naissance" name="employe-lieu-naissance">
									<?php
									foreach ($villes as $value) {
										echo '<option value="'.$value['ville'].'">'.$value['ville'].'</option>';
									}

									?>
								</select>
					                            </div>
					                           
					                        <!-- </div>
					                        <div class="form-group row"> -->
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Email<span class="text-danger">*</span></label>
	                            					<input type="email" class="form-control" id="employe-editemail" name="employe-email" placeholder="votre Email ici" required>
					                            </div>
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Adresse</label>
	                            					<input type="text" class="form-control" id="employe-editadresse" name="employe-adresse" placeholder="adresse">
					                            </div>
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Tèl</label>
	                            					<input type="text" class="form-control" id="employe-edittel" name="employe-tel" placeholder="0625325478">
					                            </div>
					                            
					                           
					                        <!-- </div>
					                        <div class="form-group row"> -->
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Statut familial</label>
	                            					<select class="custom-select" id="employe-editsituation" name="employe-situation">
									<option selected value="Célebataire">Célebataire</option>
									<option value="Marié">Marié</option>
									<option value="Divorcé">Divorcé</option>
									<option value="Remarié">Remarié</option>
									<option value="Veuf">Veuf</option>
								</select>
					                            </div>
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Entité<span class="text-danger">*</span></label>
	                            					<select class="custom-select employe-etablissement-list" id="employe-editetablissement" name="employe-etablissement" >
	                            						<?PHP
	                            						foreach ($etablissementsList as $item) {
	                            							echo '<option value="' .$item[0] .'">' . $item[1] ."</option>";
	                            						}
	                            						?>
								</select>
					                            </div>
					                            <div class="col-sm-6 col-md-4">
					                            	<label class="col-form-label">Fonction<span class="text-danger">*</span></label>
	                            					<select class="custom-select employe-fonction-list" id="employe-editfonction" name="employe-fonction" >
	                            						<?PHP
	                            						foreach ($fonctionsList as $item) {
	                            							echo '<option value="' .$item[0] .'">' . $item[1] ."</option>";
	                            						}
	                            						?>

								</select>
					                            </div>
					                           
					                        </div>
					                        <h4 class="form-section-header">Diplôme et Contrat</h4>
					                        <div class="form-group row">
					                            <div class="col-sm-6">
					                            	<label class="col-form-label">Diplôme</label>
	                            					<input type="text" class="form-control" id="employe-editdiplome" name="employe-diplome" placeholder="ex: DUT en Genie Civil">
							
					                            </div>
					                            <div class="col-sm-6">
					                            	<div class="custom-file">
									<input type="file" accept="application/pdf" class="custom-file-input" id="employe-editscan-diplome" name="employe-scan-diplome">
									<label class="custom-file-label" for="employe-editscan-diplome">Selectionner fichier</label>
								</div>
					                            	</div>
					                            <div class="col-sm-6">
					                            	<label class="col-form-label">type Contrat</label>
	                            					<select class="custom-select" id="employe-edittype-contrat" name="employe-type-contrat">
									<?php
									foreach ($contrats as $value) {
										echo '<option value="'.$value['code_contrat'].'">'.$value['libelle'].'</option>';
									}
									?>
								</select>

					                            </div>
					                             <div class="col-sm-6">
					                            	<label class="col-form-label">Scan Contrat</label>
	                            					<div class="custom-file">
								<input type="file" class="custom-file-input" id="employe-editscan-contrat" name="employe-scan-contrat" accept="application/pdf">
								<label class="custom-file-label" for="employe-scan-contrat">Selectionner fichier</label>
							</div>
	                            					</div>
					                           
					                        </div>
					                        <h4 class="form-section-header">Information Bancaire</h4>
					                        <div class="form-group row">
					                            <div class="col-sm-6">
					                            	<label class="col-form-label">Banque</label>
	                            					<input type="text" class="form-control" id="employe-editbanque" name="employe-banque" placeholder="banque xxxx, agence hay karima">
							
					                            </div>
					                            <div class="col-sm-6">
					                            	<label class="col-form-label">RIB</label>
	                            					<div class="custom-file">
								<input type="text" class="form-control" id="employe-editrib" name="employe-rib" placeholder="RIB">
								
							</div>
					                            </div>
					                            
					                           
					                        </div>
					                        <div class="text-center py-3">
							                	<button type="submit" class="border-0 btn btn-gradient-primary btn-rounded" >Modifier</button>&nbsp;&nbsp;
							                	
							                </div>
								</form>

						        </div>
							
							</div>
						</div>

					</div><!-- modal-content -->
				</div><!-- modal-dialog -->
			</div>
			<!-- modal -->
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
            

             <!--theme settings modal-->

			<div class="modal right fade settings" id="settings"  role="dialog" aria-modal="true">
				<div class="toggle-close">
          			<div class="toggle" data-toggle="modal" data-target="#settings"><i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
          			</div>
           
        		</div>
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-header p-3">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel2">Settings</h4>
						</div>

						<div class="modal-body pb-3">
							<div class="scroll">
							
				            <div>
				            	

				            	

				                <ul class="list-group">
				                    <li class="list-group-item border-0">
				                      <div class="row">
				                        <div class="col">
				                          <h5 class="pb-2">Primary Skin</h5>
				                        </div>
				                        <div class="col text-right">
				                          <a class="reset text-white bg-dark" id="ChangeprimaryDefault">Reset Default</a>
				                        </div>
				                      </div>
				                      <div class="theme-settings-swatches">
				                         <div class="themes">
												<div class="themes-body">
													<ul id="theme-change" class="theme-colors border-0 list-inline-item list-unstyled mb-0">
														<li class="theme-title">Solid Color</li>
														<li class="list-inline-item"><span class="theme-solid-black bg-black"></span></li>
														<li class="list-inline-item"><span class="theme-solid-pink bg-primary"></span></li>
														<li class="list-inline-item"><span class="theme-solid-orange bg-secondary1"></span></li> 
														<li class="list-inline-item"><span class="theme-solid-purple bg-success"></span></li>
														<!-- <li class="list-inline-item"><span class="theme-solid-blue bg-info"></span></li> -->
														<li class="list-inline-item"><span class="theme-solid-green bg-warnings"></span></li>
														<li><br /></li>
														<li><hr /></li>

														<li class="theme-title">Gradient Color</li>
														

														<li class="list-inline-item"><span class="theme-orange bg-sunny-morning"></span></li>
														<li class="list-inline-item"><span class="theme-blue bg-tempting-azure"></span></li> 
														<li class="list-inline-item"><span class="theme-grey bg-amy-crisp"></span></li>
														<li class="list-inline-item"><span class="theme-lgrey bg-mean-fruit"></span></li>
														<li class="list-inline-item"><span class="theme-dblue bg-malibu-beach"></span></li> 
														<li class="list-inline-item"><span class="theme-pink bg-ripe-malin"></span></li> 
														<li class="list-inline-item"><span class="theme-purple bg-plum-plate"></span></li>
														
													</ul>
												</div>
											</div>

				                         
				                      </div>
				                  	</li>
				              	</ul>
				              </div>

				              <div>
				                <ul class="list-group">
				                  <li class="list-group-item border-0">
				                     <div class="row">
				                      <div class="col">
				                        <h5 class="pb-2">Header Style</h5>
				                      </div>
				                      <div class="col text-right">
				                        <a class="reset text-white bg-dark" id="ChageheaderDefault">Reset Default</a>
				                      </div>
				                    </div>
				                    <div class="theme-settings-swatches">
				                    	<div class="themes">
											<div class="themes-body">
												<ul id="theme-change1" class="theme-colors border-0 list-inline-item list-unstyled mb-0">
														<li class="theme-title">Solid Color</li>
														<li class="list-inline-item"><span class="header-solid-black bg-black"></span></li>
														<li class="list-inline-item"><span class="header-solid-pink bg-primary"></span></li>
														<li class="list-inline-item"><span class="header-solid-orange bg-secondary1"></span></li> 
														<li class="list-inline-item"><span class="header-solid-purple bg-success"></span></li>
														<!-- <li class="list-inline-item"><span class="header-solid-blue bg-info"></span></li> -->
														<li class="list-inline-item"><span class="header-solid-green bg-warnings"></span></li>
														<li><br /></li>
														<li><hr /></li>

														<li class="theme-title">Gradient Color</li>

														<li class="list-inline-item"><span class="header-gradient-color1 bg-sunny-morning"></span></li>
														<li class="list-inline-item"><span class="header-gradient-color2 bg-tempting-azure"></span></li> 
														<li class="list-inline-item"><span class="header-gradient-color3 bg-amy-crisp"></span></li>
														<li class="list-inline-item"><span class="header-gradient-color4 bg-mean-fruit"></span></li>
														<li class="list-inline-item"><span class="header-gradient-color5 bg-malibu-beach"></span></li> 
														<li class="list-inline-item"><span class="header-gradient-color6 bg-ripe-malin"></span></li> 
														<li class="list-inline-item"><span class="header-gradient-color7 bg-plum-plate"></span></li>
														
												</ul>
											</div>
										</div>
				                        
				                      </div>
				                  </li>
				                </ul>
				              </div>
				              <div>
				                <ul class="list-group m-0">
				                  <li class="list-group-item border-0">
				                    <div class="row">
				                      <div class="col">
				                        <h5 class="pb-2">Apps Sidebar Style</h5>
				                      </div>
				                      <div class="col  text-right">
				                        <a class="reset text-white bg-dark" id="ChagesidebarDefault">Reset Default</a>
				                      </div>
				                    </div>
				                    <div class="theme-settings-swatches">
				                    	<div class="themes">
											<div class="themes-body">
												<ul id="theme-change2" class="theme-colors border-0 list-inline-item list-unstyled">
														<li class="theme-title">Solid Color</li>
														<li class="list-inline-item"><span class="sidebar-solid-black bg-black"></span></li>
														<li class="list-inline-item"><span class="sidebar-solid-pink bg-primary"></span></li>
														<li class="list-inline-item"><span class="sidebar-solid-orange bg-secondary1"></span></li> 
														<li class="list-inline-item"><span class="sidebar-solid-purple bg-success"></span></li>
														<!-- <li class="list-inline-item"><span class="sidebar-solid-blue bg-info"></span></li> -->
														<li class="list-inline-item"><span class="sidebar-solid-green bg-warnings"></span></li>
														<li><br /></li>
														<li><hr /></li>

														<li class="theme-title">Gradient Color</li>

														<li class="list-inline-item"><span class="sidebar-gradient-color1 bg-sunny-morning"></span></li>
														<li class="list-inline-item"><span class="sidebar-gradient-color2 bg-tempting-azure"></span></li> 
														<li class="list-inline-item"><span class="sidebar-gradient-color3 bg-amy-crisp"></span></li>
														<li class="list-inline-item"><span class="sidebar-gradient-color4 bg-mean-fruit"></span></li>
														<li class="list-inline-item"><span class="sidebar-gradient-color5 bg-malibu-beach"></span></li> 
														<li class="list-inline-item"><span class="sidebar-gradient-color6 bg-ripe-malin"></span></li> 
														<li class="list-inline-item"><span class="sidebar-gradient-color7 bg-plum-plate"></span></li>
														
												</ul>
											</div>
										</div>
				                        
				                      </div>
				                  </li>
				                </ul>
				                <div class="row Default-font">
				                	<div class="col">
				                        <h5 class="pb-2">Font Style</h5>
				                    </div>
				                    <div class="col text-right">
				                        <a class="reset text-white bg-dark font-Default">Reset Default</a>
				                    </div>
				                </div>
				                <ul class="list-inline-item list-unstyled font-family border-0 p-0">
				                  
				                  <li class="list-inline-item roboto-font">Roboto</li>
				                  <li class="list-inline-item poppins-font">Poppins</li>
				                  <li class="list-inline-item montserrat-font">Montserrat</li>
				                  <li class="list-inline-item inter-font">Inter</li>
				                </ul>
				            </div>
				            
				        </div>
						</div>

					</div>
				</div>
			</div>

		<!--theme settings-->
        <div class="sidebar-contact">
          	<div class="toggle" data-toggle="modal" data-target="#settings"><i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i></div>
           
        </div>
		<!-- jQuery -->
        <script src="<?php echo base_url()?>assets/template/js/jquery-3.5.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?php echo base_url()?>assets/template/js/popper.min.js"></script>
        <script src="<?php echo base_url()?>assets/template/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="<?php echo base_url()?>assets/template/js/jquery.slimscroll.min.js"></script>

		<!-- Select2 JS -->
		<script src="<?php echo base_url()?>assets/template/js/select2.min.js"></script>

		<!-- Datatable JS -->
		<script src="<?php echo base_url()?>assets/template/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url()?>assets/template/js/dataTables.bootstrap4.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/jszip.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/dropify-master/js/dropify.min.js"></script>
		<!-- Datetimepicker JS -->
		<script src="<?php echo base_url()?>assets/template/js/moment.min.js"></script>
		<script src="<?php echo base_url()?>assets/template/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/chart-js/chart.bundle.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/chart-js/plugins/chartjs-plugin-datalabels.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<!-- Loading js -->
		<script src="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.js"></script>

		<!-- theme JS -->
		<script src="<?php echo base_url()?>assets/template/js/theme-settings.js"></script>

		<!-- Custom template JS -->
		<script src="<?php echo base_url()?>assets/template/js/app.js"></script>

		<!-- Custom JS-->
		<script type="text/javascript">
			BaseUrl = "<?php echo base_url();?>";
		configuration = {
			'heure_debut_travail':moment('<?php echo $dtaEntreprise['hdebut']; ?>','HH:mm'),
			'heure_fin_travail':moment('<?php echo $dtaEntreprise['hfin']; ?>','HH:mm'),
			'congee_annee':'<?php echo $dtaEntreprise['conge_annee']; ?>',
			'h_travail_jour':'<?php echo $dtaEntreprise['hjr']; ?>',
			'h_travail_semaine':'<?php echo $dtaEntreprise['jsemaine'] * $dtaEntreprise['hjr']; ?>',
			'nbrJ_travail_semaine':'<?php echo $dtaEntreprise['jsemaine']; ?>',
			'h_travail_mois':'<?php echo $dtaEntreprise['jsemaine'] * 4.34524 * $dtaEntreprise['hjr']; ?>',
			'nbrJ_travail_mois':'<?php echo $dtaEntreprise['jsemaine'] * 4.34524; ?>',
			'h_travail_annee':'<?php echo  $dtaEntreprise['jsemaine'] * 52.1429 * $dtaEntreprise['jsemaine']; ?>',
			'nbrJ_travail_annee':'<?php echo 52.1429 * $dtaEntreprise['jsemaine']; ?>'
		}
		
		</script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/rh-sections/communScript.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/rh-sections/rh_mainScript.js"></script>
		
    </body>
</html>
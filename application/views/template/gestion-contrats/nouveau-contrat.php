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
        <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/jquery-steps/jquery.steps.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/ol/ol.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/contrat-sections/ajouter_contrat.css">

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
			<div class="page-wrapper" id="addContrat-section">
		<div class="content container-fluid">
				<div class="crms-title row bg-white">
	                		<div class="col  p-0">
	                			<h3 class="page-title m-0">
				                <span class="page-title-icon bg-gradient-primary text-white mr-2">
				                  <i class="feather-grid"></i>
				                </span> Nouveau Contrat<span class="numero-contrat-header text-info"></span></h3>
	                		</div>
	                		
	                	</div>
	                
								<div class="card mt-4">
									
									<div class="card-body">
										<form id="nouveau-contrat-form" action="<?php echo base_url(); ?>NouveauContrat/addContrat" method="post">
		
		<h3> <i class="fa  fa-info-circle"></i> INFORMATION GENERALE</h3>
		<fieldset>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="numero">Numéro<span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="numero" name="numero" aria-describedby="numero-aide" placeholder="Numéro" required>
					<small id="numero-aide" class="form-text text-muted">tapez un numéro pour votre affaire</small>
				</div>
				<div class="form-group col-md-6">
					<label for="libelle">Libellé<span class="text-danger">*</span></label>
					<textarea class="form-control" id="libelle" name="libelle" rows="2" required></textarea>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="numero">Date de Signature<span class="text-danger">*</span></label>
					
						<input type="date" class="form-control" id="date-signature" placeholder="23/05/2020"   name="date-signature" required>
					
				</div>
				<div class="form-group col-md-4">
					
					<label for="delai">Délai (en Jours)<span class="text-danger">*</span></label>
					<input type="number" class="form-control" id="delai" name="delai" aria-describedby="delai-aide" placeholder="ex : 120" max="3650" min="0" required>
					
				</div>
				<div class="col-12 col-md-4">
					<label for="domaine-contrat">Secteur d'activité<span class="text-danger">*</span></label>

					<select class="custom-select form-control" id="domaine-contrat" name="domaine-affaire" >
						<option value="" selected><span style="color: rgba(0,0,0,0.2);">Selectionner</span></option>
						<?php
						foreach ($domaines as $value) {
							echo '<option value="'.$value['id'].'">'.$value['libelle'].'</option>';
						}

						?>

					</select>
				</div>
			</div>
			<div class="form-row">

				
				<div class="col-12 col-md-4">
					<label for="secteur-contrat">Désignation de la prestation<span class="text-danger">*</span></label>

					<select class="custom-select form-control" id="secteur-contrat" name="secteur-contrat" required>
						<option value="" selected><span style="color: rgba(0,0,0,0.2);">Selectionner</span></option>
					</select>
				</div>
				<div class="form-group col-md-4"> 
					<div class="form-group">
						<label for="client-contrat">Client<span class="text-danger">*</span></label>
						<select class="form-control col-12 required-field" id="client-contrat" name="client-contrat" style="overflow-y: auto;" required>
							<?php
											foreach ($clients as $value) {
												echo '<option value="'.$value[0].'">'.$value[1].'</option>';
											}

											?>
						</select>
						<small id="client-aide" class="form-text text-muted">le client doit être enregistré au préalable</small>
					</div>
				</div>
				<div class="form-group col-md-4">
					<label for="contrat-observations">TVA en %<span class="text-danger">*</span></label>
					<input class="form-control" id="contrat-tva" name="contrat-tva" required value="20" type="number" max="100" min="0">
					<small id="observation-aide" class="form-text text-muted">20% par défaut</small>
				</div>
			</div>

			
			<div class="form-row">
				
				<div class="form-group col-sm-12">
					<label for="contrat-observations">Observations</label>
					<textarea class="form-control" id="contrat-observations" name="contrat-observations" rows="2" aria-describedby="observation-aide"></textarea>
					<small id="observation-aide" class="form-text text-muted">observations, remarques...  </small>
				</div>
			</div>

		</fieldset>
		<h3><i class="fa fa-list-ol"></i> LISTE DES PRIX</h3>
		<fieldset>
			<h4 class="form-section-header" style="background: #fcf7ff;">Ajouter Prix</h4>
			<div class="form-row" id="prix-data-container">
				<div class="form-group col-sm-6 col-md-2">
					<label for="numero-prix">Numéro</label>
					<input type="text" class="form-control form-control-sm prix-field" id="numero-prix"  placeholder="Numéro">
				</div>
				<div class="form-group col-sm-6 col-md-3">
					<label for="libelle-prix">Libellé</label>
					<input class="form-control form-control-sm prix-field" id="libelle-prix">
				</div>
				
				<div class="col-sm-6 col-md-3">
					<label for="unite-prixe">Unité</label>

					<select class="custom-select prix-field" id="unite-prix" style="font-size: 12px;">
						<?php
						foreach ($unites as $value) {
							echo '<option value="'.$value['code'].'">'.$value['libelle'].' ('.$value['code'].')</option>';
						}

						?>
					</select>
				</div>
				<div class="form-group col-sm-6 col-md-1">
					<label for="prix-prix">Prix.U</label>
					<input class="form-control form-control-sm prix-field" type ="number" id="prix-prix">
					<small>En DH HT</small>
				</div>
				<div class="form-group col-sm-6 col-md-1">
					<label for="quantite-prix">Quantite</label>
					<input class="form-control form-control-sm prix-field" type ="number" id="quantite-prix">
				</div>
				<div class="form-group col-4 col-md-2" style="display: flex;justify-content: space-around;align-items: center;">
					
					<button class="btn btn-primary btn-rounded" type="button" id="btn-add-prix"><i class="fa  fa-plus"></i></button>
					<span class="btn btn-success btn-rounded" type="button" id="import-prix" style="position: relative;"><i class="fa  fa-file-excel-o">
					</i><input type="file" id="prix-xls-file" accept=" application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="position: absolute;max-height: 100%;min-height: 100%;top: 0;right: 0;opacity: 0;width:100%;"></span>
					<button class="btn btn-danger btn-rounded" type="button" id="btn-removeAllprix-contrat"><i class="fa  fa-trash"></i></button>
				</div>
				
			</div>
			<div class="form-section-header" style="background: #fcf7ff;display: flex;justify-content: space-between;">
				<h4 style="background: #fcf7ff;">Bordereau des prix</h4>
				<div class="titlePrixFont ">TOTAL HT :<span style="color: #bd0a1ba1;" id="total-ht">0,00</span><span style="color: #bd0a1ba1;">&ensp;DH HT</span></div>
				<div class="titlePrixFont ">TOTAL TTC :<span style="color: #007bffb8;" id="total-ttc">0,00</span><span style="color: #007bffb8;">&ensp;DH TTC</span></div>
			</div>
			
		
			<div class="table-responsive">
				<table id="nouveau-contrat-table" class="table  table-nowrap mb-0 datatable">
				<thead>
					<tr>
						<th>N°</th>
						<th>Libelle</th>
						<th>Unité</th>
						<th>Prix.U</th>
						<th>Quantité</th>
						<th>Total Dh HT</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
			</div>
		</fieldset>
		<h3><i class="fa fa-map-marker"></i> COORDONNEES</h3>
		<fieldset>
			<div style="display: flex;flex-direction: column;">
				<div class="form-row">

					<div class="col-5">
						<label for="ville-contrat">Ville</label>

						<select class="custom-select" id="ville-contrat" name="ville-contrat" style="font-size: 12px;" >
							<option value="" selected><span style="color: rgba(0,0,0,0.2);">Selectionner</span></option>
							<?php
							foreach ($villes_affaire as $value) {
								echo '<option value="'.$value['ville'].'">'.$value['ville'].'</option>';
							}

							?>

						</select>
					</div>
					<div class="col-5">
						<label for="secteur-affaire">Secteur</label>

						<select class="custom-select" id="secteur-ville" name="secteur-ville" style="font-size: 12px;" required>
							<option value="" selected><span style="color: rgba(0,0,0,0.2);">Selectionner</span></option>
						</select>
					</div>
					<div class="col-2 d-flex justify-content-end align-items-center" >

						<button type="button" class="btn btn-outline-danger  btn-rounded" id="reset-emplacement"><i class="fa fa-trash"></i></button>
					</div>
				</div>
				<div class="form-row" style="display: none;">

					<div class="col-12 col-sm-6">
						<input type="text" name="geom-type"  id="geom-type">
						
					</div>
					<div class="col-12 col-sm-6">
						<textarea name="geom-coordonnees"  id="geom-coordonnees"></textarea>
					</div>
				</div>
				
				
				<div id="map" style="width: 100%;height: 75vh;margin-top: 10px;">

				</div>
			</div>
		</fieldset>
		
	</form>
										
									</div>
								</div>
								
	         
						

	          </div>
	          
			
		</div>
        </div>
	
		<!-- /Main Wrapper -->

		<!--modal section starts here-->
		<!-- Modal -->
			
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
		<script src="<?php echo base_url()?>assets/libraries/ol/ol.js"></script>
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
		
		<script src="<?php echo base_url()?>assets/libraries/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/jquery-steps/jquery.steps.min.js"></script>
		<script type="text/javascript">
        BaseUrl = "<?php echo base_url();?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/contrat-sections/communScript.js"></script>
    <script src="<?php echo base_url()?>assets/custom/js/contrat-sections/ajouter_contrat.js"></script>
		
    </body>
</html>
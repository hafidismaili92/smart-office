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

        <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/ol-v4.6.5-dist/ol.css">
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
        <link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/geo-business/mainView.css">
        <!-- Custom CSS-->
        
        

    </head>
    <body id="skin-color" class="inter">
		<!-- Main Wrapper -->
        <div class="main-wrapper" style="position: relative;">
		
			<!-- Header -->
             <?php echo $header;?>
			<!-- /Header -->
<!-- Sidebar -->
            <?php echo $sideBarre; ?>

			<!-- /Sidebar -->
			<!-- Right Sidebar -->
			<div class="right-sidebar">
				<section id="add-layer-section" class="right-section hidden">
					<div class="modal-header bg-gradient-success" >
		                    <h4 class="modal-title text-center">Ajouter une couche</h4>
		                    <button type="button" class="close xs-close close-rightSDB" >×</button>
		                  </div>
		                  <div id="Ajouter" class="draggable drag-add-affaire tab-section">
						<div class="right-sidebar-dataWrapper">
							<h4 class="form-section-header">Information couche</h4>
							<div class="form-group row">
								<label for="addgeoffaire-name" class="col-2 col-form-label">Nom:</label>
								<div class="col-10">
									<input type="text" class="form-control" id="addgeoffaire-name" placeholder="nom couche ici" id="addgeoffaire-name" style="border-radius: 30px;">
								</div>
							</div>
							<div class="form-group row">
								<label for="addgeoffaire-add-attributes" class="col-2 col-form-label">Champs:</label>
								<div class="col-8">
									<input type="text" class="form-control" id="addgeoffaire-add-attributes" placeholder="nom champs ici">
								</div>
								<button type="button" class="btn btn-info col-2" id="btn-add-attributes"><i class="fa fa-plus fa-sm"></i></button>
							</div>
							<div id="attributes-container">
							</div>
							<!-- <div class="form-group row">
								<label for="addgeoffaire-name" class="col-12 col-form-label">champs label <small>(importation excel):</small></label>
								<div class="col-12">
									<select class="form-control" id="champs-selector" style="border-radius: 30px;">
									</select>
								</div>
							</div> -->
							<h4 class="form-section-header">Informations Spatiales</h4>
							
								<div class="form-group row">
									<label for="add-coord-system" class="col-form-label col-form-label-sm col-4">Système de Coordonnées :</label>
									<select class="custom-select custom-select-sm col-8" id="projection-selector" data-changeEnable="true">
										<option value="4326">World-WGS84</option>
										<option value="26191">Maroc Lambert Z1</option>
										<option value="26192">Maroc Lambert Z2</option>
										<option value="26194">Maroc Lambert Z3</option>
										<option value="26195">Maroc Lambert Z4</option>
									</select>
								</div>
							<div class="form-group row">
									<label for="add-coord-system" class="col-form-label col-form-label-sm col-4">Géométrie :</label>
									<div class="col-8 mr-auto custom-selector" id="geom-selector" >
									<div class="active" data-geomType="Point">
										<img class="img-fluid" src="<?php echo base_url();?>images/geometries/pointvert.png" alt="Point">
										<input type="radio" id="add-geom-Point" name="add-radio" class="add-radio" checked="checked">
									</div>
									<div data-geomType="LineString">
										<img class="img-fluid" src="<?php echo base_url();?>images/geometries/linevert.png" alt="Line">
										<input type="radio" id="add-geom-PolyLine" name="add-radio" class="add-radio">
									</div>
									<div data-geomType="Polygon">
										<img class="img-fluid" src="<?php echo base_url();?>images/geometries/polygonvert.png" alt="Polygone">
										<input type="radio" id="add-geom-Polygon" name="add-radio" class="add-radio">
									</div>
								</div>	
								</div>
							<h4 class="form-section-header">Création des Enregistrements</h4>
							<div class="form-row" style="padding: 10px 0px;">
								<div class="col8 ml-auto">
									<button type="button" class="btn btn-sm btn-outline-secondary" id="add-geoComposantes" style="float: right;">Editer les géomtéries (<span id="add-geoComponents-counter">0</span> ajoutées)</button>
								</div>	
							</div>
							<div class="geoComposantes-liste-container table-responsive">
								<table class="table table-striped datatable geom-info-tables" id="add-geoComposantes-tables">
									<thead>
										<tr>
											<th>featureID</th>
											<th>#</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
							<!-- <div class="form-row" style="position: absolute;top:81%;width: 100%;">
							<p ><h2 style="color: gray;opacity: 0.5;font-weight: bold;font-size: 1.4em;">Glissez ou cliquer ici pour importer Vos Fichiers SHP (.zip)</h2></p>				
						</div> -->
						<div class="form-row" style="position: absolute;top: 95%;width: 100%;">
							<div class="col-5 ml-auto">
								<button type="button" class="btn btn-sm btn-info" id="insert-affaire" style="border-radius: 30px;float: right;"><i class="fas fa-check-circle"></i> Ajouter</button>
							</div>					
						</div>
						</div>
						
					</div>
				</section>
			</div>
			<!-- Right Sidebar -->
			<div id="print-dialog" class="custom-modal-left print-element hidden">
					<div style="box-shadow: none;border-radius: 0;display: flex;flex-direction: column;">
						<div id="print-header">
							<span>Impression de la carte</span>
						</div>
						<div id="print-content">
							<div id="print-body" >
								<div style="border-bottom: 1px solid gray;" class="print-dialog-titles">Grid</div>
								<div class="form-row">
									<div class="form-group col-12 row">
										<label for="print-coord-system" class="col-form-label col-form-label-sm col-12">Système de Coordonnées</label>
										<select class="custom-select custom-select-sm col-7" id="print-coord-system">
											<option value="4326">World-WGS84</option>
											<option value="26191">Maroc Lambert Z1</option>
											<option value="26192">Maroc Lambert Z2</option>
											<option value="26194">Maroc Lambert Z3</option>
											<option value="26195">Maroc Lambert Z4</option>
										</select>
										<button class="btn btn-sm btn-warning col-4 ml-auto " id="print-add-crs">Ajouter</button>
									</div>
									
								</div>
								<div class="form-check" style="padding: 10px;">
									<input class="form-check-input" type="checkbox" id="toggle-show-grid">
									<label class="form-check-label" for="defaultCheck1">
										Afficher la Grille
									</label>
								</div>
								<div class="form-group row">
									<label for="pax-x-grid" class="col-1 col-form-label">H:</label>
									<div class="col-3">
										<select class="form-control" id="densite-grid-x" >
											<option value="3">3</option>
											<option value="5">5</option>
											<option value="10">10</option>
											
										</select>
									</div>
									<label for="pax-x-grid" class="col-1 col-form-label">V:</label>
									<div class="col-3">
										<select class="form-control" id="densite-grid-y" >
											<option value="3">3</option>
											<option value="5">5</option>
											<option value="10">10</option>
											
										</select>
									</div>
									<button class="btn btn-sm btn-info col-2 ml-auto" id="refresh-grid">ok</button>
								</div>
								<div style="border-bottom: 1px solid gray;" class="print-dialog-titles">Légende et texte personnalisé</div>
								<div class="form-group row">
									<button class="btn btn-sm btn-info col-5 " id="print-add-text">Zone de text</button>
									<button class="btn btn-sm btn-warning col-5 ml-auto" id="print-add-legend">Légende</button>
								</div>
								<div style="border-bottom: 1px solid gray;" class="print-dialog-titles">Option de papier</div>
								<div class="form-group row">
									<label for="page-format" class="col-6 col-form-label">Format Papier:</label>
									<div class="col-5 mr-auto">
										<select class="form-control" id="page-format">
											<option value ="a4">A4</option>
											<option value ="a3">A3</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="page-format" class="col-6 col-form-label">Résolution:</label>
									<div class="col-5 mr-auto">
										<select class="form-control" id="page-resolution">
											<option value ="75">75 ppi</option>
											<option value ="100">100 ppi</option>
											<option value ="200">200 ppi</option>
										</select>
									</div>
								</div>
							</div>
							<div style="flex-grow: 1;display: flex;flex-direction: column;justify-content: flex-end;">
								<div class="row" style="padding: 10px 0px;border-top:1px solid rgba(0,0,0,0.3);width: 100%;">
									<button class="btn btn-outline-secondary btn-sm col-3" id="close-print-dialog">Quitter</button>
									<button class="btn btn-outline-info btn-sm col-3 ml-auto" id="print-map">Imprimer</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			
			<!-- Page Wrapper -->
<div  class="page-wrapper principal-sections" style="display: flex;" id="main-page-wrapper">
	<div id="main-map-container">
		<div id="print-progression" class="loaderDialog hidden">
					<div>
						<div class="loader">

						</div>
						<div class="loader">

						</div>

					</div>
				</div>

		<div id="map-wrapper">
			<div id="map-mask" class="hidden" >
					</div>
			<div id="main-map" style="height: 100%;width: 100%;z-index: 1010;position:relative;" class="map">
						<!-- <div id="ol-map-popup" style="height: 50px;width: 50px;"></div> -->
					</div>
		</div>

          
	</div>
          
		
	</div>

<!-- Page Wrapper -->
			
			
        </div>
	
		<!-- /Main Wrapper -->

		
			<!--modals-->
			<div class="modal fade add-attributes-modal" id="attributes-modal" tabindex="-1" role="dialog"  aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div  style="display: flex;justify-content: space-between;min-width: 80%;">
					<h5 class="modal-title">Indiquez les champs</h5>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="post" id="perform-add-composanteForm">
				<input type="text" class="hidden-item hidden-featureID" name="featureID" readonly>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="attributesValues-container">
							<div class="form-group row value-attribute attr-val-template" >
								<label for="attribute-identifiant" class="col-6 col-form-label">identifiant:</label>
								<div class="col-6">
									<input type="text" class="form-control hidden-item">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="ignore-add-attributes">Fermer</button>
					<button type="submit" class="btn btn-primary"  >Appliquer</button>
				</div>
			</form>
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
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/ol-v4.6.5-dist/ol.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/ol-v4.6.5-dist/proj4-2.4.4.js"></script>
		<!-- Bootstrap Core JS -->
        
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
		<script type="text/javascript" src="assets/libraries/jsts/jsts-1.6.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.1/jspdf.debug.js"></script>
		<script type="text/javascript">
        BaseUrl = "<?php echo base_url();?>";
    </script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/geo-business/mainView.js"></script>
		
		
    
		
    </body>
</html>
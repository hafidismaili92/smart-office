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
		<!-- Datatable CSS -->
        
		<link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/dataTables.bootstrap4.min.css">
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/font-awesome.min.css">

        <!-- Feathericon CSS -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/feather.css">

        <!--font style-->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/line-awesome.min.css">
		
		<!-- Chart CSS -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/template/plugins/morris/morris.css">

		<!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/theme-settings.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/ol/ol.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/contrat-sections/dashboard.css">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="<?php echo base_url()?>assets/template/js/html5shiv.min.js"></script>
			<script src="<?php echo base_url()?>assets/template/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body id="skin-color" class="inter">
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="noprint">
				<!-- Header -->
             <?php echo $header;?>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <?php echo $sideBarre; ?>
			<!-- /Sidebar -->
			</div>
			
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">

                	

					<!-- Page Header -->
					<div class="crms-title row bg-white mb-4">
                		<div class="col  p-0">
                			<h3 class="page-title">
			                <span class="page-title-icon bg-gradient-primary text-white mr-2">
			                  <i class="la la-table"></i>
			                </span> <span>Tableau de Bord</span></h3>
                		</div>
                		<div class="col p-0 d-flex justify-content-end align-items-center">
                				<span class="text-primary noprint"><i class="fa fa-file-pdf fa-lg" id="print-dashboard"></i></span>
								<span class="filter-icon text-primary"><i class="fa fa-filter noprint"></i></span>
								<select class="text-primary" id="periode-selector" style="border: none;background-color: transparent;max-width: 200px;">
			<option value="current-year">Année en cours</option>
			<option value="five-year">Cinq dernières Années</option>
			<option value="teen-year">Dix dernières Années</option>
		</select>
					
							
                		</div>
                	</div>
					<!-- /Page Header -->
					<div class="row graphs">
						<div class="col-md-6">
							<div class="card h-100">
								<div class="card-body" id="chart-realisation-container">
			                    	<h3 class="card-title">Réalisation/Règlement</h3>
									<canvas id="contrat-realisations-charts"></canvas>
			                	</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card h-100">
								
								<div class="card-body">
			                    	<h3 class="card-title">Performance des Revenues</h3>
									<div class="table-responsive tables-container" >
			<table id="revenue-realisation-table" class="table table-striped mb-0" width="100%">
				<thead><tr></tr></thead>
				<tbody><tr></tr></tbody>
			</table>
		</div>
			                	</div>
							</div>
						</div>
						
					</div>
					

					<div class="row graphs">
						<div class="col-md-6">
							<div class="card h-100">
								<div class="card-body" id="chart-montant-container">
			                    	<h3 class="card-title">Nombre et Montants des contrats</h3>
									<canvas id="contrats-montant-canvas"></canvas>
			                	</div>
							</div>
						</div>
						<div class="col-md-6">
							
							<div class="card h-100">
			                    <div class="card-body">
			                    	<h3 class="card-title">Etat des contrats</h3>
			                     <div id="contrats-etat-chart" class="chartContainer"></div>
			                    </div>
			                </div>
						</div>
					</div>

					<div class="row graphs">
						<div class="col-md-6">
							<div class="card h-100">
								<div class="card-body">
			                    	<h3 class="card-title">Contrats/domaine</h3>
									<div id="contrat-domaines-charts"></div>
			                	</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card h-100">
								<div class="card-body">
			                    	<h3 class="card-title">Nombre Contrats par Domaine</h3>
									<div class="table-responsive tables-container" >
			<table id="general-contrat-table" class="table table-nowrap mb-0 datatable" width="100%">
				<thead><tr></tr></thead>
				<tfoot><tr></tr></tfoot>
			</table>
		</div>
			                	</div>
							</div>
						</div>
						
					</div>
					
					<div class="row page-header pt-3 mb-3 ">
									<div class="col-md-4">
		                              <div class="card bg-gradient-success card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal">Montant Global</h4>
		                                  <span id="global-montant">......</span>
		                                  <h5 class="font-weight-normal mt-3 nombre-contrat">.....</h5>
		                                  <h5 class="font-weight-normal mt-3">Période : <span class="periode-realisation">...</span></h5>
		                                </div>
		                              </div>
		                            </div>
		                            
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-info card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal">Montant des Réalisations</h4>
		                                  <span id="realise-montant">......</span>
		                                  <h5 class="font-weight-normal mt-3">Période : <span class="periode-realisation">...</span></h5>
		                                </div>
		                              </div>
		                            </div>
		                            
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-danger card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal">Non Payé</h4>
		                                  <span id="enattente-montant">......</span>
		                                  <h5 class="font-weight-normal mt-3">au <?php echo date('d-m-Y') ?></h5>
		                                </div>
		                              </div>
		                            </div>
		                        </div>
		                        <div class="row">
						<div class="col-12">
							<div class="card h-100">
								<div class="card-body">
			                    	<h3 class="card-title">Répartition Géographique des contrats</h3>
									<div class="col-12" style="height: 70vh;width: 100%;" id="contrats-repartition-map">

									</div>
			                	</div>
							</div>
						</div>
						
					</div>
				
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->


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
		<script src="<?php echo base_url()?>assets/template/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/ol/ol.js"></script>
		<!-- Bootstrap Core JS -->
        <script src="<?php echo base_url()?>assets/template/js/popper.min.js"></script>
        <script src="<?php echo base_url()?>assets/template/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="<?php echo base_url()?>assets/template/js/jquery.slimscroll.min.js"></script>
		
		<!-- Chart JS -->
		<script src="<?php echo base_url()?>assets/template/plugins/morris/morris.min.js"></script>
		<script src="<?php echo base_url()?>assets/template/plugins/raphael/raphael.min.js"></script>
		<script src="<?php echo base_url()?>assets/template/js/chart.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
		<script src="<?php echo base_url()?>assets/template/js/chartsLine.js"> </script>

		<!-- theme JS -->
		<script src="<?php echo base_url()?>assets/template/js/theme-settings.js"></script>

		<!-- Custom JS -->
		<script src="<?php echo base_url()?>assets/template/js/app.js"></script>
		<!-- <script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/contrat-sections/communScript.js"></script> -->
		<script type="text/javascript">
        BaseUrl = "<?php echo base_url();?>";
    </script>
    <script src="<?php echo base_url()?>assets/custom/js/contrat-sections/dashboard.js"></script>

		
    </body>
</html>
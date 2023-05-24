<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="CRMS - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Global-Dashboard</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>images/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/bootstrap.min.css">
		<!-- Chart CSS -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/template/plugins/morris/morris.css">
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/dropify-master/css/dropify.min.css">
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
         <link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/affaire-sections/affaire_MainView.css">
         <style type="text/css">
         	.card-body
         	{
         		    position: relative;
         	}
         	.show-detail
         	{
         		cursor: pointer;
         	}
         	.top-cards
         	{
         		padding: 40px;
         	}
         </style>
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
			<!-- Page Wrapper -->
 <div id="globalVue-section" class="page-wrapper principal-sections" >
         
	<div class="content container-fluid" >
          			<div class="crms-title row bg-white mb-4">
                		<div class="col  p-0">
                			<h3 class="page-title m-0">
			                <span class="page-title-icon bg-gradient-primary text-white mr-2">
			                  <i class="feather-grid"></i>
			                </span>Vue Globale</h3>
                		</div>
                		<div class="col p-0 d-flex justify-content-end align-items-center">
                				
								<h5 class="text-primary" id="periode-selector" style="border: none;background-color: transparent;"><?php
								echo 'Tableau de Bord : '.date("d-M/Y", strtotime("-11 months")).' - '.date('d-M/Y');
								?></h5>
		</select>
					
							
                		</div>
                	</div>
					<!-- Content Starts -->
					<div class="row">
									<div class="col-sm-6 col-md-3">
		                              <div class="card bg-gradient-info card-img-holder text-white ">
		                                <div class="card-body top-cards">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Total des Projets</h4>
		                                  <span class="projets-total-nbr">...</span>
		                                </div>
		                                <div class="card-footer">
		                                	<div  style="display: flex;justify-content: space-between;color: gray;flex-wrap: wrap-reverse;">
		                                		<!-- Progress bar 1 -->
       
        <div class="round-progress" id="progress-total"> 
        </div>
          <!-- END -->
		                                		<div>
		                                			<h6 class="text-info show-detail" data-target="total"><i class="fa fa-search"></i> Détails</h6>
		                                		</div>
		                                	</div>
		                                </div>
		                              </div>
		                            </div>
		                            
		                            <div class="col-sm-6 col-md-3">
		                              <div class="card bg-gradient-success card-img-holder text-white">
		                                <div class="card-body top-cards">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Projets achevés</h4>
		                                  <span class="projets-acheve-nbr">...</span>
		                                </div>
		                                <div class="card-footer">
		                                	<div  style="display: flex;justify-content: space-between;color: gray;flex-wrap: wrap-reverse;">
		                                		<!-- Progress bar 1 -->
       
        <div class="round-progress" id="progress-acheve"> 
        </div>
          <!-- END -->
		                                		<div>
		                                			
		                                			<h6 class="text-success show-detail" data-target="acheve"><i class="fa fa-search"></i> Détails</h6>
		                                		</div>
		                                	</div>
		                                </div>
		                              </div>
		                            </div>
		                            <div class="col-sm-6 col-md-3">
		                              <div class="card bg-warning card-img-holder text-white">
		                                <div class="card-body top-cards">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Projets en cours</h4>
		                                  <span class="projets-encours-nbr">...</span>
		                                </div>
		                                <div class="card-footer">
		                                	<div  style="display: flex;justify-content: space-between;color: gray;flex-wrap: wrap-reverse;">
		                                		<!-- Progress bar 1 -->
       
        <div class="round-progress" id="progress-encours"> 
        </div>
          <!-- END -->
		                                		<div>
		                                			
		                                			<h6 class="text-warning show-detail" data-target="encours"><i class="fa fa-search"></i> Détails</h6>
		                                		</div>
		                                	</div>
		                                </div>
		                              </div>
		                            </div>
		                            <div class="col-sm-6 col-md-3">
		                              <div class="card bg-gradient-danger card-img-holder text-white">
		                                <div class="card-body top-cards">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Projets en Souffrance</h4>
		                                  <span class="projets-souffrance-nbr">....</span>
		                                </div>
		                                <div class="card-footer">
		                                	<div  style="display: flex;justify-content: space-between;color: gray;flex-wrap: wrap-reverse;">
		                                		<!-- Progress bar 1 -->
       
        <div class="round-progress" id="progress-ensouffrance"> 
        </div>
          <!-- END -->
		                                		<div>
		                                			
		                                			<h6 class="text-danger show-detail" data-target="ensouffrance"><i class="fa fa-search"></i> Détails</h6>
		                                		</div>
		                                	</div>
		                                </div>
		                              </div>
		                            </div>
		                        </div>
		                        <div class="container-fluid">
		                        	<div class="row ">
		                        	<div class="col-md-7" style="padding: 5px;">
		                        	<div class="card h-100">
								<div class="card-body">
									<h5 class="card-title text-secondary">Projets par Mois</h5>
									<canvas id="affaires-months-charts"></canvas>
								</div>
							</div>	
		                        	</div>
		                        	<div class="col-md-5" style="padding: 5px;">
		                        		<div class="card h-100">
								<div class="card-body">
									<h5 class="card-title text-secondary">Evolution des Projets</h5>
									<div class="affaires-etat-bars" style="width: 90%;">
										<div class="progress-item mt-3">
												<div style="display: flex;justify-content: space-between;">
													<h6 class="text-secondary">Projets Achevés</h6>
													<i class="fa fa-check text-success"></i>
												</div>
												<div class="progress progress-md" >
													<div class="progress-bar bg-success projets-acheve-percent" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<h6 class="mt-1 text-success projets-acheve-percent">...</h6>
												
											</div>
											<div class="progress-item mt-3">
												<div style="display: flex;justify-content: space-between;">
													<h6 class="text-secondary">Projets En cours</h6>
													<i class="fa fa-hourglass-start text-warning"></i>
												</div>
												<div class="progress progress-md">
													<div class="progress-bar bg-warning projets-encours-percent" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<h6 class="m-1 text-warning projets-encours-percent">...</h6>
												
											</div>
											<div class="progress-item mt-3">
												<div style="display: flex;justify-content: space-between;">
													<h6 class="text-secondary">Projets En souffrance</h6>
													<i class="fa fa-frown-o text-danger"></i>
												</div>
												<div class="progress progress-md">
													<div class="progress-bar projets-souffrance-percent" style="background-color: #ff728c;" role="progressbar"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<h6 class="m-1 text-danger projets-souffrance-percent">...</h6>
												
											</div>
											
									</div>
									<div class="mt-3">
										<canvas id="evolution-pie-chart" width="100" height="50"></canvas>
									</div>
									
								</div>
							</div>
		                        	</div>

		                        </div>
		                        </div>
					<!-- /Content End -->
        </div>
           </div>
			<!-- /Page Wrapper -->
        </div>
		<!-- /Main Wrapper -->
		 <!--theme settings modal-->
		 <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="global-table-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="modal-header">
        <h5 class="modal-title">Liste des Projets:<span class="affaires-categories">...</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		 		<div id="table-responsive">
				<table id="globalAffaires-table" class="table table-striped table-nowrap mb-0 datatable" width="100%">
					<thead>
						<tr>
							<th>Projet</th>
							<th>Intitulé</th>	
							<th>Etat</th>
							<th>Responsable</th>
							<th>Matricule</th>
							<th>Date</th>
							<th>Avancement</th>
							
							<th>Entité</th>
							<th>Fonction</th>
							
							
							
							
						</tr>

					</thead>

				</table>
			</div>
		 	</div>
    </div>
  </div>
</div>
		 	
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
		<!-- Chart JS -->
		<script src="<?php echo base_url()?>assets/template/plugins/morris/morris.min.js"></script>
		<script src="<?php echo base_url()?>assets/template/plugins/raphael/raphael.min.js"></script>
		<script src="<?php echo base_url()?>assets/template/js/chart.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
		<script src="<?php echo base_url()?>assets/template/js/chartsLine.js"> </script>
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

		<!-- Loading js -->
		<script src="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.js"></script>
<script src="<?php echo base_url()?>assets/libraries/progressbar.min.js"></script>
		<!-- theme JS -->
		<script src="<?php echo base_url()?>assets/template/js/theme-settings.js"></script>

		<!-- Custom template JS -->
		<script src="<?php echo base_url()?>assets/template/js/app.js"></script>

		<!-- Custom JS-->
		<script type="text/javascript">
			BaseUrl = "<?php echo base_url();?>";
			
			actualUser="<?php echo $this->session->userdata('numeric_matricule');?>";
			selectedAffaire="<?php echo $this->session->userdata('first-affaire');?>";
			selectedTache="";
			selectedAffaireTache="";
		</script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/affaire-sections/globalAffaires.js"></script>

    </body>
</html>

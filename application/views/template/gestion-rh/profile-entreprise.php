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
        <link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/rh-sections/rh_MainView.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/rh-sections/profilEntreprise.css">

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
<div id="profilEntreprise-section" class="page-wrapper principal-sections">
	<div class="content container-fluid">
		<div class="crms-title row bg-white">
                		<div class="col  p-0">
                			<h3 class="page-title m-0">
			                <span class="page-title-icon bg-gradient-primary text-white mr-2">
			                  <i class="feather-grid"></i>
			                </span> Profil Entreprise</h3>
                		</div>
                		
                	</div>
		
					<!-- Content Starts -->
					<div class="row">
						<div class="col-12">
							<div class="card mb-0 mt-4">
								<div class="card-body">
									<h4 class="form-section-header">Photo</h4>
									<div class="row justify-content-center">
		<div class="form-group col-3">
			
			<div class="input-group input-group-sm">
				<input type="file" class="form-control" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="1M" id="entreprise-logo-update" data-height="100" <?php echo isset($img)?'data-default-file="'.$img.'"':null ?> />

			</div>

		</div>
	</div>
	<h4 class="form-section-header">Information Entreprise</h4>
	<div class="row">
		<div class="col-12 col-sm-6">

			<ul style="list-style: none;padding-left: 10px;">

				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-tags detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Nom</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-nom"></p>
						</div>
						<div class="col-2">
							<i class="fa fa-edit detail-entreprise-icons edit-entreprise text-primary"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-at detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">E-mail</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-mail"></p>
						</div>
						<div class="col-2">
							<i class="fa fa-edit detail-entreprise-icons edit-entreprise text-primary"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-fax detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Fax</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-fax"></p>
						</div>
						<div class="col-2">
							<i class="fa fa-edit detail-entreprise-icons edit-entreprise text-primary"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-briefcase detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Domaine d'activité</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-domaine"></p>
						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-calendar  detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Date d'inscription</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-date_creation"></p>
						</div>
						
					</div>

				</li>
			</ul>
		</div>
		<div class="col-12 col-sm-6">

			<ul style="list-style: none;padding-left: 10px;">

				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-map detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Adresse</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-adresse"></p>
						</div>
						<div class="col-2">
							<i class="fa fa-edit detail-entreprise-icons edit-entreprise text-primary"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-phone-square detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Tél:</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-tel"></p>
						</div>
						<div class="col-2">
							<i class="fa fa-edit detail-entreprise-icons edit-entreprise text-primary"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-file detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">ICE</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-ice"></p>
						</div>
						<div class="col-2">
							<i class="fa fa-edit detail-entreprise-icons edit-entreprise text-primary"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-map detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Ville</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-ville"></p>
						</div>
						<div class="col-2">
							<i class="fa fa-edit detail-entreprise-icons edit-entreprise text-primary"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-user detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Directeur Général</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-directeur"></p>
						</div>
						
					</div>

				</li>
			</ul>
		</div>
	</div>
	<h4 class="form-section-header">Configuration Entreprise</h4>
	<div class="row">
		<div class="col-12 col-sm-6">

			<ul style="list-style: none;padding-left: 10px;">

				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-calendar  detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="config-entreprise-item-title">Congé annuel en Jour</p>
							<p  class="config-entreprise-item-content" id="item-entreprise-conge_annee">....</p>
						</div>
						
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-clock-o detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="config-entreprise-item-title">Heure début travail</p>
							<p  class="config-entreprise-item-content" id="item-entreprise-hdebut">.....</p>
						</div>
						
					</div>

				</li>
			
			</ul>
		</div>
		<div class="col-12 col-sm-6">

			<ul style="list-style: none;padding-left: 10px;">

				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-calendar  detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="config-entreprise-item-title">Jours de travail Par semaine</p>
							<p  class="config-entreprise-item-content" id="item-entreprise-jsemaine">.....</p>
						</div>
						
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fa fa-clock-o detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="config-entreprise-item-title">Heure Fin travail</p>
							<p  class="config-entreprise-item-content" id="item-entreprise-hfin">...</p>
						</div>
						
					</div>

				</li>
			
			</ul>
		</div>
								</div>
								<div class="row">
									<div class="col-6 col-sm-4 sol-md-2 ml-auto d-flex justify-content-end">
										<button class="btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="edit-entreprise-config" >Editer</button>
									</div>
								</div>
							</div>	
						</div>
					</div>
					
					<!-- /Content End -->

          </div>
          
		
	</div>

<!-- Page Wrapper -->	

			
        </div>
	
		

		<!--modal section starts here-->
		
			
			
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
       
       <div class="modal" tabindex="-1" role="dialog" id="modal-update-config">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Editer la configuration</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12 d-flex">
<div class="flex-fill">

<div class="card-body">
<form action="<?php echo base_url()?>Entreprise/updateConfig" id="edit-config-form" method="POST">
<div class="form-group row">
<label class="col-lg-4 col-form-label">Nombre de jours congé</label>
<div class="col-lg-8">
<input type="number" step="0.1" id="conge_annee" name="conge_annee" class="form-control" max="365" min="0">
</div>
</div>
<div class="form-group row">
<label class="col-lg-4 col-form-label">jours de travail par Semaine</label>
<div class="col-lg-8">
<input type="number" step="0.1" id="jour_semaine" name="jour_semaine" class="form-control" max="7" min="0">
</div>
</div>
<div class="form-group row">
<label class="col-lg-4 col-form-label">Heure début travail</label>
<div class="col-lg-8">
<input type="time" id="heure_debut_travail" name="heure_debut_travail" class="form-control">
</div>
</div>
<div class="form-group row">
<label class="col-lg-4 col-form-label">Heure fin travail</label>
<div class="col-lg-8">
<input type="time" id="heure_fin_travail" name="heure_fin_travail" class="form-control">
</div>
</div>
<div class="text-end" style="display: flex;justify-content: flex-end;">
<button type="submit" class="btn btn-primary">Confirmer</button>
</div>
</form>
</div>
</div>
	</div>
				</div>
			</div>
			
		</div>
	</div>
</div>    
<div class="modal" tabindex="-1" role="dialog" id="modal-update-entreprise">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modifier <span id="entreprise-attribute-modify"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-row">

					<div class="col-12">
						<span style="display: none;" id="attribute-to-update"></span>
						<input type="text" value="" id="inputAtrribute" style="width: 100%;">
						<select class="custom-select" id="selectAttribute" style="font-size: 12px;width: 100%;">

							<?php
							foreach ($villes as $value) {
								echo '<option value="'.$value['ville'].'">'.$value['ville'].'</option>';
							}
							?>

						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn-update-entreprise">Confirmer</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
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
		
		<script src="<?php echo base_url()?>assets/libraries/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/jquery-steps/jquery.steps.min.js"></script>
		<script type="text/javascript">
        BaseUrl = "<?php echo base_url();?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/rh-sections/communScript.js"></script>
    <script src="<?php echo base_url()?>assets/custom/js/rh-sections/profilEntreprise.js"></script>
		
    </body>
</html>
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
				
				<div id="gestion-fonctions-section " class="principal-sections page-wrapper">
		
		<div id="main-gestions-container" class="content container-fluid">
			<div class="crms-title row bg-white">
		                		<div class="col  p-0">
		                			<h3 class="page-title m-0">
					                <span class="page-title-icon bg-gradient-primary text-white mr-2">
					                  <i class="feather-grid"></i>
					                </span > Gestion des fonctions </h3>
		                		</div>
		                		<div class="col p-0 text-right">
		                			<ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
										<!-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
										<li class="breadcrumb-item active">Affaires</li> -->
									</ul>
		                		</div>
		                	</div>
		                	<div class="row " style="padding-top: 15px;">
		                		<div class="col-12">
		                			<div class="card flex-fill">
		                				<div class="card-body">
		                					<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
												<li class="nav-item"><a class="nav-link active" href="#fonctions-tab" data-toggle="tab">Fonctions</a></li>
												<li class="nav-item"><a class="nav-link" href="#etablissement-tab" data-toggle="tab">Entités</a></li>
												<li class="nav-item"><a class="nav-link" href="#classes-tab" data-toggle="tab">Profils</a></li>
											</ul>
											<div class="tab-content" id="tabs-container">
				<div class="tab-pane active" id="fonctions-tab">
				
					<div class="tab-items-container table-container">
						<div class="row">
							<div class="col col-md-4">
								<div style="display: flex;flex-direction: row;justify-content: left;">
									<span style="line-height: 34px;">Afficher</span>
									<select class="form-control length-table-field fonctions-length" style="max-width: 80px;height: 30px;" >
										<option>15</option>
										<option>50</option>
										<option>100</option>
									</select>
									<span  style="margin-left: 10px;line-height: 34px;">Page</span>
								</div>
		</div>
							<div class="col col-md-3">
								<div class="top-nav-search">
							
							<div>
								<input  type="text" class="form-control search-table-field search-fonctions" placeholder="Chercher">
							</div>
						</div>
							</div>
							<div class="col text-right">
								<ul class="list-inline-item pl-0">
					                <li class="nav-item dropdown list-inline-item add-lists">
					                    
					                        <div class="nav-profile-text">
					                        	<div class="btns-group" data-table="employees-table">
					                        	</div>
					                          
					                        </div>
					                    </li>
					                <li class="list-inline-item">
					                    <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded"  data-toggle="modal" data-target="#add-fonction-modal">Nouvelle Fonction</button>
					                </li>
					            </ul>
							</div>

						</div>
						<div class="table-responsive">
							
							<table id="fonctions-table" class="table table-striped table-nowrap custom-table mb-0 datatable" style="width: 100%;">
								<thead>
									<tr>
										<th>Numero</th>
										<th>Libelle</th>
										<th>Profil</th>
										<th>Type</th>
										<th>Date de Création</th>
										<th>#</th>
										<th></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="etablissement-tab">
				
					<div class="tab-items-container table-container">
						<div class="row">
							<div class="col col-md-4">
								<div style="display: flex;flex-direction: row;justify-content: left;">
									<span style="line-height: 34px;">Afficher</span>
									<select class="form-control length-table-field fonctions-length" style="max-width: 80px;height: 30px;" >
										<option>15</option>
										<option>50</option>
										<option>100</option>
									</select>
									<span  style="margin-left: 10px;line-height: 34px;">Page</span>
								</div>
		</div>
							<div class="col col-md-3">
								<div class="top-nav-search">
							
							<div>
								<input  type="text" class="form-control search-table-field search-fonctions" placeholder="Chercher">
							</div>
						</div>
							</div>
							<div class="col text-right">
								<ul class="list-inline-item pl-0">
					                <li class="nav-item dropdown list-inline-item add-lists">
					                    
					                        <div class="nav-profile-text">
					                        	<div class="btns-group" data-table="employees-table">
					                        	</div>
					                          
					                        </div>
					                    </li>
					                <li class="list-inline-item">
					                    <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded"  data-toggle="modal" data-target="#add-etablissement-modal">Nouvelle Entité</button>
					                </li>
					            </ul>
							</div>

						</div>
						<div class="table-responsive">
							
							<table id="etablissements-table" class="table table-striped table-nowrap custom-table mb-0 datatable" style="width: 100%;">
								<thead>
								<tr>
									<th>Code</th>
									<th>Libelle</th>
									<th>Type</th>
									<th>Etablissement Mère</th>
									<th>Date de Création</th>
									<th>th</th>
								</tr>
							</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="classes-tab">
				
					<div class="tab-items-container table-container">
						<div class="row">
							<div class="col col-md-4">
								<div style="display: flex;flex-direction: row;justify-content: left;">
									<span style="line-height: 34px;">Afficher</span>
									<select class="form-control length-table-field fonctions-length" style="max-width: 80px;height: 30px;" >
										<option>15</option>
										<option>50</option>
										<option>100</option>
									</select>
									<span  style="margin-left: 10px;line-height: 34px;">Page</span>
								</div>
		</div>
							<div class="col col-md-3">
								<div class="top-nav-search">
							
							<div>
								<input  type="text" class="form-control search-table-field search-fonctions" placeholder="Chercher">
							</div>
						</div>
							</div>
							<div class="col text-right">
								<ul class="list-inline-item pl-0">
					                <li class="nav-item dropdown list-inline-item add-lists">
					                    
					                        <div class="nav-profile-text">
					                        	<div class="btns-group" data-table="employees-table">
					                        	</div>
					                          
					                        </div>
					                    </li>
					                <li class="list-inline-item">
					                    <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded"  data-toggle="modal" data-target="#add-class-modal">Nouveau Profil</button>
					                </li>
					            </ul>
							</div>

						</div>
						<div class="table-responsive">
							
							<table id="classes-table" class="table table-striped table-nowrap custom-table mb-0 datatable" style="width: 100%;">
								<thead>
								<tr>
									<th>Code</th>
									<th>Libelle</th>
									<th>Salaire</th>
									<th>#</th>
								</tr>
							</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		                				</div>
		                			</div>
		                			
		                		</div>
		                		
		                	</div>
			
			
			
			
		</div>
	</div>


				
	        </div>
			<!-- /Main Wrapper -->

			<!-- /Main Wrapper -->

			<!--modal section starts here-->
			<!-- Modal -->
			<div class="modal right fade" id="add-fonction-modal" tabindex="-1" role="dialog" aria-modal="true">
				<div class="modal-dialog" role="document">
					<button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<div class="modal-content">

						<div class="modal-header">
		                    <h4 class="modal-title text-center">Gestion Organisation</h4>
		                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
		                  </div>

						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
						        	
						        	<form action="<?php echo base_url()?>Fonctions/addFonction" method="post" id="nouvelle-fonction-form">
						        		<h4>Ajouter une fonction</h4>
						        		 <div class="col-md-11 m-auto">
				                            	<label class="col-form-label">Libelle<span class="text-danger">*</span></label>
                            					<textarea class="form-control" id="fonctions-Libelle" name="fonctions-Libelle" rows="2" aria-describedby="observation-aide" required></textarea>
				                            </div>
				                            <div class="col-md-11 m-auto">
				                            	<label class="col-form-label">Profil <span class="text-danger">*</span></label>
                            					<select class="custom-select" id="fonction-classe" name="fonction-classe">
										</select>
				                            </div>
				                            <div class="col-md-11 m-auto">
				                            	<label class="col-form-label">Type<span class="text-danger">*</span></label>
                            					<select class="custom-select" id="fonction-type" name="fonction-type">
											<?php
											foreach ($types as $value) {
												echo '<option value="'.$value['id_type'].'">'.$value['libelle'].'</option>';
											}

											?>

										</select>
				                            </div>
				                            
				                            <div class="text-center py-3">
						                	<button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded" id="Btn-ajouter-fonctions" >Ajouter</button>&nbsp;&nbsp;
						                	
						                </div>
									
			</form>

						        </div>
							
							</div>

					</div><!-- modal-content -->
				</div><!-- modal-dialog -->
			</div><!-- modal -->
		</div>
			<!-- Modal -->
			<div class="modal right fade" id="add-etablissement-modal" tabindex="-1" role="dialog" aria-modal="true">
				<div class="modal-dialog" role="document">
					<button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<div class="modal-content">

						<div class="modal-header">
		                    <h4 class="modal-title text-center">Gestion Organisation</h4>
		                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
		                  </div>

						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
						        	
						        	<form action="<?php echo base_url()?>Etablissements/addEtablissement" method="post" id="nouvelle-etablissement-form">
						        		<h4>Ajouter une Entité</h4>
						        		 <div class="col-md-11 m-auto">
				                            	<label class="col-form-label">Libelle<span class="text-danger">*</span></label>
                            					<textarea class="form-control" id="etablissements-Libelle" name="etablissements-Libelle" rows="2" aria-describedby="observation-aide" required></textarea>
				                            </div>
				                            <div class="col-md-11 m-auto">
				                            	<label class="col-form-label">Entité mère <span class="text-danger">*</span></label>
                            					<select class="custom-select" id="etablissement-mere" name="etablissement-mere">

										</select>
				                            </div>
				                            <div class="col-md-11 m-auto">
				                            	<label class="col-form-label">Type<span class="text-danger">*</span></label>
                            					<select class="custom-select" id="etablissement-type" name="etablissement-type">
											<?php
											foreach ($typeEtablissements as $value) {
												echo '<option value="'.$value['id_type'].'">'.$value['designation'].'</option>';
											}

											?>

										</select>
				                            </div>
				                            
				                            <div class="text-center py-3">
						                	<button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded" id="Btn-ajouter-etablissements" >Ajouter</button>&nbsp;&nbsp;
						                	
						                </div>
									
			</form>

						        </div>
							
							</div>
						</div>

					</div><!-- modal-content -->
				</div><!-- modal-dialog -->
			</div>
			<!-- Modal -->
			<div class="modal right fade" id="update-etablissement-modal" tabindex="-1" role="dialog" aria-modal="true">
				<div class="modal-dialog" role="document">
					<button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<div class="modal-content">

						<div class="modal-header">
		                    <h4 class="modal-title text-center">Gestion Organisation</h4>
		                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
		                  </div>

						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
						        	
						        	<form action="<?php echo base_url()?>Etablissements/updateEtablissement" method="post" id="update-etablissement-form" >
						        		<h4>Editer une entité</h4>
						        		 <div class="col-md-11 m-auto">
				                            	<label class="col-form-label">Libelle<span class="text-danger">*</span></label>
                            					<textarea class="form-control" id="etablissements-Libelle-update" name="etablissements-Libelle" rows="2" aria-describedby="observation-aide" required></textarea>
				                            </div>
				                            <input type="text" name="code" id="code-update" style="display: none;">
				                            <div class="col-md-11 m-auto">
				                            	<label class="col-form-label">Entité mère <span class="text-danger">*</span></label>
                            					<select class="custom-select" id="etablissement-mere-update" name="etablissement-mere">

										</select>
				                            </div>
				                            <div class="col-md-11 m-auto">
				                            	<label class="col-form-label">Type<span class="text-danger">*</span></label>
                            					<select class="custom-select" id="etablissement-type-update" name="etablissement-type">
											<?php
											foreach ($typeEtablissements as $value) {
												echo '<option value="'.$value['id_type'].'">'.$value['designation'].'</option>';
											}

											?>

										</select>
				                            </div>
				                            
				                            <div class="text-center py-3">
						                	<button type="submit" class="border-0 btn btn-danger bg-gradient-danger btn-rounded" id="Btn-update-etablissements" >Modifier</button>&nbsp;&nbsp;
						                	
						                </div>
									
			</form>

						        </div>
							
							</div>
						</div>

					</div><!-- modal-content -->
				</div><!-- modal-dialog -->
			</div>
			<!-- modal -->
			<!-- Modal -->
			<div class="modal right fade" id="add-class-modal" tabindex="-1" role="dialog" aria-modal="true">
				<div class="modal-dialog" role="document">
					<button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<div class="modal-content">

						<div class="modal-header">
		                    <h4 class="modal-title text-center">Gestion Organisation</h4>
		                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
		                  </div>

						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
						        	
						        	<form action="<?php echo base_url()?>Classes/addClasse" method="post" id="nouvelle-classe-form">
						        		<h4>Ajouter un Profil</h4>
						        		 <div class="col-md-11 m-auto">
				                            	<label class="col-form-label">Libelle<span class="text-danger">*</span></label>
                            					<textarea class="form-control" id="classe-Libelle" name="classe-Libelle" rows="2" aria-describedby="classe" required></textarea>
				                            </div>
				                            <div class="col-md-11 m-auto">
				                            	<label class="col-form-label">Salaire de base en DH <span class="text-danger">*</span></label>
                            					<input class="form-control" type="number" name="classe-salaire" id="classe-salaire">
				                            </div>
				                            
				                            
				                            <div class="text-center py-3">
						                	<button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded" id="Btn-ajouter-etablissements" >Ajouter</button>&nbsp;&nbsp;
						                	
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
			
			</script>
			<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/rh-sections/communScript.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/rh-sections/fonctions-mainScript.js"></script>
			
	    </body>
	</html>
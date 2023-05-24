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
		<link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/admin-sections/main.css">

    </head>
    <body id="skin-color" class="inter">
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			
			
			<!-- Sidebar -->
            <?php echo $sideBarre; ?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->

            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">

                	<div class="crms-title row bg-white">
                		<div class="col  p-0">
                			<h3 class="page-title m-0">
			                <span class="page-title-icon bg-gradient-primary text-white mr-2">
			                  <i class="feather-grid"></i>
			                </span>Liste des Entreprise Inscrites</h3>
                		</div>
                		<div class="col p-0 text-right">
                			<ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
								<!-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
								<li class="breadcrumb-item active">Affaires</li> -->
							</ul>
                		</div>
                	</div>
					<!-- Content Starts -->
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped table-nowrap custom-table mb-0 datatable" id="entreprise-liste-table">
											<thead>
											<th>Numero</th>
								<th></th>
							<th>Nom</th> 
							<th>Tèl</th> 
							<th>Email</th>
							<th>Admin</th>
							<th>Etat</th>
							
							<th>action</th>
											</thead>
									</table>
									</div>
								</div>
							</div>	
						</div>
					</div>
					<!-- /Content End -->
					
					
                </div>
				<!-- /Page Content -->
				
            </div>
           
			<!-- /Page Wrapper -->	
        </div>
		<!-- /Main Wrapper -->

		<!--modal section starts here-->
		<div class="modal fade" id="add-new-list">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Add New List View</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <form class="forms-sample">
                  <div class="form-group row">
                    <label for="view-name" class="col-sm-4 col-form-label">New View Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="view-name" placeholder="New View Name">
                    </div>
                  </div>
                  <div class="form-group row pt-4">
                    <label class="col-sm-4 col-form-label">Sharing Settings</label>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value=""> Just For Me <i class="input-helper"></i></label>
                        </div><br />
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked=""> Share Filter with Everyone <i class="input-helper"></i></label>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="text-center">
                    <button type="submit" class="btn btn-gradient-primary mr-2 btn-rounded">Submit</button>
                    <button class="btn btn-light cancel-button rounded">Cancel</button>
                  </div>
                </form>
              </div>
           
            </div>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal right fade" id="employees-modal" tabindex="-1" role="dialog"   role="dialog" aria-modal="true" style="z-index: 100000;">

			<!--AJOUTER DES RANGEE-->
			<div class="modal-dialog " role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" >Liste des employées</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table id="employees-table" class="table table-striped table-nowrap custom-table mb-0 datatable" style="width: 100%;">
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

							<input type="text" readonly id="selected-responsable" class="col-8 form-control">
							<button class="col-2 ml-auto border-0 btn btn-info btn-gradient-info btn-rounded" id="select-responsable">Selectionner</button>
						</div>

					</div>

				</div>
			</div>
		</div><!-- Modal -->
        <!-- Modal -->
			<div class="modal right fade" id="add-mission-modal" tabindex="-1" role="dialog" aria-modal="true">
				<div class="modal-dialog" role="document">
					<button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<div class="modal-content">

						<div class="modal-header">
		                    <h4 class="modal-title text-center">Ajouter une mission</h4>
		                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
		                  </div>

						<div class="modal-body">
							<div class="row">
						        <div class="col-md-12">
						        	
						        	<form action="<?php echo base_url()?>Affaire_missions/addMission" method="post" id="nouveau-missions-form">
						        		<h4>Détail Mission</h4>
					<div class="form-group row">
				                        	<div class="col-12">
				                            	<label class="col-form-label">Libellé<span class="text-danger">*</span></label>
                            					<textarea class="form-control" id="missions-Libelle" name="missions-Libelle" rows="2" aria-describedby="observation-aide" required maxlength="150"></textarea>
				                            </div>
				                        </div>
						<div class="form-group row">
				                            
				                            <div class="col-12">
				                            	<label class="col-form-label">Délai (en Jours)<span class="text-danger">*</span></label>
                            					<input type="number" class="form-control" id="affaire-mission-delai" name="affaire-mission-delai" aria-describedby="delai-aide" placeholder="ex : 120" required>

				                            </div>
				                           
				                        </div>
				                        <div class="form-group row">
				                            
				                            <div class="col-12">
				                            	<label class="col-form-label">Responsable<span class="text-danger">*</span></label>
				                            	<div class="input-group">
													<div class="input-group-prepend load-employees"  >
														<span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
													</div>
													<input type="text" class="form-control" id="missions-responsable" name="missions-responsable" required>
												</div>
                            					 </div>
				                           
				                        </div>
				                        
				                         <h4>Autre Information</h4>
				                         <div class="form-group row">
											<div class="col-sm-12">
												<label class="col-form-label">Observations</label>
				                            	<textarea class="form-control" id="info-supp" name="info-supp" rows="3" aria-describedby="observation-aide"  maxlength="1000"></textarea>
				                            	<small id="observation-aide" class="form-text text-muted">observations, avancement, remarques...  </small>
											</div>
										</div>
										<h4>Attachements</h4>
				                         <div class="form-group row">
											<div class="col-sm-12">
												<label for="tache-attach-add" class="btn btn-secondary btn-circle btn-sm" style="font-size: 10px;"><input id="tache-attach-add" type="file" multiple="multiple" class="d-none"><i class="fa fa-paperclip  fa-lg"></i></label>
												<div id="divFiles">
															<table id="t-attach-list" style="width:100%">
															</table>
														</div>
											</div>
										</div>
										<div class="text-center py-3">
						                	<button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded" id="add-affaire" >Ajouter</button>&nbsp;&nbsp;
						                	
						                </div>
						
						
				</form>

						        </div>
							</div>

						</div>

					</div><!-- modal-content -->
				</div><!-- modal-dialog -->
			</div><!-- modal -->
		<!-- Modal -->
			<div class="modal right fade" id="add-affaire-modal" tabindex="-1" role="dialog" aria-modal="true">
				<div class="modal-dialog" role="document">
					<button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<div class="modal-content">

						<div class="modal-header">
		                    <h4 class="modal-title text-center">Add Project</h4>
		                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
		                  </div>

						<div class="modal-body">
							<div class="row">
						        <div class="col-md-12">
						        	
						        	<form id="affaire-form" action="<?php echo base_url(); ?>NouvelleAffaire/ajouterAffaire" method="post">
						        		<h4>Détail Affaire</h4>
					
						<div class="form-group row">
				                            <div class="col-md-6">
				                            	<label class="col-form-label">Numero Affaire <span class="text-danger">*</span></label>
                            					<input class="form-control" type="text" id="numero" name="numero" required>
				                            </div>
				                            <div class="col-md-6">
				                            	<label class="col-form-label">Délai (en Jours)<span class="text-danger">*</span></label>
                            					<input class="form-control" type="numeric" id="delai" name="delai" required>
				                            </div>
				                           
				                        </div>
				                        <div class="form-group row">
				                        	<div class="col-12">
				                            	<label class="col-form-label">Libellé<span class="text-danger">*</span></label>
                            					<textarea class="form-control" id="libelle" name="libelle" rows="2" required></textarea>
				                            </div>
				                        </div>
				                         <h4>Autre Information</h4>
				                         <div class="form-group row">
											<div class="col-sm-12">
												<label class="col-form-label">Observations</label>
				                            	<textarea class="form-control" rows="3" id="observations" name="observations" placeholder="Description"></textarea>
				                            	<small id="observation-aide" class="form-text text-muted">observations, avancement, remarques...  </small>
											</div>
										</div>
										<div class="text-center py-3">
						                	<button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded" id="add-affaire" >Ajouter</button>&nbsp;&nbsp;
						                	
						                </div>
						
						
				</form>

						        </div>
							</div>

						</div>

					</div><!-- modal-content -->
				</div><!-- modal-dialog -->
			</div><!-- modal -->

			<!--system users Modal -->
            <div class="modal right fade" id="system-user" tabindex="-1" role="dialog" aria-modal="true">
              <div class="modal-dialog" role="document">
                <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
                    <div class="row w-100">
                      <div class="col-md-7 account d-flex">
                      	<div class="company_img">
                      		<img src="<?php echo base_url()?>assets/template/img/system-user.png" alt="User" class="user-image" class="img-fluid" />
                  		</div>
                  		<div>
                  			<p class="mb-0">System User</p>
                  			<span class="modal-title">John Doe</span>
                    		<span class="rating-star"><i class="fa fa-star" aria-hidden="true"></i></span>
                    		<span class="lock"><i class="fa fa-lock" aria-hidden="true"></i></span>
                  		</div>

                      </div>
                      <div class="col-md-5 text-right">
                        <ul class="list-unstyled list-style-none">
							<li class="dropdown list-inline-item"><br />
								<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false"> Actions </a>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="#">Edit This Contact</a>
	                              	<a class="dropdown-item" href="#">Change Contact Image</a>
	                             	 <a class="dropdown-item" href="#">Delete This Contact</a>
	                              	<a class="dropdown-item" href="#">Clone This Contact</a>
	                              	<a class="dropdown-item" href="#">Change Record Owner</a>
	                              	<a class="dropdown-item" href="#">Generate Merge Document</a>
	                              	<a class="dropdown-item" href="#">Change Contact To Lead</a>
	                              	<a class="dropdown-item" href="#">Print This Contact</a>
	                              	<a class="dropdown-item" href="#">Email This Contact</a>
	                              	<a class="dropdown-item" href="#">Add New Task For Contact</a>
	                             	 <a class="dropdown-item" href="#">Add New Event For Contact</a>
	                              	<a class="dropdown-item" href="#">Add Activity Set To Contact</a>
	                              	<a class="dropdown-item" href="#">Add New Deal For Contact</a>
	                             	 <a class="dropdown-item" href="#">Add New Project For Contact</a>
								</div>
							</li>
                          
                        </ul>
                        
                      </div>
                    </div>
                   
                  </div>

                  <div class="card due-dates">
                  	<div class="card-body">
	                    <div class="row">
	                      <div class="col">
	                        <span>Title</span>
	                        <p>Phone call</p>
	                      </div>
	                      <div class="col">
	                        <span>Companies</span>
	                        <p>Claimpett corp</p>
	                      </div>
	                      <div class="col">
	                        <span>Phone</span>
	                        <p>9876764875</p>
	                      </div>
	                      <div class="col">
	                        <span>Email</span>
	                        <p>johndoe@gmail.com</p>
	                      </div>
	                      <div class="col">
	                        <span>Contact owner</span>
	                        <p>John Doe</p>
	                      </div>
	                    </div>
	                </div>
                  </div>

                  <div class="modal-body">
                    <div class="task-infos">
						<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
							<li class="nav-item"><a class="nav-link active" href="#task-details" data-toggle="tab">Details</a></li>
							<li class="nav-item"><a class="nav-link" href="#task-related" data-toggle="tab">Related</a></li>
							<li class="nav-item"><a class="nav-link" href="#task-activity" data-toggle="tab">Activity</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane show active" id="task-details">
								<div class="crms-tasks">
							  	<div class="tasks__item crms-task-item active">
							    	<div class="accordion-header js-accordion-header">Name & Occupation</div> 
								  	<div class="accordion-body js-accordion-body">
									    <div class="accordion-body__contents">
									      <table class="table">
				                                <tbody>
				                                  <tr>
				                                    <td class="border-0">Record ID</td>
				                                    <td class="border-0">124192692</td>
				                                  </tr>
				                                  <tr>
				                                    <td class="border-0">Name</td>
				                                    <td class="border-0">John Doe</td>
				                                  </tr>
				                                  <tr>
				                                    <td>Company</td>
				                                    <td>Umbrella</td>
				                                  </tr>
				                                  <tr>
				                                    <td>Title</td>
				                                    <td>Lorem ipsum</td>
				                                  </tr>
				                                </tbody>
				                            </table>
									    </div>
								    </div>
							  </div>
							  <div class="tasks__item crms-task-item active">
							    <div class="accordion-header js-accordion-header">Contact Details</div> 
							  	<div class="accordion-body js-accordion-body">
								    <div class="accordion-body__contents">
								      	<table class="table">
			                                <tbody>
			                                  <tr>
			                                    <td class="border-0">Email</td>
			                                    <td class="border-0">johndoe@gmail.com</td>
			                                  </tr>
			                                  <tr>
			                                    <td>Email Opted out</td>
			                                    <td>
			                                      <div class="form-check m-0 pl-0">
			                                        <label class="form-check-label">
			                                          <input class="checkbox" type="checkbox"> <i class="input-helper"></i><i class="input-helper"></i><i class="input-helper"></i></label>
			                                      </div>
			                                    </td>
			                                  </tr>
			                                  <tr>
			                                    <td>Phone</td>
			                                    <td>9866667775</td>
			                                  </tr>
			                                  <tr>
			                                    <td>Home Phone</td>
			                                    <td>0422-656565</td>
			                                  </tr>
			                                  <tr>
			                                    <td>Mobile Phone</td>
			                                    <td>9887876556</td>
			                                  </tr>
			                                  <tr>
			                                    <td>Other Phone</td>
			                                    <td>9786778678</td>
			                                  </tr>
			                                  <tr>
			                                    <td>Assistant Phone</td>
			                                    <td>9877667676</td>
			                                  </tr>
			                                  <tr>
			                                    <td>Assistant Name</td>
			                                    <td>David</td>
			                                  </tr>
			                                  <tr>
			                                    <td>Fax</td>
			                                    <td>1234</td>
			                                  </tr>
			                                  <tr>
			                                    <td>Linkedin</td>
			                                    <td>Lorem Ipsum</td>
			                                  </tr>
			                                  <tr>
			                                    <td>Facebook</td>
			                                    <td>Lorem ipsum</td>
			                                  </tr>
			                                  <tr>
			                                    <td>Twitter</td>
			                                    <td>David_1</td>
			                                  </tr>
			                                  
			                                </tbody>
			                            </table>
								    </div>
							    </div>
							  </div>
							  <div class="tasks__item crms-task-item active">
							    <div class="accordion-header js-accordion-header">Address Information</div> 
							  	<div class="accordion-body js-accordion-body">
								    <div class="accordion-body__contents">
								      <table class="table">
		                                <tbody>
		                                  <tr>
		                                    <td class="border-0">Mailling Address</td>
		                                    <td class="border-0">USA</td>
		                                  </tr>
		                                  <tr>
		                                    <td>Other Address</td>
		                                    <td>New York</td>
		                                  </tr>
		                                </tbody>
		                              </table>
								    </div>
								    
							    </div>
							  </div>
							  <div class="tasks__item crms-task-item active">
							    <div class="accordion-header js-accordion-header">Dates To Remember</div> 
							  	<div class="accordion-body js-accordion-body">
								    <div class="accordion-body__contents">
								      <table class="table">
			                                <tbody>
			                                  <tr>
			                                    <td class="border-0">Dates to Remember</td>
			                                    <td class="border-0">09/03/2020</td>
			                                  </tr>
			                                  <tr>
			                                    <td>Date of Birth</td>
			                                    <td>04/08/2000</td>
			                                  </tr>
			                                  
			                                </tbody>
			                              </table>
								    </div>
								    
							    </div>
							  </div>
							  <div class="tasks__item crms-task-item active">
							    <div class="accordion-header js-accordion-header">Additional Information</div> 
							  	<div class="accordion-body js-accordion-body">
								    <div class="accordion-body__contents">
								      	<table class="table">
			                                <tbody>
				                                  <tr>
				                                    <td class="border-0">Date of Next Activity</td>
				                                    <td class="border-0">04/08/2000</td>
				                                  </tr>
				                                  <tr>
				                                    <td>Date of Last Activity</td>
				                                    <td>04/05/2010</td>
				                                  </tr>
				                                  <tr>
				                                    <td>Contact Owner</td>
				                                    <td>John Doe</td>
				                                  </tr>
				                                  <tr>
				                                    <td>Contact Created</td>
				                                    <td>Jun 20, 2020</td>
				                                  </tr>
			                                  
			                                	</tbody>
			                              	</table>
								    </div>
								    
							    </div>
							  </div>
							  <div class="tasks__item crms-task-item active">
							    <div class="accordion-header js-accordion-header">Description Information</div> 
							  	<div class="accordion-body js-accordion-body">
								    <div class="accordion-body__contents">
								      <table class="table">
			                                <tbody>
				                                <tr>
				                                    <td class="border-0">Description</td>
				                                    <td class="border-0">Lorem Ipsum</td>
				                                </tr>
			                                </tbody>
			                              </table>
								    </div>
							    </div>
							  </div>
							  <div class="tasks__item crms-task-item active">
							    <div class="accordion-header js-accordion-header">Tag List</div> 
							  	<div class="accordion-body js-accordion-body">
								    <div class="accordion-body__contents">
								      <table class="table">
			                                <tbody>
			                                  <tr>
			                                    <td class="border-0">Tag List</td>
			                                    <td class="border-0">Lorem Ipsum</td>
			                                  </tr>
			                                </tbody>
			                              </table>
								    </div>
								    
							    </div>
							  </div>
							</div>
							</div>
								
							<div class="tab-pane task-related" id="task-related">
								<div class="row pt-2">
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-danger card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="<?php echo base_url()?>assets/template/img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Companies</h4>
		                                  <span>2</span>
		                                </div>
		                              </div>
		                            </div>
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-info card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="<?php echo base_url()?>assets/template/img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Deals</h4>
		                                  <span>2</span>
		                                </div>
		                              </div>
		                            </div>
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-success card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="<?php echo base_url()?>assets/template/img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Projects</h4>
		                                  <span>1</span>
		                                </div>
		                              </div>
		                            </div>
		                        </div>
		                        <div class="row pt-3">
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-success card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="<?php echo base_url()?>assets/template/img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Contacts</h4>
		                                  <span>2</span>
		                                </div>
		                              </div>
		                            </div>
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-danger card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="<?php echo base_url()?>assets/template/img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Notes</h4>
		                                  <span>2</span>
		                                </div>
		                              </div>
		                            </div>
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-info card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="<?php echo base_url()?>assets/template/img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Files</h4>
		                                  <span>2</span>
		                                </div>
		                              </div>
		                            </div>
		                        </div>
		                        <div class="row">
		                        	<div class="crms-tasks  p-2">
			                        	<div class="tasks__item crms-task-item active">
										    <div class="accordion-header js-accordion-header">Companies</div> 
										  	<div class="accordion-body js-accordion-body">
											    <div class="accordion-body__contents">
											    	<div class="table-responsive">
														<table class="table table-striped table-nowrap custom-table mb-0 datatable">
															<thead>
																<tr>
																	<th>Company Name</th>
																	<th>Phone</th>
																	<th>Billing Country</th>
																	<th class="text-right">Actions</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>
																		<a href="#" class="avatar"><img alt="" src="<?php echo base_url()?>assets/template/img/c-logo2.png"></a>
																		<a href="#" data-toggle="modal" data-target="#company-details">Clampett Oil and Gas Corp.</a>
																	</td>
																	<td>8754554531</td>
																	<td>United States</td>
										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Edit Link</a>
												                                <a class="dropdown-item" href="#">Delete Link</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td>
																		<a href="#" class="avatar"><img alt="" src="<?php echo base_url()?>assets/template/img/c-logo.png"></a>
																		<a href="#" data-toggle="modal" data-target="#company-details">Acme Corporation</a>
																	</td>
																	<td>8754554531</td>
																	<td>United States</td>
										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Edit Link</a>
												                                <a class="dropdown-item" href="#">Delete Link</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
											    </div>
										    </div>
										</div>
										<div class="tasks__item crms-task-item">
										    <div class="accordion-header js-accordion-header">Deals</div> 
										  	<div class="accordion-body js-accordion-body">
											    <div class="accordion-body__contents">
											    	<div class="table-responsive">
														<table class="table table-striped table-nowrap custom-table mb-0 datatable">
															<thead>
																<tr>
																	<th>Deal Name</th>
																	<th>Company</th>
																	<th>User Responsible</th>
																	<th>Deal Value</th>
																	<th></th>
																	<th class="text-right">Actions</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	
																	<td>
																		Bensolet
																	</td>
																	<td>Globex</td>
																	<td>John Doe</td>
																	<td>USD $‎180</td>
																	<td><i class="fa fa-star" aria-hidden="true"></i></td>
																	
										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Edit Link</a>
												                                <a class="dropdown-item" href="#">Delete Link</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
																<tr>
																	
																	<td>
																		Ansanio tech
																	</td>
																	<td>Lecto</td>
																	<td>John Smith</td>
																	<td>USD $‎180</td>
																	<td><i class="fa fa-star" aria-hidden="true"></i></td>
																	
										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Edit Link</a>
												                                <a class="dropdown-item" href="#">Delete Link</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
											    </div>
										    </div>
										</div>
										<div class="tasks__item crms-task-item">
										    <div class="accordion-header js-accordion-header">Projects</div> 
										  	<div class="accordion-body js-accordion-body">
											    <div class="accordion-body__contents">
											    	<div class="table-responsive">
														<table class="table table-striped table-nowrap custom-table mb-0 datatable">
															<thead>
																<tr>
																	<th>Project Name</th>
																	<th>Status</th>
																	<th>User Responsible</th>
																	<th>Date Created</th>
																	<th class="text-right">Actions</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>
																		Wilmer Deluna
																	</td>
																	<td>Completed</td>
																	<td>Williams</td>
																	<td>13-Jul-20 11:37 PM</td>
										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Edit Link</a>
												                                <a class="dropdown-item" href="#">Delete Link</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
											    </div>
										    </div>
										</div>
										<div class="tasks__item crms-task-item">
										    <div class="accordion-header js-accordion-header">Contacts </div> 
										  	<div class="accordion-body js-accordion-body">
											    <div class="accordion-body__contents">
											    	<div class="table-responsive">
														<table class="table table-striped table-nowrap custom-table mb-0 datatable">
															<thead>
																<tr>
																	<th>Name</th>
																	<th>Title</th>
																	<th>phone</th>
																	<th>Email</th>
																	<th class="text-right">Actions</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	
																	<td>
																		Wilmer Deluna
																	</td>
																	<td>Call Enquiry</td>
																	<td>987675656</td>
																	<td>william@gmail.com</td>
										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Edit Link</a>
												                                <a class="dropdown-item" href="#">Delete Link</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
																<tr>
																	
																	<td>
																		John Doe
																	</td>
																	<td>Enquiry</td>
																	<td>987675656</td>
																	<td>john@gmail.com</td>
										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Edit Link</a>
												                                <a class="dropdown-item" href="#">Delete Link</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
											    </div>
										    </div>
										</div>
										<div class="tasks__item crms-task-item">
										    <div class="accordion-header js-accordion-header">Notes </div> 
										  	<div class="accordion-body js-accordion-body">
											    <div class="accordion-body__contents">
											    	<div class="table-responsive">
														<table class="table table-striped table-nowrap custom-table mb-0 datatable">
															<thead>
																<tr>
																	<th>Name</th>
																	<th>Size</th>
																	<th>Category</th>
																	<th>Date Added</th>
																	<th>Added by</th>
																	<th class="text-right">Actions</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	
																	<td>
																		Document
																	</td>
																	<td>50KB</td>
																	<td>Phone call</td>
																	<td>13-Jul-20 11:37 PM</td>
																	<td>John Doe</td>
										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Edit Link</a>
												                                <a class="dropdown-item" href="#">Delete Link</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
																<tr>
																	
																	<td>
																		Finance
																	</td>
																	<td>100KB</td>
																	<td>Enquiry</td>
																	<td>13-Jul-20 11:37 PM</td>
																	<td>Smith</td>
										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Edit Link</a>
												                                <a class="dropdown-item" href="#">Delete Link</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
											    </div>
										    </div>
										</div>
										<div class="tasks__item crms-task-item">
										    <div class="accordion-header js-accordion-header">Files </div> 
										  	<div class="accordion-body js-accordion-body">
											    <div class="accordion-body__contents">
											    	<div class="table-responsive">
														<table class="table table-striped table-nowrap custom-table mb-0 datatable">
															<thead>
																<tr>
																	<th>Name</th>
																	<th>Size</th>
																	<th>Category</th>
																	<th>Date Added</th>
																	<th>Added by</th>
																	<th class="text-right">Actions</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	
																	<td>
																		Document
																	</td>
																	<td>50KB</td>
																	<td>Phone Call</td>
																	<td>13-Jul-20 11:37 PM</td>
																	<td>John Doe</td>
										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Edit Link</a>
												                                <a class="dropdown-item" href="#">Delete Link</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
																<tr>
																	
																	<td>
																		Finance
																	</td>
																	<td>100KB</td>
																	<td>Enquiry</td>
																	<td>13-Jul-20 11:37 PM</td>
																	<td>Smith</td>
										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Edit Link</a>
												                                <a class="dropdown-item" href="#">Delete Link</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
											    </div>
										    </div>
										</div>
									</div>
		                        </div>
							</div>
							<div class="tab-pane" id="task-activity">
								<div class="row pt-2">
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-danger card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="<?php echo base_url()?>assets/template/img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Total Activities</h4>
		                                  <span>2</span>
		                                </div>
		                              </div>
		                            </div>
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-info card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="<?php echo base_url()?>assets/template/img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Last Activity</h4>
		                                  <span>1</span>
		                                </div>
		                              </div>
		                            </div>
		                            
		                        </div>
		                        
		                        <div class="row">
		                        	<div class="crms-tasks  p-2">
			                        	<div class="tasks__item crms-task-item active">
										    <div class="accordion-header js-accordion-header">Upcoming Activity </div> 
										  	<div class="accordion-body js-accordion-body">
											    <div class="accordion-body__contents">
											    	<div class="table-responsive">
														<table class="table table-striped table-nowrap custom-table mb-0 datatable">
															<thead>
																<tr>
																	<th>Type</th>
																	<th>Activity Name</th>
																	<th>Assigned To</th>
																	<th>Due Date</th>
																	<th>Status</th>
																	<th class="text-right">Actions</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	
																	<td>
																		Meeting
																	</td>
																	<td>Call Enquiry</td>
																	<td>John Doe</td>
																	<td>13-Jul-20 11:37 PM</td>
																	<td>
																		<label class="container-checkbox">
																		  	<input type="checkbox" checked>
																		  	<span class="checkmark"></span>
																		</label>
																	</td>

										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Add New Task</a>
												                                <a class="dropdown-item" href="#">Add New Event</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
																<tr>
																	
																	<td>
																		Meeting
																	</td>
																	<td>Phone Enquiry</td>
																	<td>David</td>
																	<td>13-Jul-20 11:37 PM</td>
																	
																	<td>
																		<label class="container-checkbox">
																		  	<input type="checkbox" checked>
																		  	<span class="checkmark"></span>
																		</label>
																	</td>
																	
										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Add New Task</a>
												                                <a class="dropdown-item" href="#">Add New Event</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
											    </div>
										    </div>
										</div>
										<div class="tasks__item crms-task-item">
										    <div class="accordion-header js-accordion-header">Past Activity </div> 
										  	<div class="accordion-body js-accordion-body">
											    <div class="accordion-body__contents">
											    	<div class="table-responsive">
														<table class="table table-striped table-nowrap custom-table mb-0 datatable">
															<thead>
																<tr>
																	<th>Type</th>
																	<th>Activity Name</th>
																	<th>Assigned To</th>
																	<th>Due Date</th>
																	<th>Status</th>
																	<th class="text-right">Actions</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	
																	<td>
																		Meeting
																	</td>
																	<td>Call Enquiry</td>
																	<td>John Doe</td>
																	<td>13-Jul-20 11:37 PM</td>
																	<td>
																		<label class="container-checkbox">
																		  	<input type="checkbox" checked>
																		  	<span class="checkmark"></span>
																		</label>
																	</td>

										                            <td class="text-center">
																		<div class="dropdown dropdown-action">
																			<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																			<div class="dropdown-menu dropdown-menu-right">
																				<a class="dropdown-item" href="#">Add New Task</a>
												                                <a class="dropdown-item" href="#">Add New Event</a>
												                                
																			</div>
																		</div>
																	</td>
																</tr>
																
															</tbody>
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

                </div><!-- modal-content -->
              </div><!-- modal-dialog -->
            </div><!-- modal -->
            <!--modal-->
            <!--modal-->
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
            <!--modal-->
            <div class="modal right fade" tabindex="-1" role="dialog" id="modal-edit-affaire" data-keyboard="false" aria-hidden="true" style="z-index: 100000;">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Modifier Une affaire</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?php echo base_url()?>Details/editAffaire" method="post" id="edit-affaires-form">
					<div class="modal-body">

						<div class="form-row">
							<div class="form-group row col-12">
								<label for="edit-num-affaire" class="col-sm-2 col-form-label">Numéro</label>
								<div class="col-sm-10">
									<input type="text" readonly class="form-control-plaintext" id="edit-num-affaire" value="" name="edit-num-affaire" required>
								</div>
							</div>
						</div>
						<div class="form-row">

							<div class="col-12">
								<label for="edit-affaires-libelle">Libelle</label>

								<textarea class="form-control" id="edit-affaires-libelle" name="edit-affaires-libelle" rows="2" aria-describedby="observation-aide" required></textarea>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-12">
								<label for="edit-affaire-delai">Délai (en Jours)</label>
								<div class="input-group input-group-sm">
									<input type="number" class="form-control" id="edit-affaire-delai" name="edit-affaire-delai" aria-describedby="delai-aide" placeholder="ex : 120" required>
								</div>
								<small class="form-text text-muted">le Délai de l'affaire en Jours calendaires  </small>
							</div>
						</div>
						<div class="form-row">

							<div class="col-12">
								<label for="domaine-contrat">Statut</label>

								<select class="custom-select" id="edit-affaire-statut" name="edit-affaire-statut" style="font-size: 12px;" required>
									<option value="0">En cours</option>
									<option value="1">Terminée</option>
								</select>
							</div>
							
						</div>
						<div class="form-row">
							<div class="form-group col-12">
								<label for="edit-affaire-observations">Observations</label>
								<textarea class="form-control" id="edit-affaire-observations" name="edit-affaire-observations" rows="2" aria-describedby="observation-aide"></textarea>
								<small class="form-text text-muted">observations, avancement, remarques...  </small>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="btn-edit-affaire">Confirmer</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					</div>
				</form>
			</div>
		</div>
	</div>
            <!--modal-->
             <!--modal-->
            <div class="modal right fade" tabindex="-1" role="dialog" id="modal-edit-mission" data-keyboard="false" aria-hidden="true" >
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Modifier Une affaire</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?php echo base_url()?>Affaire_missions/editMission" method="post" id="edit-missions-form">
								<div class="modal-body">

									<div class="form-row">
										<div class="form-group row col-12">
											<label for="edit-num-mission" class="col-sm-2 col-form-label">Numéro</label>
											<div class="col-sm-10">
												<input type="text" readonly class="form-control-plaintext" id="edit-num-mission" value="..." name="edit-num-mission" required>
											</div>
										</div>
									</div>
									<div class="form-row">

										<div class="col-12">
											<label for="edit-missions-libelle">Libelle</label>

											<textarea class="form-control" id="edit-missions-libelle" name="edit-missions-libelle" rows="2" aria-describedby="observation-aide" required></textarea>
										</div>
									</div>
									<div class="form-row">

										<div class="form-group col-12">
											<label for="edit-missions-responsable">responsable</label>
											<div class="input-group input-group-sm">
												<div class="input-group-prepend">
													<button class="btn btn-outline-secondary load-employees" type="button"><i class="fa fa-search"></i></button>
												</div>
												<input type="text" class="form-control" id="edit-missions-responsable" name="edit-missions-responsable" required>

											</div>

										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-12">
											<label for="edit-mission-delai">Délai (en Jours)</label>
											<div class="input-group input-group-sm">
												<input type="number" class="form-control" id="edit-mission-delai" name="edit-mission-delai" aria-describedby="delai-aide" placeholder="ex : 120" required>
											</div>
											<small class="form-text text-muted">le Délai de la mission en Jours calendaires  </small>
										</div>
									</div>

								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary" id="btn-edit-mission">Confirmer</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
								</div>
							</form>
			</div>
		</div>
	</div>
            <!--modal-->
            <!--Deal details Modal -->
            <div class="modal right fade" id="affaire-details" tabindex="-1" role="dialog" aria-modal="true">
              <div class="modal-dialog" role="document">
                <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
                    <div class="row w-100">
                       <div class="col-md-7 account d-flex">
	                      	
	                  		<div>
	                  			<p class="mb-0">Affaire</p>
	                  			<span class="modal-title num-affaire-text"></span>
	                    		<span class="rating-star"><i class="fa fa-star" aria-hidden="true"></i></span>
	                    		<span class="lock"><i class="fa fa-lock" aria-hidden="true"></i></span>
	                  		</div>
                     	 </div>
                     
                    </div>
                   
                  </div>

                 
                  <div class="modal-body project-pipeline">
                  	
                    <div class="task-infos pt-3">
						<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
							<li class="nav-item"><a class="nav-link active" href="#affaire-details-tab" data-toggle="tab">Detail Affaire</a></li>
							
							
						</ul>
						<div class="tab-content">
							<div class="tab-pane show active" id="affaire-details-tab">
								<div class="row">
									<div class="col-md-4">
		                              <div class="card bg-gradient-success card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Taches terminées</h4>
		                                  <span id="detail-tacheTermineeAffaire"></span>
		                                </div>
		                              </div>
		                            </div>
		                            
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-info card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Taches en cours</h4>
		                                  <span id="detail-tacheEnCoursAffaire"></span>
		                                </div>
		                              </div>
		                            </div>
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-danger card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Taches en Souffrance</h4>
		                                  <span id="detail-tacheEnSouffrance"></span>
		                                </div>
		                              </div>
		                            </div>
		                        </div>
							<div class="tasks__item crms-task-item active">
							    	 
								  	<div class="accordion-body js-accordion-body" style="display: block;">
									    <div class="accordion-body__contents">
										    <table class="table">
				                                <tbody>
				                                    <tr>
				                                      <td ><p  class="detail-affaire-item-title">Numéro</p></td>
				                                      <td ><p  class="detail-affaire-item-content"><label id="detail-numAffaire"></label></p></td>
				                                    </tr>
				                                     <tr>
				                                      <td ><p  class="detail-affaire-item-title">Libellé</p></td>
				                                      <td ><p  class="detail-affaire-item-content"><label id="detail-libelleAffaire"></label></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-affaire-item-title">Créée Par :</p></td>
				                                      <td><p  class="detail-affaire-item-content" ><label id="detail-createurAffaire"></label></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-affaire-item-title">Délai</p></td>
				                                      <td><p  class="detail-affaire-item-content"><label id="detail-delaiAffaire"></label></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-affaire-item-title">Date de création</p></td>
				                                      <td><p  class="detail-affaire-item-content"><label id="detail-dateCreationAffaire"></label></p></td>
				                                    </tr>
				                                     <tr>
				                                      <td><p  class="detail-affaire-item-title">Date de fin prévue</p></td>
				                                      <td><p  class="detail-affaire-item-content"><label id="detail-datefinAffaire" ></label></p></td>
				                                    </tr>
				                                     <tr>
				                                      <td><p  class="detail-affaire-item-title">Statut</p></td>
				                                      <td><p  class="detail-affaire-item-content"><label id="detail-StatutAffaire"></label></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-affaire-item-title">Observation</p></td>
				                                      <td><p  class="detail-affaire-item-content"><label id="detail-observationAffaire"></label></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td ><p  class="detail-affaire-item-title">Avancement : </p></td>
				                                      <td ><div class="progress progress-lg">
									<div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="avancement-bar"></div>
								</div></td>
				                                    </tr>
				                                    
				                                </tbody>
				                            </table>
									    </div>
								    </div>
							  </div>
							   <div class="text-right py-3">
						                	<button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded" id="edit-affaire-btn" >Modifier</button>&nbsp;&nbsp;
						                	
						                </div>
							  
							  </div>

						</div>
                   
                  </div>
                </div>

                </div><!-- modal-content -->
              </div><!-- modal-dialog -->
            </div><!-- modal -->
            <!--modal-->
            <!--Deal details Modal -->
            <div class="modal right fade" id="mission-details" tabindex="-1" role="dialog" aria-modal="true">
              <div class="modal-dialog" role="document">
                <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
                    
                   
                  </div>

                 
                  <div class="modal-body project-pipeline">
                  	
                    <div class="task-infos pt-3">
						<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
							<li class="nav-item"><a class="nav-link active" href="#affaire-details-tab" data-toggle="tab">Detail Mission</a></li>
							
							
						</ul>
						<div class="tab-content">
							<div class="tab-pane show active" id="affaire-details-tab">
								
							<div class="tasks__item crms-task-item active">
							    	 
								  	<div class="accordion-body js-accordion-body" style="display: block;">
									    <div class="accordion-body__contents">
										    <table class="table">
				                                <tbody>
				                                    <tr>
				                                      <td class="border-0"><p  class="detail-mission-item-title">Numéro:</p></td>
				                                      <td class="border-0"><p  class="detail-mission-item-content"><label id="mission-num"></label></td>
				                                    </tr>
				                                     <tr>
				                                      <td class="border-0"><p  class="detail-mission-item-title">Libellé:</p></td>
				                                      <td class="border-0"><p  class="detail-mission-item-content"><label id="mission-label"></label></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-mission-item-title">Responsable:</p></td>
				                                      <td><p  class="detail-mission-item-content"><label id="mission-createur"></label></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-mission-item-title">Affaire:</p></td>
				                                      <td><p  class="detail-mission-item-content"><label id="mission-affaire"></label></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-mission-item-title">Date De Création:</p></td>
				                                      <td><p  class="detail-mission-item-content"><label id="mission-date-creation"></label></p></td>
				                                    </tr>
				                                     <tr>
				                                      <td><p  class="detail-mission-item-title">Date De Fin prévue:</p></td>
				                                      <td><p  class="detail-mission-item-content"><label id="mission-date-finPrevue"></label></p></td>
				                                    </tr>
				                                     <tr>
				                                      <td><p  class="detail-mission-item-title">Avancement:</p></td>
				                                      <td><div class="progress progress-lg">
										<div class="progress-bar progress-bar-striped bg-gradient-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="avancement-mission-bar">0%</div>
									</div></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-mission-item-title">Etat:</p></td>
				                                      <td><p  class="detail-mission-item-content"><label id="mission-etat"></label></p></td>
				                                    </tr>
				                                     <tr>
				                                      <td><p  class="detail-mission-item-title">Date de Validation:</p></td>
				                                      <td><p  class="detail-mission-item-content"><label id="mission-validation-date"></label></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-mission-item-title">Observation:</p></td>
				                                      <td><p  class="detail-mission-item-content"><label id="mission-observation"></label></p></td>
				                                    </tr>
				                                    
				                                    
				                                </tbody>
				                            </table>
				                            <div class="detail-mission-item col-12">
								<div class="col-12">
									<p  class="detail-mission-item-title">Attachements:</p>
									<table id="t-attach-detail" style="width:100%">
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

                </div><!-- modal-content -->
              </div><!-- modal-dialog -->
            </div><!-- modal -->
            <!-- cchange pipeline stage Modal -->
            <div class="modal" id="pipeline-stage">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Change Pipeline Stage</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                     <form>
                      <div class="form-group">
                  <label class="col-form-label">New Stage</label>
                    <select class="form-control" id="related-to">
                        <option>Plan</option>
                        <option>Design</option>
                        <option>Develop</option>
                        <option>Complete</option>
                     </select>
                  </div>
                     </form>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer text-center">
                    <button type="button" class="border-0 btn btn-primary btn-gradient-primary btn-rounded" data-dismiss="modal">Save</button>&nbsp;&nbsp;
					<button type="button" class="btn btn-secondary btn-rounded cancel-button" data-dismiss="modal">Cancel</button>
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

		<!-- Loading js -->
		<script src="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.js"></script>

		<!-- theme JS -->
		<script src="<?php echo base_url()?>assets/template/js/theme-settings.js"></script>

		<!-- Custom template JS -->
		<script src="<?php echo base_url()?>assets/template/js/app.js"></script>

		<!-- Custom JS-->
		
		<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/contrat-sections/communScript.js"></script>
		<script type="text/javascript">
			const base_url = '<?php echo base_url()?>';
			var table;
			$(document).ready(function(){
				table = $('#entreprise-liste-table').DataTable({
					processing: false,
	stateSave: false,
	/*"scrollY":        "70vh",
	"scrollCollapse": true,*/
	ajax: {
		url: base_url+'admin/entreprisesList',
		type: "post",
		datatype: "json",

		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//$('#affaires-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','','','','','']).draw();
			console.log(XMLHttpRequest.responseText);
		},
	},
   //data: reorderData,
   /*columns: Object.keys(reorderData[0]).map(function(item) {
   	
     return { data: item, title: item }
   }),*/
   columnDefs : [
    {targets: [0,1],"visible": false},
   {
    render: function (data, type, row) {
				if(type=="display")
				{
				
				if (data == "f" || data=="false") {
					return '<h6><span class="badge badge-danger">Désactivé</span></h6>';
				} 
				
				else
				{
					return '<h6><span class="badge badge-info">activé</span></h6>';
				}
			}
			else return data;
			},
			targets: 6,
		},
        {
    render: function (data, type, row) {
        return '<div style="display:flex;justify-content:flex-end;"><button type="button" class="btn btn-success btn-sm activate-entreprise" style="font-size: 12px;">activer</button><button type="button" class="btn btn-warning btn-sm deactivate-entreprise" style="font-size: 12px;">désactiver</button></div>';
			},
			targets: 7,
		}
    ]
	}) 
				
			})
			$('#entreprise-liste-table').on('click','.dropdown-item',function(e){
				e.preventDefault();

			})
			$('#entreprise-liste-table').on('click','.activate-entreprise',function(){
				$('body').loadingModal({
          position:'auto',
          text:'',
          color:'#fff',
          opacity:'0.6',
          backgroundColor:'rgb(171, 15, 255)',
          animation:'doubleBounce'
        });
				const parent = $(this).closest('tr');
				var data = table.row(parent).data();
				var frmData = new FormData();
				
				frmData.append('num-entreprise',data[0]);
                frmData.append('state','true');
				$.ajax({

url : base_url+'admin/setEntrepriseState',
type: 'post',
data : frmData,
cache:false,
processData:false,
contentType:false,
success: function(result){
	$('body').loadingModal('destroy');
	showInfoBox('success','entreprise activée');
	table.ajax.reload( null, false );//prevent page reset
},
error: function(err){
	showInfoBox('error',err.responseText);
	

}
})
			})
            $('#entreprise-liste-table').on('click','.deactivate-entreprise',function(){
				$('body').loadingModal({
          position:'auto',
          text:'',
          color:'#fff',
          opacity:'0.6',
          backgroundColor:'rgb(171, 15, 255)',
          animation:'doubleBounce'
        });
				const parent = $(this).closest('tr');
				var data = table.row(parent).data();
				var frmData = new FormData();
				
				frmData.append('num-entreprise',data[0]);
                frmData.append('state','false');
				$.ajax({

url : base_url+'admin/setEntrepriseState',
type: 'post',
data : frmData,
cache:false,
processData:false,
contentType:false,
success: function(result){
	$('body').loadingModal('destroy');
	showInfoBox('success','entreprise desactivée');
	table.ajax.reload( null, false );//prevent page reset
},
error: function(err){
	showInfoBox('error',err.responseText);
	

}
})
			})
		</script>
		
    </body>
</html>
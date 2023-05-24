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
        <link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/contrat-sections/contrat_mainView.css">

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

				echo $contratListSection;
				echo $listeFactures;
				echo $nouvelleFacture;
				?>
			
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
           <div class="modal" tabindex="-1" role="dialog" id="modal-change-contrat-etat" style="z-index: 1000000;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Change l'état du Contrat  <span id="num-contrat-etat"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-row">

				<div class="col-12 col-sm-6">
					<label for="domaine-contrat">Selectionner l'Etat</label>

					<select class="custom-select" id="contrat-etat-selector" name="contrat-etat-selector" style="font-size: 12px;">
						
						<?php
						foreach ($etatContrat as $value) {
							echo '<option value="'.$value['code'].'">'.$value['designation'].'</option>';
						}

						?>

					</select>
				</div>
			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn-update-contrat-etat">Confirmer</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
			</div>
		</div>
	</div>
</div> 
<!--modal-->
		<div class="modal right fade" id="contrat-recap" tabindex="-1" role="dialog" aria-modal="true">
             <div class="modal-dialog" role="document">
                <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="modal-content">

                   <div class="modal-header">
                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
                    
                   
                  </div>

                 
                  <div class="modal-body project-pipeline">
                  	<div class="row statistic-cards">
            <div class="col-12">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-folder-open fa-2x"></i>
                  </div>
                  <p class="card-category">Nombre Contrats</p>
                  <h3 class="card-title"><span id="contratnbr-list-contrat">......</span></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    
                    Selon Filtre Actuel
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-usd fa-2x"></i>
                  </div>
                  <p class="card-category">Montant</p>
                  <h3 class="card-title"><span id="contratTotal-list-contrat">......</span></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                   
                    Selon Filtre Actuel
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-money fa-2x"></i>
                  </div>
                  <p class="card-category">Payé</p>
                  <h3 class="card-title"><span id="contratPaye-list-contrat">......</span></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    Selon Filtre Actuel
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-refresh fa-2x"></i>
                  </div>
                  <p class="card-category">Non Payé</p>
                  <h3 class="card-title"><span id="contratApayer-list-contrat">......</span></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                     Selon Filtre Actuel
                  </div>
                </div>
              </div>
            </div>
          </div>
                </div>

							

                </div><!-- modal-content -->
              </div><!-- modal-dialog -->
            </div>
		<!--modal-->
		<div class="modal" tabindex="-1" role="dialog" id="modal-change-facture-etat" style="z-index: 100000;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Change l'état de la Facture  <span id="num-facture-etat" style="display: none"></span><span id="numannee-facture-etat" ></span><span id="num-contratfacture-etat" style="display: none"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-row">

					<div class="col-12 col-sm-6">
						<label>Selectionner l'Etat</label>

						<select class="custom-select" id="facture-etat-selector" name="facture-etat-selector" style="font-size: 12px;">

							<?php
							foreach ($etatFacture as $value) {
								echo '<option value="'.$value['code'].'">'.$value['designation'].'</option>';
							}

							?>

						</select>
					</div>
				</div>
				<div class="form-row" style="display: none;">
					<div class="col-12">
						<label>Motif</label>
					</div>
					<div class="col-12">
						<input type="text" name="motif-refus-facture" id="motif-refus-facture" style="width: 100%;">
					</div>
				</div>
				<div class="form-row" style="display: none;">
					<div class="col-12">
						<label>Date de Règlement</label>
					</div>
					<div class="col-12">

						<input type="date" name="date-regle-facture" id="date-regle-facture"  value="<?php echo date("Y-m-d"); ?>">
					</div>
					<div class="col-12">
						<label>Mode de Paiement</label>
					</div>
					<div class="col-12">
						<select class="custom-select" id="facture-mode-paiement" name="facture-mode-paiement" style="font-size: 12px;">

							<?php
							foreach ($modePayement as $value) {
								echo '<option value="'.$value['code'].'">'.$value['designation'].'</option>';
							}

							?>

						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn-update-facture-etat">Confirmer</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
			</div>
		</div>
	</div>
</div>
		<!--modal-->
		<div class="modal right fade" id="detail-facture-modal" tabindex="-1" role="dialog" aria-modal="true">
             <div class="modal-dialog" role="document">
                <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="modal-content">

                   <div class="modal-header">
                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
                    
                   
                  </div>

                 
                  <div class="modal-body project-pipeline">
                  	
                    <div class="task-infos pt-3">
						<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
							<li class="nav-item"><a class="nav-link active" href="#info-facture" data-toggle="tab">Information Facture</a></li>
							<li class="nav-item"><a class="nav-link" href="#prix-facture" data-toggle="tab">Liste des prix</a></li>
							
							</ul>
						<div class="tab-content">
							<div class="tab-pane show active" id="info-facture">
								<div class="accordion-body js-accordion-body" style="display: block;">
									    <div class="accordion-body__contents">
									    	<h4 class="form-section-header">Infos Facture</h4>
										  <div class="row">
										  	<div class="col-12">
									
									<ul style="list-style: none;padding-left: 10px;">
										<li style="display: none;">
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fa fa-list-ol detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Numéro</p>
													<p  class="detail-facture-item-content" id="item-facture-numero"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fa fa-list-ol detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Numéro</p>
													<p  class="detail-facture-item-content" id="item-facture-numeroannee"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fa fa-calendar detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Date Effet</p>
													<p  class="detail-facture-item-content" id="item-facture-date"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fa fa-dollar detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Montant TTC</p>
													<p  class="detail-facture-item-content" id="item-facture-montantTTC"></p>
												</div>
											</div>
											
										</li>
										
										<li>

											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fa fa-cog detail-facture-icons fa-lg"></i>

												</div>
												<div class="col-8">
													<p  class="detail-facture-item-title">Etat</p>
													<p  class="detail-facture-item-content" id="item-facture-etat"></p>
												</div>
												<div class="col-2">
													<i class="fa fa-edit detail-facture-icons fa-lg" style="color:#c52828" id="edit-facture-etat"></i>

												</div>
											</div>

										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fa fa-calendar detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Date Payement</p>
													<p  class="detail-facture-item-content" id="item-facture-datepayement"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fa fa-file detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Scan Facture</p>
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="scan-accuse-facture" name="scan-accuse-facture" accept="application/pdf" >
														<label class="custom-file-label" for="scan-fiche-conge">Selectionner le Fichier</label>
													</div>
													
												</div>
											</div>
											
										</li>
									</ul>
								</div>
										  </div>
										  <h4 class="form-section-header">Info Contrat (à la Date Effet)</h4>
										  <div class="row">
										  	<div class="col-12">
										  		<ul style="list-style: none;padding-left: 10px;">
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fa fa-list-ol detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Numéro</p>
													<p  class="detail-facture-item-content" id="item-facture-numeroContrat"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fa fa-dollar detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Montant Contrat TTC</p>
													<p  class="detail-facture-item-content" id="item-facture-montantContratTTC"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fa fa-calculator detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Montant Cumulé TTC</p>
													<p  class="detail-facture-item-content" id="item-facture-cumuleTTC"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fa fa-percent detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Avancement</p>
													<p  class="detail-facture-item-content" id="item-facture-avancement"></p>
												</div>
											</div>
											
										</li>
										
									</ul>
									
								</div>
										  </div>
									    </div>
								    </div>
							    </div>
							    <div class="tab-pane" id="prix-facture">
								
							<div class="tasks__item crms-task-item active">
							    	 <div class="col-12 d-flex justify-content-end">
								<ul class="list-inline-item pl-0">
									
					                <li class="nav-item dropdown list-inline-item add-lists">
					                    
					                        <div class="nav-profile-text">
					                        	<div class="btns-group" data-table="prix-facture-detailTable">

					                        	</div>
					                          
					                        </div>
					                    </li>
					                
					            </ul>
							</div>
								  	<div class="table-responsive">
								  		<table id="prix-facture-detailTable" class="table table-striped table-nowrap custom-table mb-0 datatable" style="width: 100%;">
							<thead>
								<tr>
									<th></th>
									<th>Numero</th>
									<th>Designation</th>
									<th>Unite</th>
									<th>Prix unitaire EN DH</th>
									<th>Quantite</th>
									<th>TOTAL DH HT</th>
									
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
								  	</div>
							  </div>
							   
							    </div>
							    
							    

						</div>
                   
                  </div>
                </div>

							

                </div><!-- modal-content -->
              </div><!-- modal-dialog -->
            </div>
		<!--modal-->
		<!--modal-->
		<div class="modal right fade" id="contrat-details" tabindex="-1" role="dialog" aria-modal="true">
             <div class="modal-dialog" role="document">
                <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="modal-content">

                   <div class="modal-header">
                    <button type="button" class="close xs-close" data-dismiss="modal">×</button>
                    
                   
                  </div>

                 
                  <div class="modal-body project-pipeline">
                  	
                    <div class="task-infos pt-3">
						<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
							<li class="nav-item"><a class="nav-link active" href="#contrat-details-tab" data-toggle="tab">Detail</a></li>
							<li class="nav-item"><a class="nav-link" href="#contrat-reglement-tab" data-toggle="tab">Règlement</a></li>
							<li class="nav-item"><a id="localisation-navTab" class="nav-link" href="#contrat-localisation-tab" data-toggle="tab">Localisation</a></li>
							
						</ul>
						<div class="tab-content">
							<div class="tab-pane show active" id="contrat-details-tab">
								<div class="row">
									<div class="col-md-4">
		                              <div class="card bg-gradient-success card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Montant</h4>
		                                  <span class="detail-contrat-montant"></span>
		                                </div>
		                              </div>
		                            </div>
		                            
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-info card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Client</h4>
		                                  <span class="detail-contrat-client"></span>
		                                </div>
		                              </div>
		                            </div>
		                            <div class="col-md-4">
		                              <div class="card bg-gradient-danger card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Réalisation</h4>
		                                  <span class="detail-contrat-realisation"></span>
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
				                                      <td ><p  class="detail-contrat-item-title">Numéro</p></td>
				                                      <td ><p  class="detail-contrat-item-content" id="item-contrat-numero"></p></td>
				                                    </tr>
				                                     <tr>
				                                      <td ><p  class="detail-contrat-item-title">Libellé</p></td>
				                                      <td ><p  class="detail-contrat-item-content" id="item-contrat-libelle"></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-contrat-item-title">Date de Signature </p></td>
				                                      <td><p  class="detail-contrat-item-content" id="item-contrat-date"></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-contrat-item-title">Délai</p></td>
				                                      <td><p  class="detail-contrat-item-content" id="item-contrat-delai"></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-contrat-item-title">Client</p></td>
				                                      <td><p  class="detail-contrat-item-content" id="item-contrat-client"></p></td>
				                                    </tr>
				                                     <tr>
				                                      <td><p  class="detail-contrat-item-title">Domaine</p></td>
				                                      <td><p  class="detail-contrat-item-content" id="item-contrat-domaine"></p></td>
				                                    </tr>
				                                     <tr>
				                                      <td><p  class="detail-contrat-item-title">Ville</p></td>
				                                      <td><p  class="detail-contrat-item-content" id="item-contrat-ville"></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-contrat-item-title">Etat</p></td>
				                                      <td><div  style="display:flex;justify-content: space-between;"><p  class="detail-contrat-item-content" id="item-contrat-etat"></p><i class="fa fa-edit detail-contrat-icons fa-lg" style="color:#c52828" id="edit-contrat-etat"></i></div></td>
														
								
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-contrat-item-title">Ville</p></td>
				                                      <td><p  class="detail-contrat-item-content" id="item-contrat-ville"></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-contrat-item-title">Observation</p></td>
				                                      <td><p  class="detail-contrat-item-content" id="item-contrat-observation"></p></td>
				                                    </tr>
				                                </tbody>
				                            </table>
									    </div>
								    </div>
							  </div>
							   
							    </div>
							    <div class="tab-pane" id="contrat-reglement-tab">
								
							<div class="tasks__item crms-task-item active">
							    	 
								  	<div class="accordion-body js-accordion-body" style="display: block;">
									    <div class="accordion-body__contents">
									    	<h4 class="form-section-header">Information Comptables</h4>
										   <table class="table">
				                                <tbody>
				                                    <tr>
				                                      <td ><p  class="detail-contrat-item-title">Montant Contrat DH TTC</p></td>
				                                      <td ><p  class="detail-contrat-item-content" id="item-contrat-montantTTC"></p></td>
				                                    </tr>
				                                     <tr>
				                                      <td ><p  class="detail-contrat-item-title">Montant des Réalisations DH TTC</p></td>
				                                      <td ><p  class="detail-contrat-item-content" id="item-contrat-cumuleTTC"></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-contrat-item-title">Avancement</p></td>
				                                      <td><p  class="detail-contrat-item-content" id="item-contrat-avancement"></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-contrat-item-title">Montant Payé DH TTC</p></td>
				                                      <td><p  class="detail-contrat-item-content" id="item-contrat-paye"></p></td>
				                                    </tr>
				                                    <tr>
				                                      <td><p  class="detail-contrat-item-title">Non encore Payé DH TTC</p></td>
				                                      <td><p  class="detail-contrat-item-content" id="item-contrat-nonPaye"></p></td>
				                                    </tr>
				                                     
				                                </tbody>
				                            </table>
				                            <h4 class="form-section-header">Téléchargement</h4>
				                             <table class="table">
				                                <tbody>
				                                    <tr>
				                                      <td ><a  id="bpLink"><button class="btn btn-outline-danger btn-sm download-BP">Bordereau des prix</button></a></td>
				                                     
				                                    </tr>
				                                    <tr>
				                                    	 <td ><a  id="AvancementLink"><button class="btn btn-outline-danger btn-sm download-avancement">Avancement Détaillé</button></a></td>
				                                    </tr>
				                                    
				                                </tbody>
				                            </table>
									    </div>
								    </div>
							  </div>
							   
							    </div>
							    <div class="tab-pane" id="contrat-localisation-tab">
							    	<div class="row">

			<div class="col-12" style="height: 75vh;" id="contrat-detail-map">

			</div>
		</div>
							    </div>
							    

						</div>
                   
                  </div>
                </div>

							

                </div><!-- modal-content -->
              </div><!-- modal-dialog -->
            </div>
		<!--modal-->
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
    <script src="<?php echo base_url()?>assets/custom/js/contrat-sections/contrat_mainScript.js"></script>
		
    </body>
</html>
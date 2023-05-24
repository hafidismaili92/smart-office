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
   
        <link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/contrat-sections/devis.css">

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
				                </span> Gestion Devis<span class="numero-contrat-header text-info"></span></h3>
	                		</div>
	                		
	                	</div>
	                	
	                <div class="card mt-4">
									
									<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-top">
<li class="nav-item"><a class="nav-link active" href="#nouveau-devis" data-toggle="tab">Nouveau Devis</a></li>
<li class="nav-item"><a class="nav-link" href="#liste-devis" data-toggle="tab">Liste des Devis</a></li>
<li class="nav-item"><a class="nav-link" href="#edit-devis" data-toggle="tab">Editer Devis</a></li>
</ul>	
	                <div class="tab-content">
	                	<div class="tab-pane active" id="nouveau-devis">
	                		
			<form id="nouveau-devis-form" action="<?php echo base_url(); ?>Devis/addDevis" method="post">
				<h4 class="form-section-header" style="background: #fcf7ff;">Données Devis</h4>
				<div class="form-row" >
						<div class="form-group col-sm-8 col-lg-5">
							<label for="objet-devis">Objet</label>
							<input type="text" class="form-control" id="objet-devis" name="objet-devis" aria-describedby="objet-devis-aide" placeholder="objet-devis" required>

						</div>
						<div class="form-group col-12 col-sm-4 col-lg-3">
							<label for="client-devis">Client</label>
							<input type="text" class="form-control" id="client-devis" name="client-devis" aria-describedby="client-devis-aide" placeholder="client-devis" required>
							
						</div>
						<div class="form-group col-8  col-lg-2">
							<label for="devis-tva">TVA en %</label>
							<input class="form-control" id="devis-tva" name="devis-tva" required value="20" type="number" max="100" min="0">
							<small id="devis-aide" class="form-text text-muted">20% par défaut</small>
						</div>
						<div class="form-group  col-4 col-lg-2 d-flex justify-content-center align-items-center">
							<button type="submit" class="btn  btn-primary"><i class="fa fa-plus"></i> &ensp; Créer Devis</button>
						</div>
					</div>
			<h4 class="form-section-header" style="background: #fcf7ff;">Ajouter Prix</h4>
			<div class="form-row" id="devis-prix-data-container">
				<div class="form-group col-sm-6 col-md-2">
					<label for="numero-prix">Numéro</label>
					<input type="text" class="form-control form-control-sm prix-field" id="numero-prix-devis"  placeholder="Numéro">
				</div>
				<div class="form-group col-sm-6 col-md-3">
					<label for="libelle-prix">Libellé</label>
					<input class="form-control form-control-sm prix-field" id="libelle-prix-devis">
				</div>
				
				<div class="col-sm-6 col-md-2">
					<label for="unite-prixe">Unité</label>

					<select class="custom-select prix-field" id="unite-prix-devis" style="font-size: 12px;">
						<?php
						foreach ($unites as $value) {
							echo '<option value="'.$value['code'].'">'.$value['libelle'].' ('.$value['code'].')</option>';
						}

						?>
					</select>
				</div>
				<div class="form-group col-sm-6 col-md-2">
					<label for="prix-prix">Prix.U</label>
					<input class="form-control form-control-sm prix-field" type ="number" id="prix-prix-devis">
					<small>En DH HT</small>
				</div>
				<div class="form-group col-sm-6 col-md-1">
					<label for="quantite-prix">Quantite</label>
					<input class="form-control form-control-sm prix-field" type ="number" id="quantite-prix-devis">
				</div>
				<div class="form-group col-4 col-md-2" style="display: flex;justify-content:space-around;align-items: center;">
					
					<button class="btn btn-outline-info btn-rounded" type="button" id="btn-add-prix-devis"><i class="fa  fa-plus"></i></button>
					<span class="btn btn-outline-info btn-rounded" type="button" id="import-prix-devis" style="position: relative;"><i class="fa  fa-file-excel-o">
					</i><input type="file" id="prix-devis-xls-file" accept=" application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="position: absolute;max-height: 100%;min-height: 100%;top: 0;right: 0;opacity: 0;width:100%;"></span>
					<button class="btn btn-outline-danger btn-rounded" type="button" id="btn-removeAllprix-devis"><i class="fa  fa-trash"></i></button>
				</div>
				
			</div>
			<div class="form-section-header" style="background: #fcf7ff;display: flex;justify-content: space-between;">
				<h4 style="background: #fcf7ff;">Bordereau des prix</h4>
				<div class="titlePrixFont ">TOTAL HT :<span style="color: #bd0a1ba1;" id="total-ht-devis">0,00</span><span style="color: #bd0a1ba1;">&ensp;DH HT</span></div>
				<div class="titlePrixFont ">TOTAL TTC :<span style="color: #007bffb8;" id="total-ttc-devis">0,00</span><span style="color: #007bffb8;">&ensp;DH TTC</span></div>
			</div>
			
		
			<div class="table-responsive">
				<table id="nouveau-devis-table" class="table  table nowrap mb-0 datatable">
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
		</form>
				</div>
						<div class="tab-pane" id="liste-devis">
							
										<div style="margin-top: 35px;display: flex;">
						<div style="display: flex;flex-direction: row;justify-content: left;flex-grow: 1;">
							<span style="line-height: 34px;">Afficher</span>
							<select class="form-control" style="max-width: 80px;height: 30px;" id="devis-aff-length">
								<option>15</option>
								<option>50</option>
								<option>100</option>
							</select>
							<span  style="margin-left: 10px;line-height: 34px;">Page</span>
						</div>
						<div id="searchDevis-group" style="display: flex;flex-direction: row;justify-content: flex-end;padding-right: 25px;">
							<div style="display: flex;flex-direction: row;">
								<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
								<input id="devis-search" type="text" class="form-control" style="flex-grow: 1;height: 30px;max-width: 200px !important;border-radius: 20px;">
							</div>	

						</div>
						<div id="btns-devis-exports">
						
					</div>

					</div>
										<div class="table-responsive">
											<table id="liste-devis-table" class="table nowrap table-striped  mb-0 datatable">
				<thead>
					<tr>
						<th>Serial</th>
						<th>Numero</th>
						<th>Objet</th>
						<th>Montant TTC</th>
						<th>Client</th>
						<th>Date edition</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
										</div>
									
						</div>
						<div class="tab-pane" id="edit-devis">
							  		
			<form id="edit-devis-form" action="<?php echo base_url(); ?>Devis/editDevis" method="post">
				<h4 class="form-section-header" style="background: #fcf7ff;">Données Devis</h4>
				<div class="form-row" >
				<div class="form-group col-12 col-sm-4 col-lg-2" style="display:none;">
							<label for="client-devis">Serial</label>
							<input type="text" class="form-control" id="edit-serial-devis" name="serial-devis" aria-describedby="client-devis-aide" placeholder="" required readonly="readonly">
							
						</div>
				<div class="form-group col-12 col-sm-4 col-lg-2">
							<label for="client-devis">Numero</label>
							<input type="text" class="form-control" id="edit-numero-devis" name="numero-devis" aria-describedby="client-devis-aide" placeholder="" required readonly="readonly">
							
						</div>
						<div class="form-group col-sm-4 col-lg-5">
							<label for="objet-devis">Objet</label>
							<input type="text" class="form-control" id="edit-objet-devis" name="objet-devis" aria-describedby="objet-devis-aide" placeholder="objet-devis" required>

						</div>
						<div class="form-group col-12 col-sm-4 col-lg-3">
							<label for="client-devis">Client</label>
							<input type="text" class="form-control" id="edit-client-devis" name="client-devis" aria-describedby="client-devis-aide" placeholder="client-devis" required>
							
						</div>
						<div class="form-group col-8 col-sm-4  col-lg-2">
							<label for="devis-tva">TVA en %</label>
							<input class="form-control" id="edit-devis-tva" name="devis-tva" required value="20" type="number" max="100" min="0">
							
						</div>
						
					</div>
					<div class="form-row" >
					<div class="form-group col-6 col-sm-3">
							<label for="client-devis">Montant DH HT</label>
							<input type="text" class="form-control" id="edit-montanttHT-devis"  aria-describedby="client-devis-aide" placeholder="" required readonly="readonly">
							
						</div>
						<div class="form-group col-6 col-sm-3">
							<label for="client-devis">Montant DH TTC</label>
							<input type="text" class="form-control" id="edit-montantTTC-devis" aria-describedby="client-devis-aide" placeholder="" required readonly="readonly">
							
						</div>
					<div class="form-group  col-12 col-sm-6 d-flex justify-content-end align-items-end">
							<button type="submit" class="btn  btn-success"><i class="fa fa-edit"></i> &ensp; Appliquer les modifications</button>
						</div>
					</div>
			<h4 class="form-section-header" style="background: #fcf7ff;">Ajouter Prix</h4>
			<div class="form-row" id="edit-devis-prix-data-container">
				<div class="form-group col-sm-6 col-md-2">
					<label for="numero-prix">Numéro</label>
					<input type="text" class="form-control form-control-sm prix-field" id="edit-numero-prix-devis"  placeholder="Numéro">
				</div>
				<div class="form-group col-sm-6 col-md-3">
					<label for="libelle-prix">Libellé</label>
					<input class="form-control form-control-sm prix-field" id="edit-libelle-prix-devis">
				</div>
				
				<div class="col-sm-6 col-md-2">
					<label for="unite-prixe">Unité</label>

					<select class="custom-select prix-field" id="edit-unite-prix-devis" style="font-size: 12px;">
						<?php
						foreach ($unites as $value) {
							echo '<option value="'.$value['code'].'">'.$value['libelle'].' ('.$value['code'].')</option>';
						}

						?>
					</select>
				</div>
				<div class="form-group col-sm-6 col-md-2">
					<label for="prix-prix">Prix.U</label>
					<input class="form-control form-control-sm prix-field" type ="number" id="edit-prix-prix-devis">
					<small>En DH HT</small>
				</div>
				<div class="form-group col-sm-6 col-md-2">
					<label for="quantite-prix">Quantite</label>
					<input class="form-control form-control-sm prix-field" type ="number" id="edit-quantite-prix-devis">
				</div>
				<div class="form-group col-4 col-md-1" style="display: flex;justify-content:space-around;align-items: center;">
					
					<button class="btn btn-outline-info btn-rounded" type="button" id="edit-btn-add-prix-devis"><i class="fa  fa-plus"></i></button>
					
				</div>
				
			</div>
			<div class="form-section-header" style="background: #fcf7ff;display: flex;justify-content: space-between;">
				<h4 style="background: #fcf7ff;">Bordereau des prix</h4><div id="btns-prix-exports">
						
						</div>
				<!-- <div class="titlePrixFont ">TOTAL HT :<span style="color: #bd0a1ba1;" id="edit-total-ht-devis">0,00</span><span style="color: #bd0a1ba1;">&ensp;DH HT</span></div>
				<div class="titlePrixFont ">TOTAL TTC :<span style="color: #007bffb8;" id="edit-total-ttc-devis">0,00</span><span style="color: #007bffb8;">&ensp;DH TTC</span></div> -->
			</div>
			
			
			<div class="table-responsive">
				<table id="edit-devis-table" class="table  table nowrap mb-0 datatable">
				<thead>
							<tr>
								<th>serial</th>
								<th>devis</th>
								<th>Numero</th>
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
		</form>
						</div>		
	                	</div>

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
    <script src="<?php echo base_url()?>assets/custom/js/contrat-sections/devis.js"></script>
		
    </body>
</html>
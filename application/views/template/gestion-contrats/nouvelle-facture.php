	<!-- Page Wrapper -->
	<div id="nouvelleFacture-section" class="page-wrapper principal-sections hidden_section">
		<div class="content container-fluid">
				<div class="crms-title row bg-white">
	                		<div class="col  p-0">
	                			<h3 class="page-title m-0">
				                <span class="page-title-icon bg-gradient-primary text-white mr-2">
				                  <i class="feather-grid"></i>
				                </span> Nouvelle Facture <span class="numero-contrat-header text-info"></span></h3>
	                		</div>
	                		<div class="col p-0 d-flex justify-content-end">
	                			<ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
	                				<div class="rounded-sm-control">
	                					<form id="search-nouvellefacture-form" action="#" method="post">
									<input class="form-control-sm" type="text" placeholder="N° contrat" id="num-contrat-nouvelleFacture" name="contrat-search-details" required="">
									<button class="btn btn-sm" type="submit" id="btn-search-Nouvellefacture"><i class="fa fa-search"></i></button>
								</form>
	                				</div>
									
								</ul>
	                		</div>
	                	</div>
	                
								<div class="card" style="margin-top: 15px;">
									
									<div class="card-body">
										<form id="nouvelleFacture-form" action="<?php echo base_url(); ?>NouvelleFacture/addFacture" method="post">
											<h4 class="form-section-header" style="background: #fcf7ff;">Récapitulatif</h4>
											<div class="row">
												<div class="form-group col-4 col-md-3" style="display: flex;flex-direction: column;justify-content: space-between;">
												<label>N° Contrat : </label>
					<input type="text"  class="form-control form-control-sm" name="contrat-nouvelle-facture" readonly id="contrat-nouvelle-facture" required>
											</div>
											<div class="form-group col-4 col-md-3" style="display: flex;flex-direction: column;justify-content: space-between;">
												<label>Date Effet:</label>
												<input type="date"  class="form-control form-control-sm" name="date-nouvelle-facture" id="date-nouvelle-facture" required>
											</div>
											<div class="form-group col-4 col-md-3" style="display: flex;flex-direction: column;justify-content: space-between;">
												<label>TOTAL DH HT</label>
												<input type="text" class="form-control form-control-sm" name="contrat-totalHT-facture" readonly id="contrat-totalHT-facture">
											</div>
											<div class="form-group col-4 col-md-3" style="display: flex;flex-direction: column;justify-content: space-between;">
												<label>TOTAL DH TTC:(TVA <span id="tva-facture">...</span> %) </label>
												<input type="text" class="form-control form-control-sm" name="contrat-totalTTC-facture" readonly id="contrat-totalTTC-facture">
												
											</div>
											</div>
											<h4 class="form-section-header" style="background: #fcf7ff;">Détail des Quantités</h4>
											 <div class="table-container">
	          	
						<!-- Content Starts -->
						<div class="row">
							<div class="col-md-12">
								
										<div class="table-responsive">
											
											<table id="nouvelleFacture-table" class="table table-striped  mb-0 datatable" >
				<thead>
					<tr>
						<th>Numero</th>
						<th>Libelle</th>
						<th>Unite</th>
						<th>Prix unitaire</th>
						<th>Quantite contrat</th>
						<th>Quantite anterieure</th>
						<th>Quantite facture</th>
						<th>Montant facture</th>
						<th></th>
						
					</tr>
				</thead>
				<tbody>
					
				</tbody>
				
			</table>
			
										</div>
									</div>
								
						</div>
						</div>
						<div class="row" style="width: 100%;margin-top:10px;padding: 0;">
				<div class="ml-auto" style="margin:0;padding: 0;">
					<button type="submit" class="btn btn-success btn-sm btn-block" id="Btn-ajouter-facture">Generer la facture</button>
				</div>
			</div>
											
										</form>
										
									</div>
								</div>
								
	         
						

	          </div>
	          
			
		</div>

	<!-- Page Wrapper -->	

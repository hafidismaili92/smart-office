<!-- Page Wrapper -->
<div id="listeContrats-section" class="page-wrapper principal-sections">
	<div class="content container-fluid">
		<div class="crms-title row bg-white">
                		<div class="col  p-0">
                			<h3 class="page-title m-0">
			                <span class="page-title-icon bg-gradient-primary text-white mr-2">
			                  <i class="feather-grid"></i>
			                </span> Liste Contrats</h3>
                		</div>
                		<!-- <div class="col p-0 d-flex justify-content-end align-items-center">
                			
								<span class="filter-icon text-primary"><i class="fa fa-filter"></i></span>
					
					<select class="form-control text-primary" style="border: none;background-color: transparent;max-width: 200px;" id="ct-aff-period">
						<option value="1">Année en cours</option>
						<option value="5" selected>5 dernières années</option>
						<option value="10">10 dernières années </option>
						<option value="0">Tout</option>
					</select>
							
                		</div> -->
                	</div>
		
          <div class="table-container">
          	<div class="page-header pt-3 mb-0 ">
						<div class="row">
							
							
								<div class="col-6 col-md-4" style="display: flex;flex-direction: row;justify-content: left;">
					<span style="line-height: 34px;">Afficher</span>
					<select class="form-control" style="max-width: 80px;height: 30px;" id="ct-aff-length">
						<option>15</option>
						<option>50</option>
						<option>100</option>
					</select>
					<span style="margin-left: 10px;line-height: 34px;">Page</span>
				</div>
							<div class="col-6 col-md-3">
								<div class="top-nav-search">
							
							<div>
								<input id="ct-search" type="text" class="form-control" placeholder="Chercher">
								
							</div>
						</div>
							</div>
							<div class="col mt-2 mt-md-0 text-right">
								<ul class="list-inline-item pl-0">
					                
					                <li class="list-inline-item">
					                    
					                    <a href="<?php echo base_url();?>NewContrat">
					                    <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-mission" data-toggle="modal" data-target="#add-mission-modal">Nouveau Contrat</button>
					                </a>
					                </li>
					            </ul>
							</div>
						</div>
						<div id="table-menu">
							<div class="page-header pt-3 mb-0 ">
			
		</div>
		</div>
					</div>
					<!-- Content Starts -->
					<div class="row">
						<div class="col-12">
							<div class="card mb-0">
								<div class="card-body">
									<div class="row">
										<div class="col-6">
											<ul class="list-inline-item pl-0">
								 <li class="list-inline-item">
								<button class="add btn btn-sm custom-sm-btn btn-gradient-primary text-white todo-list-add-btn btn-rounded" id="recap-contrats" data-toggle="modal" data-target="#contrat-recap" style="background: #08bad5">Récap</button>
								<button class="add btn btn-sm btn-gradient-primary  text-white todo-list-add-btn btn-rounded custom-sm-btn" id="" data-toggle="modal" data-target="#add-mission-modal" style="background: #08bad5" ><a href="Contrats/ExportUnpayedFactures" style=" color: inherit; text-decoration: none;">Facture en attente</a></button>
							</li>
</ul>
										</div>
										
							<div class="col-6 d-flex justify-content-end">
								<ul class="list-inline-item pl-0">
									
					                <li class="nav-item dropdown list-inline-item add-lists">
					                    
					                        <div class="nav-profile-text">
					                        	<div class="btns-group" data-table="listeContrats-table">

					                        	</div>
					                          
					                        </div>
					                    </li>
					                
					            </ul>
							</div>
									</div>
									<div class="table-responsive">
										
										<table id="listeContrats-table" class="table table-striped table-nowrap custom-table mb-0 datatable" style="width: 100%;">
			<thead>
				<tr>
					<th>Numero</th>
					<th>Libelle</th>
					<th>Date de Signature</th>	
					<th>Montant TTC</th>
					<th>Réalisation TTC</th>
					<th>% Réalisé</th>
					<th>Réglé TTC</th>
					<th>% Reglement</th>
					<th>Etat</th>
					<th>Client</th>	
					<th>Action</th>
				</tr>

			</thead>
			
		</table>
									</div>
								</div>
							</div>	
						</div>
					</div>
					</div>
					<!-- /Content End -->

          </div>
          
		
	</div>

<!-- Page Wrapper -->	

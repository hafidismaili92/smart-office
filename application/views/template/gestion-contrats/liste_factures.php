<!-- Page Wrapper -->
<div id="listeFacture-section" class="page-wrapper principal-sections hidden_section">
	<div class="content container-fluid">
			<div class="crms-title row bg-white">
                		<div class="col  p-0">
                			<h3 class="page-title m-0">
			                <span class="page-title-icon bg-gradient-primary text-white mr-2">
			                  <i class="feather-grid"></i>
			                </span> Liste Factures: <span class="numero-contrat-header text-info"></span></h3>
                		</div>
                		<div class="col p-0 d-flex justify-content-end">
                			<ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                				<div class="rounded-sm-control">
                					<form id="search-factures-form" action="#" method="post">
								<input class="form-control-sm" type="text" placeholder="N° contrat" id="num-contrat-factures" name="contrat-search-details" required="">
								<button class="btn btn-sm" type="submit" id="btn-search-factures"><i class="fa fa-search"></i></button>
							</form>
                				</div>
								
							</ul>
                		</div>
                	</div>
                	<div class="row page-header pt-3 mb-0 ">
									<div class="col-md-3">
		                              <div class="card bg-gradient-success card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Contrat</h4>
		                                  <span id="contratnum-list-facture">......</span>
		                                </div>
		                              </div>
		                            </div>
		                            
		                            <div class="col-md-3">
		                              <div class="card bg-gradient-info card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Montant Contrat</h4>
		                                  <span id="contratTotal-list-facture">......</span>
		                                </div>
		                              </div>
		                            </div>
		                            <div class="col-md-3">
		                              <div class="card bg-gradient-primary card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Payé</h4>
		                                  <span id="detail-tacheEnSouffrance"><span id="contratPaye-list-facture">......</span></span>
		                                </div>
		                              </div>
		                            </div>
		                            <div class="col-md-3">
		                              <div class="card bg-gradient-danger card-img-holder text-white h-100">
		                                <div class="card-body">
		                                  <img src="images/t_img/circle.png" class="card-img-absolute" alt="circle-image">
		                                  <h4 class="font-weight-normal mb-3">Non Payé</h4>
		                                  <span id="detail-tacheEnSouffrance"><span id="contratApayer-list-facture">......</span></span>
		                                </div>
		                              </div>
		                            </div>
		                        </div>
          <div class="table-container">
          	<div class="page-header pt-3 mb-0 ">
						
						<div id="table-menu">
							<div class="page-header pt-3 mb-0 ">
			<div class="row">
				<div class="col-5 col-md-5" style="display: flex;flex-direction: row;justify-content: left;">
					<span style="line-height: 34px;">Afficher</span>
					<select class="form-control" style="max-width: 80px;height: 30px;" id="facture-aff-length">
						<option>15</option>
						<option>50</option>
						<option>100</option>
					</select>
					<span style="margin-left: 10px;line-height: 34px;">Page</span>
				</div>
				<div class="col-4 col-md-3">
								<div class="top-nav-search">
							
							<div>
								<input id="facture-search" type="text" class="form-control" placeholder="Chercher">
								
							</div>
						</div>
							</div>
							<div class="col-3 col-md-4 d-flex justify-content-end">
								<ul class="list-inline-item pl-0">
									
					                <li class="nav-item dropdown list-inline-item add-lists">
					                    
					                        <div class="nav-profile-text">
					                        	<div class="btns-group" data-table="listeFacture-table">

					                        	</div>
					                          
					                        </div>
					                    </li>
					                
					            </ul>
							</div>
			</div>
		</div>
		</div>
					</div>
					<!-- Content Starts -->
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-body">
									<div class="table-responsive">
										
										<table id="listeFacture-table" class="table table-striped table-nowrap mb-0 datatable" >
			<thead>
			<tr>
				<th></th>
				<th></th>
				<th>Num</th>
				<th>Reference</th>
				<th>Date Effet</th>
				<th>Date Payement</th>
				<th>Montant TTC</th>
				<th>Montant Cumulé TTC</th>
				<th>Avancement Contrat</th>
				<th>Etat</th>
				<th>Télechargement</th>
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

<!-- Page Wrapper -->

            <div class="page-wrapper principal-sections hidden_section" id="affaire-missions-section">
			
				<!-- Page Content -->
                <div class="content container-fluid">

                	<div class="crms-title row bg-white">
                		<div class="col  p-0">
                			<h3 class="page-title m-0">
			                <span class="page-title-icon bg-gradient-primary text-white mr-2">
			                  <i class="feather-grid"></i>
			                </span> Projets :  <span class="numero-affaire-title text-info"></span></h3>
                		</div>
                		<div class="col p-0 text-right">
                			<ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
								<!-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
								<li class="breadcrumb-item active">Affaires</li> -->
							</ul>
                		</div>
                	</div>
					
					<!-- Page Header -->
					<div class="page-header pt-3 mb-0 ">
						<div class="row">
							<div class="col">
								<div style="display: flex;flex-wrap: wrap;justify-content: space-between;">
				<div style="display: flex;flex-direction: row;justify-content: left;">
					<span style="line-height: 34px;">Afficher</span>
					<select class="form-control" style="max-width: 80px;height: 30px;" id="missions-table-length">
						<option>15</option>
						<option>50</option>
						<option>100</option>
					</select>
					<span  style="margin-left: 10px;line-height: 34px;">Page</span>
				</div>
			</div>
							</div>
							<div class="col col-md-3" >
								<div class="top-nav-search">
							
							<div>
								<input id="search-Missions" type="text" class="form-control" placeholder="Chercher">
								
							</div>
						</div>
							</div>
							<div class="col text-right">
								<ul class="list-inline-item pl-0">
					                <li class="nav-item dropdown list-inline-item add-lists">
					                    
					                        <div class="nav-profile-text">
					                        	<div id="btns-missions-group">
												
												</div>
					                          
					                        </div>
					                    </li>
					                <li class="list-inline-item">
					                    <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-mission" data-toggle="modal" data-target="#add-mission-modal">Nouvelle Mission</button>
					                </li>
					            </ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Content Starts -->
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped table-nowrap custom-table mb-0 datatable" id="missions-table">
											<thead>
								<tr>
									<th>#</th>
									<th></th>
									<th>Identifiant</th>
									<th>Libelle</th>
									<th>Responsable </th>
									<th>Matricule </th>
									<th>Avancement</th>
									<th>Date Création</th>
									<th>Numero Projet</th>
									<th>Délai</th>
									<th>Date Fin prévue</th>
									<th>Date de validation</th>
									<th>Niveau</th>
									<th>Tache Mère</th>
									<th>validite</th>
									<th>matricule_responsable</th>
									<th>Observations</th>
									<th>Action</th>
								</tr>
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
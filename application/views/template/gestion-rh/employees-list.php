<!-- Page Wrapper -->

            <div class="page-wrapper principal-sections " id="liste-employee-section">
			
				<!-- Page Content -->
                <div class="content container-fluid">

                	<div class="crms-title row bg-white">
                		<div class="col  p-0">
                			<h3 class="page-title m-0">
			                <span class="page-title-icon bg-gradient-primary text-white mr-2">
			                  <i class="feather-grid"></i>
			                </span> Liste des Employés </h3>
                		</div>
                		<div class="col p-0 text-right">
                			<ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
								<!-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
								<li class="breadcrumb-item active">Affaires</li> -->
							</ul>
                		</div>
                	</div>
					
					<!-- Page Header -->
					<div class="table-container">
						<div class="page-header pt-3 mb-0 ">
						<div class="row">
							<div class="col-6 col-md-4">
			<div style="display: flex;flex-wrap: wrap;justify-content: space-between;">
				<div style="display: flex;flex-direction: row;justify-content: left;">
					<span style="line-height: 34px;">Afficher</span>
					<select class="form-control length-table-field" style="max-width: 80px;height: 30px;" data-table="">
						<option>15</option>
						<option>50</option>
						<option>100</option>
					</select>
					<span  style="margin-left: 10px;line-height: 34px;">Page</span>
				</div>
			</div>
		</div>
							<div class="col-6 col-md-3" >
								<div class="top-nav-search">
							
							<div>
								<input type="text" class="form-control search-table-field" placeholder="Chercher">
								
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
					                    <a href="<?php echo base_url();?>AddEmploye"><button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-toggle="modal" data-target="#add-affaire-modal">Nouvel Employé</button></a>
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
										
										<table id="employees-table" class="table table-striped table-nowrap custom-table mb-0 datatable" style="width: 100%;">
			<thead>
				<tr>
					<th></th>
					<th>Matricule</th>
					<th>Nom</th>
					<th>Prénom</th>	
					<th>Fonction</th>
					<th>Entité</th>
					<th>Email</th>
					<th>Tèl</th>
					<th>cin</th>
					<th>ville_residence</th>
					<th>ville_origine</th>
					<th>date_naissance</th>
					<th>date_inscription</th>
					<th>adresse</th>
					<th>compte_bancaire</th>
					<th>situation_famille</th>
					<th>reliquat_conge</th>
					<th>conge_annee</th>
					<th>date_fin_activite</th>
					<th>agence_bancaire</th>
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
				<!-- /Page Content -->
				
            </div>
           
			<!-- /Page Wrapper -->
<!-- Page Wrapper -->

            <div class="page-wrapper principal-sections hidden_section" id="gestion-employee-section">
			
				<!-- Page Content -->
                <div class="content container-fluid">

                	<div class="crms-title row bg-white">
                		<div class="col  p-0">
                			<h3 class="page-title m-0">
			                <span class="page-title-icon bg-gradient-primary text-white mr-2">
			                  <i class="feather-grid"></i>
			                </span> Profil Employé </h3>
                		</div>
                		<div class="col p-0 d-flex justify-content-end">
                			<ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                				<div class="rounded-sm-control">
                					<form action="<?php echo base_url()?>Employes/getEmployee" method="post" id="gestion-employee-form">
								<input class="form-control-sm" type="text" placeholder="Chercher Matricule" id="matricule-gestion" name="matricule-gestion" required>
								<button  class="btn" type="submit" id="search-gestion-employee"><i class="fa fa-search" ></i></button>
							</form>
                				</div>
								
							</ul>
                		</div>
                	</div>
					
					
					
					<!-- Content Starts -->
					
	<div id="main-gestions-employee-container">
		<div class="row tab-header">
	                  	<div class="col-md-12">
	                  		<ul class="cd-breadcrumb triangle nav nav-tabs w-100 crms-steps" role="tablist" id="gestionEmployee-tabs">
							    <li role="presentation">
							        <a href="#absence-tab" class="active" aria-controls="not-contacted" role="tab" data-toggle="tab" aria-expanded="true">
							              <span class="octicon octicon-light-bulb"></span> Absences
							         </a>
							    </li>
							    <li role="presentation" class="">
							        <a href="#conges-tab" aria-controls="attempted-contact" role="tab" data-toggle="tab" aria-expanded="false">
							            <span class="octicon octicon-diff-added"></span> Congés
							        </a>
							    </li>
							    <li role="presentation" class="">
							        <a href="#deplacement-tab" aria-controls="contact" role="tab" data-toggle="tab" aria-expanded="false">
							            <span class="octicon octicon-comment-discussion"></span>Déplacement
							        </a>
							    </li>
							     <li role="presentation" class="">
							        <a href="#heures-sup-tab" aria-controls="contact" role="tab" data-toggle="tab" aria-expanded="false">
							            <span class="octicon octicon-comment-discussion"></span>Heures Supp
							        </a>
							    </li>
							    <li role="presentation" class="">
							        <a href="#info-tab" aria-controls="contact" role="tab" data-toggle="tab" aria-expanded="false">
							            <span class="octicon octicon-comment-discussion"></span>Profil
							       	</a>
							    </li>
						   
							</ul>
	                  	</div>
	                </div>
	
		<div class="tab-content">
			<div class="tab-pane active" id="absence-tab" style="height: 100%;margin-top: 5px;">
				<div class="row">
					<div class="col-xl-7 d-flex">
						<div class="card flex-fill" >
						<div class="card-header"><h4 class="card-title mb-0">Suivi Journalier</h4></div>
						<div class="card-body">
							<form action="<?php echo base_url()?>GestionAbsence/addAbsence" method="post" id="gestion-absence-form" style="font-size:0.8em;">

							<div class="form-row">
								<div class="form-group col-6  col-sm-3">
									<label for="matricule-form-absence">matricule</label>
									<div class="input-group input-group-sm">

										<input type="text" class="form-control" id="matricule-form-absence" name="matricule-form-absence"  readonly>

									</div>
								</div>
								<div class="form-group col-6 col-sm-3">
									<label for="date-absence">Date</label>
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
										</div>
										<input type="date" class="form-control" id="date-absence" required name="date-absence">
									</div>

								</div>
								<div class="form-group col-6 col-sm-3">
									<label for="time-debut-absence">H.Début</label>
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
										</div>
										<input type="time" class="form-control" id="time-debut-absence" required name="time-debut-absence" min="<?php echo $hdebut ?>" max="<?php echo $hfin ?>" >
									</div>

								</div>
								<div class="form-group col-6 col-sm-3">
									<label for="time-fin-absence">H.Fin</label>
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
										</div>
										<input type="time" class="form-control" id="time-fin-absence" required name="time-fin-absence" min="<?php echo $hdebut ?>" max="<?php echo $hfin ?>" >
									</div>

								</div>

							</div>
							<div class="form-row">
								
								<div class="form-group col-6 col-sm-5">
									<label for="absence-justif">Justification</label>
									<div class="input-group input-group-sm">

										<select class="custom-select" id="absence-justif" name="absence-justif">
											<option value="sans">Sans</option>
											<option value="Bon-sortie">Bon de sortie</option>
										</select>
									</div>

								</div>
								<div class="form-group col-12 col-sm-5">
									<label for="scan-bon-sortie">Scan Bon-Sortie</label>
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-file"></i></span>
										</div>
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="scan-bon-sortie" name="scan-bon-sortie" accept="application/pdf,image/*">
											<label class="custom-file-label" for="scan-bon-sortie">Selectionner fichier</label>
										</div>

									</div>

								</div>
								<div class="form-group col-2" style="display: flex;justify-content: flex-end;align-items: flex-end;width: 100%;">
									
									
										<button class="btn btn-primary" id="add-absence-employee"><i class="fa fa-plus "></i></button>
									</div>
							</div>

						</form>
						<div style="width: 100%;margin-bottom: 20px;">

							<canvas id="myChart" width="400" height="80"></canvas>
						</div>

						<div class="table-responsive">
							<table id="absence-journalier" class="datatable table table-stripped mb-0 datatables dataTable no-footer" style="width: 100%;">
								<thead>
									<tr>
										<th>Heure de sortie</th>
										<th>Heure d'entrée</th>
										<th>duree</th>
										<th>motif</th>
										<th>DecimalSortie</th>
										<th>DecimalEntree</th>
										<th>Action</th>
										<th>num</th>
									</tr>
								</thead>
							</table>
						</div>
						</div>
						
						
					</div>
					</div>
					<div class="col-xl-5 d-flex">
						<div class="card flex-fill" >
						<div class="card-header"><h4 class="card-title mb-0">Registre des Absences</h4></div>
						<div class="card-body">
							<div class="text-right" style="margin-bottom: 20px;">
							<select id="absence-period" class="text-primary" style="border: 1px solid #fff;background-color: transparent;">
								<option value="j">Aujourd'hui</option>
								<option value="s">Cette semaine</option>
								<option value="m">Ce mois</option>
								<option value="a">Cette année</option>
							</select>
						</div>
						
						<div class="table-responsive">
							<table id="absence-total" class="datatable table table-stripped mb-0 datatables dataTable no-footer" style="width: 100%;">
							<thead>
								<tr>
									<th>Jour</th>
									<th>Date</th>
									<th>Total Absence</th>

								</tr>
							</thead>
						</table>
						</div>
						<div style="width: 100%;margin-bottom: 20px;height: 400px;">

							<canvas id="absenceTotal-ratio" width="400" height="150"></canvas>
						</div>
						</div>
						
						
					</div>
					</div>
					
					</div>
					
			</div>
			<div class="tab-pane" id="conges-tab" style="height: 100%;margin-top: 5px;">
				<div class="row">
					<div class="col-xl-5 d-flex">
						<div class="card flex-fill" >
						<div class="card-header"><h4 class="card-title mb-0">Ajouter Congé</h4></div>
						<div class="card-body">
							
							<form action="<?php echo base_url()?>GestionConges/addConge" method="post" id="add-conge-form">
							<div class="form-group row">
											<label class="col-lg-3 col-form-label text-secondary">Matricule</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" id="conge-matricule" name="conge-matricule" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label text-secondary">début</label>
											<div class="col-lg-9 row">
												<div class="col-7">
									<input type="date" class="form-control" id="conge-debut" name="conge-debut" required style="font-size: 11px;">
								</div>
								<div class="col-5">
									<input type="time" class="form-control" id="conge-timedebut" name="conge-timedebut"  required style="font-size: 11px;">
								</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label text-secondary">Reprise</label>
											<div class="col-lg-9 row">
												<div class="col-7">
									<input type="date" class="form-control" id="conge-fin" name="conge-fin" style="font-size: 11px;" required>
								</div>
								
								<div class="col-5">
									<input type="time" class="form-control" id="conge-timefin" name="conge-timefin" style="font-size: 11px;"  required>
								</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label text-secondary">jour à exclure</label>
											<div class="col-lg-9">
												<input type="number" min="0" class="form-control" id="conge-exclure" name="conge-exclure" max = "365" value="0">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label text-secondary">Type</label>
											<div class="col-lg-9">
												<select id="type-conge" class="form-control" required name="type-conge">
										<?php
										foreach ($congeTypes as $value) {
											echo '<option value="'.$value['code'].'">'.$value['libelle'].'</option>';
										}
										?>
									</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label text-secondary">Fiche Congé</label>
											<div class="col-lg-9">
												<div class="custom-file">
										<input type="file" class="custom-file-input" id="scan-fiche-conge" name="scan-fiche-conge" accept="application/pdf" required>
										<label class="custom-file-label" for="scan-fiche-conge">Selectionner fichier</label>
									</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label text-secondary">Observations</label>
											<div class="col-lg-9">
												<textarea type="date" class="form-control" id="conge-observation" name="conge-observation"></textarea>
											</div>
										</div>
							
							<div style="display: flex;flex-direction: row-reverse;width: 100%;">
								<button  class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Ajouter</button>
							</div>
						</form>
						</div>
						
						
					</div>
					</div>
					<div class="col-xl-7 d-flex">
						<div class="card flex-fill" >
						<div class="card-header"><h4 class="card-title mb-0">Historique des congés de l'année <span><?php echo date("Y"); ?></h4></div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="conge-table" class="datatable table table-stripped mb-0 datatables dataTable no-footer" style="width: 100%;">
							<thead>
								<tr>
									<th>Libelle</th>
									<th>Date Début</th>
									<th>Date Reprise</th>
									<th>Nbr Jour</th>
									<th>Type</th>
									<th>Action</th>
									<th>num</th>
									
								</tr>
							</thead>
						</table>
							</div>
						<div style="display: flex;flex-direction: row-reverse;width: 100%;margin-top: 10px;">
							<button  class="btn btn-primary btn-sm" id="export-congeSuivi"><i class="fas fa-file-pdf"></i> Exporter</button>
						</div>
						</div>
						
						
					</div>
					</div>
					
					</div>
				
			</div>
			<div class="tab-pane" id="deplacement-tab" style="height: 100%;margin-top: 5px;">
				<div class="row">
					<div class="col-xl-5 d-flex">
						<div class="card flex-fill" >
						<div class="card-header"><h4 class="card-title mb-0">Ajouter Déplacement</h4></div>
						<div class="card-body">
							<form action="<?php echo base_url()?>GestionDeplacement/addDeplacement" method="post" id="add-deplacement-form">
								<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Matricule</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="deplacement-matricule" name="deplacement-matricule" readonly>
											</div>
										</div>
							<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Date</label>
											<div class="col-lg-8">
												<input type="date" class="form-control" id="deplacement-date" name="deplacement-date" required>
											</div>
										</div>
							<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Durée(J)</label>
											<div class="col-lg-8">
												<input type="number" min="0" class="form-control" id="deplacement-duree" name="deplacement-duree" required>
											</div>
										</div>
							<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Prix (DH/J)</label>
											<div class="col-lg-8">
												<input type="number" min="0" class="form-control" id="deplacement-prix" name="deplacement-prix" required>
											</div>
										</div>
							<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Lieu</label>
											<div class="col-lg-8">
												<input type="text"  class="form-control" id="deplacement-lieu" name="deplacement-lieu" required>
											</div>
										</div>
							<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Objet</label>
											<div class="col-lg-8">
												<input type="text"  class="form-control" id="deplacement-objet" name="deplacement-objet" required>
											</div>
										</div>
							<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Travaux/Prestations à réaliser</label>
											<div class="col-lg-8">
												<textarea class="form-control" id="deplacement-designation" name="deplacement-designation" rows="1" required></textarea>
											</div>
										</div>
							<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Ordre de Mission</label>
											<div class="col-lg-8">
												<div class="custom-file">
										<input type="file" class="custom-file-input" id="scan-fiche-deplacement" name="scan-fiche-deplacement" accept="application/pdf" required>
										<label class="custom-file-label" for="scan-fiche-deplacement">Selectionner fichier</label>
									</div>
											</div>
										</div>
										<div style="display: flex;flex-direction: row-reverse;width: 100%;">
								<button  class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Ajouter</button>
							</div>
						</form>
						</div>
						
						
					</div>
					</div>
					<div class="col-xl-7 d-flex">
						<div class="card flex-fill" >
						<div class="card-header"><h4 class="card-title mb-0">Historique des deplacements de l'année <span><?php echo date("Y"); ?></h4></div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="deplacement-table" class="datatable table table-stripped mb-0 datatables dataTable no-footer" style="width: 100%;">
							<thead>
								<tr>
									<th>Date</th>
									<th>Lieu</th>
									<th>Objet</th>
									<th>Nbr Jour</th>
									<th>Action</th>
									<th>code</th>
								</tr>
							</thead>
						</table>
							</div>
						<div style="display: flex;flex-direction: row-reverse;width: 100%;margin-top: 10px;">
							<button  class="btn btn-primary btn-sm" id="export-deplacementSuivi"><i class="fas fa-file-pdf"></i> Exporter</button>
							<!-- <button  class="btn btn-danger btn-sm" id="export-impayee"><i class="fas fa-file-pdf"></i> Etat des impayées</button> -->
						</div>
						</div>
						
						
					</div>
					</div>
					
					</div>
				
			</div>
			<div class="tab-pane" id="heures-sup-tab" style="height: 100%;margin-top: 5px;">
				<div class="row">
					<div class="col-xl-5 d-flex">
						<div class="card flex-fill" >
						<div class="card-header"><h4 class="card-title mb-0">Ajouter Heures Supp</h4></div>
						<div class="card-body">
							<form action="<?php echo base_url()?>GestionHeuresSup/addHeuresSup" method="post" id="add-heureSup-form">
								<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Matricule</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="heureSup-matricule" name="heureSup-matricule" readonly>
											</div>
										</div>
							<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Du</label>
											<div class="col-lg-8">
												<input type="date" class="form-control" id="heureSup-datedb" name="heureSup-datedb" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Au</label>
											<div class="col-lg-8">
												<input type="date" class="form-control" id="heureSup-datefn" name="heureSup-datefn" required>
											</div>
										</div>
							<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Nombre(H)</label>
											<div class="col-lg-8">
												<input type="number" min="0" class="form-control" id="heureSup-nbr" name="heureSup-nbr" required>
											</div>
										</div>
							<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Prix (DH/H)</label>
											<div class="col-lg-8">
												<input type="number" min="0" class="form-control" id="heureSup-prix" name="heureSup-prix" required>
											</div>
										</div>
							
							<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Justification</label>
											<div class="col-lg-8">
												<textarea class="form-control" id="heureSup-justif" name="heureSup-justif" rows="1" required></textarea>
											</div>
										</div>
							<div class="form-group row">
											<label class="col-lg-4 col-form-label text-secondary">Fiche H.Supp</label>
											<div class="col-lg-8">
												<div class="custom-file">
										<input type="file" class="custom-file-input" id="scan-fiche-heureSup" name="scan-fiche-heureSup" accept="application/pdf" required>
										<label class="custom-file-label" for="scan-fiche-heureSup">Selectionner fichier</label>
									</div>
											</div>
										</div>
										<div style="display: flex;flex-direction: row-reverse;width: 100%;">
								<button  class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Ajouter</button>
							</div>
						</form>
						</div>
						
						
					</div>
					</div>
					<div class="col-xl-7 d-flex">
						<div class="card flex-fill" >
						<div class="card-header"><h4 class="card-title mb-0">Historique des heures supp de l'année <span><?php echo date("Y"); ?></h4></div>
						<div class="card-body">
							<table id="heureSup-table" class="datatable table table-stripped mb-0 datatables dataTable no-footer" style="width: 100%;">
							<thead>
								<tr>
									<th>Période</th>
									<th>Nombre(H)</th>
									<th>Justif</th>
									<th>Action</th>
									<th>code</th>
								</tr>
							</thead>
						</table>
						<div style="display: flex;flex-direction: row-reverse;width: 100%;margin-top: 10px;">
							<button  class="btn btn-primary btn-sm" id="export-heureSupSuivi"><i class="fas fa-file-pdf"></i> Exporter</button>
							<!--<button  class="btn btn-danger btn-sm" id="export-HSPimpayee"><i class="fas fa-file-pdf"></i> Etat des impayées</button>-->
						</div>
						</div>
						
						
					</div>
					</div>
					
					</div>
				
			</div>
			<div class="tab-pane " id="info-tab" style="padding-top: 50px;">
				<div class="container-fluid">
          <div class="row">
          	<div class="col-md-4 order-md-12">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="javascript:;">
                    <img class="img" src="http://127.0.0.1/geosapp_v1//ImgProfil?u=0" id="profil-photo-recrue">
                  </a>
                </div>
                <div class="card-body">
                  
                  <h4 class="card-title selected-emp-name"></h4>
                  <h5 class="card-category text-gray selected-emp-fonction"></h5>
                  <p class="card-description selected-emp-etablissement"></p>
                  <p class="card-description selected-emp-email"></p>
                  <p class="card-description selected-emp-tel"></p>
                  <p class="card-description selected-emp-adresse"></p>
                  <div class="text-center py-3">
						                	<button type="button" class="border-0 btn btn-primary btn-gradient-primary btn-rounded" id="Btn-edit-Employe" data-toggle="modal" data-target="#edit-recrue-modal">Modifier</button>&nbsp;&nbsp;
						                	
						                </div>

				
                </div>
              </div>
            </div>
            <div class="col-md-8 order-md-1">
              <div class="card">
                <div class="card-header card-header-primary bg-gradient-primary">
                  <h4 class="font-weight-bold text-white mb-2">Information Profile</h4>
                  <p class="text-white text-small selected-emp-name"></p>
                </div>
                <div class="card-body">
                  <form>
                  	
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Matricule</label>
                          <input type="text" class="form-control information-input" id="info-recrue-matricule" disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Prénom</label>
                          <input type="text" class="form-control information-input" id="info-recrue-prenom" disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Nom</label>
                          <input type="email" class="form-control information-input" id="info-recrue-nom" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">E-mail</label>
                          <input type="text" class="form-control information-input" id="info-recrue-email" disabled>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Adresse</label>
                          <input type="text" class="form-control information-input" id="info-recrue-adresse" disabled>
                        </div>
                      </div>
                      
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">C.I.N</label>
                          <input type="text" class="form-control information-input" id="info-recrue-cin" disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Résidence</label>
                          <input type="text" class="form-control information-input" id="info-recrue-residence" disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Genre</label>
                          <input type="email" class="form-control information-input" id="info-recrue-sexe" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Date de naissance</label>
                          <input type="text" class="form-control information-input" id="info-recrue-naissance" disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Date d'inscription</label>
                          <input type="text" class="form-control information-input" id="info-recrue-recrutement" disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Statut familial</label>
                          <input type="email" class="form-control information-input" id="info-recrue-statut" disabled>
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Entité</label>
                          <input type="text" class="form-control information-input" id="info-recrue-entite" disabled>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Fonction</label>
                          <input type="text" class="form-control information-input" id="info-recrue-fonction" disabled>
                        </div>
                      </div>
                      
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Tèl</label>
                          <input type="text" class="form-control information-input" id="info-recrue-tel" disabled>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Lieu de naissance</label>
                          <input type="text" class="form-control information-input" id="info-recrue-lieunaissance" disabled>
                        </div>
                      </div>
                      
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Contrat</label>
                          <input type="text" class="form-control information-input" id="info-recrue-contrat" disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Banque</label>
                          <input type="text" class="form-control information-input" id="info-recrue-banque" disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">RIB</label>
                          <input type="email" class="form-control information-input" id="info-recrue-rib" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Diplome</label>
                          <input type="text" class="form-control information-input" id="info-recrue-contrat" disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Telecharger Diplome</label>
                          <input type="text" class="form-control information-input" id="info-recrue-banque" disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="text-secondary">Télécharger contrat</label>
                          <input type="email" class="form-control information-input" id="info-recrue-rib" disabled>
                        </div>
                      </div>
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
					<!-- /Content End -->
					
                </div>
				<!-- /Page Content -->
				
            </div>
           
			<!-- /Page Wrapper -->
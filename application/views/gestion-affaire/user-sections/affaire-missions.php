<section id="affaire-missions-section" class="principal-sections hidden_section">
	<div class="container-fluid" style="display: flex;height: 100%;">
		<div class="row">
			
			<div class="col-12 col-sm-8 d-flex flex-column" id ="missions-container">
				
				<div class="missions-card-body" style="flex:1;">
					
						<div class="missions-header-titles" id="missions-list">
							<div>
								<h5>Affaire : <span class="numero-affaire-title"></span></h5>
						<p class="sub-title">Liste des missions</p>
							</div>
						<button type="button" class="btn btn-light btn-circle btn-sm" id="show-addMission-modal"><i class="fas fa-plus  fa-lg"></i></button>
					</div>
					
					
					
					<div class="missions-body">
						<div id="table-missions-menu">
							<div class="row" >
								<div class="col-6" style="display: flex;flex-direction: row;justify-content: left;">
									<span style="line-height: 34px;">Afficher</span>
									<select class="form-control" style="max-width: 80px;height: 30px;" id="missions-table-length">
										<option>15</option>
										<option>50</option>
										<option>100</option>
									</select>
									<span  style="margin-left: 10px;line-height: 34px;">Page</span>
								</div>
								
								<div class="col-6 ml-auto" id="searchMissions-group" style="display: flex;justify-content: flex-end;">
									<div style="display: flex;flex-direction: row;">
										<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
										<input id="search-Missions" type="text" class="form-control" style="flex-grow: 1;height: 30px;max-width: 200px !important;border-radius: 20px;">
									</div>	

								</div>
								
							</div>
						</div>
						<div id="missions-table-container">
							<table id="missions-table" class="dt-responsive">
							<thead>
								<tr>
									<th>#</th>
									<th>Identifiant</th>
									<th>Libelle</th>
									<th>Numero Affaire</th>
									<th>Responsable </th>
									<th>Matricule </th>
									<th>Avancement</th>
									<th>Date Création</th>
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
			<div class="col  d-flex flex-column">
				<div class="detail-missions-card-body" style="flex:1;">
					<div class="missions-header-titles" id="details-list">
						<h5>Détails : </h5>
						
					</div>
					<div id="mission-detail-box">
						<div class="row mission-detail-box" style="padding: 10px 5px 10px 5px;margin:0px;">

							<div class="detail-mission-item col-12">
								<div class="col-12">
									<p  class="detail-mission-item-title">Numéro:</p>
									<p  class="detail-mission-item-content"><label id="mission-num"></label></p>
								</div>
							</div>
							
								<div class=" detail-mission-item col-12">
									<div class="col-12">
									<p  class="detail-mission-item-title">Libellé:</p>
									<p  class="detail-mission-item-content"><label id="mission-label"></label></p>
									</div>
								</div>
							
								<div class="detail-mission-item col-12">
									<div class="col-12">
									<p  class="detail-mission-item-title">Responsable:</p>
									<p  class="detail-mission-item-content"><label id="mission-createur"></label></p>
								</div>
								</div>
							
							<div class="detail-mission-item col-12">
								<div class="col-12">
									<p  class="detail-mission-item-title">Affaire:</p>
									<p  class="detail-mission-item-content"><label id="mission-affaire"></label></p>
								</div>
							</div>
							<div class="detail-mission-item col-12">
								<div class="col-12">
									<p  class="detail-mission-item-title">Date De Création:</p>
									<p  class="detail-mission-item-content"><label id="mission-date-creation"></label></p>
								</div>
							</div>
							<div class="detail-mission-item col-12">
								<div class="col-12">
									<p  class="detail-mission-item-title">Date De Fin prévue:</p>
									<p  class="detail-mission-item-content"><label id="mission-date-finPrevue"></label></p>
								</div>
							</div>
						
						<div class="detail-mission-item col-12">
								<div class="col-12">
									<p  class="detail-mission-item-title">Avancement:</p>
									<div class="progress">
										<div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="avancement-mission-bar">0%</div>
									</div>

								</div>
							</div>
							<div class="detail-mission-item col-12">
								<div class="col-12">
									<p  class="detail-mission-item-title">Etat:</p>
									<p  class="detail-mission-item-content"><label id="mission-etat"></label></p>
								</div>
							</div>
							<div class="detail-mission-item col-12">
								<div class="col-12">
									<p  class="detail-mission-item-title">Date de Validation:</p>
									<p  class="detail-mission-item-content"><label id="mission-validation-date"></label></p>
								</div>
							</div>
							<div class="detail-mission-item col-12">
								<div class="col-12">
									<p  class="detail-mission-item-title">Observation:</p>
									<p  class="detail-mission-item-content"><label id="mission-observation"></label></p>
								</div>
							</div>
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
				</section>

				<div class="modal" tabindex="-1" role="dialog" id="modal-add-mission" data-backdrop="static" data-keyboard="false" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Ajouter Une Mission</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div id="form-add-mission-container" style="max-height: 80vh;overflow-y: auto;">
							<form action="<?php echo base_url()?>Affaire_missions/addMission" method="post" id="nouveau-missions-form">


								<div class="container-fluid" style="padding:0">
									
										<div class="col-12">
											<label for="missions-Libelle">Libelle</label>
											<div class="input-group input-group-sm">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-user"></i></span>
												</div>
												<textarea class="form-control" id="missions-Libelle" name="missions-Libelle" rows="2" aria-describedby="observation-aide" required maxlength="150"></textarea>
											</div>

										</div>
										<div class="col-12">

											<div class="form-group">
												<label for="missions-responsable">responsable</label>
												<div class="input-group input-group-sm">
													<div class="input-group-prepend">
														<button class="btn btn-outline-secondary load-employees" type="button"><i class="fas fa-search"></i></button>
													</div>
													<input type="text" class="form-control" id="missions-responsable" name="missions-responsable" required>

												</div>

											</div>
											<div class="form-group">
												<label for="affaire-mission-delai">Délai (en Jours)</label>
												<div class="input-group input-group-sm">
													<input type="number" class="form-control" id="affaire-mission-delai" name="affaire-mission-delai" aria-describedby="delai-aide" placeholder="ex : 120" required>

												</div>
												<small id="delai-aide" class="form-text text-muted">le Délai de la mission en Jours calendaires  </small>
											</div>
											<div class="form-group">
											<label for="info-supp">Informations supplémentaires</label>
											<div class="input-group input-group-sm">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-info"></i></span>
												</div>
												<textarea class="form-control" id="info-supp" name="info-supp" rows="3" aria-describedby="observation-aide"  maxlength="1000"></textarea>
											</div>

										</div>
											<div class="form-group">
												
												<div class="input-group input-group-sm">
													<div style="width: 100%;display: flex;justify-content: space-between;align-items: center;">
														<label for="tache-attach-add" class="btn btn-secondary btn-circle btn-sm" style="font-size: 10px;"><input id="tache-attach-add" type="file" multiple="multiple" class="d-none"><i class="fas fa-paperclip  fa-lg"></i></label>
														
													<button type="submit" class="btn btn-danger btn-sm btn-block" id="Btn-ajouter-missions" style="width: 40%;margin-top: 0;">Ajouter</button>
													</div>

												</div>
													
														<div id="divFiles">
															<table id="t-attach-list" style="width:100%">
															</table>
														</div>
											</div>
										</div>

									

								</div>


							</form>
						</div>
						</div>
					</div>
				</div>

				<div class="modal" tabindex="-1" role="dialog" id="modal-edit-mission" data-backdrop="static" data-keyboard="false" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier Une Mission</h5>
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
													<button class="btn btn-outline-secondary load-employees" type="button"><i class="fas fa-search"></i></button>
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



<section id="details-section" class="principal-sections hidden_section">

	
	<div class="main-titles">
		<h5>Détails</h5>
	</div>
	
	<div  id="spliter" class="row">
		<div class="col-12 col-sm-6">
			<ul style="list-style: none;padding-left: 10px;">
				<li>

					<div class="row detail-affaire-item">
						<div class="col-2">
							<i class="fas fa-list-ol detail-affaire-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p  class="detail-affaire-item-title">Numéro</p>
							<p  class="detail-affaire-item-content"><label id="detail-numAffaire"></p>
							</div>
						</div>

					</li>
					<li>

						<div class="row detail-affaire-item">
							<div class="col-2">
								<i class="fas fa-user detail-affaire-icons fa-lg"></i>
							</div>
							<div class="col-10">
								<p  class="detail-affaire-item-title">Créée Par :</p>
								<p  class="detail-affaire-item-content" ><label id="detail-createurAffaire"></label></p>
							</div>
						</div>

					</li>
					
					<li>

						<div class="row detail-affaire-item">
							<div class="col-2">
								<i class="fas fa-hourglass-start detail-affaire-icons fa-lg"></i>
								
							</div>
							<div class="col-10">
								<p  class="detail-affaire-item-title">Délai</p>
								<p  class="detail-affaire-item-content"><label id="detail-delaiAffaire"></label></p>
							</div>
						</div>

					</li>
					<li>

						<div class="row detail-affaire-item">
							<div class="col-2">
								<i class="fas fa-comment detail-affaire-icons fa-lg"></i>
								
							</div>
							<div class="col-10">
								<p  class="detail-affaire-item-title">Observation</p>
								<p  class="detail-affaire-item-content"><label id="detail-observationAffaire"></label></p>
							</div>
						</div>

					</li>
					<li>

						<div class="row detail-affaire-item">
							<div class="col-2">
								<i class="fas fa-percent detail-affaire-icons fa-lg"></i>
								
							</div>
							<div class="col-10" id="avancement">
								<p  class="detail-affaire-item-title">Avancement : </p>
								<div class="progress">
									<div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="avancement-bar"></div>
								</div>
							</div>
						</div>

					</li>
					<li>

						<div class="row detail-affaire-item">
							<div class="col-2">
								<i class="fas fa-circle detail-affaire-icons fa-sm" style="color: #ffb100 !important"></i>
								
							</div>
							<div class="col-10">
								<p  class="detail-affaire-item-title">Tâches en cours</p>
								<p  class="detail-affaire-item-content"><label id="detail-tacheEnCoursAffaire" style="font-weight: bold;"></label></p>
							</div>
						</div>

					</li>
					
					
				</ul>
			</div>
			<div class="col-12 col-sm-6">
				<ul style="list-style: none;padding-left: 10px;">
					
					<li>

						<div class="row detail-affaire-item">
							<div class="col-2">
								<i class="fas fa-tags detail-affaire-icons fa-lg"></i>
							</div>
							<div class="col-10">
								<p  class="detail-affaire-item-title">Libellé</p>
								<p  class="detail-affaire-item-content"><label id="detail-libelleAffaire"></label></p>
							</div>
						</div>

					</li>
					
					<li>

						<div class="row detail-affaire-item">
							<div class="col-2">
								<i class="fas fa-calendar-alt detail-affaire-icons fa-lg"></i>

							</div>
							<div class="col-10">
								<p  class="detail-affaire-item-title">Date de création</p>
								<p  class="detail-affaire-item-content"><label id="detail-dateCreationAffaire"></label></p>
							</div>
						</div>

					</li>
					
					<li>

						<div class="row detail-affaire-item">
							<div class="col-2">
								<i class="fas fa-calendar-alt detail-affaire-icons fa-lg"></i>

							</div>
							<div class="col-10">
								<p  class="detail-affaire-item-title">Date de fin prévue</p>
								<p  class="detail-affaire-item-content"><label id="detail-datefinAffaire" ></label></p>
							</div>
						</div>

					</li>
					
					<li>

						<div class="row detail-affaire-item">
							<div class="col-2">
								<i class="fas fa-hourglass-start detail-affaire-icons fa-lg"></i>
								
							</div>
							<div class="col-10">
								<p  class="detail-affaire-item-title">Statut</p>
								<p  class="detail-affaire-item-content"><label id="detail-StatutAffaire"></label></p>
							</div>
						</div>

					</li>
					<li>

						<div class="row detail-affaire-item">
							<div class="col-2">
								<i class="fas fa-circle detail-affaire-icons fa-sm" style="color: #21b764 !important"></i>
								
							</div>
							<div class="col-10">
								<p  class="detail-affaire-item-title">Tâches Terminées</p>
								<p  class="detail-affaire-item-content"><label id="detail-tacheTermineeAffaire" style="font-weight: bold;"></label></p>
							</div>
						</div>

					</li>
					
				</ul>
			</div>
			
		</div>
		<div class="row">
			<div class="col-6 col-sm-2 ml-auto">
				<button type="button" class="btn btn-info btn-sm btn-block" id="edit-affaire-btn">Modifier</button>
			</div>

		</div>
	</section>
	<div class="modal" tabindex="-1" role="dialog" id="modal-edit-affaire" data-backdrop="static" data-keyboard="false" aria-hidden="true">
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
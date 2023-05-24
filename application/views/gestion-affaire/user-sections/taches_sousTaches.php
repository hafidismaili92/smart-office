<section id="affaire-sTaches-section" class="principal-sections hidden_section">
	<div id="sTaches-title">
		<h5  style="padding-left: 5px;"> TACHE : <span class="numero-tache-title"></span></h5>
		<h5 style="padding-right: 15px;">Gestion des sTaches</h5>

	</div>
	<div class="row" style="margin:0 !important;height: 100%;">
		<div class="col-12 col-md-3 " id="form-add-sTache-container">
			<form action="<?php echo base_url()?>Tache_Staches/addStache" method="post" id="nouveau-sTaches-form">

				<div class="form-row">

					<div class="form-group col-12 mr-md-auto">
						<label for="sTaches-Libelle">Libelle</label>
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<textarea class="form-control" id="sTaches-Libelle" name="sTaches-Libelle" rows="2" aria-describedby="observation-aide" required></textarea>
						</div>

					</div>
					<div class="form-group col-12">
						<label for="sTaches-responsable">responsable</label>
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<button class="btn btn-outline-secondary load-employees" type="button"><i class="fas fa-search"></i></button>
							</div>
							<input type="text" class="form-control" id="sTaches-responsable" name="sTaches-responsable" required>

						</div>

					</div>
					<div class="form-group col-12">
						<label for="affaire-sTache-delai">Délai (en Jours)</label>
						<div class="input-group input-group-sm">
							<input type="number" class="form-control" id="affaire-sTache-delai" name="affaire-sTache-delai" aria-describedby="delai-aide" placeholder="ex : 120" required>

						</div>
						<small id="delai-aide" class="form-text text-muted">le Délai de la tâche en Jours calendaires  </small>
					</div>
					<div class="form-group col-12">
						<label></label>
						<div class="input-group input-group-sm">
							<button type="submit" class="btn btn-info btn-sm btn-block" id="Btn-ajouter-sTaches">Ajouter</button>

						</div>

					</div>
				</div>

			</form>
		</div>
		<div id="sTaches-array-container" class="col-12 col-md-9" style="margin-top: 10px;height: 90%;">
			<div style="height: 100%;">
				<div style="font-size: 12px;">
					<table id="sTaches-table" class="display responsive compact-style" style="width: 100%;">
						<thead>
							<tr>
								<th></th>
								<th>Identifiant</th>
								<th>Libelle</th>
								<th>Numero Affaire</th>
								<th>Responsable </th>
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
							</tr>
						</thead>

					</table>
				</div>
				<div id="sTache-detail-box" class="row">
					<div class="col-12 col-sm-6">
						<ul style="list-style: none;padding-left: 10px;width: 100%;">
							<li>

								<div class="row detail-mission-item">
									<div class="col-12">
										<p  class="detail-mission-item-title">Numéro:</p>
										<p  class="detail-mission-item-content"><label id="sTache-num"></label></p>
									</div>
								</div>

							</li>
							<li>

								<div class="row detail-mission-item">
									<div class="col-12">
										<p  class="detail-mission-item-title">Responsable:</p>
										<p  class="detail-mission-item-content"><label id="sTache-createur"></label></p>
									</div>
								</div>

							</li>
							<li>

								<div class="row detail-mission-item">
									<div class="col-12">
										<p  class="detail-mission-item-title">Date De Fin prévue:</p>
										<p  class="detail-mission-item-content"><label id="sTache-date-finPrevue"></label></p>
									</div>
								</div>

							</li>
							<li>

								<div class="row detail-mission-item">
									<div class="col-12">
										<p  class="detail-mission-item-title">Affaire:</p>
										<p  class="detail-mission-item-content"><label id="sTache-affaire"></label></p>
									</div>
								</div>

							</li>
							<li>

								<div class="row detail-mission-item">
									<div class="col-12">
										<p  class="detail-mission-item-title">Avancement:</p>
										<div class="progress">
											<div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="avancement-sTache-bar">0%</div>
										</div>
										
									</div>
								</div>

							</li>
						</ul>
					</div>
					<div class="col-12 col-sm-6">
						<ul style="list-style: none;padding-left: 10px;width: 100%;">
							<li>

								<div class="row detail-mission-item">
									<div class="col-12">
										<p  class="detail-mission-item-title">Libellé:</p>
										<p  class="detail-mission-item-content"><label id="sTache-label"></label></p>
									</div>
								</div>

							</li>
							<li>

								<div class="row detail-mission-item">
									<div class="col-12">
										<p  class="detail-mission-item-title">Date De Création:</p>
										<p  class="detail-mission-item-content"><label id="sTache-date-creation"></label></p>
									</div>
								</div>

							</li>
							<li>

								<div class="row detail-mission-item">
									<div class="col-12">
										<p  class="detail-mission-item-title">Etat:</p>
										<p  class="detail-mission-item-content"><label id="sTache-etat"></label></p>
									</div>
								</div>

							</li>
							<li>

								<div class="row detail-mission-item">
									<div class="col-12">
										<p  class="detail-mission-item-title">Date de Validation:</p>
										<p  class="detail-mission-item-content"><label id="sTache-validation-date"></label></p>
									</div>
								</div>

							</li>
							<li>

								<div class="row detail-mission-item">
									<div class="col-12">
										<p  class="detail-mission-item-title">Observation:</p>
										<p  class="detail-mission-item-content"><label id="sTache-observation"></label></p>
									</div>
								</div>

							</li>
						</ul>
					</div>
					<div style="display: flex;width: 100%;flex-direction: row-reverse;margin-top: 15px;">
						<button type="button" class="btn btn-success btn-sm" id="valider-Stache">Valider</button>
						
					</div>
				</div>

			</div>
		</div>


	</section>


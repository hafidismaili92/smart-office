<section id="addContrat-section" class="principal-sections hidden_section">
	<form id="nouveau-contrat-form" action="<?php echo base_url(); ?>NouveauContrat/addContrat" method="post">
		
		<h3> <i class="fas fa-info-circle"></i> INFORMATION GENERALE</h3>
		<fieldset>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="numero">Numéro</label>
					<input type="text" class="form-control" id="numero" name="numero" aria-describedby="numero-aide" placeholder="Numéro" required>
					<small id="numero-aide" class="form-text text-muted">tapez un numéro pour votre affaire</small>
				</div>
				<div class="form-group col-sm-6">
					<label for="libelle">Libellé</label>
					<textarea class="form-control" id="libelle" name="libelle" rows="2" required></textarea>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="numero">Date de Signature</label>
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="date" class="form-control" id="date-signature" placeholder="23/05/2020"   name="date-signature" required>
					</div>
				</div>
				<div class="form-group col-sm-6">
					
					<label for="delai">Délai (en Jours)</label>
					<input type="number" class="form-control" id="delai" name="delai" aria-describedby="delai-aide" placeholder="ex : 120" max="3650" min="0" required>
					
				</div>
				
			</div>
			<div class="form-row">

				<div class="col-12 col-sm-6">
					<label for="domaine-contrat">Secteur d'activité</label>

					<select class="custom-select" id="domaine-contrat" name="domaine-affaire" style="font-size: 12px;">
						<option value="" selected><span style="color: rgba(0,0,0,0.2);">Selectionner</span></option>
						<?php
						foreach ($domaines as $value) {
							echo '<option value="'.$value['id'].'">'.$value['libelle'].'</option>';
						}

						?>

					</select>
				</div>
				<div class="col-12 col-sm-6">
					<label for="secteur-contrat">Désignation de la prestation</label>

					<select class="custom-select" id="secteur-contrat" name="secteur-contrat" style="font-size: 12px;" required>
						<option value="" selected><span style="color: rgba(0,0,0,0.2);">Selectionner</span></option>
					</select>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-sm-6"> 
					<div class="form-group">
						<label for="client-contrat">Client</label>
						<select class="form-control col-12 required-field" id="client-contrat" name="client-contrat" style="overflow-y: auto;" required>
							
						</select>
						<small id="client-aide" class="form-text text-muted">le client doit être enregistré au préalable</small>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="contrat-observations">TVA en %</label>
					<input class="form-control" id="contrat-tva" name="contrat-tva" required value="20" type="number" max="100" min="0">
					<small id="observation-aide" class="form-text text-muted">20% par défaut</small>
				</div>
			</div>
			<div class="form-row">
				
				<div class="form-group col-sm-12">
					<label for="contrat-observations">Observations</label>
					<textarea class="form-control" id="contrat-observations" name="contrat-observations" rows="2" aria-describedby="observation-aide"></textarea>
					<small id="observation-aide" class="form-text text-muted">observations, remarques...  </small>
				</div>
			</div>

		</fieldset>
		
		<h3><i class="fas fa-list-ol"></i> LISTE DES PRIX</h3>
		<fieldset>
			<div class="form-row" id="prix-data-container">
				<div class="form-group col-sm-6 col-md-2">
					<label for="numero-prix">Numéro</label>
					<input type="text" class="form-control form-control-sm prix-field" id="numero-prix"  placeholder="Numéro">
				</div>
				<div class="form-group col-sm-6 col-md-3">
					<label for="libelle-prix">Libellé</label>
					<input class="form-control form-control-sm prix-field" id="libelle-prix">
				</div>
				
				<div class="col-sm-6 col-md-3">
					<label for="unite-prixe">Unité</label>

					<select class="custom-select prix-field" id="unite-prix" style="font-size: 12px;">
						<?php
						foreach ($unites as $value) {
							echo '<option value="'.$value['code'].'">'.$value['libelle'].' ('.$value['code'].')</option>';
						}

						?>
					</select>
				</div>
				<div class="form-group col-sm-6 col-md-1">
					<label for="prix-prix">Prix.U</label>
					<input class="form-control form-control-sm prix-field" type ="number" id="prix-prix">
					<small>En DH HT</small>
				</div>
				<div class="form-group col-sm-6 col-md-1">
					<label for="quantite-prix">Quantite</label>
					<input class="form-control form-control-sm prix-field" type ="number" id="quantite-prix">
				</div>
				<div class="form-group col-2" style="display: flex;flex-direction: row;height: 50%;justify-content: space-between;padding-top: 20px;">
					
					<button class="btn btn-outline-danger " type="button" id="btn-add-prix"><i class="fas fa-plus"></i></button>
					<span class="btn btn-outline-success " type="button" id="import-prix" style="position: relative;"><i class="fas fa-file-excel">
					</i><input type="file" id="prix-xls-file" accept=" application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="position: absolute;max-height: 100%;min-height: 100%;top: 0;right: 0;opacity: 0;width:100%;"></span>
					<button class="btn btn-outline-info " type="button" id="btn-removeAllprix-contrat"><i class="fas fa-trash"></i></button>
				</div>
				
			</div>
			<hr style="margin:0;">
			<div style="width: 100%;margin: 0;background-color: rgba(220, 219, 219, 0.57);height: 30px;display: flex;justify-content:space-around;font-size: 16px;margin-bottom: 2px;">
				<div class="titlePrixFont ">TOTAL HT :<span style="color: #bd0a1ba1;" id="total-ht">0,00</span><span style="color: #bd0a1ba1;">DH HT</span></div>
				<div class="titlePrixFont ">TOTAL TTC :<span style="color: #007bffb8;" id="total-ttc">0,00</span><span style="color: #007bffb8;">DH TTC</span></div>
			</div>
			<table id="nouveau-contrat-table" style="width: 100%;" >
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
		</fieldset>
		<h3><i class="fas fa-map-marked"></i> COORDONNEES</h3>
		<fieldset>
			<div style="display: flex;flex-direction: column;">
				<div class="form-row">

					<div class="col-12 col-sm-6">
						<label for="ville-contrat">Ville</label>

						<select class="custom-select" id="ville-contrat" name="ville-contrat" style="font-size: 12px;" >
							<option value="" selected><span style="color: rgba(0,0,0,0.2);">Selectionner</span></option>
							<?php
							foreach ($villes_affaire as $value) {
								echo '<option value="'.$value['ville'].'">'.$value['ville'].'</option>';
							}

							?>

						</select>
					</div>
					<div class="col-12 col-sm-6">
						<label for="secteur-affaire">Secteur</label>

						<select class="custom-select" id="secteur-ville" name="secteur-ville" style="font-size: 12px;" required>
							<option value="" selected><span style="color: rgba(0,0,0,0.2);">Selectionner</span></option>
						</select>
					</div>
				</div>
				<div class="form-row" style="display: none;">

					<div class="col-12 col-sm-6">
						<input type="text" name="geom-type"  id="geom-type">
						
					</div>
					<div class="col-12 col-sm-6">
						<textarea name="geom-coordonnees"  id="geom-coordonnees"></textarea>
					</div>
				</div>
				
				<div style="width: 100%;margin-top: 10px;" class="row">
					<!--<div class="col-10">
						<label class="radio-inline"><input type="radio" name="geomType" value="Point" checked>POINT</label>
						<label class="radio-inline"><input type="radio" name="geomType" value="Polygon">POLYGONE</label>
						<label class="radio-inline"><input type="radio" name="geomType" value="LineString">LIGNE</label>
					</div>-->

					<div class="col-2 ml-auto" style="padding:0;">

						<button type="button" class="btn btn-outline-danger btn-sm btn-block" id="reset-emplacement"><i class="fas fa-trash"></i>Supprimer</button>
					</div>

				</div>
				<div id="map" style="width: 100%;height: 350px;margin-top: 10px;">

				</div>
			</div>
		</fieldset>
	</form>
</section>
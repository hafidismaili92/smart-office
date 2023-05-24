<section id="addEmploye-section" class="principal-sections hidden_section">
<div class="container" >
<div class="row justify-content-center">
<div class="col-12 col-md-8" id="form-add-emp-container">
	<div id="form-add-emp-title">
		Nouvel Recrue
	</div>
<div id="form-add-emp-content">
<form action="<?php echo base_url()?>Employes/addEmployed" method="post" id="nouveau-employe-form">
<div class="form-row justify-content-center">		
				<div class="input-group input-group-sm">
					<input type="file" class="form-control dropify" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="5M" id="employe-photo" name="employe-photo" data-height="100" />
					
				</div>

</div>
<div class="form-row" style="padding-top:10px;">
					<div class="form-group col-md-4">
						<label for="employe-prenom">Prénom<span style="font-weight: bold;color:red;">*</span></label>
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" class="form-control" id="employe-prenom" name="employe-prenom" placeholder="Prenom"  required>
						</div>

					</div>
					<div class="form-group col-md-4">
						<label for="employe-nom">Nom<span style="font-weight: bold;color:red;">*</span></label>
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input  type="text" class="form-control" id="employe-nom" placeholder="Nom" required name="employe-nom">
						</div>

					</div>
					<div class="form-group col-md-4">
						<label for="employe-cin">C.I.N<span style="font-weight: bold;color:red;">*</span></label>
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-id-card"></i></span>
							</div>
							<input  type="text" class="form-control" id="employe-cin" placeholder="CIN" name="employe-cin" required>
						</div>

					</div>
					<div class="form-group col-md-4">
						<label for="employe-residence">Résidence<span style="font-weight: bold;color:red;">*</span></label>
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
							</div>
							<select class="custom-select" id="employe-residence" name="employe-residence">
								<?php
								foreach ($villes as $value) {
									echo '<option value="'.$value['ville'].'">'.$value['ville'].'</option>';
								}

								?>

							</select>
						</div>

					</div>
					<div class="form-group col-md-4">
						<label for="employe-sexe">Sexe<span style="font-weight: bold;color:red;">*</span></label>
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-restroom"></i></span>
							</div>
							<select class="custom-select" id="employe-sexe" name="employe-sexe">
								<option selected value="M">M</option>
								<option value="F">F</option>

							</select>

						</div>

					</div>
					<div class="form-group col-md-4">
						<label for="employe-date-naissance">Date naissance<span style="font-weight: bold;color:red;">*</span></label>
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
							</div>
							<input type="date" class="form-control" id="employe-date-naissance" placeholder="23/05/1999" required  name="employe-date-naissance">
						</div>

					</div>
					<div class="form-group col-md-6">
						<label for="employe-date-recrutement">Date de recrutement<span style="font-weight: bold;color:red;">*</span></label>
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
							</div>
							<input type="date" class="form-control" id="employe-date-recrutement" name="employe-date-recrutement" placeholder="23/05/2016" required >
						</div>

					</div>
					<div class="form-group col-md-6">
					<label for="employe-email">Email <span style="font-weight: bold;color:red;">*</span></label>
					<div class="input-group input-group-sm">

						<input type="email" class="form-control" id="employe-email" name="employe-email" placeholder="votre Email ici" required>
					</div>

				</div>
				<div class="form-group col-md-6">
					<label for="employe-etablissement">Entité<span style="font-weight: bold;color:red;">*</span></label>
					<div class="input-group input-group-sm">

						<select class="custom-select employe-etablissement-list" id="employe-etablissement" name="employe-etablissement" >
						</select>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label for="employe-fonction">Fonction<span style="font-weight: bold;color:red;">*</span></label>
					<div class="input-group input-group-sm">

						<select class="custom-select employe-fonction-list" id="employe-fonction" name="employe-fonction">

						</select>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label for="employe-situation">Statut familial</label>
					<div class="input-group input-group-sm">

						<select class="custom-select" id="employe-situation" name="employe-situation">
							<option selected value="Célebataire">Célebataire</option>
							<option value="Marié">Marié</option>
							<option value="Divorcé">Divorcé</option>
							<option value="Remarié">Remarié</option>
							<option value="Veuf">Veuf</option>
						</select>

					</div>

				</div>
				<div class="form-group col-md-6">
					<label for="employe-lieu-naissance">Lieu de naissance</label>
					<div class="input-group input-group-sm">

						<select class="custom-select" id="employe-lieu-naissance" name="employe-lieu-naissance">
							<?php
							foreach ($villes as $value) {
								echo '<option value="'.$value['ville'].'">'.$value['ville'].'</option>';
							}

							?>
						</select>
					</div>

				</div>
				<div class="form-group col-md-6">
					<label for="employe-adresse">Adresse</label>
					<div class="input-group input-group-sm">

						<input type="text" class="form-control" id="employe-adresse" name="employe-adresse" placeholder="adresse">

					</div>

				</div>
				<div class="form-group col-md-6">
					<label for="employe-tel">Tèl :</label>
					<div class="input-group input-group-sm">

						<input type="text" class="form-control" id="employe-tel" name="employe-tel" placeholder="0625325478">
					</div>

				</div>
				<div class="form-group col-md-6">
					<label for="employe-type-contrat">type contrat</label>
					<div class="input-group input-group-sm">

						<select class="custom-select" id="employe-type-contrat" name="employe-type-contrat">
							<?php
							foreach ($contrats as $value) {
								echo '<option value="'.$value['code_contrat'].'">'.$value['libelle'].'</option>';
							}
							?>
						</select>
					</div>

				</div>
				<div class="form-group col-md-6">
					<label for="employe-scan-contrat">Scan Contrat</label>
					<div class="input-group input-group-sm">

						<div class="custom-file">
							<input type="file" class="custom-file-input" id="employe-scan-contrat" name="employe-scan-contrat" accept="application/pdf">
							<label class="custom-file-label" for="employe-scan-contrat">Selectionner fichier</label>
						</div>

					</div>

				</div>
				<div class="form-group col-md-6">
					<label for="employe-diplome">Diplome</label>
					<div class="input-group input-group-sm">

						<input type="text" class="form-control" id="employe-diplome" name="employe-diplome" placeholder="ex: DUT en Genie Civil">
					</div>
				</div>
				<div class="form-group col-md-6">
					<label for="employe-scan-diplome">Scan Diplome</label>
					<div class="input-group input-group-sm">

						<div class="custom-file">
							<input type="file" accept="application/pdf" class="custom-file-input" id="employe-scan-diplome" name="employe-scan-diplome">
							<label class="custom-file-label" for="employe-scan-diplome">Selectionner fichier</label>
						</div>

					</div>

				</div>
				<div class="form-group col-md-6">
					<label for="employe-banque">banque</label>
					<div class="input-group input-group-sm">

						<input type="text" class="form-control" id="employe-banque" name="employe-banque" placeholder="banque xxxx, agence hay karima">
					</div>

				</div>
				<div class="form-group col-md-6">
					<label for="employe-rib">Compte Bancaire (RIB)</label>
					<div class="input-group input-group-sm">

						<input type="text" class="form-control" id="employe-rib" name="employe-rib" placeholder="RIB">
					</div>

				</div>
				<div id="add-emp-btns">
				
				<button type="submit" >Ajouter</button>
				
				</div>
				
</div>
</form>
</div>
</div>
</div>
</div>


	</section>

	<div class="modal fade" id="success-nouveau-employe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nouveau Employé</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="droit-employe-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Spécifier les Droits</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="droit-gestion-affaire" checked disabled name="droitEmployee[]" value="GAFF">
						<label class="custom-control-label" for="droit-gestion-affaire">Gestion des affaires</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="droit-gestion-rh" name="droitEmployee[]" value="GRH">
						<label class="custom-control-label" for="droit-gestion-rh">Gestion Ressources Humaines</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="droit-gestion-contrat" name="droitEmployee[]" value="GCONTRAT">
						<label class="custom-control-label" for="droit-gestion-contrat">Gestion des Contrats</label>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal" id="confirm-ajouter-employee">Ajouter l'employé</button>

				</div>
			</div>
		</div>
	</div>
<section id="gestion-employee-section" class="principal-sections hidden_section" style="min-height: 100%;">

	<div class="row" style="margin:0;padding: 0;margin-top: 2px;">
		<div class="col-12 col-md-6 ml-auto" id="form-gestion-employee-container">
			<form action="<?php echo base_url()?>Employes/getEmployee" method="post" id="gestion-employee-form">

				<div class="form-row">
					<div class="form-group col-4  ml-md-auto">
						<label for="matricule-gestion">Matricule</label>
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<button class="btn btn-outline-secondary load-all-employees" type="button"><i class="fas fa-search"></i></button>
							</div>
							<input type="text" class="form-control" id="matricule-gestion" name="matricule-gestion" required>

						</div>
					</div>
					<div class="form-group col-6  mr-md-auto">
						<label for="nomPrenom-gestion">Nom et prénom</label>
						<div class="input-group input-group-sm">

							<input type="text" class="form-control" id="nomPrenom-gestion" name="nomPrenom-gestion"  readonly>

						</div>
					</div>
					<div class="form-group col-2">
						<label for="search-gestion-employee"></label>
						<div class="input-group input-group-sm">
							<button class="btn btn-info" id="search-gestion-employee"><i class="fas fa-search "></i></button>
						</div>


					</div>
				</div>

			</form>
		</div>
	</div>
	<div id="main-gestions-employee-container">
		
		<ul class="nav nav-tabs" id="gestionEmployee-tabs">
			<li class="nav-item active">
				<span data-target="#absence-tab" data-toggle="tab" style="padding: 20px;">Absences</span >
			</li>
			<li class="nav-item">
				<span data-target="#conges-tab" data-toggle="tab" style="padding: 20px;">Congés</span >
			</li>
			<li class="nav-item">
				<span data-target="#deplacement-tab" data-toggle="tab" style="padding: 20px;">Déplacements</span >
			</li>
			<li class="nav-item">
				<span data-target="#heures-sup-tab" data-toggle="tab" style="padding: 20px;">Heures Supplémentaires</span >
			</li>
			<li class="nav-item">
				<span data-target="#info-tab" data-toggle="tab" style="padding: 20px;">Info collaborateur</span >
			</li>
			<!-- <li class="nav-item">
				<span data-target="#profil-tab" data-toggle="tab" style="padding: 20px;">Profil</span >
			</li> -->
			
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="absence-tab" style="height: 100%;margin-top: 5px;">
				<div class="row">
					<div class="col-12 col-md-7" style="border-right: 1px solid gray;font-size: 16px;">
						<div style="background: #232526;  /* fallback for old browsers */
						background: -webkit-linear-gradient(to right, #414345, #232526);  /* Chrome 10-25, Safari 5.1-6 */
						background: linear-gradient(to right, #414345, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

						color: white;width: 100%;text-align: center;margin-bottom: 10px;">Suivi Journalier</div>
						<form action="<?php echo base_url()?>GestionAbsence/addAbsence" method="post" id="gestion-absence-form" style="font-size:0.8em;">

							<div class="form-row">
								<div class="form-group col-md-12 col-md-6 mr-md-auto">
									<label for="date-absence">Date</label>
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
										</div>
										<input type="date" class="form-control" id="date-absence" required name="date-absence">
									</div>

								</div>
								<div class="form-group col-md-6 col-md-4 mr-md-auto">
									<label for="time-debut-absence">H.Début</label>
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
										</div>
										<input type="time" class="form-control" id="time-debut-absence" required name="time-debut-absence" min="<?php echo heure_debut_travail?>" max="<?php echo heure_fin_travail?>" >
									</div>

								</div>
								<div class="form-group col-md-6 col-md-4 mr-md-auto">
									<label for="time-fin-absence">H.Fin</label>
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
										</div>
										<input type="time" class="form-control" id="time-fin-absence" required name="time-fin-absence" min="<?php echo heure_debut_travail?>" max="<?php echo heure_fin_travail?>" >
									</div>

								</div>

							</div>
							<div class="form-row">
								<div class="form-group col-6  col-md-2">
									<label for="matricule-form-absence">matricule</label>
									<div class="input-group input-group-sm">

										<input type="text" class="form-control" id="matricule-form-absence" name="matricule-form-absence"  readonly>

									</div>
								</div>
								<div class="form-group col-6 col-md-4">
									<label for="absence-justif">Justification</label>
									<div class="input-group input-group-sm">

										<select class="custom-select" id="absence-justif" name="absence-justif">
											<option value="sans">Sans</option>
											<option value="Bon-sortie">Bon de sortie</option>
										</select>
									</div>

								</div>
								<div class="form-group col-12 col-md-5">
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
								<div class="form-group col-2">
									<label for="search-absence-employee"></label>
									<div class="input-group input-group-sm">
										<button class="btn btn-danger" id="add-absence-employee"><i class="fas fa-plus "></i></button>
									</div>


								</div>
							</div>

						</form>
						<div style="width: 100%;margin-bottom: 20px;">

							<canvas id="myChart" width="400" height="80"></canvas>
						</div>

						<div style="width: 100%;padding-bottom: 10px;">
							<table id="absence-journalier" class="display responsive">
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
					<div class="col-12 col-md-5" style="font-size: 15px;">
						<div style="background: #232526;  /* fallback for old browsers */
						background: -webkit-linear-gradient(to right, #414345, #232526);  /* Chrome 10-25, Safari 5.1-6 */
						background: linear-gradient(to right, #414345, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

						color: white;width: 100%;text-align: center;margin-bottom: 10px;">Registre des Absences</div>
						<div style="width: 50%;margin-bottom: 20px;">
							<select id="absence-period">
								<option value="j">Aujourd'hui</option>
								<option value="s">Cette semaine</option>
								<option value="m">Ce mois</option>
								<option value="a">Cette année</option>
							</select>
						</div>
						<table id="absence-total" class="display responsive">
							<thead>
								<tr>
									<th>Jour</th>
									<th>Date</th>
									<th>Total Absence</th>

								</tr>
							</thead>
						</table>
						<div style="width: 100%;margin-bottom: 20px;height: 400px;">

							<canvas id="absenceTotal-ratio" width="400" height="150"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="conges-tab" style="height: 100%;margin-top: 5px;">
				<div class="row">
					<div class="col-12 col-md-5" style="border-right: 1px solid gray;font-size: 16px;">
						<form action="<?php echo base_url()?>GestionConges/addConge" method="post" id="add-conge-form">
							<div class="form-group row">
								<label for="conge-matricule" class="col-md-4 col-form-label">Matricule</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="conge-matricule" name="conge-matricule" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="conge-debut" class="col-md-4 col-form-label">début</label>
								<div class="col-lg-5">
									<input type="date" class="form-control" id="conge-debut" name="conge-debut" required>
								</div>
								<div class="col-lg-4">
									<input type="time" class="form-control" id="conge-timedebut" name="conge-timedebut"  required>
								</div>
							</div>
							<div class="form-group row">
								<label for="conge-fin" class="col-md-4 col-form-label">reprise le</label>
								<div class="col-lg-5">
									<input type="date" class="form-control" id="conge-fin" name="conge-fin" required>
								</div>
								
								<div class="col-lg-4">
									<input type="time" class="form-control" id="conge-timefin" name="conge-timefin"  required>
								</div>
							</div>
							<div class="form-group row">
								<label for="conge-exclure" class="col-md-8 col-form-label">Nombre de jour à exclure (fériés)</label>
								<div class="col-md-4">
									<input type="number" min="0" class="form-control" id="conge-exclure" name="conge-exclure" max = "365" value="0">
								</div>
							</div>
							<div class="form-group row">
								
								<label for="type-conge" class="col-md-4 col-form-label">Type</label>
								<div class="col-md-9">
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
								<label for="scan-fiche-conge" class="col-md-4">Fiche Congé</label>
								<div class="input-group input-group-sm col-md-9 " >
									
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="scan-fiche-conge" name="scan-fiche-conge" accept="application/pdf" required>
										<label class="custom-file-label" for="scan-fiche-conge">Selectionner fichier</label>
									</div>

								</div>
							</div>
							<div class="form-group row">
								<label for="conge-observation" class="col-12 col-form-label">Observation</label>
								<div class="col-12">
									<textarea type="date" class="form-control" id="conge-observation" name="conge-observation"></textarea>
								</div>
								
							</div>
							<div style="display: flex;flex-direction: row-reverse;width: 100%;">
								<button  class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Ajouter</button>
							</div>
						</form>
					</div>
					<div class="col-12 col-md-7" style="font-size: 15px;">
						<div style="background: #232526;  /* fallback for old browsers */
						background: -webkit-linear-gradient(to right, #414345, #232526);  /* Chrome 10-25, Safari 5.1-6 */
						background: linear-gradient(to right, #414345, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

						color: white;width: 100%;text-align: center;margin-bottom: 10px;">Historique des congés de l'année <span><?php echo date("Y"); ?></span></div>
						
						<table id="conge-table" class="display responsive" style="width: 100%;">
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
						<div style="display: flex;flex-direction: row-reverse;width: 100%;margin-top: 10px;">
							<button  class="btn btn-info btn-sm" id="export-congeSuivi"><i class="fas fa-file-pdf"></i> Exporter</button>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="deplacement-tab" style="height: 100%;margin-top: 5px;">
				<div class="row">
					<div class="col-12 col-md-5" style="border-right: 1px solid gray;font-size: 16px;">
						<form action="<?php echo base_url()?>GestionDeplacement/addDeplacement" method="post" id="add-deplacement-form">
							<div class="form-group row">
								<label for="deplacement-matricule" class="col-md-4 col-form-label">Matricule</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="deplacement-matricule" name="deplacement-matricule" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="deplacement-date" class="col-md-4 col-form-label">Date</label>
								<div class="col-md-9">
									<input type="date" class="form-control" id="deplacement-date" name="deplacement-date" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="deplacement-duree" class="col-md-4 col-form-label">Durée(J)</label>
								<div class="col-md-9">
									<input type="number" min="0" class="form-control" id="deplacement-duree" name="deplacement-duree" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="deplacement-prix" class="col-md-4 col-form-label">Prix (DH/J)</label>
								<div class="col-md-9">
									<input type="number" min="0" class="form-control" id="deplacement-prix" name="deplacement-prix" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="deplacement-lieu" class="col-md-4 col-form-label">Lieu</label>
								<div class="col-md-9">
									<input type="text"  class="form-control" id="deplacement-lieu" name="deplacement-lieu" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="deplacement-objet" class="col-md-4 col-form-label">Objet</label>
								<div class="col-md-9">
									<input type="text"  class="form-control" id="deplacement-objet" name="deplacement-objet" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="deplacement-designation" class="col-12 col-form-label">Travaux/Prestations à réaliser</label>
								<div class="col-12">
									<textarea class="form-control" id="deplacement-designation" name="deplacement-designation" rows="1" required></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="scan-fiche-deplacement" class="col-md-4">Ordre de Mission</label>
								<div class="input-group input-group-sm col-md-9 " >

									<div class="custom-file">
										<input type="file" class="custom-file-input" id="scan-fiche-deplacement" name="scan-fiche-deplacement" accept="application/pdf" required>
										<label class="custom-file-label" for="scan-fiche-deplacement">Selectionner fichier</label>
									</div>

								</div>
							</div>

							<div style="display: flex;flex-direction: row-reverse;width: 100%;">
								<button  class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Ajouter</button>
							</div>
						</form>
					</div>
					<div class="col-12 col-md-7" style="font-size: 15px;">
						<div style="background: #232526;  /* fallback for old browsers */
						background: -webkit-linear-gradient(to right, #414345, #232526);  /* Chrome 10-25, Safari 5.1-6 */
						background: linear-gradient(to right, #414345, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

						color: white;width: 100%;text-align: center;margin-bottom: 10px;">Historique des Déplacements de l'année <span><?php echo date("Y"); ?></span></div>

						<table id="deplacement-table" class="display responsive" style="width: 100%;">
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
						<div style="display: flex;flex-direction: row-reverse;width: 100%;margin-top: 10px;">
							<button  class="btn btn-info btn-sm" id="export-deplacementSuivi"><i class="fas fa-file-pdf"></i> Exporter</button>
							<button  class="btn btn-danger btn-sm" id="export-impayee"><i class="fas fa-file-pdf"></i> Etat des impayées</button>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="heures-sup-tab" style="height: 100%;margin-top: 5px;">
				<div class="row">
					<div class="col-12 col-md-5" style="border-right: 1px solid gray;font-size: 16px;">
						<form action="<?php echo base_url()?>GestionHeuresSup/addHeuresSup" method="post" id="add-heureSup-form">
							<div class="form-group row">
								<label for="heureSup-matricule" class="col-md-4 col-form-label">Matricule</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="heureSup-matricule" name="heureSup-matricule" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="heureSup-datedb" class="col-md-4 col-form-label">Du</label>
								<div class="col-md-9">
									<input type="date" class="form-control" id="heureSup-datedb" name="heureSup-datedb" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="heureSup-datefn" class="col-md-4 col-form-label">Au</label>
								<div class="col-md-9">
									<input type="date" class="form-control" id="heureSup-datefn" name="heureSup-datefn" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="heureSup-nbr" class="col-md-4 col-form-label">Nombre(H)</label>
								<div class="col-md-9">
									<input type="number" min="0" class="form-control" id="heureSup-nbr" name="heureSup-nbr" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="heureSup-prix" class="col-md-4 col-form-label">Prix.U (DH/H)</label>
								<div class="col-md-9">
									<input type="number" min="0" class="form-control" id="heureSup-prix" name="heureSup-prix" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="heureSup-justif" class="col-12 col-form-label">Justification</label>
								<div class="col-12">
									<textarea class="form-control" id="heureSup-justif" name="heureSup-justif" rows="1" required></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="scan-fiche-heureSup" class="col-md-4">Fiche H.Sup</label>
								<div class="input-group input-group-sm col-md-9 " >

									<div class="custom-file">
										<input type="file" class="custom-file-input" id="scan-fiche-heureSup" name="scan-fiche-heureSup" accept="application/pdf" required>
										<label class="custom-file-label" for="scan-fiche-heureSup">Selectionner fichier</label>
									</div>

								</div>
							</div>

							<div style="display: flex;flex-direction: row-reverse;width: 100%;">
								<button  class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Ajouter</button>
							</div>
						</form>
					</div>
					<div class="col-12 col-md-7" style="font-size: 15px;">
						<div style="background: #232526;  /* fallback for old browsers */
						background: -webkit-linear-gradient(to right, #414345, #232526);  /* Chrome 10-25, Safari 5.1-6 */
						background: linear-gradient(to right, #414345, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

						color: white;width: 100%;text-align: center;margin-bottom: 10px;">Historique des Heures sup de l'année <span><?php echo date("Y"); ?></span></div>

						<table id="heureSup-table" class="display responsive" style="width: 100%;font-size: 12px;">
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
							<button  class="btn btn-info btn-sm" id="export-heureSupSuivi"><i class="fas fa-file-pdf"></i> Exporter</button>
							<button  class="btn btn-danger btn-sm" id="export-HSPimpayee"><i class="fas fa-file-pdf"></i> Etat des impayées</button>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane " id="info-tab" style="height: 100%;margin-top: 5px;">
				<div class="row photo-recrue-row">
					<div class="col-12 col-md-3 ml-auto" style="padding: 15px 35px 0px 0px;">

						<img src="" style="width:120px;height:120px;float: right;" id="profil-photo-recrue">
					</div>
				</div>
				<div class="row info-recrue-row" >
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-list-ol info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Matricule</p>
							<p class="info-recrue-item-content"><label id="info-recrue-matricule"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-user info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Prénom</p>
							<p class="info-recrue-item-content"><label id="info-recrue-prenom"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-user info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Nom</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-nom"></label></p>
						</div>
					</div>
					
				</div>
				<div class="row info-recrue-row" >
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-id-card info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">C.I.N</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-cin"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-map-marker-alt info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Résidence</p>
							<p class="info-recrue-item-content"><label id="info-recrue-residence"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-restroom info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Sexe</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-sexe"></label></p>
						</div>
					</div>
					
				</div>
				<div class="row info-recrue-row" >
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-calendar-alt info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Date de naissance</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-naissance"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-calendar-alt info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Date de recrutement</p>
							<p class="info-recrue-item-content"><label id="info-recrue-recrutement"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-envelope-open-text info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Email</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-email"></label></p>
						</div>
					</div>
					
				</div>
				<div class="row info-recrue-row" >
					
					
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-briefcase info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Entité</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-entite"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-briefcase info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Fonction</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-fonction"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-home info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Statut familial</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-statut"></label></p>
						</div>
					</div>
				</div>
				<div class="row info-recrue-row" >
					
					
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-map-marker-alt info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Lieu de naissance</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-lieunaissance"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-map-marker-alt info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Adresse</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-adresse"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-phone-volume info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Tèl</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-tel"></label></p>
						</div>
					</div>
				</div>
				<div class="row info-recrue-row" >
					
					
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-file info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Type contrat</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-contrat"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-university info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Banque</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-banque"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-money-check-alt info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">RIB</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-rib"></label></p>
						</div>
					</div>
				</div>
				<div class="row info-recrue-row" >
					
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-file info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Diplome</p>
							<p class="detail-affaire-item-content"><label id="info-recrue-diplome"></label></p>
						</div>
					</div>
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-download info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Telecharger Diplome</p>
							<p class="detail-affaire-item-content" id="download-diplome"></p>
						</div>
					</div>
					
					<div class="row info-recrue-item col-6 col-md-4">
						<div class="col-2">
							<i class="fas fa-download info-recrue-icons fa-lg"></i>
						</div>
						<div class="col-10">
							<p class="info-recrue-item-title">Télécharger contrat</p>
							<p class="detail-affaire-item-content" id="download-contrat"></p>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-6 col-sm-2 ml-auto">
						<button type="button" class="btn btn-info btn-sm btn-block" id="edit-recrue-btn">Modifier</button>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal fade "  tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false" id="edit-recrue-modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-emplacement-label">Modifier Collaborateur</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:white;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url()?>Employes/editEmploye" method="post" id="edit-employe-form">
					<div class="form-row justify-content-left">
						<div class="form-group col-6 col-md-3">
							<label for="employe-editphoto">Photos</label>
							<div class="input-group input-group-sm">

								<input type="file" class="form-control dropify" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="5M" id="employe-editphoto" name="employe-photo" data-height="100" />

							</div>

						</div>
						<div class="form-group col-6 col-md-3 ml-auto">
							<label for="employe-editMatricule">Matricule</label>
							<input type="text" name="employe-matricule" id="employe-editMatricule" readonly class="form-control-plaintext">

						</div>
					</div>
					<div class="form-row col-12">
						<div class="form-row" style="width:100%;">
							<div class="form-group col-md-3 mr-md-auto">
								<label for="employe-editprenom">Prénom<span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input type="text" class="form-control" id="employe-editprenom" name="employe-prenom" placeholder="Prenom"  required>
								</div>

							</div>
							<div class="form-group col-md-3 mr-md-auto">
								<label for="employe-editnom">Nom<span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input  type="text" class="form-control" id="employe-editnom" placeholder="Nom" required name="employe-nom">
								</div>

							</div>
							<div class="form-group col-md-3 mr-md-auto">
								<label for="employe-editcin">C.I.N<span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-id-card"></i></span>
									</div>
									<input  type="text" class="form-control" id="employe-editcin" placeholder="CIN" name="employe-cin" required>
								</div>

							</div>
							<div class="form-group col-md-3 mr-md-auto">
								<label for="employe-editresidence">Résidence<span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
									</div>
									<select class="custom-select" id="employe-editresidence" name="employe-residence">
										<?php
										foreach ($villes as $value) {
											echo '<option value="'.$value['ville'].'">'.$value['ville'].'</option>';
										}

										?>

									</select>
								</div>

							</div>

						</div>
						<div class="form-row" style="width:100%;">

							<div class="form-group col-md-3 mr-md-auto">
								<label for="employe-editsexe">Sexe<span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-restroom"></i></span>
									</div>
									<select class="custom-select" id="employe-editsexe" name="employe-sexe">
										<option selected value="M">M</option>
										<option value="F">F</option>

									</select>

								</div>

							</div>	
							<div class="form-group col-md-4 mr-md-auto">
								<label for="employe-editdate-naissance">Date naissance<span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
									</div>
									<input type="date" class="form-control" id="employe-editdate-naissance" placeholder="23/05/1999" required  name="employe-date-naissance">
								</div>

							</div>

							<div class="form-group col-md-5 mr-md-auto">
								<label for="employe-editdate-recrutement">Date de recrutement<span style="font-weight: bold;color:red;">*</span></label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
									</div>
									<input type="date" class="form-control" id="employe-editdate-recrutement" name="employe-date-recrutement" placeholder="23/05/2016" required >
								</div>

							</div>


						</div>
					</div>
					<div class="form-row" style="width:100%;">
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-editemail">Email <span style="font-weight: bold;color:red;">*</span></label>
							<div class="input-group input-group-sm">

								<input type="email" class="form-control" id="employe-editemail" name="employe-email" placeholder="votre Email ici" required>
							</div>

						</div>
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-editetablissement">Entité<span style="font-weight: bold;color:red;">*</span></label>
							<div class="input-group input-group-sm">

								<select class="custom-select employe-etablissement-list" id="employe-editetablissement" name="employe-etablissement" >
								</select>
							</div>
						</div>
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-editfonction">Fonction<span style="font-weight: bold;color:red;">*</span></label>
							<div class="input-group input-group-sm">

								<select class="custom-select employe-fonction-list" id="employe-editfonction" name="employe-fonction" >

								</select>
							</div>
						</div>
					</div>
					<div class="form-row" style="width:100%;">
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-editsituation">Statut familial</label>
							<div class="input-group input-group-sm">

								<select class="custom-select" id="employe-editsituation" name="employe-situation">
									<option selected value="Célebataire">Célebataire</option>
									<option value="Marié">Marié</option>
									<option value="Divorcé">Divorcé</option>
									<option value="Remarié">Remarié</option>
									<option value="Veuf">Veuf</option>
								</select>

							</div>

						</div>
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-editlieu-naissance">Lieu de naissance</label>
							<div class="input-group input-group-sm">

								<select class="custom-select" id="employe-editlieu-naissance" name="employe-lieu-naissance">
									<?php
									foreach ($villes as $value) {
										echo '<option value="'.$value['ville'].'">'.$value['ville'].'</option>';
									}

									?>
								</select>
							</div>

						</div>
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-editadresse">Adresse</label>
							<div class="input-group input-group-sm">

								<input type="text" class="form-control" id="employe-editadresse" name="employe-adresse" placeholder="adresse">

							</div>

						</div>
					</div>
					<div class="form-row" style="width:100%;">
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-edittel">Tèl :</label>
							<div class="input-group input-group-sm">

								<input type="text" class="form-control" id="employe-edittel" name="employe-tel" placeholder="0625325478">
							</div>

						</div>
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-edittype-contrat">type contrat</label>
							<div class="input-group input-group-sm">

								<select class="custom-select" id="employe-edittype-contrat" name="employe-type-contrat">
									<?php
									foreach ($contrats as $value) {
										echo '<option value="'.$value['code_contrat'].'">'.$value['libelle'].'</option>';
									}
									?>
								</select>
							</div>

						</div>
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-editscan-contrat">Scan Contrat</label>
							<div class="input-group input-group-sm">

								<div class="custom-file">
									<input type="file" class="custom-file-input" id="employe-editscan-contrat" name="employe-scan-contrat" accept="application/pdf">
									<label class="custom-file-label" for="employe-editscan-contrat">Selectionner fichier</label>
								</div>

							</div>

						</div>
					</div>
					<div class="form-row" style="width:100%;">
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-editdiplome">Diplome</label>
							<div class="input-group input-group-sm">

								<input type="text" class="form-control" id="employe-editdiplome" name="employe-diplome" placeholder="ex: DUT en Genie Civil">
							</div>
						</div>
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-editscan-diplome">Scan Diplome</label>
							<div class="input-group input-group-sm">

								<div class="custom-file">
									<input type="file" accept="application/pdf" class="custom-file-input" id="employe-editscan-diplome" name="employe-scan-diplome">
									<label class="custom-file-label" for="employe-editscan-diplome">Selectionner fichier</label>
								</div>

							</div>

						</div>
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-editbanque">banque</label>
							<div class="input-group input-group-sm">

								<input type="text" class="form-control" id="employe-editbanque" name="employe-banque" placeholder="banque xxxx, agence hay karima">
							</div>

						</div>
					</div>
					<div class="form-row" style="width:100%;">
						<div class="form-group col-md-4 mr-md-auto">
							<label for="employe-editrib">Compte Bancaire (RIB)</label>
							<div class="input-group input-group-sm">

								<input type="text" class="form-control" id="employe-editrib" name="employe-rib" placeholder="RIB">
							</div>

						</div>
						<div class="row col-md-6" style="width: 100%;margin:0;padding: 0;">

							
							<div class="mt-auto ml-auto">
								<button type="submit" class="btn btn-info btn-sm btn-block" id="Btn-edit-Employe">Modifier</button>
							</div>
						</div>
					</div>

				</form>

			</div>

		</div>
	</div>
</div>


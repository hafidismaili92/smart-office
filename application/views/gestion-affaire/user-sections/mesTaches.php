<section id="mesTaches-section" class="principal-sections hidden_section">
	<div class="container-fluid" style="height: 100%;">
		<div class="row" style="height: 100%;">
			<div class="col-12 col-md-8 " id ="taches-container">
				
				<div class="taches-card-body" >
					<div class="taches-header-titles" id="taches-list">
						<h5>Mes Tâches</h5>
						<p class="sub-title">Suivi de vos tâches</p>
					</div>
					<div class="taches-body">
						<div id="table-taches-menu">
							<div class="row" >
								<div class="col-6" style="display: flex;flex-direction: row;justify-content: left;">
									<span style="line-height: 34px;">Afficher</span>
									<select class="form-control" style="max-width: 80px;height: 30px;" id="taches-table-length">
										<option>15</option>
										<option>50</option>
										<option>100</option>
									</select>
									<span  style="margin-left: 10px;line-height: 34px;">Page</span>
								</div>
								
								<div class="col-6 ml-auto" id="searchtaches-group" style="display: flex;justify-content: flex-end;">
									<div style="display: flex;flex-direction: row;">
										<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
										<input id="search-taches" type="text" class="form-control" style="flex-grow: 1;height: 30px;max-width: 200px !important;border-radius: 20px;">
									</div>	

								</div>
								
							</div>
						</div>
						<div id="taches-table-container">
							<table id="taches-table" class="table dt-responsive nowrap" style="width: 100%;">
								<thead>
									<tr>
										<th></th>
										<th>Identifiant</th>
										<th>Libelle</th>
										<th>Numero Affaire</th>
										<th>Creer Par </th>
										<th>Avancement</th>
										<th>Date Création</th>
										<th>Délai</th>
										<th>Date Fin prévue</th>
										<th>Date de validation</th>
										<th>Niveau</th>
										<th>Tache Mère</th>
										<th>validite</th>
										<th>Créateur</th>
										<th>Observations</th>
										<th>consultée</th>
									</tr>

								</thead>

							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-4  " id ="mission-detail-container">
				<div class="taches-card-body"  style="flex-grow: 1;">
					<div class="taches-header-titles" id="taches-details-list">
						<h5>Tâche</h5>
						<p class="sub-title">Détails</p>
					</div>
					<div id="tache-detail-box">
						<div class="row tache-detail-box">

							<div class="detail-tache-item col-6">
								
									<p  class="detail-tache-item-title" style="margin:0;">Avancement:</p>
									<p  class="detail-tache-item-content" ><input type="number" id="tache-avancement" name="tache-avancement" min="0" max="100"> %</p>
								
							</div>
							<div class="col-6" style="display: flex;flex-direction: column;justify-content: center;">
								<button type="button" class="btn btn-outline-info btn-sm" id="mise-ajour-tache">Mettre à jour</button>
							</div>
						</div>
						<div class="row tache-detail-box">

							<div class="detail-tache-item col-12">
								<div class="col-12">
									<p  class="detail-tache-item-title">Numéro</p>
									<p  class="detail-tache-item-content"><label id="tache-num"></label></p>
								</div>
							</div>


							<div class="detail-tache-item col-12">
								<div class="col-12">
									<p  class="detail-tache-item-title">Labellé</p>
									<p  class="detail-tache-item-content"><label id="tache-label"></label></p>
								</div>
							</div>
						</div>
						<div class="row tache-detail-box">

							<div class="detail-tache-item col-12">
								<div class="col-12">
									<p  class="detail-tache-item-title">Crée Par </p>
									<p  class="detail-tache-item-content"><label id="tache-createur"></label></p>
								</div>
							</div>


							<div class="detail-tache-item col-12">
								<div class="col-12">
									<p  class="detail-tache-item-title">Date de création </p>
									<p  class="detail-tache-item-content"><label id="tache-date-creation"></label></p>
								</div>
							</div>
						</div>
						
						<div class="row tache-detail-box">

							<div class="detail-tache-item col-12">
								<div class="col-12">
									<p  class="detail-tache-item-title">Date de Fin prévue </p>
									<p  class="detail-tache-item-content"><label id="tache-date-finPrevue"></label></p>
								</div>
							</div>


							<div class="detail-tache-item col-12">
								<div class="col-12">
									<p  class="detail-tache-item-title">Etat</p>
									<p  class="detail-tache-item-content"><label id="tache-etat"></label></p>
								</div>
							</div>
						</div>
						<div class="row tache-detail-box">

							<div class="detail-tache-item col-12">
								<div class="col-12">
									<p  class="detail-tache-item-title">Date de validation </p>
									<p  class="detail-tache-item-content"><label id="tache-validation-date"></label></p>
								</div>
							</div>


							<div class="detail-tache-item col-12">
								<div class="col-12">
									<p  class="detail-tache-item-title">Affaire </p>
									<p  class="detail-tache-item-content"><label id="tache-affaire"></label></p>
								</div>
							</div>
							<div class="detail-tache-item col-12">
								<div class="col-12">
									<p  class="detail-tache-item-title">Observations:</p>
									<p  class="detail-tache-item-content" id="taches-observation"></p>
								</div>
							</div>
							<div class="detail-tache-item col-12">
								<div class="col-12">
									<p  class="detail-tache-item-title">Attachements:</p>
									<table id="soustache-attach-detail" style="width:100%">
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
<section id="globalAffaires-section" class="principal-sections hidden_section">
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="detail-affaires-tab" data-toggle="tab" href="#detail-affaires" role="tab" aria-controls="information" aria-selected="true">liste des affaires</a>
		</li>
		<!-- <li class="nav-item">
			<a class="nav-link" id="dashboard-globalAFF-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="prix-facture" aria-selected="false">Tableau de bord</a>
		</li> -->

	</ul>
	<div class="tab-content" id="globalAffaires-content" style="margin-top: 20px;">
		<div class="tab-pane fade show active" id="detail-affaires" role="tabpanel" aria-labelledby="Details des affaires">
			<div class="row" style="margin-bottom: 10px;">
				<div class="col-5 col-md-3" style="display: flex;flex-direction: row;justify-content: left;">
					<span style="margin-right: 10px;line-height: 34px;">Afficher</span>
					<select class="form-control" style="min-width: 80px !important;max-width: 80px !important;height: 30px;" id="globalAff-length">
						<option>10</option>
						<option>15</option>
						<option>25</option>
						<option>50</option>
						<option>100</option>
					</select>
					<span  style="margin-left: 10px;line-height: 34px;">Page</span>
				</div>
				<div class="col-7 col-md-5" style="display: flex;flex-direction: row;justify-content: space-between;">
				<div>
					<button class="btn btn-sm btn-secondary refresh-table" data-cible="#globalAffaires-table"><i class="fas fa-sync-alt"></i></button>
				</div>	
				<div style="display: flex;flex-direction: row;justify-content: left;">
					<span style="margin-right: 10px;line-height: 34px;" class="filter-icon"><i class="fa fa-filter"></i></span>
					<span style="margin-right: 10px;line-height: 34px;">Période</span>
					<select class="form-control" style="flex-grow: 1;height: 30px;max-width: 200px !important;" id="globalAff-period">
						<option value="1">Année en cours</option>
						<option value="5" selected>5 dernières années</option>
						<option value="10">10 dernières années </option>
						<option value="0">Tout</option>
					</select>
					</div>
					
				</div>
				<div class="col-12 col-md-4" id="search-group" style="display: flex;flex-direction: row;justify-content: space-between;padding-right: 25px;">
					<div style="display: flex;flex-direction: row;">
						<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
						<input id="search-globalAffaires" type="text" class="form-control" style="flex-grow: 1;height: 30px;max-width: 200px !important;">
					</div>	
									
				</div>
			</div>
			<div id="globalAffaires-tableContainer">
				<table id="globalAffaires-table" class="dt-responsive" style="width: 100%;">
					<thead>
						<tr>
							<th>Affaire</th>
							<th>Libelle</th>	
							<th>Responsable</th>
							<th>Matricule</th>
							<th>Date</th>
							<th>Avancement</th>
							<th>Situation</th>
							<th>Entité</th>
							<th>Fonction</th>
							
							
							
							
						</tr>

					</thead>

				</table>
			</div>
		</div>
		<div class="tab-pane fade show" id="dashboard" role="tabpanel" aria-labelledby="tableau de bord">
			<div class="row">

					<div class="statut-graphic-container col-12 col-md-6">
						
						<div style="width: 100%;height: 300px;position: relative;" class="graphicsContainer">
							<canvas id="globalAffaires-per-statut"></canvas>
						</div>
					</div>
			</div>
		</div>
	</div>
	
	
</section>	

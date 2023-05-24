<section id="mesAffaires-section" class="principal-sections ">
	<div class="container-fluid">
		<div class="row" style="margin-top: 20px;">
			<div class="col-lg-3 col-md-6 col-sm-6 mesAffaires-cards" >
				<div class="card-content global" >

					<div class="card-icon">
						<i class="fas fa-bullseye fa-lg"></i>
					</div>
					<p class="card-category" >Affaires</p>
					<h3 class="card-title" id="count-global-affaires">
						--
					</h3>

				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 mesAffaires-cards" >
				<div class="card-content success" >

					<div class="card-icon">
						<i class="fas fa-check-double fa-lg"></i>
					</div>
					<p class="card-category" >Terminée</p>
					<h3 class="card-title" id="count-terminee-affaires" >
						--
					</h3>

				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 mesAffaires-cards" >
				<div class="card-content current" >

					<div class="card-icon">
						<i class="fas fa-hourglass-half fa-lg"></i>
					</div>
					<p class="card-category" >En cours</p>
					<h3 class="card-title" id="count-enCours-affaires">
						--
					</h3>

				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 mesAffaires-cards" >
				<div class="card-content warning" >

					<div class="card-icon">
						<i class="fas fa-exclamation-triangle fa-lg"></i>
					</div>
					<p class="card-category" >En souffrance</p>
					<h3 class="card-title" id="count-enSouffrance-affaires">
						--
					</h3>

				</div>
			</div>
		</div>

		<div id="table-menu">
			<div style="display: flex;flex-wrap: wrap;justify-content: space-between;">
				<div style="display: flex;flex-direction: row;justify-content: left;">
					<span style="line-height: 34px;">Afficher</span>
					<select class="form-control" style="max-width: 80px;height: 30px;" id="aff-length">
						<option>15</option>
						<option>50</option>
						<option>100</option>
					</select>
					<span  style="margin-left: 10px;line-height: 34px;">Page</span>
				</div>
				<div style="display: flex;flex-direction: row;justify-content: left;margin-left: 20px;">
					<span style="margin-right: 10px;line-height: 34px;" class="filter-icon"><i class="fa fa-filter"></i></span>
					<span style="margin-right: 10px;line-height: 34px;">Période</span>
					<select class="form-control" style="flex-grow: 1;height: 30px;max-width: 150px !important;color:var(--currentText);flex-grow: 1;" id="aff-period">
						<option value="1">Année en cours</option>
						<option value="5" selected>5 dernières années</option>
						<option value="10">10 dernières années </option>
						<option value="0">Tout</option>
					</select>

				</div>
				<div id="searchAff-group" style="display: flex;flex-direction: row;justify-content: space-between;padding: 0px 25px;">
					<div style="display: flex;flex-direction: row;">
						<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
						<input id="search-Affaires" type="text" class="form-control" style="flex-grow: 1;height: 30px;max-width: 150px !important;min-width: 100px !important;border-radius: 20px;">
					</div>	

				</div>
				<div >
					<div id="btns-group">
					<button tabindex="0" aria-controls="affaires-table" type="button" class="btn btn btn-outline-secondary" id="reset-affaire-filter"><span>Réinitialiser</span></button>
						<button tabindex="0" aria-controls="affaires-table" type="button" class="btn btn-outline-info" id="add-affaire-btn"><span>Ajouter</span></button>
					</div>
				</div>
			</div>
		</div>
		<div id="affaires-tableContainer">
			<table id="affaires-table" class="dt-responsive" style="width: 100%;">
				<thead>
					<tr>
						<th><div style="display: flex;justify-content: space-between;">Numéro </th>
						<th><div style="display: flex;justify-content: space-between;">Libellé</th>
						<th><div style="display: flex;justify-content: space-between;">
						<span class="showPopup"><i class="fa fa-filter fa-xs showPopup-icon"></i>
  						<div class="popupContent">
  							<div >
  								De
  								<input type="date" class="form-control date-filter-start" >
  							</div>
  							<div >
  								à
  								<input type="date" class="form-control date-filter-end" >
  							</div>
  							<div class="btns-filter-container">
  								<button class="btn btn-info btn-sm" id="apply-date-affaire-filter">OK</button>
  							</div>
  						</div>
						</span>Date de Création</th>
						<th><div style="display: flex;justify-content: space-between;"><span class="showPopup"><i class="fa fa-filter fa-xs showPopup-icon"></i>
  						<div class="popupContent">
  							<div>
  								<select class="form-control etat-filter-select">
  									<option value="Tout">Tout</option>
  								<option value="En cours">En cours</option>
  								<option value="Terminee">Terminee</option>
  								<option value="En souffrance">En souffrance</option>
  							</select>
  							</div>
  							<div class="btns-filter-container">
  								<button class="btn btn-info btn-sm " id="apply-etat-affaire-filter">OK</button>
  							</div>
  						</div>
						</span> Etat</th>
						<th><div style="display: flex;justify-content: space-between;"><span>Avancement</th>

						<th>#</th>	
					</tr>

				</thead>

			</table>
		</div>
	</div>	
</section>	

<div class="modal fade "  tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false" id="add-affaire-modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Nouvelle Affaire</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:white;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="affaire-form" action="<?php echo base_url(); ?>NouvelleAffaire/ajouterAffaire" method="post">
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
							<label for="delai">Délai (en Jours)</label>
							<input type="numeric" class="form-control" id="delai" name="delai" aria-describedby="delai-aide" placeholder="ex : 120" >
							<small id="delai-aide" class="form-text text-muted">le Délai de l'affaire en Jours calendaires  </small>
						</div>
						<div class="form-group col-6">
							<label for="observations">Observations</label>
							<textarea class="form-control" id="observations" name="observations" rows="2" aria-describedby="observation-aide"></textarea>
							<small id="observation-aide" class="form-text text-muted">observations, avancement, remarques...  </small>
						</div>
					</div>

					<div style="width: 100%;" class="row">
						<div class="col-12 col-sm-2 ml-sm-auto">
							<button type="submit" class="btn btn-danger btn-sm btn-block" id="add-affaire" >Ajouter</button>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

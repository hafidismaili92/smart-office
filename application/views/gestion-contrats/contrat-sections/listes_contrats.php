<section id="listeContrats-section" class="principal-sections">
	<div class="container-fluid">
		<div class="row" style="background-color: #f6f7f9;padding-top: 15px;margin-bottom: 25px;">
			<div class="col-6 col-md-3 liste-contrat-header" >
				<div>
						
						<i class="fas fa-folder-open fa-2x"></i>
					
					<div style="width: 100%;text-align: center;">Contrats</div>
					<div style="width: 100%;text-align: center;color:white;"><span id="contratnbr-list-contrat">......</span></div>
				</div>
			</div>
			<div class="col-6 col-md-3 liste-contrat-header">
				<div>				
						<i class="fas fa-dollar-sign fa-2x"></i>
					
					<div style="width: 100%;text-align: center;">Montant Global</div>
					<div style="width: 100%;text-align: center;color:white;"><span id="contratTotal-list-contrat">......</span></div>
					
				</div>
			</div>
			<div class="col-6 col-md-3 liste-contrat-header" >
				<div>			
						<i class="fas fa-money-bill-wave fa-2x"></i>

					
					<div style="width: 100%;text-align: center;">Montant Encaissé</div>
					<div style="width: 100%;text-align: center;color:white;"><span id="contratPaye-list-contrat">......</span></div>
					
				</div>
			</div>
			<div class="col-6 col-md-3 liste-contrat-header">
				<div>
						
						<i class="fas fa-hand-holding-usd fa-2x"></i>
					
					<div style="width: 100%;text-align: center;">Reste A Payer</div>
					<div style="width: 100%;text-align: center;color:white;"><span id="contratApayer-list-contrat">......</span></div>
					
				</div>
			</div>
		</div>
	</div>
	<div id="ct-table-menu">
			<div class="row" >
				<div class="col-6 col-md-3 col-lg-3" style="display: flex;flex-direction: row;justify-content: left;">
					<span style="line-height: 34px;">Afficher</span>
					<select class="form-control" style="max-width: 80px;height: 30px;" id="ct-aff-length">
						<option>15</option>
						<option>50</option>
						<option>100</option>
					</select>
					<span  style="margin-left: 10px;line-height: 34px;">Page</span>
				</div>
				<div class="col-6 col-md-3 col-lg-3" style="display: flex;flex-direction: row;justify-content: flex-end;">
					<span style="margin-right: 10px;line-height: 34px;" class="filter-icon"><i class="fa fa-filter"></i></span>
					<span style="margin-right: 10px;line-height: 34px;">Période</span>
					<select class="form-control" style="flex-grow: 1;height: 30px;max-width: 200px !important;color:var(--currentText)" id="ct-aff-period">
						<option value="1">Année en cours</option>
						<option value="5" selected>5 dernières années</option>
						<option value="10">10 dernières années </option>
						<option value="0">Tout</option>
					</select>

				</div>
				<div class="col-6 col-md-3 col-lg-6" id="searchAff-group" style="display: flex;flex-direction: row;justify-content: flex-end;padding-right: 25px;">
					<div style="display: flex;flex-direction: row;">
						<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
						<input id="ct-search" type="text" class="form-control" style="flex-grow: 1;height: 30px;max-width: 200px !important;border-radius: 20px;">
					</div>	

				</div>
				
			</div>
			<div class="row">
				<div class="col-6" id="btns-group-addContrat" style="margin-bottom: 5px;">
					
						<button tabindex="0" aria-controls="Contrats-table" type="button" class="btn btn-outline-info btn-sm" id="add-contrat-btn"><span>Ajouter Contrat</span></button>
						<button tabindex="0" aria-controls="affaires-table" type="button" class="btn btn-outline-success btn-sm" id="btn-exportUnpayedFacture"><a href="Contrats/ExportUnpayedFactures" style=" color: inherit; text-decoration: none;"><span>Facture en attente</span></a></button>
					</div>
					<div class="col-6" id="btns-group-exports">
						
					</div>
				
			</div>
		</div>
	<div id="listeContrats-tableContainer">
		<table id="listeContrats-table" class="dt-responsive" width="100%">
			<thead>
				<tr>
					<th>Numero</th>
					<th>Libelle</th>
					<th>Date de Signature</th>	
					<th>Montant TTC</th>
					<th>Réalisation TTC</th>
					<th>% Réalisé</th>
					<th>Réglé TTC</th>
					<th>% Reglement</th>
					<th>Etat</th>
					<th>Client</th>	
					<th>Action</th>
				</tr>

			</thead>
			
		</table>

	</div>
	
</section>	

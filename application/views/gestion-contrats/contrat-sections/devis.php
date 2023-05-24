<section id="devis-section" class="principal-sections hidden_section">
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="noveau-devis-tab" data-toggle="tab" href="#nouveau-devis" role="tab" aria-controls="information" aria-selected="true">Nouveau Devis</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="liste-devis-tab" data-toggle="tab" href="#liste-devis" role="tab" aria-controls="prix-facture" aria-selected="false">Liste des Devis</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="edit-devis-tab" data-toggle="tab" href="#edit-devis" role="tab" aria-controls="editer-devis" aria-selected="false">Modifier un devis</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade show active" id="nouveau-devis" role="tabpanel" aria-labelledby="nouveau-devis">
			<div class="container-fluid">
				<form id="nouveau-devis-form" action="<?php echo base_url(); ?>Devis/addDevis" method="post">
					<div class="form-row">
						<div class="form-group col-sm-8 col-lg-5">
							<label for="objet-devis">Objet</label>
							<input type="text" class="form-control" id="objet-devis" name="objet-devis" aria-describedby="objet-devis-aide" placeholder="objet-devis" required>

						</div>
						<div class="form-group col-12 col-sm-4 col-lg-3">
							<label for="client-devis">Client</label>
							<input type="text" class="form-control" id="client-devis" name="client-devis" aria-describedby="client-devis-aide" placeholder="client-devis" required>
							
						</div>
						<div class="form-group col-8  col-lg-2">
							<label for="devis-tva">TVA en %</label>
							<input class="form-control" id="devis-tva" name="devis-tva" required value="20" type="number" max="100" min="0">
							<small id="devis-aide" class="form-text text-muted">20% par défaut</small>
						</div>
						<div class="form-group  col-4 col-lg-2" style="position: relative;">
							<button type="submit" class="btn  btn-danger" style="position: absolute;bottom: 25%;">Créer Devis</button>
						</div>
					</div>
					<div style="width: 100%;border-bottom: 1px solid #c5510d;text-align: left;color: gray;margin-bottom: 10px;padding: 5px 10px 10px 0;">
						<span>Tableau des Prix</span>
					</div>
					<div class="form-row" id="devis-prix-data-container">
						<div class="form-group col-sm-6 col-md-2">
							<label for="numero-prix-devis">Numéro</label>
							<input type="text" class="form-control form-control-sm prix-field" id="numero-prix-devis"  placeholder="Numéro">
						</div>
						<div class="form-group col-sm-6 col-md-3">
							<label for="libelle-prix-devis">Libellé</label>
							<input class="form-control form-control-sm prix-field" id="libelle-prix-devis">
						</div>

						<div class="col-sm-6 col-md-3">
							<label for="unite-prixe-devis">Unité</label>

							<select class="custom-select prix-field" id="unite-prix-devis" style="font-size: 12px;">
								<?php
								foreach ($unites as $value) {
									echo '<option value="'.$value['code'].'">'.$value['libelle'].' ('.$value['code'].')</option>';
								}

								?>
							</select>
						</div>
						<div class="form-group col-sm-6 col-md-1">
							<label for="prix-prix-devis">Prix.U</label>
							<input class="form-control form-control-sm prix-field" type ="number" id="prix-prix-devis" min="0">
							<small>En DH HT</small>
						</div>
						<div class="form-group col-sm-6 col-md-1">
							<label for="quantite-prix-devis">Quantite</label>
							<input class="form-control form-control-sm prix-field" type ="number" id="quantite-prix-devis" min="0">
						</div>
						<div class="form-group col-2" style="display: flex;flex-direction: row;height: 50%;justify-content: space-between;padding-top: 20px;">

							<button class="btn btn-outline-danger " type="button" id="btn-add-prix-devis"><i class="fas fa-plus"></i></button>
							<span class="btn btn-outline-success " type="button" id="import-prix-devis" style="position: relative;"><i class="fas fa-file-excel">
							</i><input type="file" id="prix-devis-xls-file" accept=" application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="position: absolute;max-height: 100%;min-height: 100%;top: 0;right: 0;opacity: 0;width:100%;"></span>
							<button class="btn btn-outline-info " type="button" id="btn-removeAllprix-devis"><i class="fas fa-trash"></i></button>
						</div>

					</div>
					<hr style="margin:0;">
					<div style="width: 100%;margin: 0;background-color: rgba(220, 219, 219, 0.57);height: 30px;display: flex;justify-content:space-around;font-size: 16px;margin-bottom: 2px;">
						<div class="titlePrixFont ">TOTAL HT :<span style="color: #bd0a1ba1;" id="total-ht-devis">0,00</span><span style="color: #bd0a1ba1;">DH HT</span></div>
						<div class="titlePrixFont ">TOTAL TTC :<span style="color: #007bffb8;" id="total-ttc-devis">0,00</span><span style="color: #007bffb8;">DH TTC</span></div>
					</div> 
					<div style="margin-top: 35px;display: flex;">
						<div style="display: flex;flex-direction: row;justify-content: left;flex-grow: 1;">
							<span style="line-height: 34px;">Afficher</span>
							<select class="form-control" style="max-width: 80px;height: 30px;" id="addDevis-aff-length">
								<option>15</option>
								<option>50</option>
								<option>100</option>
							</select>
							<span  style="margin-left: 10px;line-height: 34px;">Page</span>
						</div>
						<div id="searchaddDevis-group" style="display: flex;flex-direction: row;justify-content: flex-end;padding-right: 25px;">
							<div style="display: flex;flex-direction: row;">
								<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
								<input id="addDevis-search" type="text" class="form-control" style="flex-grow: 1;height: 30px;max-width: 200px !important;border-radius: 20px;">
							</div>	

						</div>
					
					</div>
					<table id="nouveau-devis-table" style="width: 100%;" class="dt-responsive" >
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
				</form>
			</div>
		</div>
		<div class="tab-pane fade" id="liste-devis" role="tabpanel" aria-labelledby="liste-devis" style="max-height: 500px;overflow-y: scroll;">
			<div style="margin-top: 35px;display: flex;">
						<div style="display: flex;flex-direction: row;justify-content: left;flex-grow: 1;">
							<span style="line-height: 34px;">Afficher</span>
							<select class="form-control" style="max-width: 80px;height: 30px;" id="devis-aff-length">
								<option>15</option>
								<option>50</option>
								<option>100</option>
							</select>
							<span  style="margin-left: 10px;line-height: 34px;">Page</span>
						</div>
						<div id="searchDevis-group" style="display: flex;flex-direction: row;justify-content: flex-end;padding-right: 25px;">
							<div style="display: flex;flex-direction: row;">
								<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
								<input id="devis-search" type="text" class="form-control" style="flex-grow: 1;height: 30px;max-width: 200px !important;border-radius: 20px;">
							</div>	

						</div>
						<div id="btns-devis-exports">
						
					</div>

					</div>
			<table id="liste-devis-table" class="dt-responsive">
				<thead>
					<tr>
						
						<th>Numero</th>
						<th>Objet</th>
						<th>Montant TTC</th>
						<th>Client</th>
						<th>Date edition</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="edit-devis" role="tabpanel" aria-labelledby="editer-devis" style="max-height: 500px;overflow-y: scroll;">
			
		</div>
	</div>

</section>
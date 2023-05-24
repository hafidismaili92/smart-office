<section id="listeFacture-section"  class="hidden_section">
	<div class="container">
		<div class="row" style="background-color: #f6f7f9;padding-top: 15px;margin-bottom: 25px;">
			<div class="col-3 liste-facture-header">
				<div>
					<div style="width: 100%;text-align: center;text-align: left;padding-left:20px;">
						
						<i class="fas fa-folder-open fa-2x" style="color:#003049;"></i>
					</div>
					<div style="width: 100%;text-align: center;">N°</div>
					<div style="width: 100%;text-align: center;color:#003049; "><span id="contratnum-list-facture">......</span></div>
				</div>
			</div>
			<div class="col-3 liste-facture-header">
				<div>
					<div style="width: 100%;text-align: center;text-align: left;padding-left:20px;">
						
						<i class="fas fa-dollar-sign fa-2x" style="color:#FCBF49;"></i>
					</div>
					<div style="width: 100%;text-align: center;">Montant Contrat</div>
					<div style="width: 100%;text-align: center;color:#FCBF49;"><span id="contratTotal-list-facture">......</span></div>
					
				</div>
			</div>
			<div class="col-3 liste-facture-header">
				<div>
					<div style="width: 100%;text-align: center;text-align: left;padding-left:20px;">
						
						<i class="fas fa-money-bill-wave fa-2x" style="color:#F77F00;"></i>

					</div>
					<div style="width: 100%;text-align: center;">Montant Payé</div>
					<div style="width: 100%;text-align: center;color:#F77F00;"><span id="contratPaye-list-facture">......</span></div>
					
				</div>
			</div>
			<div class="col-3 liste-facture-header">
				<div>
					<div style="width: 100%;text-align: center;text-align: left;padding-left:20px;">
						
						<i class="fas fa-hand-holding-usd fa-2x" style="color:#D62828;"></i>
					</div>
					<div style="width: 100%;text-align: center;">A Payer</div>
					<div style="width: 100%;text-align: center;color:#D62828;"><span id="contratApayer-list-facture">......</span></div>
					
				</div>
			</div>
		</div>
	</div>
		<div style="margin-top: 35px;display: flex;">
				<div style="display: flex;flex-direction: row;justify-content: left;flex-grow: 1;">
					<span style="line-height: 34px;">Afficher</span>
					<select class="form-control" style="max-width: 80px;height: 30px;" id="facture-aff-length">
						<option>15</option>
						<option>50</option>
						<option>100</option>
					</select>
					<span  style="margin-left: 10px;line-height: 34px;">Page</span>
				</div>
				<div id="searchFacture-group" style="display: flex;flex-direction: row;justify-content: flex-end;padding-right: 25px;">
					<div style="display: flex;flex-direction: row;">
						<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
						<input id="facture-search" type="text" class="form-control" style="flex-grow: 1;height: 30px;max-width: 200px !important;border-radius: 20px;">
					</div>	

				</div>
				<div id="btns-group-listeFacture">
				</div>
				
			</div>

	<table id="listeFacture-table" class="dt-responsive" width="100%">
		<thead>
			<tr>
				<th></th>
				<th></th>
				<th>Num</th>
				<th>Numero</th>
				<th>Date Effet</th>
				<th>Montant TTC</th>
				<th>Montant Cumulé TTC</th>
				<th>Avancement Contrat</th>
				<th>Etat</th>
				<th>Télechargement</th>
				<th>Action</th>

			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>

</section>
<div class="modal" tabindex="-1" role="dialog" id="modal-change-facture-etat">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Change l'état de la Facture  <span id="num-facture-etat" style="display: none"></span><span id="numannee-facture-etat" ></span><span id="num-contratfacture-etat" style="display: none"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-row">

					<div class="col-12 col-sm-6">
						<label>Selectionner l'Etat</label>

						<select class="custom-select" id="facture-etat-selector" name="facture-etat-selector" style="font-size: 12px;">

							<?php
							foreach ($etatFacture as $value) {
								echo '<option value="'.$value['code'].'">'.$value['designation'].'</option>';
							}

							?>

						</select>
					</div>
				</div>
				<div class="form-row" style="display: none;">
					<div class="col-12">
						<label>Motif</label>
					</div>
					<div class="col-12">
						<input type="text" name="motif-refus-facture" id="motif-refus-facture" style="width: 100%;">
					</div>
				</div>
				<div class="form-row" style="display: none;">
					<div class="col-12">
						<label>Date de Règlement</label>
					</div>
					<div class="col-12">

						<input type="date" name="date-regle-facture" id="date-regle-facture"  value="<?php echo date("Y-m-d"); ?>">
					</div>
					<div class="col-12">
						<label>Mode de Paiement</label>
					</div>
					<div class="col-12">
						<select class="custom-select" id="facture-mode-paiement" name="facture-mode-paiement" style="font-size: 12px;">

							<?php
							foreach ($modePayement as $value) {
								echo '<option value="'.$value['code'].'">'.$value['designation'].'</option>';
							}

							?>

						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn-update-facture-etat">Confirmer</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade "  tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false" id="detail-facture-modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #2C5364;color: white;">
				<h5 class="modal-title">Detail Facture</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:white;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="info-facture-tab" data-toggle="tab" href="#info-facture" role="tab" aria-controls="information" aria-selected="true">Information Facture</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="prix-facture-tab" data-toggle="tab" href="#prix-facture" role="tab" aria-controls="prix-facture" aria-selected="false">Liste des prix</a>
					</li>
					
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade show active" id="info-facture" role="tabpanel" aria-labelledby="info">
						<div class="container">
							<div class="row">
								<div class="col-12 col-sm-6">
									<div style="width: 100%;border-bottom: 1px solid #c5510d;text-align: left;color: gray;margin-bottom: 10px;padding: 5px 10px 10px 0;">
										<span>Info Facture</span>
									</div>
									<ul style="list-style: none;padding-left: 10px;">
										<li style="display: none;">
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fas fa-list-ol detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Numéro</p>
													<p  class="detail-facture-item-content" id="item-facture-numero"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fas fa-list-ol detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Numéro</p>
													<p  class="detail-facture-item-content" id="item-facture-numeroannee"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fas fa-calendar-alt detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Date Effet</p>
													<p  class="detail-facture-item-content" id="item-facture-date"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fas fa-dollar-sign detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Montant TTC</p>
													<p  class="detail-facture-item-content" id="item-facture-montantTTC"></p>
												</div>
											</div>
											
										</li>
										
										<li>

											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fas fa-cog detail-facture-icons fa-lg"></i>

												</div>
												<div class="col-8">
													<p  class="detail-contrat-item-title">Etat</p>
													<p  class="detail-contrat-item-content" id="item-facture-etat"></p>
												</div>
												<div class="col-2">
													<i class="fas fa-edit detail-facture-icons fa-lg" style="color:#c52828" id="edit-facture-etat"></i>

												</div>
											</div>

										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fas fa-file-import detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Acusée de Dépot</p>
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="scan-accuse-facture" name="scan-accuse-facture" accept="application/pdf" >
														<label class="custom-file-label" for="scan-fiche-conge">Selectionner le Fichier</label>
													</div>
													
												</div>
											</div>
											
										</li>
									</ul>
								</div>
								<div class="col-12 col-sm-6">
									<div style="width: 100%;border-bottom: 1px solid #8fc50d;text-align: left;color: gray;margin-bottom: 10px;padding: 5px 10px 10px 0;">
										<span>Info Contrat (à la Date Effet)</span>
									</div>
									<ul style="list-style: none;padding-left: 10px;">
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fas fa-list-ol detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Numéro</p>
													<p  class="detail-facture-item-content" id="item-facture-numeroContrat"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fas fa-dollar-sign detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Montant Contrat TTC</p>
													<p  class="detail-facture-item-content" id="item-facture-montantContratTTC"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fas fa-calculator detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Montant Cumulé TTC</p>
													<p  class="detail-facture-item-content" id="item-facture-cumuleTTC"></p>
												</div>
											</div>
											
										</li>
										<li>
											
											<div class="row detail-facture-item">
												<div class="col-2">
													<i class="fas fa-percent detail-facture-icons fa-lg"></i>
												</div>
												<div class="col-10">
													<p  class="detail-facture-item-title">Avancement</p>
													<p  class="detail-facture-item-content" id="item-facture-avancement"></p>
												</div>
											</div>
											
										</li>
										
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="prix-facture" role="tabpanel" aria-labelledby="prix-facture-tab" style="max-height: 500px;overflow-y: scroll;">
						<table id="prix-facture-detailTable">
							<thead>
								<tr>
									<th></th>
									<th>Numero</th>
									<th>Designation</th>
									<th>Unite</th>
									<th>Prix unitaire EN DH</th>
									<th>Quantite</th>
									<th>TOTAL DH HT</th>
									
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
					
				</div>
			</div>

		</div>
	</div>
</div>
<section id="addclient-section" class="principal-sections hidden_section">
	<div style="width: 100%;padding-left: 25px;padding-right: 25px;background: #2980b9; background: -webkit-linear-gradient(to bottom, #2980b9, #2c3e50);background: linear-gradient(to bottom, #2980b9, #2c3e50); display: flex;justify-content:space-between;font-size: 16px;margin-bottom: 60px;">
		<div style="flex-grow: 3;line-height: 50px;font-family: Arial, Helvetica, sans-serif;font-size: 0.9em;letter-spacing: 2px;color: white;font-weight: 700;text-decoration: none;font-style: normal;font-variant: normal;text-transform: uppercase;">Liste Des Clients</div>
	</div>
	<div style="margin-top: 35px;display: flex;">
		<div style="display: flex;flex-direction: row;justify-content: left;flex-grow: 1;">
			<span style="line-height: 34px;">Afficher</span>
			<select class="form-control" style="max-width: 80px;height: 30px;" id="client-length">
				<option>15</option>
				<option>50</option>
				<option>100</option>
			</select>
			<span  style="margin-left: 10px;line-height: 34px;">Page</span>
		</div>
		<div id="searchClient-group" style="display: flex;flex-direction: row;justify-content: flex-end;padding-right: 25px;">
			<div style="display: flex;flex-direction: row;">
				<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
				<input id="client-search" type="text" class="form-control" style="flex-grow: 1;height: 30px;max-width: 200px !important;border-radius: 20px;">
			</div>	

		</div>
		<div id="btns-client-exports">

		</div>

	</div>
	<div id="client-array-container" style="margin-top: 30px;">
		<table id="clients-table" class="dt-responsive" style="width: 100%;">
			<thead>
				<tr>
					<th>Identifiant</th>
					<th>Libellé</th>
					<th>tel</th>
					<th>Fax</th>
					<th>Email</th>
					<th>Representant</th>
					<th>Adresse</th>
					<th>ICE</th>
					<th>Date Ajout</th>
					<th>Action</th>

				</tr>

			</thead>
			
		</table>
	</div>
</section>

<div class="modal fade "  tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false" id="add-client-modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-emplacement-label">Nouveau Client</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:white;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url()?>Clients/addclient" method="post" id="nouveau-client-form">

					<div class="form-row">

						<div class="form-group col-md-4 mr-md-auto">
							<label for="client-Libelle">Nom</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" class="form-control" id="client-nom" name="client-nom" required>
							</div>

						</div>
						<div class="form-group col-md-4 mr-md-auto">
							<label for="client-identifiant">Identifiant</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
								</div>
								<input type="text" class="form-control" id="client-identifiant" name="client-identifiant" placeholder="CIN, N°regitre,...." required>

							</div>

						</div>
						<div class="form-group col-md-4 mr-md-auto">
							<label for="client-representant">Representant</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" class="form-control" id="client-representant" name="client-representant" required>
							</div>

						</div>

					</div>
					<div class="form-row">

						<div class="form-group col-md-6 mr-md-auto">
							<label for="client-email">Email</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text">@</span>
								</div>
								<input type="email" class="form-control" id="client-email" name="client-email" placeholder="banque xxxx, agence hay karima" required>
							</div>

						</div>
						<div class="form-group col-md-6 mr-md-auto">
							<label for="client-tel">Tèl :</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
								</div>
								<input type="text" class="form-control" id="client-tel" name="client-tel" placeholder="0625325478" required>
							</div>

						</div>
						<div class="form-group col-md-6 mr-md-auto">
							<label for="client-Fax">Fax :</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
								</div>
								<input type="text" class="form-control" id="client-fax" name="client-fax" placeholder="0625325478">
							</div>

						</div>
						<div class="form-group col-md-6 mr-md-auto">
							<label for="client-adresse">Adresse</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
								</div>
								<input type="text" class="form-control" id="client-adresse" name="client-adresse" placeholder="adresse" required>

							</div>

						</div>
						<div class="client-ice">
							<label for="client-adresse">ICE</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
								</div>
								<input type="text" class="form-control" id="client-ice" name="client-ice" placeholder="ICE" required="">

							</div>
						</div>
						<div class="row" style="width: 100%;margin-top:10px;padding: 0;">
							<div class="col-3 ml-md-auto" style="margin:0;padding: 0;">
								<button type="submit" class="btn btn-secondary btn-sm btn-block" id="Btn-ajouter-client">Ajouter</button>
							</div>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

<div class="modal fade "  tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false" id="edit-client-modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modifier Client</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:white;">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url()?>Clients/editclient" method="post" id="edit-client-form">

					<div class="form-row">

						<div class="form-group col-md-4 mr-md-auto">
							<label for="edit-client-Libelle">Nom</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" class="form-control" id="edit-client-nom" name="client-nom" required>
							</div>

						</div>
						<div class="form-group col-md-4 mr-md-auto">
							<label for="edit-client-identifiant">Identifiant</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
								</div>
								<input type="text" class="form-control" id="edit-client-identifiant" name="client-identifiant" placeholder="CIN, N°regitre,...." required>
								<input type="text" readOnly class="form-control" id="ancien-client-identifiant" name="ancien-client-identifiant" style="display: none;">
							</div>

						</div>
						<div class="form-group col-md-4 mr-md-auto">
							<label for="edit-client-representant">Representant</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" class="form-control" id="edit-client-representant" name="client-representant" required>
							</div>

						</div>

					</div>
					<div class="form-row">

						<div class="form-group col-md-6 mr-md-auto">
							<label for="edit-client-email">Email</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text">@</span>
								</div>
								<input type="email" class="form-control" id="edit-client-email" name="client-email" placeholder="" required>
							</div>

						</div>
						<div class="form-group col-md-6 mr-md-auto">
							<label for="edit-client-tel">Tèl :</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
								</div>
								<input type="text" class="form-control" id="edit-client-tel" name="client-tel" placeholder="0625325478" required>
							</div>

						</div>
						<div class="form-group col-md-6 mr-md-auto">
							<label for="edit-client-Fax">Fax :</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
								</div>
								<input type="text" class="form-control" id="edit-client-fax" name="client-fax" placeholder="0625325478">
							</div>

						</div>
						<div class="form-group col-md-6 mr-md-auto">
							<label for="edit-client-adresse">Adresse</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
								</div>
								<input type="text" class="form-control" id="edit-client-adresse" name="client-adresse" placeholder="adresse" required>

							</div>

						</div>
						<div class="client-ice">
							<label for="edit-client-adresse">ICE</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
								</div>
								<input type="text" class="form-control" id="edit-client-ice" name="client-ice" placeholder="ICE" required="">

							</div>
						</div>
						<div class="row" style="width: 100%;margin-top:10px;padding: 0;">
							<div class="col-3 ml-md-auto" style="margin:0;padding: 0;">
								<button type="submit" class="btn btn-secondary btn-sm btn-block" id="Btn-edit-client">Modifier</button>
							</div>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>


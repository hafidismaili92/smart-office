<section id="profilEntreprise-section" class="principal-sections hidden_section">
	<div class="row justify-content-center">
		<div class="form-group col-3">
			
			<div class="input-group input-group-sm">
				<input type="file" class="form-control" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="1M" id="entreprise-logo-update" data-height="100" <?php echo isset($img)?'data-default-file="'.$img.'"':null?> />

			</div>

		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-6">

			<ul style="list-style: none;padding-left: 10px;">

				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fas fa-tags detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Nom</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-nom"></p>
						</div>
						<div class="col-2">
							<i class="fas fa-edit detail-entreprise-icons edit-entreprise"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fas fa-at detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">E-mail</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-mail"></p>
						</div>
						<div class="col-2">
							<i class="fas fa-edit detail-entreprise-icons edit-entreprise"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fas fa-fax detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Fax</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-fax"></p>
						</div>
						<div class="col-2">
							<i class="fas fa-edit detail-entreprise-icons edit-entreprise"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fas fa-briefcase detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Domaine d'activité</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-domaine"></p>
						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fas fa-calendar-alt  detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Date d'inscription</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-date_creation"></p>
						</div>
						
					</div>

				</li>
			</ul>
		</div>
		<div class="col-12 col-sm-6">

			<ul style="list-style: none;padding-left: 10px;">

				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fas fa-map-marker-alt detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Adresse</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-adresse"></p>
						</div>
						<div class="col-2">
							<i class="fas fa-edit detail-entreprise-icons edit-entreprise"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fas fa-phone-square detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Tél:</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-tel"></p>
						</div>
						<div class="col-2">
							<i class="fas fa-edit detail-entreprise-icons edit-entreprise"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fas fa-file-signature detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">ICE</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-ice"></p>
						</div>
						<div class="col-2">
							<i class="fas fa-edit detail-entreprise-icons edit-entreprise"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fas fa-map-marker-alt detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Ville</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-ville"></p>
						</div>
						<div class="col-2">
							<i class="fas fa-edit detail-entreprise-icons edit-entreprise"></i>

						</div>
					</div>

				</li>
				<li>

					<div class="row detail-entreprise-item">
						<div class="col-2">
							<i class="fas fa-user-tie detail-entreprise-icons "></i>

						</div>
						<div class="col-8">
							<p  class="detail-entreprise-item-title">Directeur Général</p>
							<p  class="detail-entreprise-item-content" id="item-entreprise-directeur"></p>
						</div>
						
					</div>

				</li>
			</ul>
		</div>
	</div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="modal-update-entreprise">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modifier <span id="entreprise-attribute-modify"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-row">

					<div class="col-12">
						<span style="display: none;" id="attribute-to-update"></span>
						<input type="text" value="" id="inputAtrribute" style="width: 100%;">
						<select class="custom-select" id="selectAttribute" style="font-size: 12px;width: 100%;">

							<?php
							foreach ($villes as $value) {
								echo '<option value="'.$value['ville'].'">'.$value['ville'].'</option>';
							}
							?>

						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn-update-entreprise">Confirmer</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
			</div>
		</div>
	</div>
</div>



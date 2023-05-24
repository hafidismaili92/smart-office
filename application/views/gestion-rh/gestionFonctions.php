<section id="gestion-fonctions-section" class="principal-sections hidden_section">
	
	<div id="main-gestions-container" style="height: 90vh;">
		<ul class="nav nav-tabs" id="gestionEmployee-tabs">
			<li class="nav-item active">
				<a data-toggle="tab" href="#fonctions-tab">
					<div class="header-tab active" >
						
						<i class="fa fa-briefcase  fa-lg"></i>
						<span>Fonction</span>
					</div>
				</a>
			</li>
			<li class="nav-item">
				<a data-toggle="tab" href="#etablissement-tab">
					<div class="header-tab" >
						
						<i class="fa fa-list "></i>
						<span>Entités</span>
					</div>
				</a>
				
			</li>
			<li class="nav-item">
				<a data-toggle="tab" href="#classes-tab">
					<div class="header-tab" >
						
						<i class="fa fa-list "></i>
						<span>Profils</span>
					</div>
				</a>
				
			</li>
			<li class="nav-item" id="updateOrganigramme">
				<a data-toggle="tab" href="#organigramme-tab">
					<div class="header-tab" >
						
						<i class="fa fa-list "></i>
						<span>Organigramme</span>
					</div>
				</a>
				
			</li>
		</ul>
		
		<div class="tab-content" id="tabs-container">
			<div class="tab-pane active" id="fonctions-tab" style="height: 100%;">
			<div class="add-fn-form">
				<div class="add-fn-form-title">Nouvelle fonction</div>
			<form action="<?php echo base_url()?>Fonctions/addFonction" method="post" id="nouvelle-fonction-form">
			<div class="row" style="display:flex;align-items:center;">
			<div class="form-group col-6 col-md-4">
									<label for="fonctions-Libelle">Libelle</label>
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user"></i></span>
										</div>
										<textarea class="form-control" id="fonctions-Libelle" name="fonctions-Libelle" rows="2" aria-describedby="observation-aide" required></textarea>
									</div>

								</div>
								<div class="form-group col-6 col-md-3">
									<label for="fonctions-classe">Profil</label>
									<div class="input-group input-group-sm">
										<select class="custom-select" id="fonction-classe" name="fonction-classe">
										</select>

									</div>

								</div>
								<div class="form-group col-6 col-md-3">
									<label for="fonction-type">Type</label>
									<div class="input-group input-group-sm">
										<select class="custom-select" id="fonction-type" name="fonction-type">
											<?php
											foreach ($types as $value) {
												echo '<option value="'.$value['id_type'].'">'.$value['libelle'].'</option>';
											}

											?>

										</select>

									</div>

								</div>
								<div class="col-1 ml-auto" style="min-width:100px;">
									<label></label>
										<button type="submit" class="btn btn-outline-danger btn-sm btn-block" id="Btn-ajouter-fonctions" style="color:#17a2b8;border-color:#17a2b8;">Ajouter</button>

									</div>
			</div>
			</form>
			</div>
				<div class="h-100 tab-items-container">
					
					<div class="col-12  table-container">
						<div style="display: flex;flex-wrap: wrap;justify-content: space-between;">
							<div style="display: flex;flex-direction: row;justify-content: left;">
								<span style="line-height: 34px;">Afficher</span>
								<select class="form-control fonctions-length" style="max-width: 80px;height: 30px;" >
									<option>15</option>
									<option>50</option>
									<option>100</option>
								</select>
								<span  style="margin-left: 10px;line-height: 34px;">Page</span>
							</div>

							<div id="searchpersonnel-group" style="display: flex;flex-direction: row;justify-content: space-between;">
								<div style="display: flex;flex-direction: row;">
									<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
									<input  type="text" class="form-control search-table-field search-fonctions" >
								</div>	

							</div>

						</div>
						<table id="fonctions-table" class="display dt-responsive dataTable no-footer dtr-inline" style="width: 100%;">
							<thead>
								<tr>
									<th>Numero</th>
									<th>Libelle</th>
									<th>Profil</th>
									<th>Type</th>
									<th>Date de Création</th>
									<th>#</th>
									<th></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="etablissement-tab" style="height: 100%;">
			<div class="add-fn-form">
				<div class="add-fn-form-title" style="background-color:#636cf6;">Nouvelle Entité</div>
				<form action="<?php echo base_url()?>Etablissements/addEtablissement" method="post" id="nouvelle-etablissement-form">
				<div class="row" style="display:flex;align-items:center;">
			<div class="form-group col-6 col-md-4">
			<label for="etablissements-Libelle">Libelle</label>
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user"></i></span>
										</div>
										<textarea class="form-control" id="etablissements-Libelle" name="etablissements-Libelle" rows="2" aria-describedby="observation-aide" required></textarea>
								</div>
			</div>
								<div class="form-group col-6 col-md-3">
								<label for="etablissements-mere">Entité Mère</label>
									<div class="input-group input-group-sm">
										<select class="custom-select" id="etablissement-mere" name="etablissement-mere">

										</select>

									</div>

								</div>
								<div class="form-group col-6 col-md-3">
								<label for="etablissement-type">Type</label>
									<div class="input-group input-group-sm">
										<select class="custom-select" id="etablissement-type" name="etablissement-type">
											<?php
											foreach ($typeEtablissements as $value) {
												echo '<option value="'.$value['id_type'].'">'.$value['designation'].'</option>';
											}

											?>

										</select>

									</div>

								</div>
								<div class="col-1 ml-auto" style="min-width:100px;">
									<label></label>
									<button type="submit" class="btn btn-outline-danger btn-sm btn-block" id="Btn-ajouter-etablissements" style="color: #636cf6;border-color: #636cf6;">Ajouter</button>

									</div>
			</div>
			</form>
										</div>
				<div class="row h-100 tab-items-container">
					
					<div class="col-12 table-container">
						<div style="display: flex;flex-wrap: wrap;justify-content: space-between;">
							<div style="display: flex;flex-direction: row;justify-content: left;">
								<span style="line-height: 34px;">Afficher</span>
								<select class="form-control fonctions-length" style="max-width: 80px;height: 30px;" >
									<option>15</option>
									<option>50</option>
									<option>100</option>
								</select>
								<span  style="margin-left: 10px;line-height: 34px;">Page</span>
							</div>

							<div id="searchpersonnel-group" style="display: flex;flex-direction: row;justify-content: space-between;">
								<div style="display: flex;flex-direction: row;">
									<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
									<input type="text" class="form-control search-fonctions search-table-field" >
								</div>	

							</div>

						</div>
						<table id="etablissements-table" class="display dt-responsive" style="width: 100%;">
							<thead>
								<tr>
									<th>Code</th>
									<th>Libelle</th>
									<th>Type</th>
									<th>Etablissement Mère</th>
									<th>Date de Création</th>
									<th>th</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="classes-tab" style="height: 100%;">
			<div class="add-fn-form">
				<div class="add-fn-form-title" style="background-color:#2a98d0;">Nouveau Profil</div>
				<form  action="<?php echo base_url()?>Classes/addClasse" method="post" id="nouvelle-classe-form">
				<div class="row" style="display:flex;align-items:center;">
			<div class="form-group col-6 col-md-5">
			<label for="classe-Libelle">Libelle</label>
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user"></i></span>
										</div>
										<textarea class="form-control" id="classe-Libelle" name="classe-Libelle" rows="2" aria-describedby="classe" required></textarea>
									</div>
			</div>
								<div class="form-group col-6 col-md-4">
								<label for="classe-salaire">Salaire de Base en DH</label>
									<div class="input-group input-group-sm">
										<input type="number" name="classe-salaire" id="classe-salaire">

									</div>
								</div>
								
								<div class="col-1 ml-auto" style="min-width:100px;">
									<label></label>
									<button type="submit" class="btn btn-outline-danger btn-sm btn-block" id="Btn-ajouter-etablissements" style="color:#2a98d0;border-color:#2a98d0;">Ajouter</button>

									</div>
			</div>
			</form>
										</div>
				<div class="row h-100 tab-items-container" >
					
					<div class="col-12 table-container">
						<div style="display: flex;flex-wrap: wrap;justify-content: space-between;">
							<div style="display: flex;flex-direction: row;justify-content: left;">
								<span style="line-height: 34px;">Afficher</span>
								<select class="form-control fonctions-length" style="max-width: 80px;height: 30px;" >
									<option>15</option>
									<option>50</option>
									<option>100</option>
								</select>
								<span  style="margin-left: 10px;line-height: 34px;">Page</span>
							</div>

							<div id="searchpersonnel-group" style="display: flex;flex-direction: row;justify-content: space-between;">
								<div style="display: flex;flex-direction: row;">
									<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
									<input type="text" class="form-control search-fonctions search-table-field" >
								</div>	

							</div>

						</div>
						<table id="classes-table" class="display dt-responsive" style="width: 100%;">
							<thead>
								<tr>
									<th>Code</th>
									<th>Libelle</th>
									<th>Salaire</th>
									<th>#</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="organigramme-tab" style="height: 100%;position: relative;">
				<button class="btn btn-outline-danger" id="download-organigramme" style="position: absolute;right: 10px;top:10px;">DOWNLOAD</button>
				<!--CHART ORGANIGRAME-->
				<div class="container organigramme-container" id="organigramme_div">

				</div>
				<!--CHART ORGANIGRAME-->
			</div>
		</div>
	</div>
</section>


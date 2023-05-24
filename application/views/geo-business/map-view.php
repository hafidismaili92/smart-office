<section id="mapView-section" class="main-sections">
	<div class="container-fluid main-container">
		<div class="row">
			<div id="geobusiness-options" class="left-bare-card col-12 col-md-6 col-lg-5 col-xl-3">
				<div id="business-options-header" class="row">
					<div class="header-tab active col-6 col-sm-3" data-target="#Affaires" id="affaire-tab">
						<div class="tab-active-focus">
						</div>
						<i class="fa fa-list "></i>
						<span>Affaires</span>
					</div>
					<div class="header-tab col-6 col-sm-3" data-target="#Attachements" id="attachement-tab">
						<div class="tab-active-focus">
						</div>
						<i class="fas fa-file-alt "></i>
						<span>Attachements</span>
					</div>
					<div class="header-tab col-6 col-sm-3" data-target="#Details" id="detail-tab">
						<div class="tab-active-focus">
						</div>
						<i class="fa fa-info "></i>
						<span>Details</span>
					</div>
					<div class="header-tab col-6 col-sm-3" data-target="#Ajouter" id="ajouter-tab">
						<div class="tab-active-focus">
						</div>
						<i class="fa fa-plus "></i>
						<span>Ajouter</span>
					</div>
				</div>
				<!--*********************************************************Add data section************************************************************-->
				<div class="tab-sections" id="affaires-content">
					<div id="Affaires" class="tab-section active">
						<div style="display: flex;flex-direction: column;">
							<div id="table-affaire-menu" style="margin-bottom: 20px;">
								<div style="display: flex;flex-wrap: wrap;justify-content: space-between;align-items: center;">
									<div id="searchAff-group" style="display: flex;flex-direction: row;justify-content: space-between;">
										<div style="display: flex;flex-direction: row;">
											<label  style="line-height: 34px;margin-right: 10px;"><i class="fas fa-search"></i></label>
											<input id="search-Affaires" type="text" class="form-control" style="flex-grow: 1;height: 30px;max-width: 150px !important;min-width: 100px !important;border-radius: 20px;">
										</div>	
									</div>
									<!--<div style="position:relative;background-color: rgba(255,255,255,1);border-radius: 100%;height: 30px;width: 30px;display: flex;justify-content: center;align-items: center;-webkit-box-shadow: 0px 1px 6px 0px rgba(0,0,0,0.75);-moz-box-shadow: 0px 1px 6px 0px rgba(0,0,0,0.75);box-shadow: 0px 1px 6px 0px rgba(0,0,0,0.75);">
										<i class="fas fa-search-location"></i>
									</div>
									<button type="button" class="btn btn-sm btn-info" id="Action-GeoAffaire" style="border-radius: 30px;">Action <i class="fas fa-chevron-circle-down"></i></button>-->
								</div>
							</div>
							<div style="width: 100%;flex-grow: 1">
								<table id="geoAffaires-table" class="display" style="width:100%;">
									<thead>
										<tr>
											<th>numero</th>
											<th></th>
											<th>label</th>
											<th>Créé le</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
					<div id="Attachements"  class="tab-section">
						<div id="table-attachements-menu" style="margin-bottom: 20px;">
							<div style="display: flex;flex-wrap: wrap;justify-content: space-between;align-items: center;">
								<div id="searchAff-group" style="display: flex;flex-direction: row;justify-content: space-between;">
									<input id="search-attachement-input" type="text" class="form-control" style="flex-grow: 1;height: 30px;max-width: 150px !important;min-width: 100px !important;border-radius: 20px;margin-right: 2px;">
									<button type="button" class="btn btn-sm btn-outline-secondary" id="search-aff-attachemts" style="border-radius: 30px;"><i class="fas fa-search"></i></button>
								</div>
								<div>
									<button type="button" class="btn btn-sm btn-outline-info" id="att-show-slider" style="border-radius: 10px;"><i class="fas fa-eye"></i> Slider</button>
									<label class="btn btn-sm btn-danger" for="att-add-file" style="border-radius: 100%;margin-bottom: 0;">
										<input id="att-add-file" type="file" class="d-none" multiple>
										<i class="fas fa-plus"></i>
									</label>
									<button type="button" class="btn btn-sm btn-info" id="att-download-allAttachements" style="border-radius: 100%;"><i class="fas fa-download"></i></button>
								</div>
							</div>
						</div>
						<div style="display: flex;justify-content: space-between;width: 100%;border-bottom: 1px solid orange;">
							<h6>Liste des Attachements : </h6>
							<label>Affaire : <span id="att-selected-geoaffName"></span><span id="att-selected-geoaffId" style="display: none;"></span></label>
						</div>
						<div style="width: 100%;">
							<table id="attachements-table" class="display" style="width:100%" data-scroll-y="75vh">
								<thead>
									<tr>
										<th>numero</th>
										<th>ext</th>
										<th>nom</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<div id="Details"  class="tab-section">det</div>
					<div id="Ajouter" class="draggable drag-add-affaire tab-section">
						<div style="max-height: 80%;overflow-y: auto;overflow-x: hidden;">
							<div class="form-group row">
								<label for="addgeoffaire-name" class="col-2 col-form-label">Nom:</label>
								<div class="col-10">
									<input type="text" class="form-control" id="addgeoffaire-name" placeholder="nom affaire ici" id="addgeoffaire-name" style="border-radius: 30px;">
								</div>
							</div>
							<div class="form-group row">
								<label for="addgeoffaire-add-attributes" class="col-2 col-form-label">Champs:</label>
								<div class="col-8">
									<input type="text" class="form-control" id="addgeoffaire-add-attributes" placeholder="nom champs ici">
								</div>
								<button type="button" class="btn btn-info col-2" id="btn-add-attributes"><i class="fa fa-plus fa-sm"></i></button>
							</div>
							<div id="attributes-container">
							</div>
							<!-- <div class="form-group row">
								<label for="addgeoffaire-name" class="col-12 col-form-label">champs label <small>(importation excel):</small></label>
								<div class="col-12">
									<select class="form-control" id="champs-selector" style="border-radius: 30px;">
									</select>
								</div>
							</div> -->
							<div id="add-spatial-info-container">
								<div class="data-headers">
									<p>Informations Spatiales</p>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-12">
									<label for="add-coord-system" class="col-form-label col-form-label-sm">Système de Coordonnées</label>
									<select class="custom-select custom-select-sm" id="projection-selector" data-changeEnable="true">
										<option value="4326">World-WGS84</option>
										<option value="26191">Maroc Lambert Z1</option>
										<option value="26192">Maroc Lambert Z2</option>
										<option value="26194">Maroc Lambert Z3</option>
										<option value="26195">Maroc Lambert Z4</option>
									</select>
								</div>
							</div>
							<div class="form-row">
								<label for="add-geom-type" class="col-form-label col-form-label-sm col-3 ">Géométrie</label>
								<div class="col-8 mr-auto custom-selector" id="geom-selector">
									<div class="active">
										<i class="fas fa-map-marker-alt fa-lg"></i>
										<p data-geomType="Point">Point</p>
										<input type="radio" id="add-geom-Point" name="add-radio" class="add-radio" checked="checked">
									</div>
									<div>
										<i class="fas fa-road fa-lg"></i>
										<p data-geomType="LineString">Ligne</p>
										<input type="radio" id="add-geom-PolyLine" name="add-radio" class="add-radio">
									</div>
									<div>
										<i class="fas fa-draw-polygon fa-lg"></i>
										<p data-geomType="Polygon">Polygone</p>
										<input type="radio" id="add-geom-Polygon" name="add-radio" class="add-radio">
									</div>
								</div>								
							</div>
							<div class="form-row" style="padding: 10px 0px;">
								<div class="col8 ml-auto">
									<button type="button" class="btn btn-sm btn-outline-secondary" id="add-geoComposantes" style="float: right;">Editer les géomtéries (<span id="add-geoComponents-counter">0</span> ajoutées)</button>
								</div>	
							</div>
						</div>
						<div class="form-row" style="position: absolute;top:81%;width: 100%;">
							<p ><h2 style="color: gray;opacity: 0.5;font-weight: bold;font-size: 1.4em;">Glissez ou cliquer ici pour importer Vos Fichiers SHP (.zip)</h2></p>				
						</div>
						<div class="form-row" style="position: absolute;top: 95%;width: 100%;">
							<div class="col-5 ml-auto">
								<button type="button" class="btn btn-sm btn-info" id="insert-affaire" style="border-radius: 30px;float: right;"><i class="fas fa-check-circle"></i> Ajouter</button>
							</div>					
						</div>
					</div>
				</div>
				<!--*********************************************************Modals*************************************************************-->
				<div id="add-geometries-data-modal" class="hidden custom-modal-left">
					<div class="draggable drag-add-composante">
						<div id="add-geoComposantes-header">
							<span>Dessinez sur la carte ou Glisser pour ajouter les Goémétrie</span>
						</div>
						<div id="add-geoComposantes-body">
							<div class="table-menu">
								<div style="display: flex;flex-wrap: wrap;justify-content: space-between;">
									<div  style="display: flex;flex-direction: row;justify-content: space-between;padding: 0px 25px;">
										<div style="display: flex;flex-direction: row;">
											<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
											<input type="text" class="form-control search-in-table" style="flex-grow: 1;height: 30px;max-width: 150px !important;min-width: 100px !important;border-radius: 20px;" data-targetTable="add-geoComposantes-tables">
										</div>	
									</div>
									<div >
										<div>
											<button class="btn btn-sm btn-danger" id="add-manual-composante">Ajout manuel</button>
										</div>
									</div>
								</div>
							</div>
							<div class="geoComposantes-liste-container">
								<table class="geom-info-tables backgroundHeader" id="add-geoComposantes-tables">
									<thead>
										<tr>
											<th>featureID</th>
											<th>#</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
						<div class="container-fluid" >
							<div id="add-geoComposantes-footer" class="row" style="padding: 5px 15px 15px 15px;border-top:1px solid rgba(0,0,0,0.3)">
								<button class="btn btn-outline-secondary btn-sm col-3" id="close-add-geocomposantes">Quitter</button>
								<button class="btn btn-outline-info btn-sm col-3 ml-auto" id="confirm-add-geocomposantes">Appliquer</button>
							</div>
						</div>
					</div>
				</div>
				<div id="print-dialog" class="custom-modal-left print-element hidden">
					<div style="box-shadow: none;border-radius: 0;display: flex;flex-direction: column;">
						<div id="print-header">
							<span>Impression de la carte</span>
						</div>
						<div id="print-content">
							<div id="print-body" >
								<div style="border-bottom: 1px solid gray;" class="print-dialog-titles">Grid</div>
								<div class="form-row">
									<div class="form-group col-12 row">
										<label for="print-coord-system" class="col-form-label col-form-label-sm col-12">Système de Coordonnées</label>
										<select class="custom-select custom-select-sm col-7" id="print-coord-system">
											<option value="4326">World-WGS84</option>
											<option value="26191">Maroc Lambert Z1</option>
											<option value="26192">Maroc Lambert Z2</option>
											<option value="26194">Maroc Lambert Z3</option>
											<option value="26195">Maroc Lambert Z4</option>
										</select>
										<button class="btn btn-sm btn-warning col-4 ml-auto " id="print-add-crs">Ajouter</button>
									</div>
									
								</div>
								<div class="form-check" style="padding: 10px;">
									<input class="form-check-input" type="checkbox" id="toggle-show-grid">
									<label class="form-check-label" for="defaultCheck1">
										Afficher la Grille
									</label>
								</div>
								<div class="form-group row">
									<label for="pax-x-grid" class="col-1 col-form-label">H:</label>
									<div class="col-3">
										<select class="form-control" id="densite-grid-x" >
											<option value="3">3</option>
											<option value="5">5</option>
											<option value="10">10</option>
											
										</select>
									</div>
									<label for="pax-x-grid" class="col-1 col-form-label">V:</label>
									<div class="col-3">
										<select class="form-control" id="densite-grid-y" >
											<option value="3">3</option>
											<option value="5">5</option>
											<option value="10">10</option>
											
										</select>
									</div>
									<button class="btn btn-sm btn-info col-2 ml-auto" id="refresh-grid">ok</button>
								</div>
								<div style="border-bottom: 1px solid gray;" class="print-dialog-titles">Légende et texte personnalisé</div>
								<div class="form-group row">
									<button class="btn btn-sm btn-info col-5 " id="print-add-text">Zone de text</button>
									<button class="btn btn-sm btn-warning col-5 ml-auto" id="print-add-legend">Légende</button>
								</div>
								<div style="border-bottom: 1px solid gray;" class="print-dialog-titles">Option de papier</div>
								<div class="form-group row">
									<label for="page-format" class="col-6 col-form-label">Format Papier:</label>
									<div class="col-5 mr-auto">
										<select class="form-control" id="page-format">
											<option value ="a4">A4</option>
											<option value ="a3">A3</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="page-format" class="col-6 col-form-label">Résolution:</label>
									<div class="col-5 mr-auto">
										<select class="form-control" id="page-resolution">
											<option value ="75">75 ppi</option>
											<option value ="100">100 ppi</option>
											<option value ="200">200 ppi</option>
										</select>
									</div>
								</div>
							</div>
							<div style="flex-grow: 1;display: flex;flex-direction: column;justify-content: flex-end;">
								<div class="row" style="padding: 10px 0px;border-top:1px solid rgba(0,0,0,0.3);width: 100%;">
									<button class="btn btn-outline-secondary btn-sm col-3" id="close-print-dialog">Quitter</button>
									<button class="btn btn-outline-info btn-sm col-3 ml-auto" id="print-map">Imprimer</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="attributes-data-modal" class="hidden custom-modal-left" data-affaire="" data-nomaffaire="">
					<div>
						<div id="add-geoComposantes-header">
							<span>Table Attributaire</span>
						</div>
						<div>
							<div class="table-menu">
								<div style="display: flex;flex-wrap: wrap;justify-content: space-between;">
									<div  style="display: flex;flex-direction: row;justify-content: space-between;padding: 0px 25px;">
										<div style="display: flex;flex-direction: row;">
											<label  style="line-height: 34px;margin-right: 10px;">Rechercher</label>
											<input type="text" class="form-control search-in-table" style="flex-grow: 1;height: 30px;max-width: 150px !important;min-width: 100px !important;border-radius: 20px;" data-targetTable="attributes-tables">
										</div>	
									</div>
								</div>
							</div>
							<div class="geoComposantes-liste-container">
								<table class="geom-info-tables backgroundHeader" id="attributes-tables">
									<thead><tr><th></th></tr></thead>
								</table>
							</div>
						</div>
						<div class="container-fluid" >
							<div id="add-geoComposantes-footer" class="row" style="padding: 5px 15px 15px 15px;border-top:1px solid rgba(0,0,0,0.3)">
								<button class="btn btn-outline-secondary btn-sm col-3" id="close-attributes-table">Quitter</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--*********************************************************Map************************************************************-->
			<div id="main-map-container">
				<div id="print-progression" class="loaderDialog hidden">
					<div>
						<div class="loader">

						</div>
						<div class="loader">

						</div>

					</div>
				</div>
				<div id="map-wrapper" class="normalMode">
					
					<div id="map-mask" class="hidden" >
					</div>
					<div id="main-map" style="height: 100%;width: 100%;position: relative;z-index: 1010;" class="map">
						<div id="ol-map-popup" style="height: 50px;width: 50px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Modal -->
<div class="modal fade" id="ShowBornes-modal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div  style="display: flex;justify-content: space-between;min-width: 80%;">
					<h5 class="modal-title">Liste des Bornes </h5>
					<span class="hidden-featureID hidden-item" ></span>
					<h5><span id="concerned-composant" style="color: red;"></span></h5>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="geoComposantes-liste-container">
					<table class="geom-info-tables" id="bornes-table">
						<thead>
							<tr>
								<th>libellé</th>
								<th>x</th>
								<th>y</th>
								<!-- <th>Action</th> -->
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" id="updateBornes">Appliquer</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade add-attributes-modal" id="attributes-modal" tabindex="-1" role="dialog"  aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div  style="display: flex;justify-content: space-between;min-width: 80%;">
					<h5 class="modal-title">Indiquez les champs</h5>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="post" id="perform-add-composanteForm">
				<input type="text" class="hidden-item hidden-featureID" name="featureID" readonly>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="attributesValues-container">
							<div class="form-group row value-attribute attr-val-template" >
								<label for="attribute-identifiant" class="col-6 col-form-label">identifiant:</label>
								<div class="col-6">
									<input type="text" class="form-control hidden-item">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="ignore-add-attributes">Fermer</button>
					<button type="submit" class="btn btn-primary"  >Appliquer</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade add-attributes-modal" id="add-manual-compo-modal" tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<div  style="display: flex;justify-content: space-between;min-width: 80%;">
					<h5 class="modal-title">Création de la Géometrie</h5>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-6 add-manual-container" id="manual-attributes" style="border-right: 1px solid black;">
							<div class="attributesValues-container manual-comp">
							</div>
						</div>
						<div class="col-6 add-manual-container" id="manual-Geom">
							<div style="display: flex;align-items:flex-end;">
								<div>
									<label class="col-form-label">libellé:</label>
									<div>
										<input type="text" class="manual-borne-label form-control">
									</div>
								</div>
								<div>
									<label class="col-form-label">x:</label>
									<div>
										<input type="number" class="manual-borne-x form-control">
									</div>
								</div>
								<div>
									<label class="col-form-label">y:</label>
									<div>
										<input type="number" class="manual-borne-y form-control">
									</div>
								</div>
								<div>
									<label class="col-form-label"></label>
									<div>
										<button class="btn btn-info btn-sm" id="add-manual-borne">+</button>
									</div>
								</div>
							</div>
							<div class="manual-comp">
								<table class="geom-info-tables" id ="manual-bornes-table">
									<thead>
										<tr>
											<th>Label</th>
											<th>x</th>
											<th>y</th>
											<th>#</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary" id="perform-manual-composante" >Appliquer</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade " id="slidershow-modal" tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="true" data-keyboard="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 20px;">
			<div class="modal-body" style="background: none;">
				<div id="attachementsImg-shower" class="carousel slide" data-interval="false">
					<div class="carousel-inner" style="height: 70vh;display: flex;align-items: center;background: #e0e0da;">
					</div>
					<a class="carousel-control-prev" href="#attachementsImg-shower" role="button" data-slide="prev">
						<div style="padding: 5px;background-color: rgba(187,226,255,0.7);height: 30px;border-radius: 100%;">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</div>
					</a>
					<a class="carousel-control-next" href="#attachementsImg-shower" role="button" data-slide="next">
						<div style="padding: 5px;background-color: rgba(187,226,255,0.7);height: 30px;border-radius: 100%;">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="setStyle-modal" tabindex="-1" role="dialog"  aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div  style="display: flex;justify-content: space-between;min-width: 80%;">
					<h5 class="modal-title">Personnaliser le style </h5>
					<span class="hidden-featureID hidden-item" ></span>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form data-target="0" action="#" method="post" id="changeStyleForm">
					<div class="form-group row">
						<label for="style-fill" class="col-8 col-form-label">Remplissage:</label>
						<div class="col-3 mr-auto">
							<input class="color form-control" id="style-fill" value="rgba(100,100,100,0.5)"  name="style-fill" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="style-strokecolor" class="col-8 col-form-label">contour:</label>
						<div class="col-3 mr-auto">
							<input type="color" class="form-control" id="style-strokecolorHex">
							<input type="text" class="form-control" id="style-strokecolor" name="style-strokecolor" required >
						</div>
					</div>
					<div class="form-group row">
						<label for="style-strokecolor" class="col-8 col-form-label">Epaisseur:</label>
						<div class="col-3 mr-auto">
							<input type="number" class="form-control" id="style-strokewidth" max="5" min="1" name="style-strokewidth" required>
						</div>
					</div>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button class="btn btn-primary" id="appliquerStyle">Appliquer</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="export-modal" tabindex="-1" role="dialog"  aria-hidden="true" data-affaire="0" data-name="null">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div  style="display: flex;justify-content: space-between;min-width: 80%;">
					<h5 class="modal-title">Exporter Affaire </h5>
					<span class="hidden-featureID hidden-item" ></span>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group row">
					<label for="style-fill" class="col-6 col-form-label">Format de sortie:</label>
					<div class="col-5 ml-auto">
						<select class="custom-select custom-select-sm" id="export-format-selector">
							<option value="excel">Excel</option>
							<option value="shp">Shapefile</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<a href="#"><button class="btn btn-info" id="ExporteAffaire">Exporter</button></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="legend-config-modal" tabindex="-1" role="dialog"  aria-hidden="true" data-legendId="0">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div  style="display: flex;justify-content: space-between;min-width: 80%;">
					<h5 class="modal-title">Configurer la légende </h5>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group row">
					<label for="style-fill" class="col-4 col-form-label">Couche:</label>
					<div class="col-5 ml-auto">
						<select class="custom-select custom-select-sm" id="couche-legend-selector">
						</select>
					</div>
					<button class="btn-sm btn-info" id="add-layer-ToLegend"><i class="fas fa-plus"></i></button>
				</div>
				<div id="couche-legend-selected">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button class="btn btn-info" id="apply-legend">Appliquer</button>
				</div>
			</div>
		</div>
	</div>
</div>
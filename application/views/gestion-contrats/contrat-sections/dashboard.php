<section id="dashboard-section" class="principal-sections hidden_section">
	<div  id="dashboard-header" class="noprint" style="position: relative;">
		<select id="periode-selector">
			<option value="current-year">Année en cours</option>
			<option value="five-year">Cinq dernières Années</option>
			<option value="teen-year">Dix dernières Années</option>
		</select>
		<div style="position: absolute;right: 5px;top:5px;color: white;height: 30px;width: 30px;cursor: pointer;" id="print-dashboard"><i class="fas fa-file-pdf fa-lg"></i></div>
	</div>
	<div id="dashboard-container" class="container-fluid" style="padding: 0px 30px;">
		<div class="dashboard-titles">TABLEAU DE BORD GENERAL DES CONTRATS  <span class="peroide-label"></span></div>
		<div style="display: flex;justify-content: center;width: 100%"><h3 style="border-top: 2px solid #ec9c10;width:60px;"></h3></div>
		<div class="tables-container" style="margin-bottom: 25px;">
			<table id="general-contrat-table" class="dt-responsive" width="100%">
				<thead><tr></tr></thead>
				<tfoot><tr></tr></tfoot>
			</table>
		</div>
		<div id="contrats-charts-container" class="container-fluid" style="background-color: rgba(185, 176, 176, 0.16);">
			<div class="row" >
				<div class="col-12 col-md-8 histogrammes">
					<div class="graphicsContainerParent">
						<div style="width: 100%;height: 200px;" class="graphicsContainer">
							<canvas id="contrats-sectors-canvas"></canvas>
						</div>
					</div>
					<div class="graphicsContainerParent">
						<div style="width: 100%;height: 250px;" class="graphicsContainer">
							<canvas id="contrats-time-canvas"></canvas>
						</div>
					</div>
					
				</div>
				<div class="col-12 col-md-4 Doughnuts graphicsContainerParent">
					<div class="row graphicsContainer" style="height: 100%;">
						<div style="width: 100%;display: flex;justify-content: center;" class="col-4 col-md-12 encours-container">
							
							<div style="width: 100px;height: 120px;position: relative;">
								<div id="encours-doughnut-pourcent" class="dought-percent-text">

								</div>
								<canvas id="contrats-enCours-canvas"></canvas>
							</div>

						</div>
						<div style="width: 100%;display: flex;justify-content: center;" class="col-4 col-md-12 arret-container">
							
							<div style="width: 100px;height: 120px;position: relative;">
								<div id="arret-doughnut-pourcent" class="dought-percent-text">

								</div>
								<canvas id="contrats-arret-canvas"></canvas>
							</div>

						</div>
						<div style="width: 100%;display: flex;justify-content: center;" class="col-4 col-md-12 termine-container">
							
							<div style="width: 100px;height: 120px;position: relative;">
								<div id="termine-doughnut-pourcent" class="dought-percent-text">

								</div>
								<canvas id="contrats-termine-canvas"></canvas>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="dashboard-titles" style="margin-top: 10px;">TABLEAU DE BORD DES PERFORMANCES DES REVENUS  <span class="peroide-label"></span></div>
		<div style="display: flex;justify-content: center;width: 100%"><h3 style="border-top: 2px solid #ec9c10;width:60px;"></h3></div>

		<div class="tables-container" style="margin-bottom: 25px;">
			<table id="revenue-realisation-table" class="dt-responsive" width="100%">
				<thead><tr></tr></thead>
				<tbody><tr></tr></tbody>
			</table>
		</div>
		<div id="revenue-charts-container" class="container-fluid" style="background-color: rgba(185, 176, 176, 0.16);">
			<div class="row" >
				<div class="col-12 histogrammes">
					<div class="graphicsContainerParent">
						<div style="width: 100%;height: 250px;" class="graphicsContainer">
							<canvas id="revenue-realisation-canvas"></canvas>
						</div>
					</div>
					
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-4">
					<div class="statistic-box" id="realisation-box">
						<div style="width: 100%;text-align:center;color: white;">Montant des Réalisations</div>
						<div style="width: 100%;text-align:center;color: white;">Période : <span class="periode-realisation">...</span></div>
						<div style="text-align: center;flex-grow: 1;display: flex;justify-content: center;flex-direction: column;"><span id="realise-montant" class="box-values">.....</span></div>

					</div>
				</div>
				<div class="col-4">
					<div class="statistic-box" id="regle-box">
						<div style="width: 100%;text-align:center;color: white;">Montant Règlé</div>
						<div style="width: 100%;text-align:center;color: white;">Période : <span class="periode-realisation">...</span></div>
						<div style="text-align: center;flex-grow: 1;display: flex;justify-content: center;flex-direction: column;"><span id="revenue-montant" class="box-values">.....</span></div>

					</div>
				</div>
				<div class="col-4">
					<div class="statistic-box" id="enAttente-box">
						<div style="width: 100%;text-align:center;color: white;">Montant en Attente</div>
						<div style="width: 100%;text-align:center;color: white;">au <?php echo date('d-m-Y') ?></div>
						<div style="text-align: center;flex-grow: 1;display: flex;justify-content: center;flex-direction: column;"><span id="enattente-montant" class="box-values">......</span></div>

					</div>
				</div>
			</div>
		</div>
		<div style="break-after:page"></div>
		<div class="dashboard-titles page-head" style="margin-top: 10px;">Répartition Géographique des Contrats</div>
		<div style="display: flex;justify-content: center;width: 100%"><h3 style="border-top: 2px solid #ec9c10;width:60px;"></h3></div>
		
		<div class="row">

			<div class="col-12" style="height: 400px;" id="contrats-repartition-map">

			</div>
		</div>
	</div>
</section>
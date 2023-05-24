<section id="nouvellFacture-section">
	<form id="nouvelleFacture-form" action="<?php echo base_url(); ?>NouvelleFacture/addFacture" method="post">
		<div class="form-row" style="margin: 15px 0px;" id="nouvelleFacture-inputs">
			<div class="col-3 row">
				<label for="contrat-nouvelle-facture" class="col-12" style="line-height: 30px;font-size: 1.2em;">N° Contrat : </label>
				<div class="input-group-sm col-12">
					
					<input type="text"  class="form-control" name="contrat-nouvelle-facture" readonly id="contrat-nouvelle-facture" required>
				</div>
			</div>
			<div class="col-3 row">
				<label for="date-nouvelle-facture" class="col-12" style="line-height: 30px;font-size: 1.2em;">Date Effet : </label>
				<div class="input-group-sm col-12">
					
					<input type="date"  class="form-control" name="date-nouvelle-facture" id="date-nouvelle-facture" required>
				</div>
			</div>
			<div class="col-3 row">
				<label for="contrat-totalHT-facture" class="col-12" style="line-height: 30px;font-size: 1.2em;">TOTAL DH HT : </label>
				<div class="input-group-sm col-12">
					<input type="text" class="form-control" name="contrat-totalHT-facture" readonly id="contrat-totalHT-facture">
				</div>
			</div>
			<div class="col-3 row" style="display: flex;justify-content: space-around;">
				<label for="contrat-totalTTC-facture" class="col-12" style="line-height: 30px;font-size: 1.2em;">TOTAL DH TTC :(TVA <span id="tva-facture">20</span> %) </label>
				<div class="input-group-sm col-12" >
					<input type="text" class="form-control" name="contrat-totalTTC-facture" readonly id="contrat-totalTTC-facture">
				</div>
			</div>
		</div>
		
		
		<table id="nouvelleFacture-table" class="table dt-responsive nowrap compact" width="100%">
			<thead>
				<tr>
					<th>Numero</th>
					<th>Libelle</th>
					<th>Unite</th>
					<th>Prix unitaire</th>
					<th>Quantite contrat</th>
					<th>Quantite anterieure</th>
					<th>Quantite facture</th>
					<th>Montant facture</th>
					<th></th>
					
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		<div class="row" style="width: 100%;margin-top:10px;padding: 0;">
			<div class="ml-auto" style="margin:0;padding: 0;">
				<button type="submit" class="btn btn-success btn-sm btn-block" id="Btn-ajouter-facture">Generer la facture</button>
			</div>
		</div>
	</form>
</section>
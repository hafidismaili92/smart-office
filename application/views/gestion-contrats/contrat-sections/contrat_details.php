<section id="contrat-details" class="principal-sections hidden_section">
	<div style="width: 100%;padding-left: 25px;padding-right: 25px;background: #2193b0;  /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #6dd5ed, #2193b0);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #6dd5ed, #2193b0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

; display: flex;justify-content:space-between;font-size: 16px;margin-bottom: 2px;">
		<div id="details-title" style="flex-grow: 3;line-height: 50px;font-family: Arial, Helvetica, sans-serif;font-size: 0.9em;letter-spacing: 2px;color: white;font-weight: 700;text-decoration: none;font-style: normal;font-variant: normal;text-transform: uppercase;">
			NOUVELLE FACTURE
		</div>
		<form style="flex-grow: 1;" id="search-contrat-form" action="#" method="post">
			<div class="form-row" style="width: 100%;">
			<input type="text" class="form-control col-10" name="contrat-search-details" id="contrat-search-details" style="border-radius: 25px;margin-top: 5px;" required>
			<Button type="submit" id="btn-search-contrat" style="position: relative;background-color: transparent;outline: none;border: none;" class="col-2">
				<i class="fas fa-search fa-lg" style="background-color: #6dd5ed;height: 30px;width: 30px;line-height: 30px;position: absolute;left: 0;top:5px;border-radius: 100%;text-align: center;color: white;"></i></Button>
		</div>
		</form>
	</div>
	<?php echo $infoContrat ?>
	<?php echo $nouvelleFacture ?>
	<?php echo $listeFactures ?>
</section>




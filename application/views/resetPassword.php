<html style="height: 100%;width: 100%;">
<head>
	<meta set="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/loginStyle.css">
</head>
<body style="height: 100%;width: 100%;">
	<div id="main-container">
		<div id="second-container">
			<div id="third-container">
				<div id="img-container" >
					<div ></div>
					<img src="<?php echo base_url(); ?>assets\img\logos\header_login.jpg" style="width: 100%;height: 100%;">
				</div>
				<div id="mainForm-container" >
					<div class="form-container" style="padding-left: 10px;margin-top: 20px;width: 100%;">
						<form id="reset-passwordForm" method="post" action="<?php echo base_url(); ?>Login/resetPassword">
							<div class="row" style="width: 100%;">
								<label for="emp-matricule" class="col-3 col-form-label" style="margin:0;color: gray;text-align: right;">Matricule</label>
								<div class="col-8" style="margin: 0;" >
									<input id="emp-matricule" name="emp-matricule" type="text" id="colFormLabel" placeholder="ancien mot de passe" required value="<?php echo $matricule ?>">
								</div>
							</div>
							<div class="row" style="width: 100%;">
								<label for="emp-oldPassword" class="col-3 col-form-label" style="margin:0;color: gray;text-align: right;">ancien mot de passe</label>
								<div class="col-8" style="margin: 0;" >
									<input id="emp-oldPassword" name="emp-oldPassword" type="password" placeholder="************" required>
								</div>
							</div>
							<div class="row" style="width: 100%;">
								<label for="emp-newPassword" class="col-3 col-form-label" style="margin:0;color: gray;text-align: right;">Nouveau mot de passe</label>
								<div class="col-8" style="margin: 0;" >
									<input id="emp-newPassword" name="emp-newPassword" type="password" placeholder="************" required>
								</div>
							</div>
							<div class="row" style="width: 100%;">
								<label for="emp-confirmPassword" class="col-3 col-form-label" style="margin:0;color: gray;text-align: right;">Confirmer mot de passe</label>
								<div class="col-8" style="margin: 0;" >
									<input id="emp-confirmPassword" name="emp-confirmPassword" type="password" placeholder="************" required>
								</div>
							</div>
							<div class="row" style="display: flex;flex-direction: row-reverse;width: 95%;margin-top: 40px;">
								<button type="submit" >
									Connection
								</button>
							</div>
						</form>	
					</div>

				</div>
				<div style="position: relative;display: flex;flex-direction: row;justify-content: center;">
					<img src="<?php echo base_url() ?>assets\img\logos\loginHeader.png" style="width: 30px;height: 30px;position: absolute;bottom: 0;">
				</div>
			</div>
		</div>

	</div>
	<script type="text/javascript" src="<?php echo base_url()?>assets/libraries/jquery/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/loginScript.js"></script>
</body>
</html>
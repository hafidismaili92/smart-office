<html style="height: 100%;width: 100%;">
<head>
	<meta set="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/fontawesome-free-5.12.0-web/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/loginStyle.css">
</head>
<body style="height: 100%;width: 100%;background:url('<?php echo base_url(); ?>Login/serveImages?id=BG')">
	<!--<body style="height: 100%;width: 100%;background:url('<?php echo base_url()?>assets/img/logos/header_login.jpg');background-repeat: no-repeat;background-size: 100%;">-->
		<div class="container-fluid" style="height: 100%;">
			<div class="row h-100">
				<div class="col-12 col-md-6 my-auto" style="display: flex;justify-content: center;">
					<img src="<?php echo base_url()?>assets\img\logos\loginHeader.png" style="width: 40px;height: 40px;border-radius: 50%;border: 2px solid white;padding: 3px;margin-right: 10px;">
					<div>
						<h3 style="font-size: 1.4rem;color: white;font-weight: bold;letter-spacing: 6px;line-height: 20px;">Smart-Desk</h3>
						<h6 style="font-size: 0.9rem;color: white;letter-spacing: 2px;line-height: 20px;margin: 0;">GEOSOLUTIONS</h6>
					</div>
				</div>
				<div class="col-12 col-md-6 my-auto" style="display: flex;justify-content: center;height: 80%;align-items:center;border-left: 2px solid white;" >
					<div id="mainForm-container" style="height: 90%;min-height: 250px;">
						<div class="form-container">
							<form id="loginForm" method="post" action="<?php echo base_url(); ?>Login/connection">
								<div style="display: flex;flex-direction: column;justify-content: space-around;height: 100%;">
									<div>
										<h5 style="font-size: 1.3em ;letter-spacing: 5px;color: white;text-align: center;">CONNECTION</h5>
									</div>
									<div  class="row-data" >
										<i class="far fa-user " ></i>
										<div style="width: 100%;">
											
											<label>Matricule</label>
											<input id="emp-matricule" name="emp-matricule" type="text" id="colFormLabel" required class="login-input" style="width: 100%;">
										</div>
									</div>
									<div class="row-data">
										<i class="fas fa-unlock-alt "></i>
										<div style="width: 100%;">
											
											<label>Mot de Passe</label>
											<input id="emp-Password" name="emp-Password" type="password" class="login-input" required style="width: 100%;">
										</div>
									</div>

									<div>
										<button type="submit" class="btn btn-info" style="width: 100%;">
											Connection
										</button>
									</div>
									<div style="display: flex;justify-content: flex-end; color: white; align-items: baseline;margin-top: 20px;">
										<i class="fas fa-envelope fa-lg" style="height: 100%;margin-right: 10px;"></i>
										<label>Mot de passe oublié?</label>
									</div>
								</div>
							</form>	
						</div>

					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">

			document.body.classList.add('js-loading');
			window.addEventListener("load", removeLoadingClass);
			function removeLoadingClass() {
				document.body.classList.remove('js-loading');
			}
		</script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/libraries/jquery/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/loginScript.js"></script>
	</body>
	</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="CRMS - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>SMART-DESK</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>images/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/font-awesome.min.css">

        <!-- Feathericon CSS -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/feather.css">

        <!--font style-->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/template/css/style.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/loginStyle.css">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="<?php echo base_url()?>assets/template/js/html5shiv.min.js"></script>
			<script src="<?php echo base_url()?>assets/template/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index.html"><img src="<?php echo base_url()?>images/entreprise_logo.png" alt="SMART-DESK"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Login</h3>
							<p class="account-subtitle">Acceder à votre espace Smart-Desk</p>
							<p class="account-subtitle text-danger hidden customError">Données invalide</p>
							<!-- Account Form -->
							<form id="loginForm" method="post" action="<?php echo base_url(); ?>Login/connection" >
								<div class="form-group">
									<label>Matricule</label>
									<input id="emp-matricule" name="emp-matricule" type="text" class="form-control" required>
									
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Mot de Passe</label>
										</div>
										<div class="col-auto">
											<a class="text-muted" href="forgot-password.html">
												Mot de passe oubliè?
											</a>
										</div>
									</div>
									<input id="emp-Password" class="form-control" name="emp-Password" type="password" required>
									
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">Se connecter</button>
								</div>
								<div class="account-footer">
									<p> <a href="<?php echo base_url();?>Inscription">Créer compte pour mon Entreprise</a></p>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="<?php echo base_url()?>assets/template/js/jquery-3.5.0.min.js"></script>
		<script src="<?php echo base_url()?>assets/libraries/jquery-validation/jquery.validate.min.js"></script>
		<!-- Bootstrap Core JS -->
        <script src="<?php echo base_url()?>assets/template/js/popper.min.js"></script>
        <script src="<?php echo base_url()?>assets/template/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo base_url()?>assets/template/js/app.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/loginScript.js"></script>
		
    </body>
</html>
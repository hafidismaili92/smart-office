<!DOCTYPE html>
<html>
<head>
	<title>COMPANY SOLUTIONS</title>
	<meta set="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		html,body
		{
			height: 100%;
			width: 100%;
		}
		.btn
		{
			width: 45%;
			border-radius: 25px 0 25px 0;
			color: white;
		}
		.btn:hover
		{
			
			color: #fbd15b;
		}
		ul
		{
			list-style-type: circle;
		}
	</style>
</head>
<body>
	<div class="container" style="height: 100%;display: flex;flex-direction: column;justify-content: top;padding-top: 10%;">
		<div class="row justify-content-center">
			<div class="col-7 col-sm-6 col-lg-6 my-auto mx-auto">

				<?php
				$image_properties = array('src' => $img,'width' => '80%');
				echo img($image_properties); 


				?>

			</div>
			<div class="col-12 col-sm-6 col-lg-6 row mx-auto">
				<div class="col-11 col-sm-12 ml-auto">
					<h4><span style="color:#46467c; ">SMART</span>-<span style="color:#dd6f6f;">DESK</span></h4>
					<h6>Gérer facilement votre entreprise</h6>
					<ul>
						<li>Automatisation des Factures</li>
						<li>Tableaux de Bord</li>
						<li>Gestion des Ressources Humaines</li>
						<li>Distribution des Tâches</li>
					</ul>
					<button type="button" class="btn" onclick="location.href = 'Inscription'" style="background-color: #46467c;">Inscription</button>
					<button type="button" class="btn" onclick="location.href = 'Login'" style="background-color: #dd6f6f;">Connexion</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
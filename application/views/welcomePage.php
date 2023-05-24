<!DOCTYPE html>
<html>
<head>
	<title>GESTION</title>
	<meta set="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/fontawesome-free-5.12.0-web/css/all.css">
	<style type="text/css">
		html, body {
			height: 100%;
			font-size: 16px;
		}
		.title{
			font-family: Georgia, serif;
			font-size: 1em;
			letter-spacing: 4px;
			word-spacing: 3px;
			color: #8C8C8C;
			font-weight: 700;
			text-decoration: none;
			font-style: normal;
			font-variant: normal;
			text-transform: none;
		}
		.menu-titles{
			font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
			font-size: 0.7em;
			letter-spacing: 1.4px;
			word-spacing: 0.8px;
			color: #8C8C8C;
			font-weight: normal;
			text-decoration: none;
			font-style: normal;
			font-variant: small-caps;
			text-transform: none;
			margin-top: 10px;
		}


		#user-avatar 
{
	
	background-color: transparent;
	height: 80px;
	width: 80px;
	text-align: center;
}
#user-avatar img
{
	
	border-radius: 100%;
	-webkit-border-radius:100%;
	-moz-border-radius:100%;
	width: 100%;height: 100%;
	border:1px solid white;
	
}
/* On screens that are 600px or less, set the background color to olive */
@media screen and (max-width: 700px) {
	.menu-item 
	{
		
		height: 40px;
		
	}
	#logo-footer
	{
		height: 20px;
		width: 40px;
		bottom: 0;
		left: calc(50% - 20px)
	}

}
@media screen and (min-width: 701px) {
	.menu-item 
	{
		
		height: 100px;
		
	}
	#logo-footer
	{
		height: 35px;
		width: 60px;
		bottom: 0;
		left: calc(50% - 40px)
	}

}
	</style>
</head>
<body>
	
	<div style="display: flex;flex-direction: row;justify-content: center;width:100%;position: relative; ">
		<div class="title" style="margin-top: 20px;">
			Bienvenue <?php echo $this->session->userPrenom.' '.$this->session->userNom; ?>
		</div>
	</div>
	<div style="display: flex;flex-direction: row;justify-content: center;width:100%;position: relative; ">
		<h3 style="border-top:2px solid #26bebe;width:25px;margin-right: 20px;"></h3>
		<h3 style="border-top:2px solid #407f88;width:25px;margin-right: 20px;"></h3>
		<h3 style="border-top:2px solid #0cb8b8;width:25px;margin-right: 20px;"></h3>
		<h3 style="border-top:2px solid #ec9c10;width:25px;"></h3>
	</div>
	<div style="width: 100%;display: flex;justify-content: center;">
		<div id="user-avatar">
				<img src="data:<?php echo $profil['photoMime']?>;base64, <?php echo $profil['photo64']?>">
			</div>
	</div>
	<div class="row h-75">
		<div class="col-md-2"></div>
		<div class="col-md-8 row">
			<?php
			if(in_array('GRH',$droits))
			{
				echo '<div class="col-3 my-auto menu-item" style="text-align: center;cursor: pointer;" onclick="window.open(\''.base_url().'RH_main\');">';
				$image_properties = array('src' => 'images/welcomepage/RH.png','height' => '100%');
				echo img($image_properties);
				echo '<div class="menu-titles ">RESSOURCES HUMAINES</div>';
				echo '</div>';
			}
			if(in_array('GAFF',$droits))
			{
				
				echo '<div class="col-3 my-auto menu-item" style="text-align: center;cursor: pointer;" onclick="window.open(\''.base_url().'GeoBusiness_main\');">';
				$image_properties = array('src' => 'images/welcomepage/geobusiness.png','height' => '100%');
				echo img($image_properties);
				echo '<div class="menu-titles ">GEO-BUSINESS</div>';
				echo '</div>';
				echo '<div class="col-3 my-auto menu-item" style="text-align: center;cursor: pointer;" onclick="window.open(\''.base_url().'Users_main\');">';
				$image_properties = array('src' => 'images/welcomepage/MON_COMPTE.png','height' => '100%');
				echo img($image_properties);
				echo '<div class="menu-titles ">MON COMPTE</div>';
				echo '</div>';
			}
			if(in_array('GCONTRAT',$droits))
			{
				echo '<div class="col-3 my-auto menu-item" style="text-align: center;cursor: pointer;" onclick="window.open(\''.base_url().'Contrat_main\');">';
				$image_properties = array('src' => 'images/welcomepage/CONTRATS.png','height' => '100%');
				echo img($image_properties);
				echo '<div class="menu-titles ">SUIVI DES CONTRATS</div>';
				echo '</div>';
			}
			?>
			<!--<div class="col-4 col-sm-4 my-auto menu-item" style="text-align: center;cursor: pointer;" onclick="window.open('<?php echo base_url()?>RH_main');">

				<?php
				$image_properties = array('src' => 'images/welcomepage/RH.png','height' => '100%');
				echo img($image_properties); 
				?>
				<div class="menu-titles ">RESSOURCES HUMAINES</div>
			</div>
			<div class="col-4 col-sm-4 my-auto menu-item" style="text-align: center;cursor: pointer;" onclick="window.open('<?php echo base_url()?>Users_main');">

				<?php
				$image_properties = array('src' => 'images/welcomepage/MON_COMPTE.png','height' => '100%');
				echo img($image_properties); 
				?>
				<div class="menu-titles">MON COMPTE</div>
			</div>
			<div class="col-4 col-sm-4 my-auto menu-item" style="text-align: center;cursor: pointer;" onclick="window.open('<?php echo base_url()?>Contrat_main');">

				<?php
				$image_properties = array('src' => 'images/welcomepage/CONTRATS.png','height' => '100%');
				echo img($image_properties); 
				?>
				<div class="menu-titles">SUIVI DES CONTRATS</div>
			</div>
			<div class="col-6 col-sm-3 my-auto menu-item" style="text-align: center;cursor: pointer;" >

				<?php
				$image_properties = array('src' => 'images/welcomepage/REPORTS.png','height' => '100%');
				echo img($image_properties); 
				?>
				<div class="menu-titles">RAPPORTS</div>
			</div>-->
		</div>
		<div class="col-md-2"></div>
	</div>
	<div style="position: relative;width: 100%;">
		<img src='<?php echo base_url() ?>assets/img/logos/loginHeader.png' id="logo-footer" style="position: absolute;">
	</div>
			
</body>
</html>
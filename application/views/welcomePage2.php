<!DOCTYPE html>
<html>
<head>
	<title>GESTION</title>
	<meta set="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/fontawesome-free-5.12.0-web/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/welcome.css">
</head>
<body>
	<div id="main-container">
	<div id="welcome-header" style="background-image: url('<?php echo base_url()?>assets/img/logos/header_services.jpg');">
	<div id="welcome-header-color"></div>
	</div>
	<div class="container" id="cards-container">
	<div id="title">
	<h5 >BIENVENUE </h5>
	</div>
		<div class="row">
		<?php
		 foreach ($services as $serviceView) {
			 echo $serviceView;
		 }
		?>
		
		</div>
	</div>
	<!-- <div id="welcome-footer">
		<div ></div>
	<div >

</div>
	</div> -->
	</div>
	<script type="text/javascript" src="<?php echo base_url()?>assets/libraries/particles/particles.min.js"></script>		
		 <script type="text/javascript">
			 particlesJS.load('welcome-header-color','assets/libraries/particles/particles.json', function() {
  
});
		 </script>
</body>
</html>
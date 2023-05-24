<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
	<meta set="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Smart-desk</title>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/ol-v4.6.5-dist/ol.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/fontawesome-free-5.12.0-web/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/DataTables/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/DataTables/Responsive-2.2.3/css/responsive.bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/DataTables/FixedColumns-3.3.2/css/fixedColumns.dataTables.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/dropify-master/css/dropify.min.css">

	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/chart-js/chart.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/datatables-style.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/rgbaColorPicker/rgbaColorPicker.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/geo-business/mainView.css">
</head>
<body>
	<div style="width: 50px;height: 50px;border-radius: 30px;background: white;z-index: 100000000;display: flex;justify-content: center;align-items: center;position: absolute;right: 10px;top: 10px;box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
		<!--Back to home-->
				
	<a href="<?php echo base_url() ?>">
		<i class="fa fa-home text-danger fa-lg"></i>
	</a>
	</div>
	<!-- <div class="custom-info-box success">
		<i class="far fa-check-circle fa-lg"></i>
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		<p>Hello  man how are you !</p>
	</div> -->
	<div id="loader-container" class="loaderDialog hidden">
		<div>
			<div class="loader">

			</div>
			<div class="loader">
				
			</div>

		</div>
	</div>

	<?php echo $mapView; ?>
	<div class="modal" tabindex="-1" role="dialog" id="modal-dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Confirmation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p id="dialog-msg"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="confirm-dialog-btn">confirmer</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-dialog-btn">Quitter</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url()?>assets/libraries/jquery/jquery-3.4.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/ol-v4.6.5-dist/ol.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/ol-v4.6.5-dist/proj4-2.4.4.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/moment/moment.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/libraries/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/DataTables/datatables.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/jszip.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/buttons.html5.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/DataTables/Responsive-2.2.3/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/DataTables/FixedColumns-3.3.2/js/dataTables.fixedColumns.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/chart-js/chart.bundle.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/chart-js/plugins/chartjs-plugin-datalabels.min.js"></script>
	<script src="<?php echo base_url()?>assets/libraries/dropify-master/js/dropify.min.js"></script>
	<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.1/jspdf.debug.js"></script>
	
	<script type="text/javascript">
		BaseUrl = "<?php echo base_url();?>";
	</script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/libraries/rgbaColorPicker/rgbaColorPicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/custom/js/geo-business/mainView.js"></script>
	<script type="text/javascript" src="assets/libraries/jsts/jsts-1.6.1.min.js"></script>
</body>
</html>
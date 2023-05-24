<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Smart-desk</title>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/fontawesome-free-5.12.0-web/css/all.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/DataTables/datatables.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/DataTables/Responsive-2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/dropify-master/css/dropify.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/ol/ol.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/datatables-style.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/jquery-steps/jquery.steps.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/chart-js/chart.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/custom/css/contrat-sections/contrat_mainView.css">
    <style type="text/css">
        html
        {
            height: 100%;
            width: 100%;

        }
        body
        {
            min-height: 100%;
            

        }
    </style>
</head>
<body>
    <div class="wrapper">

        <!-- Sidebar -->
        <nav id="sidebar" class="hidden noprint" >
            <div id="toggle-sidebar"><i class="fas fa-bars"></i></div>
            <div style="width:100%;display: flex;justify-content: top;flex-direction: column;">
                <div style="text-align: center;width: 100%;padding-top: 2px;flex-grow: 1">
                    <?php
                    if(isset($img))
                    {
                    $image_properties = array('src' => $img,'width' => '60','height' => '60','id'=>'logo-entreprise');
                    echo img($image_properties);   
                    }
                    ?>
                </div>
                
            </div>
            <div id="menu">
                <ul class="principal-list">
                    <li id="menu-list-contrat" class="li-titre active">
                        <i class="fas fa-file-signature menu-icons"></i>
                        <span>Liste des Contrats</span>
                        <span class="menu-badge" id="nbr-contrat"></span>
                    </li>
                    <li id="menu-info-contrat" class="li-titre">
                        <i class="fas fa-info-circle"></i>
                        <span>Informations</span>
                        
                        <ul class="secondery-list">
                            <li id="infoContrat-li" class="li-secondtitre">
                                <i class="fas fa-info menu-secondicons"></i>
                                <span>Details</span>
                                
                            </li>
                            <li id="listeFactures-li" class="li-secondtitre">
                                <i class="fas fa-dollar-sign menu-secondicons"></i>
                                <span>Factures</span>
                                <span class="menu-badge"></span>
                            </li>
                            <li id="nouvelleFacture-li" class="li-secondtitre">
                                <i class="fas fa-plus menu-secondicons"></i>
                                <span>Nouvelle Facture</span>
                                
                            </li>
                        </ul>
                        
                    </li>
                    <li id="menu-list-nouveauContrat" class="li-titre">
                        <i class="far fa-plus-square menu-icons"></i>
                        <span>Nouveau Contrat</span>
                        
                    </li>
                    <li id="menu-list-devis" class="li-titre">
                        <i class="far fa-plus-square menu-icons"></i>
                        <span>Gestion des Devis</span>
                        
                    </li>
                    <li id="menu-list-client" class="li-titre">
                        <i class="fas fa-users menu-icons"></i>
                        <span>Nos Clients</span>
                        <span class="menu-badge" id="nbr-client"></span>
                    </li>
                    <li id="menu-list-dashboard" class="li-titre">
                        <i class="fas fa-chart-line menu-icons"></i>
                        <span>Tableau de Bord</span>
                        
                    </li>
                    <li id="menu-list-profilEntreprise" class="li-titre">
                        <i class="fas fa-briefcase menu-icons"></i>
                        <span>Profil Entreprise</span>
                        
                    </li>
                </ul>
                
                
                
            </div>
            <div style="width: 100%;text-align: center;">
                <a href="Login/logout"><i class="fas fa-power-off fa-2x" style="color:#718487;"></i></a>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content" style="width: 100%;height: 100%;">
          
            <div id="main-container" style="width: 100%;padding: 5px;">
                <?php echo $contratListSection ?>
                <?php echo $detailsSection?>
                <?php echo $nouveauContrat ?>
                <?php echo $devisSection ?>
                <?php echo $clientsSection ?>
                <?php echo $dashboard ?>
                <?php echo $profilEntrepriseSection ?>
            </div>

        </div>

    </div>  
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
    <script src="<?php echo base_url()?>assets/libraries/ol/ol.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/libraries/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/moment/moment.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/DataTables/datatables.min.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/DataTables/Responsive-2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/jszip.min.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/DataTables/Buttons-1.6.1/js/buttons.html5.min.js"></script>
    
    <script src="<?php echo base_url()?>assets/libraries/chart-js/chart.bundle.min.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/chart-js/plugins/chartjs-plugin-datalabels.min.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/dropify-master/js/dropify.min.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/loading/jquery.loadingModal.min.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url()?>assets/libraries/jquery-steps/jquery.steps.min.js"></script>
    <script type="text/javascript">
        BaseUrl = "<?php echo base_url();?>";
    </script>
    <script src="<?php echo base_url()?>assets/custom/js/contrat-sections/contrat_mainScript.js"></script>

</body>
</html>

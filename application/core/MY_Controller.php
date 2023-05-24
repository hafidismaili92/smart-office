<?php 


/**
 * MY_Controller extends CI_Controller from the core of the codeigniter, this controller
 * will include default functions which will be used throughout the application
 *
 */
class MY_Controller extends CI_Controller
{

    /****************************************Entreprise Folder PATH*******************************************/
    //Default is in the same as the application folder
    
    protected $isAdmin = 0;
    protected $folderPath= entrepriseFolderPath;
    protected $DroitArray =array();
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('M_login');
        $this->load->model('M_entreprise');
        
        if(!($this->router->fetch_class()=='Entreprise' && $this->router->fetch_method()=='inscription'))
        {
         if(!is_logged_in())
         {
            try {
                if($_SERVER['REQUEST_METHOD'] == "POST")
                {
                    throw new Exception("BAD REQUEST");
                }
                else
                {
                    echo $this->load->view('template/login','',true);
                    die;

                }
            }
            catch (Exception $e) {

                http_response_code(400);
                die;
            }
        }
        else
        {
            $dossier =  $this->M_entreprise->entrepriseFolder($this->session->entreprise);
             $this->DroitArray = $this->M_login->verifierDroit($this->session->numeric_matricule);
            $this->isAdmin =$this->session->is_admin;
            if(!empty($dossier))
                 $this->FolderPath = $dossier.'/';
            $currentController = $this->router->fetch_class();
            $adminControllersArray = array('AdminController','Main');
            $affairesControllersArray=array('Affaire_missions','Affaires','Details','NouvelleAffaire','Taches','Tache_Staches','Users_main','User_Fiches_loader','GlobalAffaires');
            $geoBusinessArray = ['GeoBusiness_main','EditGeoBusiness','CustomReader','Attachements','EditComoposantes'];
            $rhControllersArray = array('Employes','Classes','Etablissements','Fonctions','RH_main','GestionAbsence','GestionConges','GestionDeplacement','GestionHeuresSup','Entreprise');
            $contratControllersArray = array('Contrat_main','NouveauContrat','ExcelOperations','Contrats','NouvelleFacture','ListeFacture','Clients','Dashboard','Devis');
            if( $this->isAdmin==1)
            {

                if(!in_array($currentController,$adminControllersArray))
                {
                    header("HTTP/1.1 404 Not Found");
                    exit($currentController);
                }
            }
            else if(!$this->session->confirmed)
            {
                $this->session->sess_destroy();
                die( $this->load->view('template/waitConfirmation','',true));
            }
            else if(!$this->session->active)
            {
                $this->session->sess_destroy();
               die( $this->load->view('template/entrepriseinactive','',true));
                
            }
            else
            {

                if (in_array($currentController,array_merge($affairesControllersArray,$geoBusinessArray)))
            {

              if(!in_array('GAFF', $this->DroitArray))

              {
                header("HTTP/1.1 404 Not Found");
                exit('ACTION INTERDITE');
            }
        }
        elseif (in_array($currentController,$rhControllersArray)) {

            if(!in_array('GRH', $this->DroitArray) && $this->router->fetch_method()!='ImgProfil')

            {
                header("HTTP/1.1 404 Not Found"); 
                exit();
            }
             

        }
        elseif (in_array($currentController,$contratControllersArray)) {
            if(!in_array('GCONTRAT', $this->DroitArray))
            {
                header("HTTP/1.1 404 Not Found"); 
                exit();
            }
        }
        else if($currentController!='Main')
        {
            header("HTTP/1.1 404 Not Found"); 
                exit();
        }
        
            }
        
    }
}


}
}

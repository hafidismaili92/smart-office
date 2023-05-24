<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('M_login');
		$this->load->model('M_entreprise');
	}
	function index()
	{
		if(is_logged_in())
		{

				if($this->session->is_admin)
				{
					redirect('admin');
				}
				else
				{
					$data['profil']=$this->userProfil($this->session->char_matricule);
				$data['services'] = array();
				if (in_array('GAFF', $this->DroitArray))
				{
					array_push($data['services'],$this->load->view('welcomeCards',array("title"=>"MON COMPTE","img"=>base_url()."images/cardsImg/account0.png","description"=>"Accéder à votre espace professionel pour partager et suivre l'évolution des missions aux sein de vous équipes de travail","url"=>base_url()."Users_main"),true));
					array_push($data['services'],$this->load->view('welcomeCards',array("title"=>"GEO-BUSINESS","img"=>base_url()."images/cardsImg/geobusiness0.png","description"=>"créez des affaires géoréférencées, importez des attachements, imprimez vos cartes et beaucoup plus à l'aide d'un SIG simple et intuitif ","url"=>base_url()."GeoBusiness_main"),true));
				}
				if(in_array('GCONTRAT', $this->DroitArray))
			{
				array_push($data['services'],$this->load->view('welcomeCards',array("title"=>"CONTRATS","img"=>base_url()."images/cardsImg/contrats0.png","description"=>"Générez automatiqument vos factures et Garder l'oeil sur l'avancement comptable de vos contrats","url"=>base_url()."Contrat_main"),true));
			}
				if(in_array('GRH', $this->DroitArray))
			{
				array_push($data['services'],$this->load->view('welcomeCards',array("title"=>"RESSOURCES HUMAINS","img"=>base_url()."images/cardsImg/rh0.png","description"=>"Un espace qui vous permet de gérez vos ressources humains et l'organisation de votre entreprise ","url"=>base_url()."RH_main"),true));
			}
				$this->load->helper('html');
				$this->load->view('welcomePage2',$data);
				}
		
			
		}
		else
		{
			$this->load->helper('html');
			//$img = 'images/landPhoto.png';
			$this->load->view('template/login');
		}
	}
	function userProfil($matricule)
	{
		
		
		$this->load->model('M_GestionRH/M_employes','employes');
		$profilPhotoLink = $this->employes->getUserProfilImg($matricule)[0]['photo'];
		$file_info = finfo_open(FILEINFO_MIME_TYPE);
		if(!empty($profilPhotoLink))
		{
			$photo = base64_encode(file_get_contents( $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$matricule.'/photo/'.$profilPhotoLink));
			$mime = finfo_file($file_info, $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$matricule.'/photo/'.$profilPhotoLink);
		}
		else
		{
			$photo = base64_encode(file_get_contents('images/userProfilImg.png'));
			$mime = finfo_file($file_info,'images/userProfilImg.png');
		}
		
		return array('photo64'=>$photo,'photoMime'=>$mime);
		
		
	}
}

?>
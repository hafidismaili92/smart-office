<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_main extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_GestionAffaire/M_nouvelAffaire','nouvelAffaire');
		$this->load->model('M_GestionRH/M_employes','employes');
		
	}
	function index()
	{
		$profil = $this->userProfil($this->session->char_matricule);
		$dataAffaires = array(
			'profil'=>$profil,
			'affairesSection' => $this->load->view('template/gestion-affaire/mesAffaires','',true),
			'affaireMissionsSection' => $this->load->view('template/gestion-affaire/mesAffaires-missions','',true),
			'header'=>$this->load->view('template/gestion-affaire/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-affaire/sideBarre',array('ismesAffaires'=>true,'actif'=>'mesAffaires','profil'=>$profil),true),
			/*'detailsSection' => $this->load->view('gestion-affaire/user-sections/details','',true),
			'eDocumentsSection' => $this->load->view('gestion-affaire/user-sections/eDocuments','',true),
			'mesTachesSection' => $this->load->view('gestion-affaire/user-sections/mesTaches','',true),
			'tache_StacheSection' => $this->load->view('gestion-affaire/user-sections/taches_sousTaches','',true),
			'globalAffaires' => $this->load->view('gestion-affaire/user-sections/globalAffaires','',true)*/
			
		);
		$this->load->view('template/gestion-affaire/mesAffaires-container',$dataAffaires);
	}
		function tachesView()
	{
		$profil = $this->userProfil($this->session->char_matricule);
		$data = array(
			'profil'=>$profil,
			'header'=>$this->load->view('template/gestion-affaire/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-affaire/sideBarre',array('ismesAffaires'=>false,'actif'=>'mesTaches','profil'=>$profil),true)
		);
		$this->load->view('template/gestion-affaire/mesTaches',$data);
	}
	function eDocumentView()
	{
		$profil = $this->userProfil($this->session->char_matricule);
		$data = array(
			'profil'=>$profil,
			'header'=>$this->load->view('template/gestion-affaire/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-affaire/sideBarre',array('ismesAffaires'=>false,'actif'=>'edocuments','profil'=>$profil),true)
		);
		$this->load->view('template/gestion-affaire/edocuments',$data);
	}
	function mesDocuments()
	{
		$profil = $this->userProfil($this->session->char_matricule);
		$data = array(
			'profil'=>$profil,
			'header'=>$this->load->view('template/gestion-affaire/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-affaire/sideBarre',array('ismesAffaires'=>false,'actif'=>'mesDocuments','profil'=>$profil),true)
		);
		$this->load->view('template/gestion-affaire/mesDocuments',$data);
	}
	function globalView()
	{
		$profil = $this->userProfil($this->session->char_matricule);
		$data = array(
			'profil'=>$profil,
			'header'=>$this->load->view('template/gestion-affaire/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-affaire/sideBarre',array('ismesAffaires'=>false,'actif'=>'globalView','profil'=>$profil),true)
		);
		$this->load->view('template/gestion-affaire/global-dashboard',$data);
	}
	function userProfil($matricule)
	{
		$this->load->model('M_GestionRH/M_employes','employes');
		$profilPhotoLink = $this->employes->getUserProfilImg($matricule)[0]['photo'];
		$file_info = finfo_open(FILEINFO_MIME_TYPE);
		if(!empty($profilPhotoLink))
		{
			$photo = base64_encode(file_get_contents($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$matricule.'/photo/'.$profilPhotoLink));
			$mime = finfo_file($file_info,$this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$matricule.'/photo/'.$profilPhotoLink);
		}
		else
		{
			$photo = base64_encode(file_get_contents('images/userProfilImg.png'));
			$mime = finfo_file($file_info,'images/userProfilImg.png');
		}
		
		return array('photo64'=>$photo,'photoMime'=>$mime);
	}
	
	

	function addRangee()
	{
		try {
			$rangee= pg_escape_string($this->input->post('rangee', TRUE));
			if ($rangee =='')
			{
				throw new Exception("Veuillez ajouter un nom");

			}
			elseif (strlen($rangee)>30) {
				throw new Exception("Nom trop long");
			}
			else
			{
				$rslt = $this->nouvelAffaire->insertRangee($rangee,$this->session->numeric_matricule);
				if($rslt>0)
				{
					return $rslt;
				}
				else
				{
					throw new Exception("Cet emplacement existe deja");	
				}
			}
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
		
	}

	function nonConsultedTaches()
	{
		return $this->nouvelAffaire->rangeeList($this->session->numeric_matricule);
	}
	
	
}
?>
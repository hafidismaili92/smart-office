<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GeoBusiness_main extends MY_Controller
{
	
	function __constract(){
		parent::__constract();
	}

	function index(){
		$profil=$this->userProfil($this->session->char_matricule);
		$data = array(
			
			'header'=>$this->load->view('template/geobusiness/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/geobusiness/sideBarre',array('profil'=>$profil),true),
		);
		/*$dataSections['mapView']=$this->load->view('geo-business/map-view',null,true);
		$this->load->view('geo-business/geoBusiness-mainView',$dataSections);*/
		$this->load->view('template/geobusiness/mainView',$data);
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
	
}
?>
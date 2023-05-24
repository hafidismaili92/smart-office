<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contrat_main extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_GestionContrat/M_nouveauContrat','nouveauContrat');
		$this->load->model('M_GestionContrat/M_contrats','contrat');
		$this->load->model('M_GestionContrat/M_listeFactures','facture');
		$this->load->model('M_GestionRH/M_employes','employes');
		$this->load->model('M_entreprise','entreprise');
		$this->load->model('M_GestionContrat/M_clients','M_clients');
	}
	function index2()
	{
		$this->load->helper('html');
		$imgEntreprise = glob($this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.{jpg,png,jpeg}', GLOB_BRACE);
		if(count($imgEntreprise)>0)
		{
			$dataSections['img']=$imgEntreprise[0];
			$dtaEntreprise['img']=$imgEntreprise[0];
		}
		$dtaEntreprise['villes']=$this->entreprise->entrepriseListeVille();
		$dataSections['nouveauContrat'] = $this->load->view('gestion-contrats/contrat-sections/ajouter_contrat',array('villes_affaire'=>$this->getListVilles(),'domaines'=>$this->getListDomaines(),'unites'=>$this->getListunites()),true);

		$dataSections['contratListSection']= $this->load->view('gestion-contrats/contrat-sections/listes_contrats','',true);
		$dataSections['clientsSection']= $this->load->view('gestion-contrats/contrat-sections/clients','',true);
		$dataSections['profilEntrepriseSection']= $this->load->view('gestion-contrats/contrat-sections/profil_entreprise',$dtaEntreprise,true);
		$detailsArray['infoContrat'] = $this->load->view('gestion-contrats/contrat-sections/contratDetails/infoContrat',array('etatContrat'=>$this->getetatContrat()),true);
		$detailsArray['nouvelleFacture'] = $this->load->view('gestion-contrats/contrat-sections/contratDetails/nouvelleFacture','',true);
		$detailsArray['listeFactures'] = $this->load->view('gestion-contrats/contrat-sections/contratDetails/listeFactures',array('etatFacture'=>$this->getetatFacture(),'modePayement'=>$this->getModePayement()),true);
		$dataSections['dashboard'] = $this->load->view('gestion-contrats/contrat-sections/dashboard',array('thinkimg'=>'images/letsThink.png'),true);
		$dataSections['devisSection'] = $this->load->view('gestion-contrats/contrat-sections/devis',array('unites'=>$this->getListunites()),true);
		$dataSections['detailsSection']= $this->load->view('gestion-contrats/contrat-sections/contrat_details',$detailsArray,true);
		
		//$this->load->view('gestion-contrats/contrats_mainView',$dataSections);
		$this->load->view('template/gestion-contrats/contrats-container',$dataSections);
		//$this->load->view('welcomePage');
	}
	function index()
	{
		$profil = $this->userProfil($this->session->char_matricule);
		$data = array(
			'profil'=>$profil,
			'header'=>$this->load->view('template/gestion-contrats/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-contrats/sideBarre',array('isContrat'=>true,'actif'=>'contratList','profil'=>$profil),true),
			'contratListSection'=>$this->load->view('template/gestion-contrats/listes_contrats','',true),
			'listeFactures'=>$this->load->view('template/gestion-contrats/liste_factures',array('etatFacture'=>$this->getetatFacture(),'modePayement'=>$this->getModePayement()),true),
			'etatContrat'=>$this->getetatContrat(),
			'nouvelleFacture'=>$this->load->view('template/gestion-contrats/nouvelle-facture','',true),
			
		);
		$this->load->view('template/gestion-contrats/contrats-container',$data);
	}
	function getDashboard()
	{
		$profil = $this->userProfil($this->session->char_matricule);
		$data = array(
			'profil'=>$profil,
			'header'=>$this->load->view('template/gestion-contrats/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-contrats/sideBarre',array('isContrat'=>false,'actif'=>'dashboard','profil'=>$profil),true),
			
			
		);
		$this->load->view('template/gestion-contrats/dashboard',$data);
	}
	function newContratView()
	{
		$profil = $this->userProfil($this->session->char_matricule);
		$data = array(
			'profil'=>$profil,
			'header'=>$this->load->view('template/gestion-contrats/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-contrats/sideBarre',array('isContrat'=>false,'actif'=>'nouveauContrat','profil'=>$profil),true),
			'villes_affaire'=>$this->getListVilles(),
			'domaines'=>$this->getListDomaines(),
			'unites'=>$this->getListunites(),
			'clients'=>$this->loadClients()["data"]
			
		);
		$this->load->view('template/gestion-contrats/nouveau-contrat',$data);
		
	}
	function devisView()
	{
		$profil = $this->userProfil($this->session->char_matricule);
		$data = array(
			'profil'=>$profil,
			'header'=>$this->load->view('template/gestion-contrats/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-contrats/sideBarre',array('isContrat'=>false,'actif'=>'devis','profil'=>$profil),true),
			'unites'=>$this->getListunites()
			
		);
		$this->load->view('template/gestion-contrats/devis',$data);
		
	}
	function clientView()
	{
		$profil = $this->userProfil($this->session->char_matricule);
		$data = array(
			'profil'=>$profil,
			'header'=>$this->load->view('template/gestion-contrats/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-contrats/sideBarre',array('isContrat'=>false,'actif'=>'client','profil'=>$profil),true),
			
			
		);
		$this->load->view('template/gestion-contrats/clients',$data);
		
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
	function getetatContrat()
	{
		return $this->contrat->etatList();
	}
	function getetatFacture()
	{
		return $this->facture->etatFactureList();
	}
	function getModePayement()
	{
		return $this->facture->modePayement();
	}
	function getListVilles()
	{
		return $this->nouveauContrat->villesList();
	}
	function getListDomaines()
	{
		return $this->nouveauContrat->domainesList();
	}
	function getListunites()
	{
		return $this->nouveauContrat->load_unites();
	}
	function loadClients()
	{
		
		$rslt = $this->M_clients->clientsList($this->session->entreprise);
		
		return $rslt;
	}

}
?>
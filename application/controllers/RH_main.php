<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
class RH_main extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		
		$this->load->model('M_GestionRH/M_employes','employes');
		$this->load->model('M_GestionRH/M_gestionFonctions','gestionFonctions');
		$this->load->model('M_GestionRH/M_gestionConge','gestionConge');
		$this->load->model('M_GestionRH/M_gestionEtablissements','gestionEtablissements');
		$this->load->model('M_GestionRH/fonctionsList','gestionFonctions');
	}
	function index()
	{
		$profil=$this->userProfil($this->session->char_matricule);
		$gestionEmpArr = $this->nouveauEmployeData();
		$gestionEmpArr['congeTypes']=$this->loadConge_type();
		$entrData = $this->M_entreprise->entrepriseData($this->session->entreprise);
		$hdb = strtotime(date('Y-m-d ').$entrData['hdebut'].':00');
        $hfn = strtotime(date('Y-m-d ').$entrData['hfin'].':00');

        $entrData['hjr'] = abs($hdb-$hfn)/3600;
		$entrData['demiJconge_heure'] = $entrData['hjr']/2;
		$etablissements = $this->gestionEtablissements->etablissementList($this->session->entreprise);
		$fonctions = $this->gestionFonctions->fonctionsList($this->session->entreprise);
		
		$etabLibAndIds = array_map(fn($item)=> array($item[0],$item[1]),$etablissements['data']);
		$foncbLibAndIds = array_map(fn($item)=> array($item[0],$item[1]),$fonctions['data']);
		$dataEmp = array(
			'profil'=>$profil,
			'listEmploye' => $this->load->view('template/gestion-rh/employees-list',null,true),
			'gestionEmployee'=>$this->load->view('template/gestion-rh/gestion-employee',array_merge($gestionEmpArr,$entrData),true),
			'header'=>$this->load->view('template/gestion-rh/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-rh/sideBarre',array('isEmpList'=>true,'actif'=>'EmpList','profil'=>$profil),true),
			'etablissementsList'=>$etabLibAndIds,
			'fonctionsList'=>$foncbLibAndIds,
			'dtaEntreprise'=>$entrData
			
		);
		/*$dataSections['profil']=$this->userProfil($this->session->char_matricule);
		$employeesList =$this->load->view('template/gestion-rh/employees-list',null,true);
		$gestionEmpArr = $this->nouveauEmployeData();
		$gestionEmpArr['congeTypes']=$this->loadConge_type();
		$gestionEmployee=$this->load->view('gestion-rh/gestionEmployee',$gestionEmpArr,true);
		$dataSections['nouveauEmploye'] =$this->load->view('gestion-rh/ajouterEmploye',$this->nouveauEmployeData(),true);// ;
		$dataSections['gestionFonctions']= $this->nouvelleFonctionsData();
		$dataSections['listEmploye']= $employeesList;
		$dataSections['gestionEmployee']= $gestionEmployee;*/
		$this->load->view('template/gestion-rh/rh-container',$dataEmp);
		
		//$this->load->view('welcomePage');
	}
	function addEmpView()
	{
		$profil=$this->userProfil($this->session->char_matricule);
		$gestionEmpArr = $this->nouveauEmployeData();
		$etablissements = $this->gestionEtablissements->etablissementList($this->session->entreprise);
		$fonctions = $this->gestionFonctions->fonctionsList($this->session->entreprise);
		
		$etabLibAndIds = array_map(fn($item)=> array($item[0],$item[1]),$etablissements['data']);
		$foncbLibAndIds = array_map(fn($item)=> array($item[0],$item[1]),$fonctions['data']);
		$dataEmp = array(
			'profil'=>$profil,
			
			'header'=>$this->load->view('template/gestion-rh/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-rh/sideBarre',array('isEmpList'=>false,'actif'=>'addEmp','profil'=>$profil),true),
			'etablissementsList'=>$etabLibAndIds,
			'fonctionsList'=>$foncbLibAndIds
		);
		$this->load->view('template/gestion-rh/ajouter-employe',array_merge($dataEmp,$gestionEmpArr));

	}
	function organisationView()
	{
		$profil=$this->userProfil($this->session->char_matricule);
		$gestionEmpArr = $this->nouvelleFonctionsData();
		$dataEmp = array(
			'profil'=>$profil,
			
			'header'=>$this->load->view('template/gestion-rh/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-rh/sideBarre',array('isEmpList'=>false,'actif'=>'organisation','profil'=>$profil),true),
			
			
		);
		$this->load->view('template/gestion-rh/gestion-fonctions',array_merge($dataEmp,$gestionEmpArr));

	}
	function entrepriseView()
	{
		$imgEntreprise = glob($this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.{jpg,png,jpeg}', GLOB_BRACE);
		$profil = $this->userProfil($this->session->char_matricule);
		$data = array(
			'profil'=>$profil,
			'header'=>$this->load->view('template/gestion-rh/header',array('profil'=>$profil),true),
			'sideBarre'=>$this->load->view('template/gestion-rh/sideBarre',array('isEmpList'=>false,'actif'=>'entreprise','profil'=>$profil),true),
			'villes'=>$this->M_entreprise->entrepriseListeVille()
			
			
		);
		if(count($imgEntreprise)>0) {$data['img']=$imgEntreprise[0];}
		$this->load->view('template/gestion-rh/profile-entreprise',$data);
		
	}
	function loadConge_type()
	{
		$typeList =$this->gestionConge->typeConge_list();
		return $typeList;
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
	function nouveauEmployeData()
	{
		$entreprise = $this->session->entreprise;
		$nouveauEmployeData = $this->employes->M_nouveauEmployeData($entreprise);
		$data['contrats']= $nouveauEmployeData['contrats'];
		$data['villes']= $nouveauEmployeData['villes'];
		return $data;
		
	}
	function nouvelleFonctionsData()
	{
		$nouvelleFonctionsData = $this->gestionFonctions->M_nouvelleFonctionsData($this->session->entreprise);
		$data['types']= $nouvelleFonctionsData['type'];
		$data['typeEtablissements']= $nouvelleFonctionsData['typeEtablissement'];
		return $data;
		//return $this->load->view('gestion-rh/gestionFonctions',$data,true);
		
	}

	
}
?>
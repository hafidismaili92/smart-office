<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employes extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_GestionRH/M_employes','employes');
		$this->load->model('M_GestionRH/M_gestionEtablissements','gestionEtablissements');
		$this->load->model('M_GestionRH/M_gestionFonctions','gestionFonctions');
		$this->load->library('form_validation');
		$this->load->helper('download');
	}
	function downloadContrat()
	{
		try {

			if(isset($_GET['cible']))
			{
				$matricule = $_GET['cible'];
				if(strlen($matricule)>10)
				{
					throw new Exception("fichier introuvable");
				}
				$liendata = $this->employes->checkAttachement($matricule,$this->session->entreprise,'contrat');
				if(is_array($liendata))
				{
					$fullLink = $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$liendata['char_matricule'].'/contrat/'.$liendata['lien_contrat'];
					$ext = pathinfo($fullLink, PATHINFO_EXTENSION);
					force_download('contrat collaborateur'.$liendata['char_matricule'].'.'. $ext,$fullLink);
					//echo $fullLink;
				}
				else
				{
					throw new Exception("fichier introuvable");
				}
			}
			else
			{
				throw new Exception("fichier introuvable");

			}

		} catch (Exception $e) {

			$message = $e->getMessage();
			http_response_code(400);
			die( $message );

		}
	}
	function downloadDiplome()
	{
		try {

			if(isset($_GET['cible']))
			{
				$matricule = $_GET['cible'];
				if(strlen($matricule)>10)
				{
					throw new Exception("fichier introuvable");
				}
				$liendata = $this->employes->checkAttachement($matricule,$this->session->entreprise,'diplome');
				if(is_array($liendata))
				{

					$fullLink = $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$liendata['char_matricule'].'/diplome/'.$liendata['lien_diplome'];
					$ext = pathinfo($fullLink, PATHINFO_EXTENSION);
					force_download('Diplome collaborateur '.$liendata['char_matricule'].'.'. $ext,$fullLink);
					//echo $fullLink;
				}
				else
				{
					throw new Exception("fichier introuvable");
				}
			}
			else
			{
				throw new Exception("fichier introuvable");

			}

		} catch (Exception $e) {

			$message = $e->getMessage();
			http_response_code(400);
			die( $message );

		}
	}
	function employeeProfil()
	{
		try {
			$FolderPath = entrepriseFolderPath;
			$matricule = pg_escape_string($this->input->post('matricule-gestion', TRUE));
			if(strlen($matricule)>10)
			{
				throw new Exception("matricule invalide");
			}
			else if(strlen($matricule)<4)
			{
				throw new Exception("Veuillez indiquer le matricule");
			}
			$rslt = $this->employes->getUserProfil($matricule,$this->session->entreprise);
			if(is_array($rslt))
			{
				$profilPhotoLink = $rslt [0]['lien_photo'];
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$path = $FolderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$matricule.'/photo/'.$profilPhotoLink;
				if(!empty($profilPhotoLink) && file_exists($path))
				{
					$photo = base64_encode(file_get_contents($path));
					$mime = finfo_file($file_info,$path);
					$rslt[0]['hasPhoto']=1;
				}
				else
				{
					$rslt[0]['hasPhoto']=0;
					$photo = base64_encode(file_get_contents('images/userProfilImg.png'));
					$mime = finfo_file($file_info,'images/userProfilImg.png');
				}
				$rslt[0]['photo64'] = $photo;
				$rslt[0]['photoMime'] = $mime;
				unset($rslt [0]['lien_photo']);
				$rslt [0]['lien_diplome'] = !empty($rslt [0]['lien_diplome'])?'<a href="Employes/downloadDiplome?cible='.$rslt[0]['numeric_matricule'].'"><i class="fas fa-download fa-lg" style="color:rgba(255,0,0,0.7)"></i></a>':'<i class="far fa-times-circle info-recrue-icons fa-lg" style="color:rgba(0,0,0,0.3)"></i>';
				$rslt [0]['lien_contrat'] = !empty($rslt [0]['lien_contrat'])?'<a href="Employes/downloadContrat?cible='.$rslt[0]['numeric_matricule'].'"><i class="fas fa-download fa-lg" style="color:rgba(255,0,0,0.7)"></i></a>':'<i class="far fa-times-circle info-recrue-icons fa-lg" style="color:rgba(0,0,0,0.3)"></i>';
				echo json_encode($rslt);
			}
			else
			{
				throw new Exception("matricule invalide");

			}

		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function addEmploye()
	{

		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->form_validation->set_data($_POST);
		try{
			$this->load->library('custom_crypt');

			if($this->form_validation->run('ajouterEmployee')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			$photoLink =null;
			$diplomeLink=null;
			$contratLink=null;
			$email = pg_escape_string($this->input->post('employe-email', TRUE));
			$prenom = pg_escape_string($this->input->post('employe-prenom', TRUE));
			$nom = pg_escape_string($this->input->post('employe-nom', TRUE));
			$sexe=pg_escape_string($this->input->post('employe-sexe', TRUE));
			/****************************************************************************
			*								verification de la photo        			*
			*																			*
			*****************************************************************************/
			if (isset($_FILES['employe-photo']['name'])  && !empty($_FILES['employe-photo']['name'])) {
				$configPhotos['allowedMime'] = array('image/jpeg', 'image/pjpeg','image/png');
				$configPhotos['max_size'] = 5*1024*1024;
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($file_info, $_FILES['employe-photo']['tmp_name']);

				if (!in_array($mime,$configPhotos['allowedMime'])) {
					
					throw new Exception('Fichier non autorisé : '.$_FILES['employe-photo']['name']);
				}
				elseif ($_FILES['employe-photo']['size']>$configPhotos['max_size']) {
					throw new Exception('Fichier dépassant 1Mo : '.$_FILES['employe-photo']['name']);
				}
				elseif (0 < $_FILES['employe-photo']['error']) {
					throw new Exception('erreur de lecture' . $_FILES['employe-photo']['error']);
				}
				else
				{
					$ext = pathinfo($_FILES['employe-photo']['name']);
					$renamePhoto =  $this->custom_crypt->random_str(35,date('mds'));
					$photoLink = $renamePhoto.'.'.$ext['extension'];
				}
				
			}
			/*else
			{
				throw new Exception('Photo manquante');
			}*/
			/****************************************************************************
			*								verification diplome						*
			*																			*
			*****************************************************************************/
			
			if (isset($_FILES['employe-scan-diplome']['name']) && !empty($_FILES['employe-scan-diplome']['name'])) {
				$configDiplome['allowedMime'] = array('application/pdf');
				$configDiplome['max_size'] = 0.8*1024*1024;
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($file_info, $_FILES['employe-scan-diplome']['tmp_name']);

				if (!in_array($mime,$configDiplome['allowedMime'])) {
					
					throw new Exception('Fichier PDF requis : '.$_FILES['employe-scan-diplome']['name']);
				}
				elseif ($_FILES['employe-scan-diplome']['size']>$configDiplome['max_size']) {
					throw new Exception('Fichier dépassant 500ko : '.$_FILES['employe-scan-diplome']['name']);
				}
				elseif (0 < $_FILES['employe-scan-diplome']['error']) {
					throw new Exception('erreur de lecture' . $_FILES['employe-scan-diplome']['error']);
				}
				else
				{
					$ext = pathinfo($_FILES['employe-scan-diplome']['name']);
					$renameDiplome =  $this->custom_crypt->random_str(35,date('mds'));
					$diplomeLink = $renameDiplome.'.'.$ext['extension'];
					

				}
			}
			
			/****************************************************************************
			*								verification contrat						*
			*																			*
			*****************************************************************************/
			
			if (isset($_FILES['employe-scan-contrat']['name']) && !empty($_FILES['employe-scan-contrat']['name'])) {
				$configContrat['allowedMime'] = array('application/pdf');
				$configContrat['max_size'] = 2*1024*1024;
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($file_info, $_FILES['employe-scan-contrat']['tmp_name']);

				if (!in_array($mime,$configContrat['allowedMime'])) {
					
					throw new Exception('Fichier PDF requis : '.$_FILES['employe-scan-contrat']['name']);
				}
				elseif ($_FILES['employe-scan-contrat']['size']>$configContrat['max_size']) {
					throw new Exception('Fichier dépassant 500ko : '.$_FILES['employe-scan-contrat']['name']);
				}
				elseif (0 < $_FILES['employe-scan-contrat']['error']) {
					throw new Exception('erreur de lecture' . $_FILES['employe-scan-contrat']['error']);
				}
				else
				{
					$ext = pathinfo($_FILES['employe-scan-contrat']['name']);
					$renameContrat =  $this->custom_crypt->random_str(35,date('mds'));
					$contratLink = $renameContrat.'.'.$ext['extension'];
					
					/*move_uploaded_file($_FILES['employe-scan-contrat']['tmp_name'],'dossier_Employes/'.$nom.'_'.$rnd.'/contrat/contratEmploye_'.$_FILES['employe-scan-contrat']['name']);*/
				}
			}
			/***************************************************************************
			*					check etablissement and fonction valid		        	*
			*																			*
			*****************************************************************************/
			$rsltET = $this->gestionEtablissements->checkValidEtablissement(pg_escape_string($this->input->post('employe-etablissement', TRUE)),$this->session->entreprise);
			if(!is_array($rsltET))
				throw new Exception("Etablissement Invalide");
			$rsltFN = $this->gestionFonctions->checkValidFonction(pg_escape_string($this->input->post('employe-fonction', TRUE)),$this->session->entreprise);
			if(!is_array($rsltFN))
				throw new Exception("Fonction Invalide");
			/****************************************************************************
			*					Creation des mots de passe provisoire	       			*
			*																			*
			*****************************************************************************/
			
			
			$rndomPassword=$this->custom_crypt->generatePassword();
			$rndomPasswordCrypt=$this->custom_crypt->cryptPassword($rndomPassword);
			/****************************************************************************
			*					insertion à la BD	       								*
			*																			*
			*****************************************************************************/
			$droitArray = $data = explode("," ,pg_escape_string($this->input->post('droits-employee', TRUE)));
			if (!in_array("GAFF", $droitArray)) //tjrs attribuer le droit GAFF
			{
				array_push($droitArray,'GAFF');
			}
			$this->load->library('Date_operations');
			$entrepriseData = $this->M_entreprise->entrepriseData($this->session->entreprise);
			$dteRectrutement=new Datetime($this->input->post('employe-date-recrutement', TRUE));
			$dtecurrentYEar = new DateTime('31-12-'.date('Y'));
			if($dteRectrutement->format('Y')==$dtecurrentYEar->format('Y'))
			{
				$reliquatGlobal = 0;
				$reliquatAnne = $this->date_operations->daysCalculator($dteRectrutement,new DateTime('31-12-'.date('Y')),false);
			}
			else
			{

				$reliquattoAnne = $this->date_operations->daysCalculator($dteRectrutement,new DateTime('31-12-'.$dteRectrutement->format('Y')),false);
				$reliquatGlobal = $reliquattoAnne+(date('Y')-$dteRectrutement->format('Y')-1)*365;
				$reliquatAnne = 365;
			}
			

			//$reliquatAnne = $this->date_operations->daysCalculator(new Datetime(),new DateTime('31-12-'.date('Y')));
			
			
			$reliquatGlobal  = round($reliquatGlobal*$entrepriseData['conge_annee']/365,1);
			$reliquatAnne = round($reliquatAnne*$entrepriseData['conge_annee']/365,1);
			$dataArray = array(
				$reliquatGlobal,
				$reliquatAnne,
				pg_escape_string($this->input->post('employe-cin', TRUE)),
				pg_escape_string($this->input->post('employe-etablissement', TRUE)),
				$sexe,
				$prenom,
				$nom,
				pg_escape_string($this->input->post('employe-situation', TRUE)),
				pg_escape_string($this->input->post('employe-residence', TRUE)),
				pg_escape_string($this->input->post('employe-date-naissance', TRUE)),
				pg_escape_string($this->input->post('employe-lieu-naissance', TRUE)),
				pg_escape_string($this->input->post('employe-date-recrutement', TRUE)),
				pg_escape_string($this->input->post('employe-adresse', TRUE)),
				pg_escape_string($this->input->post('employe-diplome', TRUE)),
				pg_escape_string($this->input->post('employe-fonction', TRUE)),
				pg_escape_string($this->input->post('employe-banque', TRUE)),
				pg_escape_string($this->input->post('employe-rib', TRUE)),
				$email,
				pg_escape_string($this->input->post('employe-tel', TRUE)),
				$photoLink,
				$diplomeLink,
				$rndomPasswordCrypt,
				$contratLink,
				pg_escape_string($this->input->post('employe-type-contrat', TRUE))
			);
			
			
			$empData = $this->employes->insertEmployee($dataArray,$droitArray,$rndomPassword,$entrepriseData['nom']);
			
			if(is_array($empData))
			{
				$MmeOrM = $sexe=="F"?"Mme":"M";
			/****************************************************************************
			*								Stockage des fichiers		       			*
			*																			*
			*****************************************************************************/
			mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat']);
			mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/photo');
			mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/absence');
			mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/fiche_conge');
			mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/ordre_mission');
			mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/heures_sup');
			mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/diplome');
			mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/contrat');
			if (!empty($empData['lienp']))
			{
				
				move_uploaded_file($_FILES['employe-photo']['tmp_name'],$this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/photo/'.$empData['lienp']);
			}
			if (!empty($empData['liend']))
			{
				
				move_uploaded_file($_FILES['employe-scan-diplome']['tmp_name'],$this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/diplome/'.$empData['liend']);
			}
			if (!empty($empData['lienc']))
			{
				
				move_uploaded_file($_FILES['employe-scan-contrat']['tmp_name'],$this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/contrat/'.$empData['lienc']);
			}
			
			
			
			
			echo json_encode(array(
				$empData['char_mat'],
				$empData['nom'],
				$empData['prenom'],
				$MmeOrM,
				$empData['msg'],

			));
			
		}
		elseif (is_string($empData)) {
			throw new Exception($empData);
		}


		else
		{
			throw new Exception('une erreur s est produite');
		}
	}
	catch( Exception $e ) {
		$message = $e->getMessage();
		http_response_code(400);
		die( $message );
	}



}
function editEmploye()
{
	if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
		exit('<h1>No direct script access allowed<h2>');
	$postData = $_POST;
	try{
		$this->load->library('custom_crypt');
		$matricule = pg_escape_string($this->input->post('employe-matricule', TRUE));
			if(strlen($matricule)>10)
				throw new Exception("Matricule Invalide");
		//si c undirecteur on va interdire l'édition de etablissement, fonction, type contrat et diplome et leurs scan
		$emp = $this->employes->employee($matricule,$this->session->entreprise);
		$is_directeur = false;
		if(!is_array($emp))
			throw new Exception("Matricule Invalide");
		else if(trim($emp[0]['is_directeur'])=="t" || trim($emp[0]['is_directeur'])=="true")
		{
				$is_directeur = true;
		}
		if($is_directeur==true)
		{
			$postData['employe-etablissement']="DG";
			$postData['employe-fonction']="DG";
		}
		$this->form_validation->set_data($postData);
		if($this->form_validation->run('ajouterEmployee')== FALSE)
		{
			throw new Exception(validation_errors());


		}
		$photoLink =null;
		$diplomeLink=null;
		$contratLink=null;
		$email = pg_escape_string($this->input->post('employe-email', TRUE));
		$prenom = pg_escape_string($this->input->post('employe-prenom', TRUE));
		$nom = pg_escape_string($this->input->post('employe-nom', TRUE));
		$sexe=pg_escape_string($this->input->post('employe-sexe', TRUE));
		$imageData='';

		

			/****************************************************************************
			*								verification de la photo        			*
			*																			*
			*****************************************************************************/
			if (isset($_FILES['employe-photo']['name'])  && !empty($_FILES['employe-photo']['name'])) {
				$configPhotos['allowedMime'] = array('image/jpeg', 'image/pjpeg','image/png');
				$configPhotos['max_size'] = 5*1024*1024;
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($file_info, $_FILES['employe-photo']['tmp_name']);

				if (!in_array($mime,$configPhotos['allowedMime'])) {
					
					throw new Exception('Fichier non autorisé : '.$_FILES['employe-photo']['name']);
				}
				elseif ($_FILES['employe-photo']['size']>$configPhotos['max_size']) {
					throw new Exception('Fichier dépassant 1Mo : '.$_FILES['employe-photo']['name']);
				}
				elseif (0 < $_FILES['employe-photo']['error']) {
					throw new Exception('erreur de lecture' . $_FILES['employe-photo']['error']);
				}
				else
				{
					$ext = pathinfo($_FILES['employe-photo']['name']);
					$renamePhoto =  $this->custom_crypt->random_str(35,date('mds'));
					$photoLink = $renamePhoto.'.'.$ext['extension'];
				}
				
			}
			else if(isset($_POST['img']))
			{
				$imageData= $_POST['img'];				
				list($type, $imageData) = explode(';', $imageData);
				list(,$extension) = explode('/',$type);
				list(,$imageData) = explode(',', $imageData);
				$renamePhoto =  $this->custom_crypt->random_str(35,date('mds'));
				$photoLink = $renamePhoto.'.'.$extension;
				$imageData = base64_decode($imageData);
				
				
			}
			/*else
			{
				throw new Exception('Photo manquante');
			}*/
			/****************************************************************************
			*								verification diplome						*
			*																			*
			*****************************************************************************/
			
			if (isset($_FILES['employe-scan-diplome']['name']) && !empty($_FILES['employe-scan-diplome']['name'])) {
				$configDiplome['allowedMime'] = array('application/pdf');
				$configDiplome['max_size'] = 0.8*1024*1024;
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($file_info, $_FILES['employe-scan-diplome']['tmp_name']);

				if (!in_array($mime,$configDiplome['allowedMime'])) {
					
					throw new Exception('Fichier PDF requis : '.$_FILES['employe-scan-diplome']['name']);
				}
				elseif ($_FILES['employe-scan-diplome']['size']>$configDiplome['max_size']) {
					throw new Exception('Fichier dépassant 500ko : '.$_FILES['employe-scan-diplome']['name']);
				}
				elseif (0 < $_FILES['employe-scan-diplome']['error']) {
					throw new Exception('erreur de lecture' . $_FILES['employe-scan-diplome']['error']);
				}
				else
				{
					$ext = pathinfo($_FILES['employe-scan-diplome']['name']);
					$renameDiplome =  $this->custom_crypt->random_str(35,date('mds'));
					$diplomeLink = $renameDiplome.'.'.$ext['extension'];
					

				}
			}
			
			/****************************************************************************
			*								verification contrat						*
			*																			*
			*****************************************************************************/
			
			if (isset($_FILES['employe-scan-contrat']['name']) && !empty($_FILES['employe-scan-contrat']['name']) && $is_directeur==false) {
				$configContrat['allowedMime'] = array('application/pdf');
				$configContrat['max_size'] = 2*1024*1024;
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($file_info, $_FILES['employe-scan-contrat']['tmp_name']);

				if (!in_array($mime,$configContrat['allowedMime'])) {
					
					throw new Exception('Fichier PDF requis : '.$_FILES['employe-scan-contrat']['name']);
				}
				elseif ($_FILES['employe-scan-contrat']['size']>$configContrat['max_size']) {
					throw new Exception('Fichier dépassant 500ko : '.$_FILES['employe-scan-contrat']['name']);
				}
				elseif (0 < $_FILES['employe-scan-contrat']['error']) {
					throw new Exception('erreur de lecture' . $_FILES['employe-scan-contrat']['error']);
				}
				else
				{
					$ext = pathinfo($_FILES['employe-scan-contrat']['name']);
					$renameContrat =  $this->custom_crypt->random_str(35,date('mds'));
					$contratLink = $renameContrat.'.'.$ext['extension'];
					
					/*move_uploaded_file($_FILES['employe-scan-contrat']['tmp_name'],'dossier_Employes/'.$nom.'_'.$rnd.'/contrat/contratEmploye_'.$_FILES['employe-scan-contrat']['name']);*/
				}
			}
			/***************************************************************************
			*					check etablissement and fonction valid		        	*
			*																			*
			*****************************************************************************/
			if($is_directeur==false)
			{
				$rsltET = $this->gestionEtablissements->checkValidEtablissement(pg_escape_string($this->input->post('employe-etablissement', TRUE)),$this->session->entreprise);
			if(!is_array($rsltET))
				throw new Exception("Etablissement Invalide");
			$rsltFN = $this->gestionFonctions->checkValidFonction(pg_escape_string($this->input->post('employe-fonction', TRUE)),$this->session->entreprise);
			if(!is_array($rsltFN))
				throw new Exception("Fonction Invalide");
			}
			

			/****************************************************************************
			*					insertion à la BD	       								*
			*																			*
			*****************************************************************************/
			
				if($is_directeur==false)
				{
					$dataArray = array(
				
				pg_escape_string($this->input->post('employe-cin', TRUE)),
				pg_escape_string($this->input->post('employe-etablissement', TRUE)),
				pg_escape_string($this->input->post('employe-fonction', TRUE)),
				pg_escape_string($this->input->post('employe-residence', TRUE)),
				pg_escape_string($this->input->post('employe-lieu-naissance', TRUE)),
				$nom,
				$prenom,
				pg_escape_string($this->input->post('employe-date-naissance', TRUE)),
				pg_escape_string($this->input->post('employe-date-recrutement', TRUE)),
				$sexe,
				pg_escape_string($this->input->post('employe-situation', TRUE)),
				pg_escape_string($this->input->post('employe-rib', TRUE)),
				pg_escape_string($this->input->post('employe-tel', TRUE)),
				$email,
				pg_escape_string($this->input->post('employe-adresse', TRUE)),
				$diplomeLink,
				pg_escape_string($this->input->post('employe-diplome', TRUE)),
				pg_escape_string($this->input->post('employe-banque', TRUE)),
				$photoLink,
				$matricule,
				$matricule,
				pg_escape_string($this->input->post('employe-type-contrat', TRUE)),
				$contratLink,
			);
				}
			else
			{
				$dataArray = array(
				
				pg_escape_string($this->input->post('employe-cin', TRUE)),
				
				pg_escape_string($this->input->post('employe-residence', TRUE)),
				pg_escape_string($this->input->post('employe-lieu-naissance', TRUE)),
				$nom,
				$prenom,
				pg_escape_string($this->input->post('employe-date-naissance', TRUE)),
				pg_escape_string($this->input->post('employe-date-recrutement', TRUE)),
				$sexe,
				pg_escape_string($this->input->post('employe-situation', TRUE)),
				pg_escape_string($this->input->post('employe-rib', TRUE)),
				pg_escape_string($this->input->post('employe-tel', TRUE)),
				$email,
				pg_escape_string($this->input->post('employe-adresse', TRUE)),
				
				pg_escape_string($this->input->post('employe-banque', TRUE)),
				$photoLink,
				$matricule,
				$matricule,
				
			);
				
			}
			
			$entrepriseData = $this->M_entreprise->entrepriseData($this->session->entreprise);
			$empData = $this->employes->editEmployee($dataArray,$this->session->entreprise,$is_directeur);
			
			if(is_array($empData))
			{
				// Folder path to be flushed 
				$folderPhoto_path = $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/photo'; 
				
				$files = glob($folderPhoto_path.'/*');  
				foreach($files as $file) { 

					if(is_file($file))  
						unlink($file);  
				} 

				

				if (!empty($empData['lienp']))
				{
					if($imageData!='')
					{
						file_put_contents($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/photo/'.$empData['lienp'], $imageData);
					}
					else
					{
						move_uploaded_file($_FILES['employe-photo']['tmp_name'],$this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/photo/'.$empData['lienp']);
					}
					
				}
				if ($is_directeur==false && !empty($empData['liend']) && !empty($diplomeLink))
				{
					$folderDiplome_path = $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/diplome'; 

					$filesD = glob($folderDiplome_path.'/*');  
					foreach($filesD as $file) { 

						if(is_file($file))  
							unlink($file);  
					}
					move_uploaded_file($_FILES['employe-scan-diplome']['tmp_name'],$this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/diplome/'.$empData['liend']);
				}
				if ($is_directeur==false && !empty($empData['lienc']) && !empty($contratLink))
				{
					$folderContrat_path = $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/contrat'; 

					$filesC = glob($folderContrat_path.'/*');  
					foreach($filesC as $file) { 

						if(is_file($file))  
							unlink($file);  
					} 

					move_uploaded_file($_FILES['employe-scan-contrat']['tmp_name'],$this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$empData['char_mat'].'/contrat/'.$empData['lienc']);
				}




				echo 1;

			}
			elseif (is_string($empData)) {
				throw new Exception($empData);
			}


			else
			{
				throw new Exception('une erreur s est produite');
			}
		}
		catch( Exception $e ) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}

	}
	function listeEmployees()
	{

		$rslt = $this->employes->employeesListe($this->session->entreprise);

		echo json_encode($rslt);

	}
	function getEmployee()
	{
		try {
			$matricule = pg_escape_string($this->input->post('matricule-gestion', TRUE));
			if(strlen($matricule)>10)
			{
				throw new Exception("matricule invalide");
			}
			else if(strlen($matricule)<4)
			{
				throw new Exception("Veuillez indiquer le matricule");
			}
			$rslt = $this->employes->employee($matricule,$this->session->entreprise);
			if(is_array($rslt))
			{
				echo json_encode($rslt);
			}
			else
			{
				throw new Exception("matricule invalide");

			}

		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}

	}
	function ImgProfil()
	{
		if(isset($_GET['u']) and strlen($_GET['u'])<50)
		{
			$rslt = $this->employes->employee($_GET['u'],$this->session->entreprise);
			if(count($rslt)>0)
			{
				$matricule = $rslt[0]['matricule'];
				$profilPhotoLink = $rslt[0]['photo'];
				$filePath =  entrepriseFolderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$matricule.'/photo/'.$profilPhotoLink;
		$file_info = finfo_open(FILEINFO_MIME_TYPE);
		if(!empty($profilPhotoLink) && file_exists($filePath))
		{

			
			$mime = finfo_file($file_info,$filePath);
			$this->load->image($filePath,$mime);
		}
		else
		{
			$filePath = 'images/userProfilImg.png';
			$mime = finfo_file($file_info,$filePath);
			$this->load->image($filePath,$mime);
		}
			}
		}
		
		else
		{
			$folder = 'images/userProfilImg.png';
			$mime = finfo_file($file_info,'images/userProfilImg.png');
			$this->load->image($folder,$mime);
		}
	}
}
?>
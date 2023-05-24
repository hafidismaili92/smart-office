	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Affaire_missions extends My_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			
			if(!in_array($this->router->fetch_method(),array('downloadAttachement')) && defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST")
				exit('<h1>No direct script access allowed<h2>');
			$this->load->model('M_GestionAffaire/M_affaireMissions','affaireMissions');
			$this->load->model('M_GestionAffaire/M_affaires','M_affaires');
			$this->load->library('form_validation');
		}
		function loadMissions()
		{
			
			$numAffaire = pg_escape_string($this->input->post('affaire', TRUE));
			$rslt = $this->affaireMissions->missionsList($this->session->numeric_matricule,strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire);
			
			echo json_encode($rslt);
			
		}
		function suggestContact()
		{
			if(!isset($_POST['term'])  || strlen($_POST['term'])>100)
			return json_encode([]);
			$filter = $_POST['term'];
		$rslt = $this->affaireMissions->suggestContact($filter,$this->session->entreprise);
		
		echo json_encode($rslt);
		}
		function shareFile()
		{
			try {
				if(!isset($_POST['file']) || !is_numeric($_POST['file']) || empty($_POST['file']) )
				{
					throw new Exception("Document invalide");	
				}
				if(!isset($_POST['contacts']) || empty($_POST['contacts']) || strlen($_POST['contacts'])>500 )
				{
					throw new Exception("liste des contacts invalide");	
				}
				
				$numFile = pg_escape_string($this->input->post('file', TRUE));
				$contacts  = explode(';',$this->input->post('contacts', TRUE));
				$shareData = [];
				foreach ($contacts as  $value) {
					$cmatrArray = explode('(',$value);
					$cmatr = trim($cmatrArray[0]);
					if(!empty($cmatr) && $cmatr !=$this->session->char_matricule)
						array_push($shareData, array("share_with"=>preg_replace('/[^0-9.]+/', '', $cmatr),"id_file"=>$numFile,"share_date"=>date("Y-m-d")));
				}

				$rslt = $this->affaireMissions->add_sharedFile($shareData);
				
				if($rslt==1)
				{
					echo 1;
				}
				else
				{
					
					throw new Exception("une erreur s'est produite");	
					
				}

			} catch (Exception $e) {

				$message = $e->getMessage();
				http_response_code(400);
				die( $message );

			}
		}
		function toggleValidateMission()
		{
			try {
				if(!isset($_POST['numero']) || !is_numeric($_POST['numero']) || empty($_POST['numero']) )
				{
					throw new Exception("numero de mission invalide");	
				}
				if(!isset($_POST['numero_affaire']) || empty($_POST['numero_affaire']))
				{
					throw new Exception("numero d'affaire invalide");	
				}
				if(!isset($_POST['validate']) || !in_array($_POST['validate'],[1,0]))
				{
					throw new Exception("une Erreur s'est produite");
				}
				$numAffaire = pg_escape_string($this->input->post('numero_affaire', TRUE));
				$dta = array(
					
					pg_escape_string($this->input->post('numero', TRUE)),
					strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire,
					$this->session->numeric_matricule
					
				); 
				
				$rslt = $this->affaireMissions->validate_mission($dta,$_POST['validate']);
				if($rslt==1)
				{
					echo 1;
				}
				else
				{
					
					throw new Exception("une erreur s'est produite");	
					
				}

			} catch (Exception $e) {

				$message = $e->getMessage();
				http_response_code(400);
				die( $message );

			}
			
		}
		function addMission()
		{
			try {
				if($this->form_validation->run('ajouterMission')== FALSE)
				{
					throw new Exception(validation_errors());


				}
				$rslt = $this->M_affaires->check_responsableMatricule($this->session->etablissement,$this->session->entreprise,pg_escape_string($this->input->post('missions-responsable', TRUE)));
				if(!is_array($rslt) || count($rslt)==0)
				{

					throw new Exception("matricule invalide");

				}
				foreach ($_FILES as $file) {
				if($file['size']>(10*1024*1024)){
					throw new Exception("fichier".$file['name']." Trop volumineux!");
				}
			}
			$numAffaire = pg_escape_string($this->input->post('affaire', TRUE));
			$coorectNameAffaire = strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire;
				$dtaMission = array(
					'delai'=>pg_escape_string($this->input->post('affaire-mission-delai', TRUE)),
					'matricule'=>$rslt[0]['numeric_matricule'],
					'libelle'=>pg_escape_string($this->input->post('missions-Libelle', TRUE)),
					'numero_affaire'=>$coorectNameAffaire,
					'avancement'=>0,
					'niveau'=>1,
					'consulte'=>'false',
					'nouvel'=>'true',
					'validee'=>'false',
					'matricule_createur'=>$this->session->numeric_matricule,
					'date_debut'=>date("Y-m-d h:i:s"),
					'observations'=>pg_escape_string($this->input->post('info-supp', TRUE)),
				); 
				$idtache = $this->affaireMissions->insertMission($dtaMission);
				if($idtache>0)
				{
					$folderName = $this->normalizeString($numAffaire);
					if(!is_dir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_affaires/'.$folderName.'/taches/'.$idtache.'/att'))
					{
						mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_affaires/'.$folderName.'/taches/'.$idtache.'/att',0775,true);
						
					}
					$allowMime = array(
				'image/jpeg',
				'image/pjpeg',
				'image/png',
				'image/gif',
				'image/x-icon',
				'image/tiff',
				'text/plain',
				'text/x-csv',
				'application/csv',
				'text/csv',
				'application/zip',
				'application/x-rar-compressed',
				'application/xml',
				'application/vnd.ms-excel',
				'application/pdf',
				'application/vnd.openxmlformats-officedocument.presentationml.presentation',
				'application/x-rar-compressed',
				'application/json',
				'application/vnd.ms-excel',
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				'zz-application/zz-winassoc-dat',
				'application/msword',
				'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'image/x-dwg',
				'image/x-dxf',
				'drawing/x-dwf',
				'application/acad',
				'application/dxf'
			);
					$allowOctet_stream = array('pdf','xlsx','xls','doc','docx','dwg','dxf','gif','jpeg','jpg','png','rar','zip','svg','ppt','pptx','ico');
					$maxFileSize = 10*1024*1024;
					$this->load->library('custom_crypt');
			$error ="";
			$compteur=0;
					foreach ($_FILES as $file) {
				$name = $file['name'];
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($file_info, $file['tmp_name']);
				$path_parts = pathinfo($name);
				$ext = $path_parts['extension'];
				if (!in_array($mime,$allowMime) && !in_array($ext,$allowOctet_stream)) {
					$error=$error.'<p>"'.$name.'" : fichier non autorisé!</p>';
					continue;
				}
				else if (0 < $file['error']) {
					$error=$error.'<p>"'.$name.'" : une erreur inattendue empêche l\'importation du fichier</p>';
					continue;
				}
				else if($file['size']>$maxFileSize)
				{
					$error= $error.'<p>"'.$name.'" : Fichier dépassant la taille maximale 10MB!</p>';
					continue;
				}
				
				$normalizeName = $this->normalizeString($name);
				$cryptedName = $this->custom_crypt->random_str(35,$normalizeName).time().'.'.$ext;
				$fileKey = $this->custom_crypt->random_str(35,$normalizeName).time();
				$destinationFolder = $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_affaires/'.$folderName.'/taches/'.$idtache.'/att';
				
				$rslt = $this->affaireMissions->insertTacheAtt(array($name,$ext,$cryptedName,$fileKey,$idtache));
				if(is_dir($destinationFolder) && $rslt != 0)
					move_uploaded_file($file['tmp_name'],$destinationFolder.'/'.$rslt['crypted_name']);
				$compteur++;
				}
					//mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_affaires/'.$folderName.'/taches/'.$rslt);
					echo 1;	
					
				}
				else
				{
					throw new Exception("une erreur s'est produite");	
				}
			} catch (Exception $e) {
				$message = $e->getMessage();
				http_response_code(400);
				die( $message );
			}
		}
		function getAttachements()
		{
			try {
				if(!isset($_POST['numero']) || !is_numeric($_POST['numero']) || empty($_POST['numero']) )
				{
					throw new Exception("numero de mission invalide");	
				}
				if(!isset($_POST['affaire']) || empty($_POST['affaire']))
				{
					throw new Exception("numero d'affaire invalide");	
				}
				if(isset($_POST['resp']) && !in_array($_POST['resp'],array('OWNER','RESP')))
				{
					throw new Exception("données invalides");	
				}
				$ownerOrResp = $_POST['resp']=='RESP'?'RESP':'OWNER';
				$numerotache = pg_escape_string($this->input->post('numero', TRUE));
				$numAffaire = pg_escape_string($this->input->post('affaire', TRUE));
				$dtaMission = array(
					'id_tache'=>$numerotache ,
					'affaire'=>strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire,
					'user'=>$this->session->numeric_matricule,
				);
				$rslt = $this->affaireMissions->getAttachements($dtaMission,$ownerOrResp);
				if(is_array($rslt))
				{
					$attArray = array();
		foreach ($rslt as $row) {
			array_push($attArray,array(
				
				'download'=>html_escape($row['key'])==''?'<i class="fa  fa-question-circle" style="color: #1212131a;"></i>':'<a href="Affaire_missions/downloadAttachement?file='.$row['key'].'&t='.$row['tnum'].'&ty='.$ownerOrResp.'"><i class="fa fa-download" style="color: #f95e66;cursor:pointer;"></i></a>',
				'name'=>$row['nom'],
				'extension'=>$row['extension'],
			));
		}
		echo json_encode($attArray);
				}
				else
				{
					throw new Exception("une erreur s'est produite");	
				}
			} catch (Exception $e) {
				$message = $e->getMessage();
				http_response_code(400);
				die( $message );
			}
		}
		function allMesAttach()
	{
		try {
			
			
			$rslt = $this->affaireMissions->M_allMesAttach($this->session->numeric_matricule,$this->session->entreprise);
			echo json_encode($rslt);
		} catch (Exception $e) {
			echo json_encode([]);
		}
	}
	function filesShared()
	{
		try {
			
			
			$rslt = $this->affaireMissions->M_filesShared($this->session->numeric_matricule,$this->session->entreprise);
			echo json_encode($rslt);
		} catch (Exception $e) {
			echo json_encode([]);
		}
	}
		function downloadAttachement()
{
	$this->load->helper('download');
	if(!isset($_GET['ty']) || !in_array($_GET['ty'],array('OWNER','RESP'))) return;
	else if(isset($_GET['file']) && strlen($_GET['file'])<50 && isset($_GET['t']) && is_numeric($_GET['t']))
	{
		$user = $this->session->numeric_matricule;
		$fileData = $this->affaireMissions->getAttByKey(array($_GET['file'],$_GET['t'],$user),$_GET['ty']);
		
		if(is_array($fileData))
		{
			$folderName = $this->normalizeString(str_replace($this->session->entreprise.'_pfx_','',$fileData['affaire']));
			 
			$folder = $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_affaires/'.$folderName.'/taches/'.$fileData['tnum'].'/att';
			
			if(file_exists($folder.'/'.$fileData['crypted_name']))
				force_download($fileData['nom'],file_get_contents($folder.'/'.$fileData['crypted_name']), NULL);
		}
		else return;
	}
	else
		return;
}
		function removeMission()
		{
			try {
				if(!isset($_POST['numero']) || !is_numeric($_POST['numero']) || empty($_POST['numero']) )
				{
					throw new Exception("numero de mission invalide");	
				}
				if(!isset($_POST['affaire']) || empty($_POST['affaire']))
				{
					throw new Exception("numero d'affaire invalide");	
				}


				$numerotache = pg_escape_string($this->input->post('numero', TRUE));
				$numAffaire = pg_escape_string($this->input->post('affaire', TRUE));
				
				$dtaMission = array(
					'id_tache'=>$numerotache ,
					'affaire'=>strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire,
					'createur'=>$this->session->numeric_matricule,
				);
				$rslt = $this->affaireMissions->removeMission($dtaMission);
				if($rslt>0)
				{
					echo $rslt;
				}
				else
				{
					throw new Exception("une erreur s'est produite");	
				}
			} catch (Exception $e) {
				$message = $e->getMessage();
				http_response_code(400);
				die( $message );
			}

		}
		function editMission()
		{
			try {
				if($this->form_validation->run('editMission')== FALSE)
				{
					throw new Exception(validation_errors());


				}
				$rslt = $this->M_affaires->check_responsableMatricule($this->session->etablissement,$this->session->entreprise,pg_escape_string($this->input->post('edit-missions-responsable', TRUE)));
				if(!is_array($rslt) || count($rslt)==0)
				{

					throw new Exception("matricule invalide");

				}
				$numAffaire = pg_escape_string($this->input->post('affaire', TRUE));
				$dtaMission = array(
					'delai'=>pg_escape_string($this->input->post('edit-mission-delai', TRUE)),
					'matricule'=>$rslt[0]['numeric_matricule'],
					'libelle'=>pg_escape_string($this->input->post('edit-missions-libelle', TRUE)),
					'id_tache'=>pg_escape_string($this->input->post('edit-num-mission', TRUE)),
					'matricule_createur'=>$this->session->numeric_matricule,
					'numero_affaire'=>strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire
					
				); 
				$rslt = $this->affaireMissions->editMission($dtaMission);
				if($rslt>0)
				{
					echo $rslt;
				}
				else
				{
					throw new Exception("une erreur s'est produite");	
				}
			} catch (Exception $e) {
				$message = $e->getMessage();
				http_response_code(400);
				die( $message );
			}
		}
		public static function normalizeString ($str = '')
		{
			$str = strip_tags($str); 
			$str = preg_replace('/[\r\n\t ]+/', '_', $str);
			$str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', '_', $str);
			$str = strtolower($str);
			$str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
			$str = htmlentities($str, ENT_QUOTES, "utf-8");
			$str = preg_replace("/(&)([a-z])([a-z]+;)/i", '_', $str);
			$str = str_replace(' ', '_', $str);
			$str = rawurlencode($str);
			$str = str_replace('%', '_', $str);
			return $str;
		}
		
		
	}
	?>
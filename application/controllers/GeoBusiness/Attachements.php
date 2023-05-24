<?php
class Attachements extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Geobusiness/M_Attachements','Attachements');
		$this->load->model('M_Geobusiness/M_EditGeoBusiness','EditGeoBusiness');
		$this->load->library('form_validation');
	}
	function addAttachements()
	{
		try {
			set_time_limit(5);
		$postMax = ini_get('post_max_size'); //grab the size limits...
		if($_SERVER['CONTENT_LENGTH']>$postMax){
			throw new Exception("Taille des fichiers dépassant 55 MB!");
		}
		if(count($_FILES)>5)
		{
			throw new Exception("maximum 5 fichiers à la fois");
		}
		foreach ($_FILES as $file) {
			if($file['size']>(20*1024*1024)){
				throw new Exception("fichier".$file['name']." Trop volumineux!");
			}
		}
		$affaire = pg_escape_string($this->input->post('geoaffaire', TRUE));
		$idgeoaffaire = pg_escape_string($this->input->post('id', TRUE));
		if(empty($affaire)|| !is_numeric($idgeoaffaire))
			throw new Exception("geoAffaire invalide!");
		$validAffaire = $this->EditGeoBusiness->checkGeoAffExist(array($this->session->numeric_matricule,$affaire,$idgeoaffaire));
		if($validAffaire==0)
			throw new Exception("geoAffaire invalide!");
		else
		{
			$idgeoaffaire = $validAffaire['id'];
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
		$maxFileSize = 10*1024*1024;
		$this->load->library('custom_crypt');
		$error ="";
		$compteur=0;
		foreach ($_FILES as $file) {
			$name = $file['name'];
			$file_info = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($file_info, $file['tmp_name']);
			if (!in_array($mime,$allowMime)) {
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
			$path_parts = pathinfo($name);
			$ext = $path_parts['extension'];
			$normalizeName = $this->normalizeString($name);
			$cryptedName = $this->custom_crypt->random_str(35,$normalizeName).time().'.'.$ext;
			$fileKey = $this->custom_crypt->random_str(35,$normalizeName).time();
			$destinationFolder = $this->folderPath.'entreprises/'.$this->session->entreprise.'/geoBusiness/'.$this->session->numeric_matricule.'/'.$idgeoaffaire.'/attachements';
			if(!is_dir($destinationFolder))
				mkdir($destinationFolder,0777, true);
			$rslt = $this->Attachements->insertAttachements(array($name,$ext,$cryptedName,$fileKey,$idgeoaffaire));
			if(is_dir($destinationFolder) && $rslt != 0)
				move_uploaded_file($file['tmp_name'],$destinationFolder.'/'.$rslt['crypted_name']);
			$compteur++;
		}
		echo json_encode(array($compteur,$compteur.'/'.count($_FILES).' fichiers importés',$error));
	} catch (Exception $e) {
		$message = $e->getMessage();
		http_response_code(400);
		die( $message );
	}
}
function loadAttachements()
{
	$onlyImg = false;
	if(isset($_POST['Img']) and pg_escape_string($this->input->post('Img', TRUE)) == 1)
	{
		$onlyImg = true;
	}
	$toDatatable = pg_escape_string($this->input->post('toDatatable', TRUE));
	$toDatatable = $toDatatable ==1?true:false;
	$affaire = pg_escape_string($this->input->post('geoaffaire', TRUE));
	$idgeoaffaire = pg_escape_string($this->input->post('id', TRUE));
	if(!isset($_POST['geoaffaire']) || !isset($_POST['id']) || strlen($affaire)>100 || !is_numeric($idgeoaffaire) || empty($affaire))
	{
		echo json_encode(array('data'=>array()));
		return;
	}
	$rslt = $this->Attachements->loadAttachements(array($this->session->numeric_matricule,$idgeoaffaire,$affaire),$toDatatable,$onlyImg);
	if($onlyImg)
	{
		$ImgArr = array();
		foreach ($rslt as $row) {
			array_push($ImgArr,array(
				'src'=>'Attachements/serveImages?file='.$row['key'].'&a='.$row['numero'],
				'download'=>html_escape($row['key'])==''?'<i class="fas fa-question-circle" style="color: #1212131a;"></i>':'<a href="Attachements/downloadAttachement?file='.$row['key'].'&a='.$row['numero'].'"><i class="fas fa-download" style="color: #fff;cursor:pointer;"></i></a>',
				'name'=>$row['nom']
			));
		}
		echo json_encode($ImgArr);
	}
	else
	{
		echo json_encode($rslt);	
	}
}
function serveImages()
{
	if(isset($_GET['file']) && strlen($_GET['file'])<50 && isset($_GET['a']) && is_numeric($_GET['a']))
	{
		$user = $this->session->numeric_matricule;
		$imgData = $this->Attachements->getAttachementsImage(array($user,$_GET['file'],$_GET['a']));
		if($imgData !=0)
		{
			$folder = $this->folderPath.'entreprises/'.$this->session->entreprise.'/geoBusiness/'.$imgData['creerpar'].'/'.$imgData['idgeoaffaire'].'/attachements';
			if(file_exists($folder.'/'.$imgData['crypted_name']))
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($file_info,$folder.'/'.$imgData['crypted_name']);
			$this->load->image($folder.'/'.$imgData['crypted_name'],$mime);
		}
		else return;
	}
	else
		return;
}
function downloadAttachement()
{
	$this->load->helper('download');
	if(isset($_GET['file']) && strlen($_GET['file'])<50 && isset($_GET['a']) && is_numeric($_GET['a']))
	{
		$user = $this->session->numeric_matricule;
		$imgData = $this->Attachements->getAttachementsImage(array($user,$_GET['file'],$_GET['a']));
		if($imgData !=0)
		{
			$folder = $this->folderPath.'entreprises/'.$this->session->entreprise.'/geoBusiness/'.$imgData['creerpar'].'/'.$imgData['idgeoaffaire'].'/attachements';
			if(file_exists($folder.'/'.$imgData['crypted_name']))
				force_download($imgData['nom'],file_get_contents($folder.'/'.$imgData['crypted_name']), NULL);
		}
		else return;
	}
	else
		return;
}
function downloadAllAttachements()
{
	$this->load->helper('download');
	$affaire = pg_escape_string($this->input->post('geoaffaire', TRUE));
	$idgeoaffaire = pg_escape_string($this->input->post('id', TRUE));
	$rslt = $this->Attachements->getAllAtachements(array($this->session->numeric_matricule,$idgeoaffaire,$affaire));
	if(strlen($affaire)>100 || !is_numeric($idgeoaffaire) || empty($affaire))
		return;
	if(is_array($rslt) and count($rslt)>0)
	{
		$folder = $this->folderPath.'entreprises/'.$this->session->entreprise.'/geoBusiness/'.$rslt[0]['creerpar'].'/'.$rslt[0]['idgeoaffaire'].'/attachements';
		$zip = new ZipArchive;
		if ($zip->open($folder.'_'.$rslt[0]['affnom'].'.zip', ZipArchive::CREATE) === TRUE)
		{
			foreach ($rslt as $row) {
				if(file_exists($folder.'/'.$row['crypted_name']))
					$zip->addFile($folder.'/'.$row['crypted_name'],$row['nom']);
			}
			$zip->close();
			force_download($folder.'_'.$rslt[0]['affnom'].'.zip', NULL);
		}
		else
			return;
	}
	else
		return;
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
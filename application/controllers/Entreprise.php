<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Entreprise extends MY_controller
{
 
 function __construct()
 {
  parent::__construct();
  
  $this->load->model('M_entreprise','entreprise');
  $this->load->library('form_validation');
 }
 function getDomaineEntreprise()
 {
  $rslt = $this->entreprise->loadDomaines();
  return $rslt;
 }
 function ClearPhoto()
 {
  if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
   exit('<h1>No direct script access allowed<h2>');
  $imgEntreprise = glob($this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.{jpg,png,jpeg}', GLOB_BRACE);
  foreach ($imgEntreprise as $key => $value) {
   unlink($value);
  }
  
 }
 function updateField()
 {
  if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
   exit('<h1>No direct script access allowed<h2>');

  try {
   if(isset($_POST['val']) && isset($_POST['attribute']))
   {
    if(strlen($_POST['attribute'])>30 )
     throw new Exception("Données Invalide");
    $val = pg_escape_string($this->input->post('val', TRUE)); 
    $attr = pg_escape_string($this->input->post('attribute', TRUE));
    $attr = str_replace('item-entreprise-','',$attr);
    switch ($attr) {
     case 'mail':
     if (!filter_var($_POST['val'], FILTER_VALIDATE_EMAIL) || strlen($_POST['val'])>50) 
      throw new Exception("Email invalide");
     break;
     case 'ice':
     if(!is_numeric($_POST['val']) || strlen($_POST['val'])<15 || strlen($_POST['val'])>40 )
      throw new Exception("ICE invalide");
     break;
     case 'tel':
     case 'fax':
     if(!is_numeric($_POST['val']) || strlen($_POST['val'])<5 || strlen($_POST['val'])>15 )
      throw new Exception($attr." invalide");
     break;
     case 'ville':
     if(strlen($_POST['val'])>30 )
      throw new Exception($attr." invalide");
     break;
     case 'adresse':
     if(strlen($_POST['val'])>250 || strlen($_POST['val'])=='' )
      throw new Exception($attr." invalide");
     break;
     case 'nom':
     if(strlen($_POST['val'])>50 || strlen($_POST['val'])=='' )
      throw new Exception($attr." invalide");
     break;
     default:
      throw new Exception(" Données invalides");
     break;
    }
    
    $rslt = $this->entreprise->updateField($this->session->entreprise,$val,$attr);

    if($rslt!=0)
    {
     echo 1; 
    }
    else
    {
     throw new Exception("Contrat Invalide");

    }
   }
   else
   {
    throw new Exception("Données Vides!");
   }

  } catch (Exception $e) {
   $message = $e->getMessage();
   http_response_code(400);
   die( $message );

  }
 }
 function updatePhoto()
 {
  $this->ClearPhoto();
  try {

   if (isset($_FILES['entreprise-logo']['name'])  && !empty($_FILES['entreprise-logo']['name'])) {
    $configPhotos['allowedMime'] = array('image/jpeg', 'image/pjpeg','image/png');
    $configPhotos['max_size'] = 5*1024*1024;
    $file_info = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($file_info, $_FILES['entreprise-logo']['tmp_name']);

    if (!in_array($mime,$configPhotos['allowedMime'])) {
     
     throw new Exception('Fichier non autorisé : '.$_FILES['entreprise-logo']['name']);
    }
    elseif ($_FILES['entreprise-logo']['size']>$configPhotos['max_size']) {
     throw new Exception('Fichier dépassant 1Mo : '.$_FILES['entreprise-logo']['name']);
    }
    elseif (0 < $_FILES['entreprise-logo']['error']) {
     throw new Exception('erreur de lecture' . $_FILES['entreprise-logo']['error']);
    }
    else
    {
     $ext = pathinfo($_FILES['entreprise-logo']['name']);
     move_uploaded_file($_FILES['entreprise-logo']['tmp_name'],$this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.'.$ext['extension']);
     echo $this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.'.$ext['extension'];
    }
    
   }
   else
   {
    throw new Exception("Veuillez ajouter l'image");
    
   }
   
  } catch (Exception $e) {
   
  }

 }
 function getEntrepriseDta()
 {
  if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
   exit('<h1>No direct script access allowed<h2>');
  $dta = $this->entreprise->entrepriseData($this->session->entreprise);
  unset($dta['id_domaine']);
  unset($dta['id_directeur']);
  unset($dta['dossier']);
  echo json_encode($dta);
 }
 function updateConfig()
 {

  try {
   $this->form_validation->set_data($_POST);
   if($this->form_validation->run('updateEntrepriseConfig')== FALSE)
   {
    throw new Exception(validation_errors());
   }
   $hdebut = $this->input->post('heure_debut_travail', TRUE);
   $hfin = $this->input->post('heure_fin_travail', TRUE);
   $this->load->library('Date_operations');
   if (!$this->date_operations->compareTwoTime($hfin,$hdebut))
   {
    throw new Exception('Interval invalide');
   }
   $dta = array();
   foreach ($_POST as $key => $value) {
   	if(in_array($key,array('heure_debut_travail','heure_fin_travail','jour_semaine','conge_annee')))
   	{
		$dta[$key] = $value;
   	}
   }
   $dta['id_entreprise'] = $this->session->entreprise;
   if($this->entreprise->updateConfig($dta))
    {
      unset($dta['id_entreprise']);
      echo json_encode($dta);
    }
  else
    throw new Exception('Une erreur produite');
   
  } catch (Exception $e) {
   
  $message = $e->getMessage();
  http_response_code(400);
  die( $message );
  }
 }
 function inscription()
 {
  try {
   $this->form_validation->set_data($_POST);
   if($this->form_validation->run('ajouterEntreprise')== FALSE)
   {
    throw new Exception(validation_errors());
   }
   /****************************************************************************
   *        verification de la photo           *
   *                   *
   *****************************************************************************/
   if (isset($_FILES['entreprise-logo']['name'])  && !empty($_FILES['entreprise-logo']['name'])) {
    $configPhotos['allowedMime'] = array('image/jpeg', 'image/pjpeg','image/png');
    $configPhotos['max_size'] = 5*1024*1024;
    $file_info = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($file_info, $_FILES['entreprise-logo']['tmp_name']);

    if (!in_array($mime,$configPhotos['allowedMime'])) {
     
     throw new Exception('Fichier non autorisé : '.$_FILES['entreprise-logo']['name']);
    }
    elseif ($_FILES['entreprise-logo']['size']>$configPhotos['max_size']) {
     throw new Exception('Fichier dépassant 1Mo : '.$_FILES['entreprise-logo']['name']);
    }
    elseif (0 < $_FILES['entreprise-logo']['error']) {
     throw new Exception('erreur de lecture' . $_FILES['entreprise-logo']['error']);
    }
    
    
   }
   $email=pg_escape_string($this->input->post('employe-email', TRUE));
   $nom = pg_escape_string($this->input->post('employe-nom', TRUE));
   $prenom=pg_escape_string($this->input->post('employe-prenom', TRUE));
   $nomentreprise = pg_escape_string($this->input->post('entreprise-nom', TRUE));
   /****************************************************************************
   *     Creation des mots de passe provisoire           *
   *                   *
   *****************************************************************************/
   $this->load->library('custom_crypt');
   $this->load->library('Date_operations');
   $rndomPassword=$this->custom_crypt->generatePassword();
   $rndomPasswordCrypt=$this->custom_crypt->cryptPassword($rndomPassword);

   $reliquatAnne = $this->date_operations->daysCalculator(new Datetime(),new DateTime('31-12-'.date('Y')));
   $reliquatAnne = round($reliquatAnne*29/365,1);
   $entrepriseArray = array(
    
    'nom'=>$nomentreprise,
    'adresse'=>pg_escape_string($this->input->post('entreprise-adresse', TRUE)),
    'tel'=>pg_escape_string($this->input->post('entreprise-tel', TRUE)),
    'mail'=>pg_escape_string($this->input->post('entreprise-email', TRUE)),
    'fax'=>pg_escape_string($this->input->post('entreprise-fax', TRUE)),
    'ice'=>pg_escape_string($this->input->post('entreprise-ice', TRUE)),
    'id_domaine'=>pg_escape_string($this->input->post('entreprise-domaine', TRUE)),
    'ville'=>pg_escape_string($this->input->post('entreprise-ville', TRUE)),
    'date_creation'=>date('Y-m-d')
   );
   $directeurArray = array(
    
    'nom'=>$nom,
    'prenom'=>$prenom,
    'email'=>$email,
    'telephone'=>pg_escape_string($this->input->post('employe-tel', TRUE)),
    'date_recrutement'=>date('Y-m-d'),
    "password"=>$rndomPasswordCrypt,
    'reliquatannee'=>$reliquatAnne,
    
   );
   $classArray = array();
   $rslt = $this->entreprise->addEntreprise($entrepriseArray,$directeurArray,$classArray,$rndomPassword);
   if(is_array($rslt))
   {
    
   /****************************************************************************
   *        Creation des dossiers            *
   *                   *
   *****************************************************************************/
   mkdir('entreprises/'.$rslt['id_entreprise']);
   mkdir('entreprises/'.$rslt['id_entreprise'].'/contrats');
   mkdir('entreprises/'.$rslt['id_entreprise'].'/dossier_Employes');
   mkdir('entreprises/'.$rslt['id_entreprise'].'/dossier_affaires');
   mkdir('entreprises/'.$rslt['id_entreprise'].'/dossier_Employes/'.$rslt['char_matricule']);
   mkdir('entreprises/'.$rslt['id_entreprise'].'/dossier_Employes/'.$rslt['char_matricule'].'/photo');
   mkdir('entreprises/'.$rslt['id_entreprise'].'/dossier_Employes/'.$rslt['char_matricule'].'/absence');
   mkdir('entreprises/'.$rslt['id_entreprise'].'/dossier_Employes/'.$rslt['char_matricule'].'/fiche_conge');
   mkdir('entreprises/'.$rslt['id_entreprise'].'/dossier_Employes/'.$rslt['char_matricule'].'/ordre_mission');
   mkdir('entreprises/'.$rslt['id_entreprise'].'/dossier_Employes/'.$rslt['char_matricule'].'/heures_sup');
   mkdir('entreprises/'.$rslt['id_entreprise'].'/dossier_Employes/'.$rslt['char_matricule'].'/diplome');
   mkdir('entreprises/'.$rslt['id_entreprise'].'/dossier_Employes/'.$rslt['char_matricule'].'/contrat');
   if (isset($_FILES['entreprise-logo']['name']) && !empty($_FILES['entreprise-logo']['name']))
   {
    $ext = pathinfo($_FILES['entreprise-logo']['name']);
    move_uploaded_file($_FILES['entreprise-logo']['tmp_name'],'entreprises/'.$rslt['id_entreprise'].'/entreprise_logo.'.$ext['extension']);
   }
   
   
   echo json_encode(array(
    $rslt['char_matricule'],
    $nom,
    $prenom,
    $rslt['msg'],

   ));
   
  }
  elseif (is_string($rslt)) {
   throw new Exception($rslt);
  }

 } catch (Exception $e) {

  $message = $e->getMessage();
  http_response_code(400);
  die( $message );

 }
}

}

?>
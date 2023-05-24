<?php

class GestionDeplacement extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		
		$this->load->model('M_GestionRH/M_gestionDeplacement','gestionDeplacement');
		$this->load->model('M_GestionRH/M_employes','employes');	
		$this->load->library('form_validation');
		$this->load->library('custom_crypt');
		$this->load->helper('download');
	}

	function fiche_deplacement()
	{
		try {

			if(isset($_GET['file']) && isset($_GET['user']) )
			{
				$key = $_GET['file'];
				$matricule = $_GET['user'];
				$liendata = $this->gestionDeplacement->getLien($key,$matricule,$this->session->entreprise);
				if($liendata !=0)
				{
					//print_r($liendata);
					$fullLink = $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$liendata['char_matricule'].'/ordre_mission/'.$liendata['lien'];
					force_download($fullLink, NULL);
					
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
	
	function currentYear_deplacement()
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		try {
			$matricule = pg_escape_string($this->input->post('matricule', TRUE));
			$matriculeData = $this->employes->employee($matricule,$this->session->entreprise);
			$numMatricule=0;
			if(is_array($matriculeData))
			{
				$numMatricule = $matriculeData[0]['num_matricule'];
			}
			else
			{
				throw new Exception("matricule invalide");
				
			}
			$rslt = $this->gestionDeplacement->deplacementList($numMatricule);
			echo json_encode($rslt);
		} catch (Exception $e) {

			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
			
		}
	}
	function export_SuiviDeplacement()
	{
		try {
			$this->load->model('M_GestionAffaire/M_user_data','userData');
			include ("mpdf/vendor/autoload.php");
			$this->load->helper('html');
			if(isset($_GET['user']))
			{
				$matriculeData = $this->employes->employee($_GET['user'],$this->session->entreprise);
				$numMatricule=0;
				$etablissement=0;
				if(is_array($matriculeData))
				{
					$numMatricule = $matriculeData[0]['num_matricule'];
					$etablissement = $matriculeData[0]['etablissement'];
				}
				else
				{
					throw new Exception("matricule invalide");

				}

				$pdf= new \Mpdf\Mpdf();
				$mpdf->shrink_tables_to_fit = 0;
				$dta = $this->userData->employeeData($etablissement,$numMatricule,$this->session->entreprise);
				$dta['suiviDeplacement']=$this->gestionDeplacement->deplacementList($numMatricule,false);
				$imgEntreprise = glob($this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.{jpg,png,jpeg}', GLOB_BRACE);
				$entrepriseData = $this->M_entreprise->entrepriseData($this->session->entreprise);
				$dta['nomEntreprise']=$entrepriseData['nom'];
				if(count($imgEntreprise)>0)
					$dta['imgEntreprise']=$imgEntreprise[0];
				if(!empty($dta['photo']))
				{
					$dta['src'] = $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$dta['matricule'].'/photo/'.$dta['photo'];
				}
				else
				{
					$dta['src'] = 'images/userProfilImg.png';
				}
   		//print_r($dta);
   		//$this->load->view('fiches/deplacements_annee',$dta);
				$html = $this->load->view('fiches/deplacements_annee',$dta,true);
				$pdfFilePath = "deplacement_".date("dmY").".pdf";

        //generate the PDF from the given html
				$pdf->WriteHTML($html);

        //download it.
				$pdf->Output($pdfFilePath,"D");
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
	function export_unPayedDeplacement()
	{
		try {
			$this->load->model('M_GestionAffaire/M_user_data','userData');
			include ("mpdf/vendor/autoload.php");
			$this->load->helper('html');
			if(isset($_GET['user']))
			{
				$matriculeData = $this->employes->employee($_GET['user'],$this->session->entreprise);
				$numMatricule=0;
				$etablissement=0;
				if(is_array($matriculeData))
				{
					$numMatricule = $matriculeData[0]['num_matricule'];
					$etablissement = $matriculeData[0]['etablissement'];
				}
				else
				{
					throw new Exception("matricule invalide");

				}

				$pdf= new \Mpdf\Mpdf();

				$dta = $this->userData->employeeData($etablissement,$numMatricule,$this->session->entreprise);
				$dta['suiviImpayee']=$this->gestionDeplacement->unPayedDeplacement($numMatricule);
				$imgEntreprise = glob($this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.{jpg,png,jpeg}', GLOB_BRACE);
				$entrepriseData = $this->M_entreprise->entrepriseData($this->session->entreprise);
				$dta['nomEntreprise']=$entrepriseData['nom'];
				if(count($imgEntreprise)>0)
					$dta['imgEntreprise']=$imgEntreprise[0];
				if(!empty($dta['photo']))
				{
					$dta['src'] = $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$dta['matricule'].'/photo/'.$dta['photo'];
				}
				else
				{
					$dta['src'] = 'images/userProfilImg.png';
				}
   		//print_r($dta);
   		//$this->load->view('fiches/deplacements_nonPaye',$dta);
				$html = $this->load->view('fiches/deplacements_nonPaye',$dta,true);
				$pdfFilePath = "deplacement_apayer".date("dmY").".pdf";

        //generate the PDF from the given html
				$pdf->WriteHTML($html);

        //download it.
				$pdf->Output($pdfFilePath,"D");
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
	function addDeplacement()
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		try {
			$ficheLink='';
			
			$this->form_validation->set_data($_POST);
			if($this->form_validation->run('ajouterDeplacement')== FALSE)
			{
				throw new Exception(validation_errors());

			}
			/****************************************************************************
			*								verification de la fiche Deplacement        			*
			*																			*
			*****************************************************************************/
			if (isset($_FILES['scan-fiche-deplacement']['name'])  && !empty($_FILES['scan-fiche-deplacement']['name'])) {
				$configPhotos['allowedMime'] = array('application/pdf');
				$configPhotos['max_size'] = 1.5*1024*1024;
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($file_info, $_FILES['scan-fiche-deplacement']['tmp_name']);

				if (!in_array($mime,$configPhotos['allowedMime'])) {
					
					throw new Exception('Fichier non autorisé : '.$_FILES['scan-fiche-deplacement']['name']);
				}
				elseif ($_FILES['scan-fiche-deplacement']['size']>$configPhotos['max_size']) {
					throw new Exception('Fichier dépassant 1.5 Mo : '.$_FILES['scan-fiche-deplacement']['name']);
				}
				elseif (0 < $_FILES['scan-fiche-deplacement']['error']) {
					throw new Exception('erreur de lecture' . $_FILES['scan-fiche-deplacement']['error']);
				}
				else
				{
					$ficheLink = 'OM_'.date('d-m-Y').'.pdf';
				}
				
			}
			else
			{
				throw new Exception('Veuillez joindre la Fiche de Déplacement');
			}
			
			$date=pg_escape_string($this->input->post('deplacement-date', TRUE));
			$lieu=pg_escape_string($this->input->post('deplacement-lieu', TRUE));
			$duree=pg_escape_string($this->input->post('deplacement-duree', TRUE));
			$objet=pg_escape_string($this->input->post('deplacement-objet', TRUE));
			$matricule = pg_escape_string($this->input->post('deplacement-matricule', TRUE));
			$designation = pg_escape_string($this->input->post('deplacement-designation', TRUE));
			$prix = pg_escape_string($this->input->post('deplacement-prix', TRUE));
			/************************verification matricule***************************/
			$matriculeData = $this->employes->employee($matricule,$this->session->entreprise);
			$numMatricule=0;
			if(is_array($matriculeData))
			{
				$numMatricule = $matriculeData[0]['num_matricule'];
			}
			else
			{
				throw new Exception("matricule invalide");
				
			}
			$fileKey = $this->custom_crypt->random_str(35,date('s').$duree.date('i').date('md'));

			$deplacementArray = array(
				'date_deplacement'=>$date, 
				'nombre_jour'=>$duree,
				'matricule'=>$numMatricule,
				'objet'=>$objet,
				'lieu'=>$lieu,
				'designation'=>$designation,
				'prix_unitaire'=>$prix,
				'paye'=>'false',
				'lien' =>$ficheLink,
				'downloadkey'=>$fileKey
			);
			$rslt = $this->gestionDeplacement->insertDeplacement($deplacementArray);
			if($rslt!=1)
			{
				throw new Exception("Une erreur s'est produite");

			}
			else
			{
				move_uploaded_file($_FILES['scan-fiche-deplacement']['tmp_name'],$this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$matricule.'/ordre_mission/'.$ficheLink);
				echo 1;
			}
			
			
		}
		catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
function removeDeplacement()
{
	try {
			if(!isset($_POST['code'])  || strlen($_POST['code'])>20 || !is_numeric($_POST['code']) || !isset($_POST['matricule']) || strlen($_POST['matricule'])>100)
			{
				throw new Exception('Données invalides');
			}
			$rslt = $this->gestionDeplacement->deleteDeplacement($this->input->post('code', TRUE),$this->input->post('matricule', TRUE));
			if($rslt==1)
				return 1;
			else
				throw new Exception("Affaire non Trouvé");
				
				
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
}

}
?>
<?php

class GestionConges extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		
		$this->load->model('M_GestionRH/M_gestionConge','gestionConge');
		$this->load->model('M_GestionRH/M_employes','employes');	
		$this->load->library('form_validation');
		$this->load->library('custom_crypt');
		$this->load->helper('download');
	}
	
	function fiche_conge()
	{
		try {

			if(isset($_GET['file']) && isset($_GET['user']) )
			{
				$key = $_GET['file'];
				$matricule = $_GET['user'];
				$liendata = $this->gestionConge->getLien($key,$matricule,$this->session->entreprise);
				if($liendata !=0)
				{
					$fullLink = $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$liendata['char_matricule'].'/fiche_conge/'.$liendata['lien'];
					force_download($fullLink, NULL);
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
	function currentYear_conge()
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
			$rslt = $this->gestionConge->congeList($numMatricule);
			echo json_encode($rslt);
		} catch (Exception $e) {

			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
			
		}
	}

	function export_SuiviConge()
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
				$dta['suiviConge']=$this->gestionConge->congeList($numMatricule)['data'];
				$dta['isdemande']=false;
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
				$html = $this->load->view('fiches/fiche_conge',$dta,true);
				$pdfFilePath = "fiche_conge_".date("dmY").".pdf";

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
	function addConge()
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		try {
			$ficheLink='';
			$this->load->library('Date_operations');
			$dureeCongee =0;
			$this->form_validation->set_data($_POST);
			if($this->form_validation->run('ajouterConge')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			/****************************************************************************
			*								verification de la fiche conge        			*
			*																			*
			*****************************************************************************/
			if (isset($_FILES['scan-fiche-conge']['name'])  && !empty($_FILES['scan-fiche-conge']['name'])) {
				$configPhotos['allowedMime'] = array('application/pdf');
				$configPhotos['max_size'] = 1.5*1024*1024;
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($file_info, $_FILES['scan-fiche-conge']['tmp_name']);

				if (!in_array($mime,$configPhotos['allowedMime'])) {
					
					throw new Exception('Fichier non autorisé : '.$_FILES['scan-fiche-conge']['name']);
				}
				elseif ($_FILES['scan-fiche-conge']['size']>$configPhotos['max_size']) {
					throw new Exception('Fichier dépassant 1.5 Mo : '.$_FILES['scan-fiche-conge']['name']);
				}
				elseif (0 < $_FILES['scan-fiche-conge']['error']) {
					throw new Exception('erreur de lecture' . $_FILES['scan-fiche-conge']['error']);
				}
				else
				{
					$ficheLink = 'fiche_conge_'.date('d-m-Y').'.pdf';
				}
				
			}
			else
			{
				throw new Exception('Veuillez joindre la Fiche de congé');
			}
			 $dtaEnt =  $this->M_entreprise->entrepriseData($this->session->entreprise);
			$date_db=pg_escape_string($this->input->post('conge-debut', TRUE));
			$time_db=pg_escape_string($this->input->post('conge-timedebut', TRUE));
			$date_fn=pg_escape_string($this->input->post('conge-fin', TRUE));
			$time_fn=pg_escape_string($this->input->post('conge-timefin', TRUE));
			$exclure = pg_escape_string($this->input->post('conge-exclure', TRUE));
			$exclure=empty($exclure)? 0: $exclure;
			$matricule = pg_escape_string($this->input->post('conge-matricule', TRUE));
			$typeConge = pg_escape_string($this->input->post('type-conge', TRUE));
			$observation = pg_escape_string($this->input->post('conge-observation', TRUE));

			if(!$this->date_operations->validateTime($time_db,$dtaEnt['hdebut'],$dtaEnt['hfin']))
			{
				throw new Exception('heure de debut doit être dans \'literval ['.$dtaEnt['hdebut'].'-'.$dtaEnt['hfin'].']');
			}
			if(!$this->date_operations->validateTime($time_fn,$dtaEnt['hdebut'],$dtaEnt['hfin']))
			{
				throw new Exception('heure de debut doit être dans \'literval ['.$dtaEnt['hdebut'].'-'.$dtaEnt['hfin'].']');
			}
			$dateDB_ToSeuilMax = $this->date_operations->compareDateTime($date_db." ".$dtaEnt['hfin'],$date_db." ".$time_db);
			$dateDB_ToSeuilMin = $this->date_operations->compareDateTime($date_db." ".$time_db,$date_db." ".$dtaEnt['hdebut']);
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
			/**********************verification validite et cohérence données************/
			if($dateDB_ToSeuilMax<0)
			{
				throw new Exception('heure de Début doit être inférieur à'.$dtaEnt['hfin'].'h');
			}
			if($dateDB_ToSeuilMin<0)
			{
				throw new Exception('heure de Début doit être supérieure à'.$dtaEnt['hdebut'].'h');
			}
			$dateFN_ToSeuilMax = $this->date_operations->compareDateTime($date_fn." ".$dtaEnt['hfin'],$date_fn." ".$time_fn);
			$dateFN_ToSeuilMin = $this->date_operations->compareDateTime($date_fn." ".$time_fn,$date_fn." ".$dtaEnt['hdebut']);
			if($dateFN_ToSeuilMax<0)
			{
				throw new Exception('heure de Fin doit être inférieur à'.$dtaEnt['hfin'].'h');
			}
			if($dateFN_ToSeuilMin<0)
			{
				throw new Exception('heure de Fin doit être supérieure à'.$dtaEnt['hdebut'].'h');
			}
			$timePassed = $this->date_operations->compareDateTime($date_fn." ".$time_fn,$date_db." ".$time_db);
			if($timePassed<=0)
			{
				throw new Exception('période de congé invalide');
			}

			/**********************calcul de nombre de jour tenant compte:
			- de l'heure de sortie au congé (si inférieur à 4heure demi journée si plus une journée)
			- nombre de jour sans calculer les weekend et les jours fériés
			- il faut pas calculer les heures qui sans en dehors des heures de service (la nuit)

			************/
			else
			{
				/****** nombre total des jour entre ls deux date et soustraction de la première et dernière journée (qui sera calculé suite nombre heures)******************/
				$hdb = strtotime(date('Y-m-d ').$dta['hdebut'].':00');
                $hfn = strtotime(date('Y-m-d ').$dta['hfin'].':00');
                $hjr = abs($hdb-$hfn)/3600;
				$demiJconge_heure = $hjr/2;
				$datefn = new DateTime($date_fn);
				$datedb = new DateTime($date_db);
				$interval = $datefn->diff($datedb);
				$dureeJour = $interval->format('%a');

				if($dureeJour>1)// le premier et dernier jour sont calculés par la suite
				{
					$dureeCongee+=$dureeJour-1;
				}

				/* jour début congé : demi journée ou journée entière*/
				if($dateDB_ToSeuilMax*24<=$demiJconge_heure && $dateDB_ToSeuilMax!=0) // heure de sortie-heure officiel fin service<4
				{
					$dureeCongee+=0.5;
				}
				elseif ($dateDB_ToSeuilMax*24>$demiJconge_heure)
				{
					$dureeCongee+=1;
				}
				/* jour fin+ congé : demi journée ou journée entière*/
				if($dateFN_ToSeuilMin*24<=$demiJconge_heure && $dateFN_ToSeuilMin!=0 ) // heure de sortie-heure officiel fin service<4
				{
					$dureeCongee+=0.5;
				}
				elseif ($dateFN_ToSeuilMin*24>=$demiJconge_heure) 
				{
					$dureeCongee+=1;
				}
				/*******************soustrire les weekend**********************/
				$dateArr = $this->date_operations->getweekEndesDates($date_db, $date_fn,weekend_days_indexes); //0 Sun, 1 Mon, etc.
				$dureeCongee -= count($dateArr);
				/********************Sousctraire les jours fériés************/
				$dureeCongee -= $exclure;
				if($dureeCongee<=0)
				{
					throw new Exception('Erreur : Nombre de jour à exclure supérieure à la durée du Congé!');
				}
				$fileKey = $this->custom_crypt->random_str(35,date('s').$dureeCongee.date('i').date('md'));
				$congeArray = array(

					'date_debut' =>$date_db." ".$time_db,
					'observation' =>$observation,
					'nbr_jour' =>$dureeCongee,
					'date_reprise' =>$date_fn." ".$time_fn,
					'date_validation' =>date('Y-m-d'),
					'lien' =>$ficheLink,
					'matricule' =>$numMatricule,
					'heure_debut' =>$time_db,
					'heure_reprise' =>$time_fn,
					'code_type' =>$typeConge,
					'downloadkey'=>$fileKey
				);
				$rslt = $this->gestionConge->insertConge($congeArray);
				if($rslt!=1)
				{
					throw new Exception("Une erreur s'est produite");
					
				}
				else
				{
					move_uploaded_file($_FILES['scan-fiche-conge']['tmp_name'],$this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$matricule.'/fiche_conge/'.$ficheLink);
					echo 1;
				}
			}
			
		}
		catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
function removeConge()
{
	try {
			if(!isset($_POST['code'])  || strlen($_POST['code'])>20 || !is_numeric($_POST['code']) || !isset($_POST['matricule']) || strlen($_POST['matricule'])>100)
			{
				throw new Exception('Données invalides');
			}
			$rslt = $this->gestionConge->deleteConge($this->input->post('code', TRUE),$this->input->post('matricule', TRUE));
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
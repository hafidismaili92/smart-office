<?php

class GestionAbsence extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionRH/M_gestionAbsence','gestionAbsence');
		$this->load->model('M_GestionRH/M_employes','employes');	
		$this->load->model('M_GestionRH/M_entreprise','entreprise');	
		$this->load->library('form_validation');
	}
	function absencePeroid()
	{
		try {
			$this->form_validation->set_data($_POST);
			$this->form_validation->set_rules('matricule', 'matricule', 'max_length[10]', array('max_length' => '%s trop long'));
			
			if($this->form_validation->run()== FALSE)
			{
				throw new Exception(validation_errors());

			}
			$absenceperiod = pg_escape_string($this->input->post('period', TRUE));
			$matricule = pg_escape_string($this->input->post('matricule', TRUE));
			$matriculeData = $this->employes->employee($matricule,$this->session->entreprise);
			if(!is_array($matriculeData))
			{
				throw new Exception("matricule invalide");
			}
			$startDate='';
			$endDate = date('Y-m-d');
			switch ($absenceperiod) {
				case 'j':
				$startDate=$endDate;
				break;
				case 's':
				$startDate=date('Y-m-d',strtotime('monday this week'));
				break;
				case 'm':
				$startDate=date('Y-m-01', strtotime($endDate));
				break;
				case 'a':
				$startDate=date('Y-01-01', strtotime($endDate));
				break;
				default:
				throw new Exception("period invalide");

				break;
			}
			$rslt = $this->gestionAbsence->Absence_peroid($startDate,$endDate,$matricule);
			echo json_encode($rslt);
		} catch (Exception $e) {
			
		}
	}
	function absenceJournalier()
	{
		try {

			
			$this->form_validation->set_data($_POST);
			$this->form_validation->set_rules('dateAbsence', 'Date absence', 'required|validateDate', array('validateDate' => '%s invalide','required' => 'Veuillez saisir %s'));
			$this->form_validation->set_rules('matricule', 'matricule', 'max_length[10]', array('max_length' => '%s trop long'));
			
			if($this->form_validation->run()== FALSE)
			{
				throw new Exception(validation_errors());

			}

			$absenceDate = pg_escape_string($this->input->post('dateAbsence', TRUE));
			$matricule = pg_escape_string($this->input->post('matricule', TRUE));
			$matriculeData = $this->employes->employee($matricule,$this->session->entreprise);
			if(!is_array($matriculeData))
			{
				throw new Exception("matricule invalide");
			}
			$rslt = $this->gestionAbsence->AbsenceJList($absenceDate,$matricule);
			echo json_encode($rslt);
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function addAbsence()
	{
		try {
			$this->load->library('Date_operations');
			/****************************************************************************
			*								verification du bon        			*
			*																			*
			*****************************************************************************/
			$bonLink='';
			$this->form_validation->set_data($_POST);
			$date_absence=pg_escape_string($this->input->post('date-absence', TRUE));
			$heureDebut = pg_escape_string($this->input->post('time-debut-absence', TRUE));
			$heureFin = pg_escape_string($this->input->post('time-fin-absence', TRUE));
			$matricule = pg_escape_string($this->input->post('matricule-form-absence', TRUE));

			if($this->form_validation->run('ajouterAbsence')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			$matriculeData = $this->employes->employee($matricule,$this->session->entreprise);
			$dtaEnt =  $this->M_entreprise->entrepriseData($this->session->entreprise);
			if(!is_array($matriculeData))
			{
				throw new Exception("matricule invalide");
			}
			
			
			
			else if(!$this->date_operations->validateTime($heureDebut,$dtaEnt['hdebut'],$dtaEnt['hfin']))
			{
				throw new Exception('heure de debut doit être dans \'literval ['.$dtaEnt['hdebut'].'-'.$dtaEnt['hfin'].']');
			}
			else if(!$this->date_operations->validateTime($heureFin,$dtaEnt['hdebut'],$dtaEnt['hfin']))
			{
				throw new Exception('heure de debut doit être dans \'literval ['.$dtaEnt['hdebut'].'-'.$dtaEnt['hfin'].']');
			}
			else if (!$this->date_operations->compareTime($heureFin,$heureDebut,$dtaEnt['hdebut'],$dtaEnt['hfin']))
			{
				throw new Exception('heure entrée doit être superieur a heure sortie '.$heureFin.'/'.$heureDebut);
			}
			else if(!$this->validateAbsenceInterval($date_absence,$matricule,$heureDebut,$heureFin))
			{
				throw new Exception('interval déja ajoutée!');
			}
			if (isset($_FILES['scan-bon-sortie']['name']) && $_FILES['scan-bon-sortie']['size']!=0 ) {
				$configFiles['allowedMime'] = array('application/pdf');
				$configFiles['max_size'] = 0.5*1024*1024;
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($file_info, $_FILES['scan-bon-sortie']['tmp_name']);

				if (!in_array($mime,$configFiles['allowedMime'])) {
					echo 'Fichier non autorisé';
					throw new Exception('Fichier non autorisé : '.$_FILES['scan-bon-sortie']['name']);
				}
				elseif ($_FILES['scan-bon-sortie']['size']>$configFiles['max_size']) {
					throw new Exception('Fichier dépassant 0.5Mo : '.$_FILES['scan-bon-sortie']['name']);
				}
				elseif (0 < $_FILES['scan-bon-sortie']['error']) {
					throw new Exception('erreur de lecture' . $_FILES['scan-bon-sortie']['error']);
				}
				else
				{
					$bonLink = 'absence_'.date('d-m-Y').'.pdf';
				}

			}

			$dtaAbsence = array(
				$date_absence,
				pg_escape_string($this->input->post('absence-justif', TRUE)),
				pg_escape_string($this->input->post('absence-justif', TRUE))=='Bon de sortie'?true:false,
				$bonLink,
				$heureDebut,
				$heureFin,
				$matricule,
				false
			); 
			$rslt = $this->gestionAbsence->insertAbsence($dtaAbsence);
			if($rslt==1)
			{
				if ($bonLink!='')
				{

					move_uploaded_file($_FILES['scan-bon-sortie']['tmp_name'],$this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$matricule.'/absence/'.$bonLink);
				}
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
	public function validateAbsenceInterval($date,$matricule,$HDebut,$HFin)
	{
		$rslt = $this->gestionAbsence->get_AbsenceInterval($date,$matricule);
		for ($i=0; $i <count($rslt) ; $i++) {
			list($hhdb, $mmdb) = explode(':',$HDebut); 
			list($hhfn, $mmfn) = explode(':',$HFin); 
			list($hhfnDB, $mmfnDB,$ssfnDB) = explode(':', $rslt[$i]['heure_fin']);  
			list($hhddDB, $mmddDB,$ssddDB) = explode(':', $rslt[$i]['heure_debut']); 
			if(mktime((int) $hhddDB, (int) $mmddDB)<=mktime((int) $hhdb, (int) $mmdb) && mktime((int) $hhdb, (int) $mmdb)<=mktime((int) $hhfnDB, (int) $mmfnDB))
			{
				return FALSE;

			}
			elseif (mktime((int) $hhddDB, (int) $mmddDB)<=mktime((int) $hhfn, (int) $hhfn) && mktime((int) $hhfn, (int) $hhfn)<=mktime((int) $hhfnDB, (int) $mmfnDB) ) {
				return FALSE;

			}

		}
		return true;
	}
function removeAbsence()
{
	try {
			if(!isset($_POST['code'])  || strlen($_POST['code'])>20 || !is_numeric($_POST['code']) || !isset($_POST['matricule']) || strlen($_POST['matricule'])>100)
			{
				throw new Exception('Données invalides');
			}
			$rslt = $this->gestionAbsence->deleteAbsence($this->input->post('code', TRUE),$this->input->post('matricule', TRUE));
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
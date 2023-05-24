<?php

class Taches extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionAffaire/M_taches','M_taches');
		$this->load->library('form_validation');
		
	}
	function loadTaches()
	{

		$rslt = $this->M_taches->tachesList($this->session->numeric_matricule);
		echo json_encode($rslt);
		
	}

	function UpdateTache()
	{
		try {
			if($this->form_validation->run('updateMission')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			$numAffaire = pg_escape_string($this->input->post('numero_affaire', TRUE));
			$dta = array(
				pg_escape_string($this->input->post('avancement', TRUE))==''?0:pg_escape_string($this->input->post('avancement', TRUE)),
				pg_escape_string($this->input->post('observation', TRUE)),
				pg_escape_string($this->input->post('numero', TRUE)),
				strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire,
				$this->session->numeric_matricule
				
			); 
			$rslt = $this->M_taches->update_tache($dta);
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
	function nonConsulteTaches()
	{

		echo json_encode($this->M_taches->tachesNotifications($this->session->numeric_matricule));
	}
	function selectedTache()
	{
		try {
			$numAffaire = pg_escape_string($this->input->post('numero_affaire', TRUE));
			$dta = array(
				
				pg_escape_string($this->input->post('numero', TRUE)),
				strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire,
				$this->session->numeric_matricule
				
			); 
			$rslt = $this->M_taches->setSelectedTache($dta);
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
	
	
	
}
?>
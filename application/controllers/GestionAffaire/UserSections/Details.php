<?php

class Details extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionAffaire/M_details','M_details');
		$this->load->library('form_validation');	
	}
	function getDetails()
	{
		
		try {
			$numAffaire = pg_escape_string($this->input->post('affaire', TRUE));
			$dtaAffaire = array(
				strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire,
				$this->session->numeric_matricule,
				
			); 
			$rslt = $this->M_details->M_getDetails($dtaAffaire);
			if(is_array($rslt))
			{
				echo json_encode($rslt);
			}
			else
			{
				throw new Exception("une erreur s'est produite!");	
			}
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function editAffaire()
	{
		try {
			if($this->form_validation->run('editAffaire')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			$statut = $this->input->post('edit-affaire-statut', TRUE)==1?'true':'false';
			$numAffaire = pg_escape_string($this->input->post('edit-num-affaire', TRUE));
			$dataArray = array(
				'libelle'=>pg_escape_string($this->input->post('edit-affaires-libelle', TRUE)),
				'delai'=>pg_escape_string($this->input->post('edit-affaire-delai', TRUE)),
				'observation'=>pg_escape_string($this->input->post('edit-affaire-observations', TRUE)),
				'statut'=>$statut,
				'numero'=>strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire,
				'matricule'=>$this->session->numeric_matricule,
				
			);
			$rslt = $this->M_details->editAffaire($dataArray);
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
}
?>
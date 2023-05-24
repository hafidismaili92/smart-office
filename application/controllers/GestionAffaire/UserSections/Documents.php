<?php

class Documents extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionAffaire/M_documents','documents');	
	}
	function getDocuments()
	{
		
		try {
			$numAffaire = pg_escape_string($this->input->post('affaire', TRUE));
			$dtaAffaire = array(
				strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire,
				$this->session->numeric_matricule,
				
			); 
			$rslt = $this->documents->M_getDocuments($dtaAffaire);
			echo json_encode($rslt);
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	
}
?>
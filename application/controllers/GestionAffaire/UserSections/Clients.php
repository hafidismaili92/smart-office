<?php

class Clients extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionAffaire/M_clients','M_clients');	
	}
	function loadClients()
	{
		$draw = intval($_REQUEST["draw"]);
		$start = intval($_REQUEST["start"]);
		$length = intval($_REQUEST["length"]);
		$rslt = $this->M_clients->clientsList();
		$rslt["draw"]=$draw;
		$rslt["start"]=$start;
		$rslt["length"]=$length;
		echo json_encode($rslt);
	}
	function addclient()
	{
		try {
			$dtaClient = array(
				pg_escape_string($this->input->post('client-Libelle', TRUE)),
				pg_escape_string($this->input->post('client-adresse', TRUE)),
				pg_escape_string($this->input->post('client-tel', TRUE)),
				pg_escape_string($this->input->post('client-email', TRUE)),
				pg_escape_string($this->input->post('client-Fax', TRUE)),
				pg_escape_string($this->input->post('client-identifiant', TRUE)),
				pg_escape_string($this->input->post('client-representant', TRUE)),
				pg_escape_string($this->input->post('client-identifiant', TRUE))
			); 
			$rslt = $this->M_clients->insertClient($dtaClient);
			if($rslt>0)
				{
					return $rslt;
				}
				else
				{
					throw new Exception("identifiant".pg_escape_string($this->input->post('client-identifiant', TRUE))." existe deja");	
				}
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
}
?>
<?php

class Clients extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionContrat/M_clients','M_clients');	
		$this->load->library('form_validation');
	}
	function loadClients()
	{
		
		$rslt = $this->M_clients->clientsList($this->session->entreprise);
		
		echo json_encode($rslt);
	}
	function addclient()
	{
		try {
			$this->form_validation->set_data($_POST);
			if($this->form_validation->run('ajouterClient')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			$dtaClient = array(
				pg_escape_string($this->input->post('client-nom', TRUE)),
				pg_escape_string($this->input->post('client-adresse', TRUE)),
				pg_escape_string($this->input->post('client-tel', TRUE)),
				pg_escape_string($this->input->post('client-email', TRUE)),
				pg_escape_string($this->input->post('client-Fax', TRUE)),
				pg_escape_string($this->input->post('client-identifiant', TRUE)),
				pg_escape_string($this->input->post('client-representant', TRUE)),
				pg_escape_string($this->input->post('client-ice', TRUE)),
				date('Y-m-d'),
				$this->session->entreprise,
				pg_escape_string($this->input->post('client-identifiant', TRUE)),
				
			); 
			$rslt = $this->M_clients->insertClient($dtaClient);
			if($rslt>0)
				{
					return $rslt;
				}
				else
				{
					throw new Exception("identifiant".pg_escape_string($this->input->post('client-identifiant', TRUE))."  existe deja");	
				}
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function editclient()
	{
		try {
			$this->form_validation->set_data($_POST);
			if($this->form_validation->run('ajouterClient')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			$nouveauIdentifiant = pg_escape_string($this->input->post('client-identifiant', TRUE));
			$ancienIdentifiant = pg_escape_string($this->input->post('ancien-client-identifiant', TRUE));
			if(empty($ancienIdentifiant))
			{
				throw new Exception("identifiant invalide");	
			}
			
			else
			{
				$dtaClient = array(
				pg_escape_string($this->input->post('client-nom', TRUE)),
				pg_escape_string($this->input->post('client-adresse', TRUE)),
				pg_escape_string($this->input->post('client-tel', TRUE)),
				pg_escape_string($this->input->post('client-email', TRUE)),
				pg_escape_string($this->input->post('client-Fax', TRUE)),
				pg_escape_string($this->input->post('client-identifiant', TRUE)),
				pg_escape_string($this->input->post('client-representant', TRUE)),
				pg_escape_string($this->input->post('client-ice', TRUE)),
				$this->session->entreprise,
				$ancienIdentifiant,
			); 
			$rslt = $this->M_clients->editClient($dtaClient);
			if($rslt>0)
				{
					return $rslt;
				}
				else
				{
					throw new Exception("identifiant".pg_escape_string($this->input->post('client-identifiant', TRUE))."  existe deja");	
				}
			}
			
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
}
?>
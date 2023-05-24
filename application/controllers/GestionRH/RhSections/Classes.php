<?php

class Classes extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		

		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionRH/M_gestionClasses','gestionClasses');
		$this->load->library('form_validation');	
	}
	function loadClasses()
	{
		
		$rslt = $this->gestionClasses->ClasseList($this->session->entreprise);
		
		echo json_encode($rslt);
	}
	function hideClasse()
	{
		try {
			if(!isset($_POST['code']) || !is_numeric($_POST['code']) || strlen($_POST['code'])>20)
				throw new Exception('Données invalides');
			$rslt = $this->gestionClasses->hideClasse($this->input->post('code', TRUE),$this->session->entreprise);
			if($rslt==1)
				return 1;
			else
				throw new Exception("Profil non Trouvé");
				
				
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function addClasse()
	{
		$this->form_validation->set_data($_POST);
		try {
			if($this->form_validation->run('ajouterClasse')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			$dtaClasse = array(
				pg_escape_string($this->input->post('classe-Libelle', TRUE)),
				pg_escape_string($this->input->post('classe-salaire', TRUE)),
				$this->session->entreprise
				
			); 
			$rslt = $this->gestionClasses->insertClasse($dtaClasse);
			if($rslt>0)
				{
					return $rslt;
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
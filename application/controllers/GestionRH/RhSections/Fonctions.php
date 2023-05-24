<?php

class Fonctions extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionRH/M_gestionFonctions','gestionFonctions');
		$this->load->model('M_GestionRH/M_gestionClasses','gestionClasses');	
		$this->load->library('form_validation');
	}
	function loadFonctions()
	{
		
		$rslt = $this->gestionFonctions->fonctionsList($this->session->entreprise);
		
		echo json_encode($rslt);
	}
	function hideFonction()
	{
		try {
			if(!isset($_POST['code']) || !is_numeric($_POST['code']) || strlen($_POST['code'])>20)
				throw new Exception('Données invalides');
			$rslt = $this->gestionFonctions->hideFonction($this->input->post('code', TRUE),$this->session->entreprise);
			if($rslt==1)
				return 1;
			else
				throw new Exception("Fonction non Trouvé");
				
				
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	
	function addFonction()
	{
		$this->form_validation->set_data($_POST);
		try {
			if($this->form_validation->run('ajouterFonction')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			$classe = $this->gestionClasses->checkValideClasse(pg_escape_string($this->input->post('fonction-classe', TRUE)),$this->session->entreprise);
				if(is_array($classe))
				{
					$dtafonction = array(
						$classe['id_classe'],
						pg_escape_string($this->input->post('fonction-type', TRUE)),
						pg_escape_string($this->input->post('fonctions-Libelle', TRUE)),

					); 
					$rslt = $this->gestionFonctions->insertfonction($dtafonction);
					if($rslt>0)
					{
						return $rslt;
					}
					else
					{
						throw new Exception("une erreur s'est produite");	
					}
				}
				else
				{
					throw new Exception('classe invalide');
				}

			} catch (Exception $e) {
				$message = $e->getMessage();
				http_response_code(400);
				die( $message );
			}
		}


	}
	?>
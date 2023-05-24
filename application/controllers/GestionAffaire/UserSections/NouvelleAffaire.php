<?php

class NouvelleAffaire extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		

		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionAffaire/M_nouvelAffaire','M_ajouterAffaire');	
		$this->load->model('M_GestionAffaire/M_affaires','M_affaires');	
		$this->load->library('form_validation');
	}
	function index()
	{

	}
	
	function ajouterAffaire()
	{
		$this->form_validation->set_data($_POST);
		try {
			$this->load->library('custom_crypt');
			$time= time();
			$folderName = $this->normalizeString(pg_escape_string($this->input->post('numero', TRUE)));
			$folderKey = $this->custom_crypt->random_str(35,date('s', $time).$folderName.date('i', $time));

			if($this->form_validation->run('ajouterAffaire')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			$numContrat = $this->input->post('numero-contrat', TRUE);
			$numContrat = strpos($numContrat,'_pfx_') !== false?$numContrat:$this->session->entreprise.'_pfx_'.$numContrat;
			$dataArray = array(
				pg_escape_string($this->input->post('numero', TRUE)),
				$this->session->numeric_matricule,
				pg_escape_string($this->input->post('libelle', TRUE)),
				pg_escape_string($this->input->post('delai', TRUE)),
				$numContrat ==$this->session->entreprise."_pfx_"?null:$numContrat,
				pg_escape_string($this->input->post('observations', TRUE)),
				$folderName,
			);
			
			$rslt = $this->M_ajouterAffaire->insertAffaire($dataArray);
			if($rslt==1)
			{
				if(!is_dir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_affaires/'.$folderName.'/taches'))
				{
					
					mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_affaires/'.$folderName.'/taches',0775,true);	
				}
				
				echo 'Affaire enregistrée';
			}
			else if($rslt==2)
			{
				echo $rslt;	
			}
			else
			{
				throw new Exception('Données invalides! ');	
			}

		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );

		}
	}
	public static function normalizeString ($str = '')
	{
		$str = strip_tags($str); 
		$str = preg_replace('/[\r\n\t ]+/', '_', $str);
		$str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', '_', $str);
		$str = strtolower($str);
		$str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
		$str = htmlentities($str, ENT_QUOTES, "utf-8");
		$str = preg_replace("/(&)([a-z])([a-z]+;)/i", '_', $str);
		$str = str_replace(' ', '_', $str);
		$str = rawurlencode($str);
		$str = str_replace('%', '_', $str);
		return $str;
	}

}
?>
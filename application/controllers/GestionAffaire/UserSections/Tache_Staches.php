<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tache_Staches extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		

		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionAffaire/M_tache_Staches','sousTache');
		$this->load->model('M_GestionAffaire/M_affaires','M_affaires');
		$this->load->library('form_validation');
		
	}
	function addStache()
	{
		$this->form_validation->set_data($_POST);
		try {
			if($this->form_validation->run('ajouterStache')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			$res = $this->M_affaires->check_responsableMatricule($this->session->etablissement,$this->session->entreprise,pg_escape_string($this->input->post('sTaches-responsable', TRUE)));
			if(!is_array($res) || count($res)==0)
			{
			
				throw new Exception("matricule invalide");

			}
			$numAffaire = pg_escape_string($this->input->post('affaire', TRUE));
			$dtaTache = array(
				pg_escape_string($this->input->post('affaire-sTache-delai', TRUE)),
				$res[0]['char_matricule'],
				pg_escape_string($this->input->post('sTaches-Libelle', TRUE)),
				strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire,
				pg_escape_string($this->input->post('tache', TRUE)),
				0,
				pg_escape_string($this->input->post('tache', TRUE)),
				'false',
				'true',
				'false',
				$this->session->numeric_matricule,
				date("Y-m-d h:i:s")
			); 
			$rslt = $this->sousTache->add_Stache($dtaTache);
			if($rslt>0)
			{
				echo $res[0]['numeric_matricule'];
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
	function loadStaches()
	{
		$numAffaire = pg_escape_string($this->input->post('affaire', TRUE));
		$numtache = pg_escape_string($this->input->post('tache', TRUE));
		if($numAffaire=='' || $numtache=='' )
		{
			$rslt=array("data" => []);
		}
		else
		{
			$rslt = $this->sousTache->sTachesList($this->session->numeric_matricule,strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire,$numtache);
		}
		
		
		echo json_encode($rslt);
		
	}
	
	function validateTache()
	{
		try {
			if(empty($this->input->post('numero', TRUE))||empty($this->input->post('numero_affaire', TRUE)))
				throw new Exception("Tache introuvable");
				$numAffaire = pg_escape_string($this->input->post('numero_affaire', TRUE));
			$dta = array(
				
				pg_escape_string($this->input->post('numero', TRUE)),
				strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire,
				$this->session->numeric_matricule
				
			); 

			$rslt = $this->sousTache->validate_tache($dta);
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
<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
class Affaires extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionAffaire/M_affaires','M_affaires');
		$this->load->model('M_GestionContrat/M_contrats','contrats');
	}
	function loadAffaires()
	{
		
		$rslt = $this->M_affaires->affairesList($this->session->numeric_matricule);
		
		echo json_encode($rslt);
		
	}
	// function deleteAffaire()
	// {
	// 	try {
	// 		if(!isset($_POST['numero'])  || strlen($_POST['numero'])>40)
	// 			throw new Exception('Données invalides');
	// 		$rslt = $this->M_affaires->deleteAffaire($this->input->post('numero', TRUE),$this->session->numeric_matricule);
	// 		if($rslt==1)
	// 			return 1;
	// 		else
	// 			throw new Exception("Affaire non Trouvé");
				
				
			
	// 	} catch (Exception $e) {
	// 		$message = $e->getMessage();
	// 		http_response_code(400);
	// 		die( $message );
	// 	}
	// }
	function deleteAffaire()
	{
		$this->load->library('utils');
		try {
			if(!isset($_POST['numero'])  || strlen($_POST['numero'])>40)
				throw new Exception('Données invalides');
			
		
			$numAffaire = pg_escape_string($this->input->post('numero', TRUE));
			$numMatriculeCreateur = $this->session->numeric_matricule;
			$rslt = $this->M_affaires->deleteAffaire(strpos($numAffaire,'_pfx_') !== false?$numAffaire:$this->session->entreprise.'_pfx_'.$numAffaire,$numMatriculeCreateur);
			
			if($rslt==1)
			{
				/*$folderName = $this->utils->normalizeString($numero);
				 $this->utils->delete_folder($this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_affaires/'.$folderName);*/
				return 1;
			}
			else
				throw new Exception("Affaire non Trouvé");
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function loadEmployees()
	{
		$rslt = $this->M_affaires->employeesList($this->session->etablissement,$this->session->entreprise);
		echo json_encode($rslt);
	}
	
	function suggestContrats()
	{
		if(!isset($_POST['term'])  || strlen($_POST['term'])>100)
			return json_encode([]);
			$filter = $_POST['term'];
		$rslt = $this->contrats->ContratsNumeros($filter,$this->session->entreprise);
		echo json_encode($rslt);
	}
}
?>
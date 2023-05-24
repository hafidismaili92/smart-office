<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
class GlobalAffaires extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionAffaire/M_globalAffaires','globalAffaires');
		
	}
	function loadGlobalAffaires()
	{
		/*if(isset($_POST['periode']) && in_array($_POST['periode'],[0,1,5,10]))
		{
			$rslt = $this->globalAffaires->globalAffairesList($this->session->etablissement,$this->session->entreprise,pg_escape_string($this->input->post('periode', TRUE)));
		
		echo json_encode($rslt);
		}*/

		if(isset($_POST['categorie']) && in_array($_POST['categorie'],['total','ensouffrance','encours','acheve']))
		{

			$rslt = $this->globalAffaires->globalAffairesList($this->session->etablissement,$this->session->entreprise,pg_escape_string($this->input->post('categorie', TRUE)));
		
		echo json_encode($rslt);
		}
		else
		{
			echo json_encode(array(
			"data" => []
		));
		}
		
		
	}
	function loadGlobalAffDB()
	{
		$parEtat = $this->globalAffaires->affairesByEtat($this->session->etablissement,$this->session->entreprise);
		$parMois = $this->globalAffaires->affairesByMonths($this->session->etablissement,$this->session->entreprise);
		echo json_encode(array('parEtat'=>$parEtat,'parMois'=>$parMois));
		
	}
	// function confirmDeleteAffaire()
	// {
	// 	try {
	// 		if(!isset($_POST['numero'])  || strlen($_POST['numero'])>40)
	// 			throw new Exception('Données invalides');
	// 		if(!isset($_POST['createur'])  || strlen($_POST['createur'])>40)
	// 			throw new Exception('Données invalides');
	// 		$numero = $this->input->post('numero', TRUE);
	// 		$numMatriculeCreateur = preg_replace("/[^0-9]/", "",$this->input->post('createur', TRUE));
	// 		$rslt = $this->globalAffaires->confirmDeleteAffaire($numero,$numMatriculeCreateur,$this->session->etablissement,$this->session->entreprise);
			
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
	
	
}
?>
<?php

class Etablissements extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionRH/M_gestionEtablissements','gestionEtablissements');
		$this->load->library('form_validation');	
	}
	function loadEtablissements()
	{
		
		$rslt = $this->gestionEtablissements->etablissementList($this->session->entreprise);
		
		echo json_encode($rslt);
	}
	function hideEtablissement()
	{
		try {
			if(!isset($_POST['code']) || !is_numeric($_POST['code']) || strlen($_POST['code'])>20)
				throw new Exception('Données invalides');
			$rslt = $this->gestionEtablissements->hideEtablissement($this->input->post('code', TRUE),$this->session->entreprise);
			if($rslt==1)
				return 1;
			else
				throw new Exception("Entité non Trouvé");
				
				
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function deleteEtablissement()
	{
		try {
			if(!isset($_POST['code']) || !is_numeric($_POST['code']) || strlen($_POST['code'])>20)
				throw new Exception('Données invalides');
			$rslt = $this->gestionEtablissements->deleteEtablissement($this->input->post('code', TRUE),$this->session->entreprise);
			if($rslt==1)
				return 1;
			else
				throw new Exception("Entité non supprimé car Non vide (contient des employés ou d'autres entité)");
				
				
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function updateEtablissement()
	{

		$this->form_validation->set_data($_POST);
		try {
			$code = -1;
			if(isset($_POST['code']) && is_numeric($_POST['code']))
			{
				$code = $_POST['code'];
				unset($_POST['code']);
			}
			else
				throw new Exception("Code erroné");
				
			if($this->form_validation->run('ajouterEtablissement')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			 $mere = $this->gestionEtablissements->checkValidEtablissement(pg_escape_string($this->input->post('etablissement-mere', TRUE)),$this->session->entreprise);

			 if(is_array($mere))
			 {
			 	$dtaEtablissement = array(
				$mere['id_niveau']+1,
				$mere['code_etablissement'],
				pg_escape_string($this->input->post('etablissement-type', TRUE)),
				pg_escape_string($this->input->post('etablissements-Libelle', TRUE)),
				$code,
				$this->session->entreprise,
				
				
			); 
			$rslt = $this->gestionEtablissements->updateEtablissement($dtaEtablissement);

			if($rslt>0)
				{
					echo $rslt;
				}
				else
				{
					throw new Exception("une erreur s'est produite");	
				}
			 }
			 else
			 {
			 	throw new Exception("Etablissement mère invalide");
			 }
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function addEtablissement()
	{
		$this->form_validation->set_data($_POST);
		try {

			if($this->form_validation->run('ajouterEtablissement')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			 $mere = $this->gestionEtablissements->checkValidEtablissement(pg_escape_string($this->input->post('etablissement-mere', TRUE)),$this->session->entreprise);

			 if(is_array($mere))
			 {
			 	$dtaEtablissement = array(
				$mere['id_niveau']+1,
				$mere['code_etablissement'],
				pg_escape_string($this->input->post('etablissement-type', TRUE)),
				pg_escape_string($this->input->post('etablissements-Libelle', TRUE)),
				$this->session->entreprise
				
			); 
			$rslt = $this->gestionEtablissements->insertEtablissement($dtaEtablissement);

			if($rslt>0)
				{
					echo $rslt;
				}
				else
				{
					throw new Exception("une erreur s'est produite");	
				}
			 }
			 else
			 {
			 	throw new Exception("Etablissement mère invalide");
			 }
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function getOrganigramme()
  {
    
    $etablissementsArray = $this->gestionEtablissements->getOrganigramme(49);
    
    $organigramme = array();
    $level1 = array(array('v'=>$etablissementsArray[0]['code_etablissement'],'f'=>'<div style="color:black; font-style:italic">'.$etablissementsArray[0]['libelle'].'<br><span style="color:gray;"> code : '.$etablissementsArray[0]['code_etablissement'].'</span></div>'),'','koko');
  
   foreach ($etablissementsArray as $etablissement) {
     $block = array(array('v'=>$etablissement['code_etablissement'],'f'=>'<div style="font-style:italic">'.$etablissement['libelle'].'<br><span style="color:gray;"> code : '.$etablissement['code_etablissement'].'</span></div>'),$etablissement['mere'],'koko');
     array_push($organigramme,$block);
   }
    
   echo json_encode($organigramme);
   //$this->load->view('gestion-rh/organigramme',array('organigramme'=>json_encode($organigramme)));
  
   
  }
	
}
?>
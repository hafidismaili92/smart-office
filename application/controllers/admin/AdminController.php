<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminController extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('M_entreprise','entreprise');
	
	}
	
	function index()
	{
	$data = array(
			'sideBarre'=>$this->load->view('template/admin/sideBarre',array('actif'=>'demande-inscription'),true)

	);
		$this->load->view('template/admin/demande-inscription',$data);
		
			
	}
	function entreprisesDemandes()
	{
		$dta = $this->entreprise->show('e.nom,e.numero,e.tel,e.ville,e.date_creation as date_demande,e.mail ,d.libelle as domaine, concat(emp.nom,\' \',emp.prenom) as administrateur',array('confirmed'=>'false'),true,"demandes");
		
		echo json_encode($dta);
	}
	function entreprisesList()
	{
		$dta = $this->entreprise->show('e.nom,e.numero,e.tel,e.mail , concat(emp.nom,\' \',emp.prenom) as administrateur,active',array('confirmed'=>'true'),true,"listes");
		
		echo json_encode($dta);
	}
	function setEntrepriseState()
	{
		try {
			$numEntreprise = pg_escape_string($this->input->post('num-entreprise', TRUE));
			$state = pg_escape_string($this->input->post('state', TRUE));
			if(!is_numeric($numEntreprise) || strlen($numEntreprise)>20 || !in_array($state,['true','false']))
				throw new Exception("Données invalides");
			
			$rslt = $this->entreprise->updateField($numEntreprise,$state,"active");
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
	function listeView()
	{
		$data = array(
			'sideBarre'=>$this->load->view('template/admin/sideBarre',array('actif'=>'liste-entreprises'),true)

	);
	$this->load->view('template/admin/liste-entreprises',$data);
	}
function confirmDemande()
{
	try {
		$numEntreprise = pg_escape_string($this->input->post('num-entreprise', TRUE));
		
		if(!is_numeric($numEntreprise) || strlen($numEntreprise)>20)
			throw new Exception("Données invalides");
		
		$rslt = $this->entreprise->updateField($numEntreprise,"true","confirmed");
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
function logOut()
{
	$session_items= array('nom','is_admin','logged_in');
		$this->session->unset_userdata($session_items);
		$this->session->sess_destroy();
		
		redirect(base_url());
}
}
?>
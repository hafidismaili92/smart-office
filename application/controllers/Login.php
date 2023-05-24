<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('M_login');

	}
	function serveImages()
	{
		if(isset($_GET['id']) and in_array($_GET['id'],['BG']))
		{
			switch ($_GET['id']) {
				case 'BG':
					$this->load->image('images/login_BG0.png');
					break;
				
				default:
					# code...
					break;
			}
		}
	}
	public function index()
	{
		if(is_logged_in())
		{
			redirect(base_url().'Main');
		}
		else
		{
			$this->load->view('template/login');
		}
	}
	public function resetPasswordView($matricule=null)
	{
		if(is_logged_in())
		{
			
			redirect(base_url().'Main');
		}
		else
		{
			$this->load->view('template/resetPassword',array('matricule' => $matricule ));
		}
		
	}
	public function resetPassword()
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->form_validation->set_data($_POST);
		try {

			if($this->form_validation->run('resetPassword')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			else
			{
				$this->load->library('custom_crypt');
				$matricule = pg_escape_string($this->input->post('emp-matricule', TRUE));
				$oldPassword = pg_escape_string($this->input->post('emp-oldPassword', TRUE));	
				$newPassword = pg_escape_string($this->input->post('emp-newPassword', TRUE));
				$PasswordCrypt=$this->custom_crypt->cryptPassword($newPassword);
				$dta = $this->M_login->userResetPassword($matricule,$oldPassword,$PasswordCrypt);
				if(is_array($dta))
				{
					$newdata = array(
						'userNom'  => $dta['nom'],
						'userPrenom'=>$dta['prenom'],
						'email'     => $dta['email'],
						'char_matricule'=>$dta['char_matricule'],
						'numeric_matricule'=>$dta['numeric_matricule'],
						'etablissement'=>$dta['code_etablissement'],
						'fonction'=>$dta['id_fonction'],
						'libelle_etablissement'=>$dta['libelle_etabli'],
						'libelle_fonction'=>$dta['libelle_fonction'],
						'first-affaire'=>$dta['numero_affaire'],
						'entreprise'=>$dta['entreprise'],
						'logged_in' => TRUE
					);
					$this->session->set_userdata($newdata);			
					echo json_encode(array('logged'=>true));
				}
				else
				{
					throw new Exception($dta);
				}
				
			}

		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
		
	}
	public function connection()
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');

		else
		{
			try {
			$matricule = pg_escape_string($this->input->post('emp-matricule', TRUE));
			$password = pg_escape_string($this->input->post('emp-Password', TRUE));
			//check if an admin credentials
			$adminData = $this->M_login->adminLogin($matricule,$password);
			if(is_array($adminData))
			{
				$admininfos = array(
					'nom'=>$adminData['nom'],
					'is_admin'=>true,
					'logged_in' => true
				);
				$this->session->set_userdata($admininfos);			
				echo json_encode(array('logged'=>true));
			}
			else
			{
				$dta = $this->M_login->userLogin($matricule,$password);
			if(is_array($dta))
			{
				$newdata = array(
					'userNom'  => $dta['nom'],
					'userPrenom'=>$dta['prenom'],
					'email'     => $dta['email'],
					'char_matricule'=>$dta['char_matricule'],
					'numeric_matricule'=>$dta['numeric_matricule'],
					'etablissement'=>$dta['code_etablissement'],
					'fonction'=>$dta['id_fonction'],
					'libelle_etablissement'=>$dta['libelle_etabli'],
					'libelle_fonction'=>$dta['libelle_fonction'],
					'first-affaire'=>$dta['numero_affaire'],
					'entreprise'=>$dta['entreprise'],
					'confirmed'=> ($dta['confirmed']=='true' || $dta['confirmed']=='t'),
					'active'=> ($dta['active']=='true' || $dta['active']=='t'),
					'logged_in' => TRUE
				);
				$this->session->set_userdata($newdata);			
				echo json_encode(array('logged'=>true));
			}
			elseif ($dta==true) {


				$page =  base_url().'Login/resetPasswordView/'.$matricule;
				echo json_encode(array('page'=>$page));

			}
			else
			{
				throw new Exception("matricule ou Mot de pass erroné");

			}
			}

		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
		}
		
	}
	public function logout(){
		$session_items= array('userNom','userPrenom','email','char_matricule','numeric_matricule','etablissement','fonction','libelle_etablissement','libelle_fonction','first-affaire','logged_in');
		$this->session->unset_userdata($session_items);
		$this->session->sess_destroy();
		
		redirect(base_url());

	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscription extends CI_Controller {


	public function index()
	{
		$this->load->model('M_entreprise','entreprise');
		$rslt = $this->entreprise->loadDomaines();
		$villes = $this->entreprise->entrepriseListeVille();
		$this->load->helper('html');
		$img = 'images/landPhoto.png';
		$this->load->view('template/inscription',array('img'=>$img,'domaines'=>$rslt,'villes'=>$villes));
	}
}

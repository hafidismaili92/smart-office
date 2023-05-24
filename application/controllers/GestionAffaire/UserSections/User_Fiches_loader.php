<?php
/**
 * 
 */
class User_Fiches_loader extends My_Controller
{
	public $imgEntreprise='';
	public $entrepriseData='';
	function __construct()
	{
		parent::__construct();
		

		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			$this->load->model('M_GestionRH/M_gestionConge','gestionConge');
		$this->load->model('M_GestionAffaire/M_user_data','userData');
		include ("mpdf/vendor/autoload.php");
		$this->load->helper('html');
		$this->imgEntreprise = glob($this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.{jpg,png,jpeg}', GLOB_BRACE);
		$this->entrepriseData = $this->M_entreprise->entrepriseData($this->session->entreprise);
		
	}

	function load_ficheConge()
	{
		$etablissement=$this->session->etablissement;
		$matricule=$this->session->numeric_matricule;
		$pdf= new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf']);
		$dta = $this->userData->employeeData($etablissement,$matricule,$this->session->entreprise);
		$dta['suiviConge']=$this->gestionConge->congeList($matricule)['data'];
		$dta['isdemande']=true;
		$dta['nomEntreprise']=$this->entrepriseData['nom'];
		if(count($this->imgEntreprise)>0)
			$dta['imgEntreprise']=$this->imgEntreprise[0];
		if(!empty($dta['photo']))
		{
			$dta['src'] = $this->folderPath.'entreprises/'.$this->session->entreprise.'/dossier_Employes/'.$dta['matricule'].'/photo/'.$dta['photo'];
		}
		else
		{
			$dta['src'] = 'images/userProfilImg.png';
		}
   		//$this->load->view('fiches/fiche_conge',$dta);
		$html = $this->load->view('fiches/fiche_conge',$dta,true);
		$pdfFilePath = "fiche_conge_".date("dmY").".pdf";
		
        //generate the PDF from the given html
		$pdf->WriteHTML($html);
		
        //download it.
		$pdf->Output($pdfFilePath,"D");
	}
	function load_bnSortie()
	{
		$etablissement=$this->session->etablissement;
		$matricule=$this->session->numeric_matricule;
	$pdf= new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf']);
		$dta = $this->userData->employeeData($etablissement,$matricule,$this->session->entreprise);
		$dta['nomEntreprise']=$this->entrepriseData['nom'];
		if(count($this->imgEntreprise)>0)
			$dta['imgEntreprise']=$this->imgEntreprise[0];
		$html = $this->load->view('fiches/bon_sortie',$dta,true);
		$pdfFilePath = "Bon_sortie_".date("dmY").".pdf";
		
        //generate the PDF from the given html
		$pdf->WriteHTML($html);
		
        //download it.
		$pdf->Output($pdfFilePath,"D");
	}
	function load_ordreMission()
	{
		$etablissement=$this->session->etablissement;
		$matricule=$this->session->numeric_matricule;
		$pdf= new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf']);
		$dta = $this->userData->employeeData($etablissement,$matricule,$this->session->entreprise);
		$dta['nomEntreprise']=$this->entrepriseData['nom'];
		if(count($this->imgEntreprise)>0)
			$dta['imgEntreprise']=$this->imgEntreprise[0];
		$html = $this->load->view('fiches/ordre_mission',$dta,true);
		$pdfFilePath = "ordre_mission_".date("dmY").".pdf";
		
        //generate the PDF from the given html
		$pdf->WriteHTML($html);
		
        //download it.
		$pdf->Output($pdfFilePath,"D");
	}
	function load_ficheHS()
	{
		$etablissement=$this->session->etablissement;
		$matricule=$this->session->numeric_matricule;
		$pdf= new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf']);
		$dta = $this->userData->employeeData($etablissement,$matricule,$this->session->entreprise);
		$dta['nomEntreprise']=$this->entrepriseData['nom'];
		if(count($this->imgEntreprise)>0)
			$dta['imgEntreprise']=$this->imgEntreprise[0];
		$html = $this->load->view('fiches/heures_supp',$dta,true);
		$pdfFilePath = "ordre_mission_".date("dmY").".pdf";
		
        //generate the PDF from the given html
		$pdf->WriteHTML($html);
		
        //download it.
		$pdf->Output($pdfFilePath,"D");
	}
}
?>
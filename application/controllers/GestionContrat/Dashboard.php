<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		
		$this->load->model('M_GestionContrat/M_dashboard','dashboard');
		
	}

	function getDashboardContrats()
	{
		try {

			if(isset($_POST['periode']) and in_array($_POST['periode'],array("current-year", "five-year", "teen-year")))
		{
			$periode = pg_escape_string($this->input->post('periode', TRUE));
			$periodeLabel='';
			switch ($periode) {
				case "current-year":
					$monthOrYear='Month';
					$yearsNombre=1;
					$periodeLabel = date('Y');
					break;
				case "five-year":
					$monthOrYear='Year';
					$yearsNombre=5;
					$periodeLabel = date('Y').'-'.(date('Y')-4);
					break;
				case "teen-year":
					$monthOrYear='Year';
					$yearsNombre=10;
					$periodeLabel = date('Y').'-'.(date('Y')-9);
					break;
				
			}
			$rsltParSecteur = $this->dashboard->contratsparSecteur($this->session->entreprise,$monthOrYear,$yearsNombre);
			$rsltParEtat= $this->dashboard->contratparEtat($this->session->entreprise,$yearsNombre);
			$rsltParMontant= $this->dashboard->contratsparMontant($this->session->entreprise,$monthOrYear,$yearsNombre);
			$rsltParRevenue = $this->dashboard->facturesPartime($this->session->entreprise,$monthOrYear,$yearsNombre);
			$rsltParRealisation = $this->dashboard->facturesRealise($this->session->entreprise,$monthOrYear,$yearsNombre);
			$geometries = $this->dashboard->geometriesListe($this->session->entreprise);
			echo json_encode(array('parSecteur'=>$rsltParSecteur,'parEtat'=>$rsltParEtat,'parMontant'=>$rsltParMontant,'periodeLabel'=>$periodeLabel,'parRevenue'=>$rsltParRevenue,'parRealisation'=>$rsltParRealisation,'geom'=>$geometries));	
		}
		else
			throw new Exception("Periode invalide");
			
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
		
	}
	
}
?>
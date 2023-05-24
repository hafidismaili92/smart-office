<?php

class ListeFacture extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		

		
		$this->load->model('M_GestionContrat/M_listeFactures','ListeFactures');
		$this->load->model('M_GestionContrat/M_contrats','contrats');
		$this->load->helper('download');
		
	}
	function downloadCopy()
	{

		try {
			if(isset($_GET['facture']))
			{
				$numero = $this->input->get('facture', TRUE);
				
				if(strlen($numero)>20)
				{
					throw new Exception("facture invalide");
					
				}
				$this->load->helper('html');
				include ("mpdf/vendor/autoload.php");

   /**
 * Create a new PDF document
 *
 * @param string $mode
 * @param string $format
 * @param int $font_size
 * @param string $font
 * @param int $margin_left
 * @param int $margin_right
 * @param int $margin_top (Margin between content and header, not to be mixed with margin_header - which is document margin)
 * @param int $margin_bottom (Margin between content and footer, not to be mixed with margin_footer - which is document margin)
 * @param int $margin_header
 * @param int $margin_footer
 * @param string $orientation (P, L)
 */

   $pdf= new \Mpdf\Mpdf(['margin_left' => 15,'margin_right' => 15]);
   $pdf->setAutoTopMargin = 'stretch';
   $pdf->defaultfooterline = 0;
   $pdf->setFooter('<div style="with:100%;text-align:center;color:gray;font-size:12px"> - Page {PAGENO} / {nb} - </div>');
   $facturePrix = $this->ListeFactures->getFacturePrix($numero);
   $factureData= $this->ListeFactures->getFacturedata($numero,$this->session->entreprise);
   if(!is_array($factureData))
   {
   	throw new Exception("fichier introuvable");
   }
   $imgEntreprise = glob($this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.{jpg,png,jpeg}', GLOB_BRACE);
   if(count($imgEntreprise)>0)
   	$factureData['img']=$imgEntreprise[0];
   
   //$this->load->view('fiches/facture',array('dataFacture'=>$factureData));
   $pdf->SetHTMLHeader($this->load->view('fiches/facture/header',$factureData,true));
   $html = $this->load->view('fiches/facture/facture',array('dataFacture'=>$facturePrix,'tva'=> $factureData['tva']),true);
   $pdfFilePath = "facture".date("dmY").".pdf";

   $pdf->WriteHTML($html);

   $pdf->Output($pdfFilePath,"D");
}
else
{
	throw new Exception("fichier introuvable");
}

} catch (Exception $e) {

}
}
function downloadfacture()
{
	try {

		if(isset($_GET['file']) && isset($_GET['facture']) )
		{
			$key = $_GET['file'];
			$facture = $_GET['facture'];
			$liendata = $this->ListeFactures->getLien($facture,$key);
			if($liendata !=0)
			{
				$fullLink = $this->folderPath.'entreprises/'.$this->session->entreprise.'/contrats/'.$liendata['dossier'].'/factures/'.$liendata['lien'].'.pdf';
				force_download($fullLink, NULL);
					//echo $fullLink;
			}
			else
			{
				throw new Exception("fichier introuvable");
			}
		}
		else
		{
			throw new Exception("fichier introuvable");

		}

	} catch (Exception $e) {

		$message = $e->getMessage();
		http_response_code(400);
		die( $message );

	}
}
function addFactureAcusse($facture=null,$contrat=null)
{
	try {

		$this->load->library('custom_crypt');
		$numContrat = pg_escape_string($this->input->post('contrat-num', TRUE));
		$reelNumero = strpos($numContrat,'_pfx_') !== false?$numContrat:$this->session->entreprise.'_pfx_'.$numContrat;
		$numfacture = pg_escape_string($this->input->post('facture-num', TRUE));
		$contratdta = $this->contrats->getcontratData($reelNumero);
		if(is_array($contratdta))
		{
			$contratNumNorm = $contratdta['dossier'];
		}
		else
		{
			throw new Exception('contrat invalide!');
		}
			/****************************************************************************
			*								verification de la fiche Facture       			*
			*																			*
			*****************************************************************************/
			if (isset($_FILES['fichier']['name'])  && !empty($_FILES['fichier']['name'])) {
				$configPhotos['allowedMime'] = array('application/pdf');
				$configPhotos['max_size'] = 1.5*1024*1024;
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($file_info, $_FILES['fichier']['tmp_name']);

				if (!in_array($mime,$configPhotos['allowedMime'])) {
					
					throw new Exception('Fichier non autorisé : '.$_FILES['fichier']['name']);
				}
				elseif ($_FILES['fichier']['size']>$configPhotos['max_size']) {
					throw new Exception('Fichier dépassant 1.5 Mo : '.$_FILES['fichier']['name']);
				}
				elseif (0 < $_FILES['fichier']['error']) {
					throw new Exception('erreur de lecture' . $_FILES['fichier']['error']);
				}
				else
				{
					$fichierName = 'F'.$numfacture.'C'.$contratNumNorm;
					$fileKey = $this->custom_crypt->random_str(35,$fichierName).time();
					$rslt = $this->ListeFactures->addFacture_accusee($numfacture,$reelNumero,$fichierName,$fileKey);
					if($rslt==1)
					{
						move_uploaded_file($_FILES['fichier']['tmp_name'],$this->folderPath.'entreprises/'.$this->session->entreprise.'/contrats/'.$contratNumNorm.'/factures/'.$fichierName.'.pdf');
						echo 1;	
					}
					else
					{
						throw new Exception($rslt);

					}
				}


				
			}
			else
			{
				throw new Exception('Veuillez joindre le fichier');
			}
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
			
		}
	}
	function removeFacture()
	{
		try{
			if(isset($_POST['contrat-num']) && isset($_POST['facture-num']))
		{
			if(strlen($_POST['contrat-num'])>100 || strlen($_POST['facture-num'])>100 )
					throw new Exception("Données Invalide");
			$numeroContrat = pg_escape_string($this->input->post('contrat-num', TRUE));
			$reelNumero = strpos($numeroContrat,'_pfx_') !== false?$numeroContrat:$this->session->entreprise.'_pfx_'.$numeroContrat;
			$numeroFacture = pg_escape_string($this->input->post('facture-num', TRUE));	
			$rslt = $this->ListeFactures->removeFacture($numeroFacture,$reelNumero);
			if($rslt==1)
				echo 'Facture supprimée';
			else
				throw new Exception('impossible de supprimer la facture');
		}
		}
		catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
			
		}
	}
	function updateFactureState()
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');

		try {
			if(isset($_POST['numeroFacture']) && isset($_POST['etat']) && isset($_POST['numeroContrat']))
			{
				/*if(strlen($_POST['numeroContrat'])>50|| strlen($_POST['etat'])>20 || $_POST['numeroFacture']>50 )
					throw new Exception("Données Invalide");*/

				$etat = pg_escape_string($this->input->post('etat', TRUE));	
				$numeroContrat = pg_escape_string($this->input->post('numeroContrat', TRUE));
				$numeroContrat = strpos($numeroContrat,'_pfx_') !== false?$numeroContrat:$this->session->entreprise.'_pfx_'.$numeroContrat;
				$numeroFacture = pg_escape_string($this->input->post('numeroFacture', TRUE));
				$motif = pg_escape_string($this->input->post('motifRefus', TRUE));
				$dateReglement = pg_escape_string($this->input->post('dateReglement', TRUE));
				$modePayement = pg_escape_string($this->input->post('modePayement', TRUE));
				$rslt = $this->contrats->cotratDetail($numeroContrat,$this->session->entreprise);

				if($rslt!=0)
				{
					$dta = array(
						'etat'=>$etat, 
						'numeroContrat'=>$numeroContrat, 
						'numeroFacture'=>$numeroFacture, 
						'motif'=>$motif, 
						'dateReglement'=>$dateReglement,
						'modePayement'=>$modePayement,
						'entreprise'=>$this->session->entreprise
					);
					$rslt = $this->ListeFactures->update_FactureState($dta);
					echo $rslt;
				}
				else
				{
					throw new Exception("Contrat Invalide");

				}
			}
			else
			{
				throw new Exception("Données Vides!");
			}

		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );

		}
	}
	function exportListeFacture()
	{
		try {
			$entreprise = $this->session->entreprise;

			if(isset($_GET['contrat']))
			{
				$numero = $this->input->get('contrat', TRUE);
				$numero = strpos($numero,'_pfx_') !== false?$numero:$this->session->entreprise.'_pfx_'.$numero;
				if(strlen($numero)>50)
				{
					throw new Exception("contrat invalide");

				}
				$contratData= $this->contrats->getallContratData($numero,$this->session->entreprise);
				if(!is_array($contratData))
				{
					throw new Exception('contrat invalide!');
				}
				$imgEntreprise = glob($this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.{jpg,png,jpeg}', GLOB_BRACE);
				if(count($imgEntreprise)>0)
					$contratData['img']=$imgEntreprise[0];
				$this->load->helper('html');
				include ("mpdf/vendor/autoload.php");
				$rslt = $this->ListeFactures->loadFactureListe($numero,$this->session->entreprise)['factures'];
				$pdf= new \Mpdf\Mpdf(['margin_left' => 5,'margin_right' => 5,'format' => 'A4-L']);
				$pdf->setAutoTopMargin = 'stretch'; 
				$pdf->defaultfooterline = 0;
				$pdf->setFooter('<div style="with:100%;text-align:center;color:gray;font-size:12px"> - Page {PAGENO} / {nb} - </div>');

				$pdf->SetHTMLHeader($this->load->view('fiches/contrat/header',$contratData,true));
				$html = $this->load->view('fiches/facture/liste_facture',array('dataListe'=>$rslt),true);
				$pdfFilePath = "liste Factures_".date("dmY").".pdf";

				$pdf->WriteHTML($html);

				$pdf->Output($pdfFilePath,"D");

			}
			else
			{
				throw new Exception("contrat invalide");

			}
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
			
		}
		

	}

	function detailFacture($facture=null,$contrat=null)
	{
		try {

			if(isset($_POST['contrat-num']) and isset($_POST['facture-num']))
			{
				$numero = pg_escape_string($this->input->post('contrat-num', TRUE));
				$reelNumero = strpos($numero,'_pfx_') !== false?$numero:$this->session->entreprise.'_pfx_'.$numero;
				$rslt = $this->ListeFactures->getFacturePrix(pg_escape_string($this->input->post('facture-num', TRUE)),$reelNumero,true);
				if(count($rslt)>0)
				{
					echo json_encode($rslt);	
				}
				else
				{
					throw new Exception("une erreur s'est produite");

				}
			}
			else
			{
				throw new Exception("Veuillez indiquer le numero de la facture");
			}
			

		}
		catch (Exception $e) {

			$message = $e->getMessage();
			http_response_code(400);
			die( $message );

		}
		
		
	}
	
	function loadFactures($contrat=null)
	{
		try {

			if($contrat==null and isset($_POST['contrat-search-details']))
			{
				$numero = pg_escape_string($this->input->post('contrat-search-details', TRUE));
				$reelNumero = strpos($numero,'_pfx_') !== false?$numero:$this->session->entreprise.'_pfx_'.$numero;
				$rslt = $this->ListeFactures->loadFactureListe($reelNumero,$this->session->entreprise);
				if(count($rslt)>0)
				{
					echo json_encode($rslt);	
				}
				else
				{
					throw new Exception("une erreur s'est produite");

				}

			}
			else
			{
				throw new Exception("Veuillez indiquer le N° du Contrat");
			} 

		}
		catch (Exception $e) {

			$message = $e->getMessage();
			http_response_code(400);
			die( $message );

		}
		
		
	}


}
?>
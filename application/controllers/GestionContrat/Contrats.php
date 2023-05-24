<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ("phpSpreadSheet/vendor/autoload.php");
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
class Contrats extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		
		$this->load->model('M_GestionContrat/M_contrats','contrats');
		
	}
	function ExportUnpayedFactures()
	{
		
		$rslt = $this->contrats->unpayedFacture($this->session->entreprise);
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
		$worksheet = $spreadsheet->getActiveSheet();
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
		$spreadsheet->getActiveSheet()->mergeCells('A1:F1');
		$worksheet->getCell('A1')->setValue('Liste des Factures en Attente de Payement Au '.date('d-m-Y'));
		$style = array(
			'alignment' => array(
				'horizontal' =>Alignment::HORIZONTAL_CENTER,
			),
			'font'=> array(
					'bold'  =>  true,
					'underline'=>  true
				)
		);

		$worksheet->getStyle("A1:F1")->applyFromArray($style);

		$worksheet->getCell('A2')->setValue('N° Contrat');
		$worksheet->getCell('B2')->setValue('N° Facture');
		$worksheet->getCell('C2')->setValue('Montant TTC');
		$worksheet->getCell('D2')->setValue('Date Effet');
		$worksheet->getCell('E2')->setValue('Client');
		$worksheet->getCell('F2')->setValue('Etat');
		/*$worksheet->getStyle('A1:F1')->applyFromArray(
			array(
				'fill' => array(
					'type' => Fill::FILL_SOLID,
					'color' => array('ARGB' => 'FFFF0000' )
				),
				'font'  => array(
					'bold'  =>  true
				)
			)
		);*/
		$worksheet->getStyle('A2:F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('2C3A4D');
		$spreadsheet->getActiveSheet()->mergeCells('A1:F1');
		$worksheet->getStyle('A2:F2')->getFont()->setBold(true);
		$worksheet->getStyle('A2:F2')->getFont()->getColor()->setARGB('FFFFFF');
		for($col = 'A'; $col !== 'G'; $col++) {
			$worksheet->getColumnDimension($col)->setAutoSize(true);
		}
		for ($i=0; $i <count($rslt) ; $i++) { 
			$worksheet->getCell('A'.($i+3))->setValue($rslt[$i]['numero_contrat']);
			$worksheet->getCell('B'.($i+3))->setValue($rslt[$i]['numero']);
			$worksheet->getCell('C'.($i+3))->setValue($rslt[$i]['totalttc']);
			$worksheet->getCell('D'.($i+3))->setValue($rslt[$i]['dateeffet']);
			$worksheet->getCell('E'.($i+3))->setValue($rslt[$i]['client']);
			$worksheet->getCell('F'.($i+3))->setValue($rslt[$i]['etat']);
		}
		
		$fileName=$this->folderPath.'entreprises/'.$this->session->entreprise.'/FactureEnAttente.xlsx';
		$writer->save($fileName);
		$this->load->helper('download');
		force_download($fileName, NULL);
		
	}
	function updateState()
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');

		try {
			if(isset($_POST['numero']) && isset($_POST['etat']))
			{
				if(strlen($_POST['numero'])>50|| strlen($_POST['etat'])>20 )
					throw new Exception("Données Invalide");
				$etat = pg_escape_string($this->input->post('etat', TRUE));	
				
				$numero = pg_escape_string($this->input->post('numero', TRUE));
				$reelNumero = strpos($numero,'_pfx_') !== false?$numero:$this->session->entreprise.'_pfx_'.$numero;
				$rslt = $this->contrats->cotratDetail($reelNumero,$this->session->entreprise);

				if($rslt!=0)
				{
					if ($rslt['etatcontrat']!=$etat)
					{
						$dta = array('numero'=>$reelNumero,'etat'=>$etat,'etatprecedente'=>$rslt['etatcontrat'],'date'=>date("Y-m-d"));
						$updaterslt = $this->contrats->update_State($dta);
						if($updaterslt==1)
							echo 1;
						else
							throw new Exception("Erreur s'est produite");

					}
					else
					{
						echo 1;
					}	
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
	function ExportActifContrats()
	{
		$entreprise = $this->session->entreprise;
		$rslt = $this->contrats->contratsList($this->session->entreprise,false);

		$this->load->helper('html');
		include ("mpdf/vendor/autoload.php");

		$pdf= new \Mpdf\Mpdf(['margin_left' => 5,'margin_right' => 5,'format' => 'A4-L']);
		$pdf->setAutoTopMargin = 'stretch'; 
		$pdf->defaultfooterline = 0;
		$pdf->setFooter('<div style="with:100%;text-align:center;color:gray;font-size:12px"> - Page {PAGENO} / {nb} - </div>');
		$entrepriseData = $this->contrats->entrepriseData($this->session->entreprise);
		$imgEntreprise = glob($this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.{jpg,png,jpeg}', GLOB_BRACE);
		if(count($imgEntreprise)>0)
			$entrepriseData['img']=$imgEntreprise[0];

		$pdf->SetHTMLHeader($this->load->view('fiches/contrat/header',$entrepriseData,true));
		$html = $this->load->view('fiches/contrat/bodyListeContrats',array('dataListe'=>$rslt),true);
		$pdfFilePath = "liste Contrats_".date("dmY").".pdf";

		$pdf->WriteHTML($html);

		$pdf->Output($pdfFilePath,"D");

	}
	function loadContrats()
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		/*$draw = intval($_REQUEST["draw"]);
		$start = intval($_REQUEST["start"]);
		$length = intval($_REQUEST["length"]);*/
		$rslt = $this->contrats->contratsList($this->session->entreprise);
		/*$rslt["draw"]=$draw;
		$rslt["start"]=$start;
		$rslt["length"]=$length;*/
		echo json_encode($rslt);
		
	}
	function deleteContrat()
	{
		
		try {
			if(!isset($_POST['numero'])  || strlen($_POST['numero'])>40)
				throw new Exception('Données invalides');
			
			
			$numero = pg_escape_string($this->input->post('numero', TRUE));
				$reelNumero = strpos($numero,'_pfx_') !== false?$numero:$this->session->entreprise.'_pfx_'.$numero;
			$entreprise = $this->session->entreprise;
			$rslt = $this->contrats->deleteContrat($reelNumero,$entreprise);
			
			if($rslt==1)
			{
				
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
	function updateEtat($contrat=null)
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');

		try {
			if(isset($_POST['contrat-num']) && isset($_POST['contrat-state']) )
			{
				$state =pg_escape_string($this->input->post('contrat-state', TRUE))=='true'?'en cours':'termine';
				$rslt = $this->contrats->update_ContratState(pg_escape_string($this->input->post('contrat-num', TRUE)),$this->session->entreprise,$state);
				if($rslt==1)
				{
					echo 1;	
				}
				else
				{
					throw new Exception("une erreur s'est produite");

				}
				
			}
			else
			{
				throw new Exception("Veuillez indiquer le numero du contrat");
			}

		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );

		}
	}
	function loadDetailsContrat($contrat=null)
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');

		try {
			if(isset($_POST['contrat-search-details']))
			{
				$numero = pg_escape_string($this->input->post('contrat-search-details', TRUE));
				$reelNumero = strpos($numero,'_pfx_') !== false?$numero:$this->session->entreprise.'_pfx_'.$numero;
				$rslt = $this->contrats->cotratDetail($reelNumero,$this->session->entreprise);

				if($rslt!=0)
				{
					$rslt['avancement'] = round($rslt['realise']*100/$rslt['montant_ttc'],2).' %';
					$rslt['nonPaye'] = number_format(round($rslt['realise']-$rslt['paye_ttc'],2),2,'.',' ');

					echo json_encode($rslt);	
				}
				else
				{
					throw new Exception("Aucun contrat trouvé");

				}
			}
			else
			{
				throw new Exception("Veuillez indiquer le numero du contrat");
			}

		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );

		}
	}
	function exportAvancement($contrat=null)
	{

		try {
			if(isset($_GET['contrat']))
			{
				$numero = $this->input->get('contrat', TRUE);
				
				if(strlen($numero)>50)
				{
					throw new Exception("contrat invalide");
					
				}
				$this->load->helper('html');
				include ("mpdf/vendor/autoload.php");

				$pdf= new \Mpdf\Mpdf(['margin_left' => 15,'margin_right' => 15]);
				$pdf->setAutoTopMargin = 'stretch';
				$pdf->defaultfooterline = 0;
				$pdf->setFooter('<div style="with:100%;text-align:center;color:gray;font-size:12px"> - Page {PAGENO} / {nb} - </div>');
				$reelNumero = strpos($numero,'_pfx_') !== false?$numero:$this->session->entreprise.'_pfx_'.$numero;
				$contratPrix = $this->contrats->getcontratAvancement($reelNumero,$this->session->entreprise);
				$contratData= $this->contrats->getallContratData($reelNumero,$this->session->entreprise);
				if(!is_array($contratData))
				{
					throw new Exception("fichier introuvable");
				}
				$imgEntreprise = glob($this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.{jpg,png,jpeg}', GLOB_BRACE);
				if(count($imgEntreprise)>0)
					$contratData['img']=$imgEntreprise[0];

   //$this->load->view('fiches/facture',array('dataFacture'=>$factureData));
				$pdf->SetHTMLHeader($this->load->view('fiches/contrat/header',$contratData,true));
				$html = $this->load->view('fiches/contrat/bodyAvancement',array('dataContrat'=>$contratPrix,'tva'=> $contratData['tva']),true);
				$pdfFilePath = "Avancement contrat".$contrat."_".date("dmY").".pdf";

				$pdf->WriteHTML($html);

				$pdf->Output($pdfFilePath,"D");
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
	function exportBP($contrat=null)
	{

		try {
			if(isset($_GET['contrat']))
			{
				$numero = $this->input->get('contrat', TRUE);
				
				if(strlen($numero)>50)
				{
					throw new Exception("contrat invalide");
					
				}
				$this->load->helper('html');
				include ("mpdf/vendor/autoload.php");

				$pdf= new \Mpdf\Mpdf(['margin_left' => 15,'margin_right' => 15]);
				$pdf->setAutoTopMargin = 'stretch';
				$pdf->defaultfooterline = 0;
				$pdf->setFooter('<div style="with:100%;text-align:center;color:gray;font-size:12px"> - Page {PAGENO} / {nb} - </div>');
				$reelNumero = strpos($numero,'_pfx_') !== false?$numero:$this->session->entreprise.'_pfx_'.$numero;
				$contratPrix = $this->contrats->getcontratPrix($reelNumero,$this->session->entreprise);
				$contratData= $this->contrats->getallContratData($reelNumero,$this->session->entreprise);
				if(!is_array($contratData))
				{
					throw new Exception("fichier introuvable");
				}
				$imgEntreprise = glob($this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.{jpg,png,jpeg}', GLOB_BRACE);
				if(count($imgEntreprise)>0)
					$contratData['img']=$imgEntreprise[0];

				$pdf->SetHTMLHeader($this->load->view('fiches/contrat/header',$contratData,true));
				$html = $this->load->view('fiches/contrat/bodyBP',array('dataContrat'=>$contratPrix,'tva'=> $contratData['tva']),true);
				$pdfFilePath = "BP contrat".$contrat."_".date("dmY").".pdf";

				$pdf->WriteHTML($html);

				$pdf->Output($pdfFilePath,"D");
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
	
	
}
?>
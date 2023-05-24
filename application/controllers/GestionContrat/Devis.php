<?php

class Devis extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		

		
		$this->load->model('M_GestionContrat/M_devis','devis');
		$this->load->library('form_validation');
	}
	function index()
	{
		echo 'hi';
	}
	function loadDevis()
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$rslt = $this->devis->DevisList($this->session->entreprise);
		echo json_encode($rslt);
		
	}
	function addDevis()
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		try {


			

			if($this->form_validation->run('ajouterDevis')== FALSE)
			{
				throw new Exception(validation_errors());


			}

			$prixJson = pg_escape_string($this->input->post('prixArray', TRUE));
			$objet = pg_escape_string($this->input->post('objet-devis', TRUE));
			$client =  pg_escape_string($this->input->post('client-devis', TRUE));
			$tva = pg_escape_string($this->input->post('devis-tva', TRUE));
			$entreprise = $this->session->entreprise;
			
			/***************************Valider la liste des prix***********************************/
			$prixArray = json_decode($prixJson);
			$rsltValiation = $this->validateDevisPrix($prixArray);
			if($rsltValiation->empty)
			{
				throw new Exception('la Liste des prix est vide');
			}
			elseif(!$rsltValiation->validprice)
			{
				throw new Exception($rsltValiation->msg);
			}
			

			/*****************************Proceder à l'insertion dans la BD************************/

			$devisArray = array(
				'id_entreprise'=>$this->session->entreprise,
				'objet'=>$objet, 
				'tva'=>$tva ,  
				'date_edition'=>date('Y-m-d'), 
				'client'=>$client,
				'matricule_editeur'=>$this->session->numeric_matricule, 
				'validite_mois'=>3, 
			);
			$fullArray = array(
				'devis'=>$devisArray,
				'toutprix'=>$rsltValiation->dta
			);
			$rslt = $this->devis->insertDevis($fullArray);

			if($rslt!=0)
			{
				echo 'Devis/downloadCopy?numero='.$rslt;
				
			}
			else
			{
				throw new Exception('une erreur s\'est produite');
			}
			

		} catch (Exception $e) {

			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
			
		}
	}
	function removeDevis()
	{
		try{
			if(isset($_POST['devis-num']))
		{
			if(strlen($_POST['devis-num'])>100)
					throw new Exception("Données Invalide");
			
			$numeroDevis = pg_escape_string($this->input->post('devis-num', TRUE));	
			$rslt = $this->devis->removeDevis($numeroDevis,$this->session->entreprise);
			if($rslt==1)
				echo 'Devis supprimée';
			else
				throw new Exception('impossible de supprimer le devis');
		}
		}
		catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
			
		}
	}
	function removePrix()
	{
		try{
			if(isset($_POST['devis-num']))
		{
			if(strlen($_POST['devis-num'])>100 || strlen($_POST['prix-num'])>100 )
					throw new Exception("Données Invalide");
			
			$numeroPrix = pg_escape_string($this->input->post('prix-num', TRUE));
			$numeroDevis = pg_escape_string($this->input->post('devis-num', TRUE));	
			$rslt = $this->devis->removePrix($numeroPrix,$numeroDevis);
			if($rslt==1)
				echo 'Prix supprimée';
			else
				throw new Exception('impossible de supprimer le prix');
		}
		}
		catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
			
		}
	}
	function getDevisData()
	{
		$numero = isset($_POST['devis-num'])?$this->input->post('devis-num', TRUE):0;

			if(strlen($numero)>20 || !is_numeric($numero) || empty($numero) )
			{
				throw new Exception("Devis invalide");

			}
		$devisPrix = $this->devis->getDevisPrix($numero,$this->session->entreprise);
		$devisData= $this->devis->getallDevisData($numero,$this->session->entreprise);
		if(!is_array($devisData))
			{
				throw new Exception("Devis introuvable");
			}
		$globalData = array("attributes"=>$devisData,"prixListe"=>$devisPrix);
		echo json_encode($globalData);
	}
	function editDevis()
	{
		try{
		$numero = isset($_POST['serial-devis'])?$this->input->post('serial-devis', TRUE):0;

			if(strlen($numero)>20 || !is_numeric($numero) || empty($numero) )
			{
				throw new Exception("Devis invalide");

			}
			if($this->form_validation->run('editerDevis')== FALSE)
			{
				throw new Exception(validation_errors());


			}
			$devisArray = array(
				
				'objet'=>$_POST['objet-devis'], 
				'client'=>$_POST['client-devis'],
				'tva'=>$_POST['devis-tva'],  
				 
				
				
			);
		$rslt= $this->devis->editDevis($numero,$devisArray,$this->session->entreprise);
		if($rslt==1)
				echo 'Devis modifié';
			else
				throw new Exception('impossible de modifier le devis');
			}
			catch (Exception $e) {
				$message = $e->getMessage();
				http_response_code(400);
				die( $message );
				
			}
	}
	function addPrixToDevis()
	{
		try{
			$numero = isset($_POST['numero'])?$this->input->post('numero', TRUE):0;
	
				if(strlen($numero)>20 || !is_numeric($numero) || empty($numero) )
				{
					throw new Exception("Devis invalide");
	
				}
				$prixData = new stdClass();
				$prixData->num_prix=pg_escape_string($this->input->post('numero-prix', TRUE));
				$prixData->lib_prix=pg_escape_string($this->input->post('libelle-prix', TRUE));
				$prixData->unite_prix=pg_escape_string($this->input->post('unite-prix', TRUE));
				$prixData->quantite_prix=pg_escape_string($this->input->post('quantite-prix', TRUE));
				$prixData->pu_prix=pg_escape_string($this->input->post('pu-prix', TRUE));
			$prixArray = array($prixData);
			$rsltValiation = $this->validateDevisPrix($prixArray);
			if($rsltValiation->empty)
			{
				throw new Exception('prix vide');
			}
			elseif(!$rsltValiation->validprice)
			{
				throw new Exception($rsltValiation->msg);
			}
			$dta = $rsltValiation->dta;
			
			$rslt = $this->devis->addPrix($numero,$rsltValiation->dta[0],$this->session->entreprise);
			if($rslt==1)
				echo 'Prix ajouté';
			else
				throw new Exception('impossible d\'ajouter le prix');
				}
				catch (Exception $e) {
					$message = $e->getMessage();
					http_response_code(400);
					die( $message );
					
				}
				
	}
	function loadDevisPrix()
	{
		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$numero = isset($_POST['numero'])?$this->input->post('numero', TRUE):0;
		if(strlen($numero)>20 || !is_numeric($numero) || empty($numero) )
			return null;
		$rslt = $this->devis->DevisListePrix($numero,$this->session->entreprise);
		echo json_encode($rslt);
	}
	function downloadCopy($devis=null)
	{

		try {
			
			$numero = isset($_GET['numero'])?$this->input->get('numero', TRUE):$numero=$devis;

			if(strlen($numero)>20 || !is_numeric($numero) || empty($numero) )
			{
				throw new Exception("Devis invalide");

			}
			$this->load->helper('html');
			include ("mpdf/vendor/autoload.php");

			$pdf= new \Mpdf\Mpdf(['margin_left' => 15,'margin_right' => 15]);
			$pdf->setAutoTopMargin = 'stretch';
			$pdf->defaultfooterline = 0;
			$pdf->setFooter('<div style="with:100%;text-align:center;color:gray;font-size:12px"> - Page {PAGENO} / {nb} - </div>');
			$devisPrix = $this->devis->getDevisPrix($numero,$this->session->entreprise);
			$devisData= $this->devis->getallDevisData($numero,$this->session->entreprise);
			
			if(!is_array($devisData))
			{
				throw new Exception("fichier introuvable");
			}
			$imgEntreprise = glob($this->folderPath.'entreprises/'.$this->session->entreprise.'/entreprise_logo.{jpg,png,jpeg}', GLOB_BRACE);
			if(count($imgEntreprise)>0)
				$devisData['img']=$imgEntreprise[0];
			//print_r($devisPrix);
			$pdf->SetHTMLHeader($this->load->view('fiches/devis/header',$devisData,true));
			//$this->load->view('fiches/devis/bodyDV',array('dataDevis'=>$devisPrix,'tva'=> $devisData['tva']));
			$html = $this->load->view('fiches/devis/bodyDV',array('dataDevis'=>$devisPrix,'tva'=> $devisData['tva'],'validite'=> $devisData['validite_mois']),true);
			$pdfFilePath = "Devis".$numero."_".date("dmY").".pdf";

			$pdf->WriteHTML($html);

			$pdf->Output($pdfFilePath,"D");

		} catch (Exception $e) {

			$message = $e->getMessage();
			http_response_code(400);
			die( $message );

		}
	}
	public function validateDevisPrix($objectArray)
	{

		$unitesArray = $this->devis->load_unites();
		$nums =[];
		$rslt = new stdClass();
		$rslt->msg='';
		$rslt->validprice=true;
		$rslt->empty = true;
		$rslt->dta = [];
		foreach ($objectArray as $key => $value) {
			$rslt->empty = false;
			$prix ="".$value->num_prix."";
			$lib =$value->lib_prix;
			$unite =$value->unite_prix;
			$quanttite =$value->quantite_prix;
			$pu = $value->pu_prix;
			if(in_array("",[$prix,$lib,$unite,$quanttite,$pu]))
			{
				$rslt->validprice=false;
				$rslt->msg='Valeur Null en ligne : '.($key+1);
				break;
			} 
			elseif (!is_numeric($quanttite) || $quanttite<=0 ) {
				$rslt->validprice=false;
				$rslt->msg='Quantité non valide en ligne : '.($key+1);
				break;
			}
			elseif (!is_numeric($pu) || $pu<=0 ) {
				$rslt->validprice=false;
				$rslt->msg='Prix Unitaire non valide en ligne : '.($key+1);
				break;
			}
			
			else
			{
				for ($i=0; $i <count($nums) ; $i++) { 
					if($prix===$nums[$i])
					{
						$rslt->validprice=false;
						$rslt->msg='Numero de prix dupliqué en ligne '.strval($prix).': '.json_encode($nums);
						break 2;
					}
				}
				
				$validunit = false;

				foreach ($unitesArray as $value) {

					if ($unite== $value['code'])
					{
						$validunit = true;
						break;
					}
					
				}
				if(!$validunit)
				{
					$rslt->validprice=false;
					$rslt->msg='Unité invalide en ligne : '.($key+1);
					break;	
				}
				else
				{
					array_push($nums,$prix);
					$row = array(
						'numero' =>$prix ,
						'libelle'=>$lib,
						'quantitetotale' =>$quanttite,
						'prix_unitaire' =>$pu,
						'code_unite' =>$unite
					);
					array_push($rslt->dta, $row);
				}
				

			}
		}
		return $rslt;

	}

}
?>
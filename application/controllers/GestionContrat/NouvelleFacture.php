<?php

class NouvelleFacture extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		

		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionContrat/M_nouvelleFacture','NouvelleFacture');
		$this->load->model('M_GestionContrat/M_contrats','contrats');
		$this->load->library('form_validation');
	}
	
	function loadDataFacture($contrat=null)
	{
		try {

			if($contrat==null and isset($_POST['contrat-search-details']))
			{
				$numero = pg_escape_string($this->input->post('contrat-search-details', TRUE));
				$reelNumero = strpos($numero,'_pfx_') !== false?$numero:$this->session->entreprise.'_pfx_'.$numero;
				$rslt = $this->NouvelleFacture->loadFactureData($reelNumero);
				
				$contratData = $this->contrats->getcontratData($reelNumero);
				if(count($rslt)>0 and count($contratData)>0)
				{
					$dta = array(
						'factures'=>$rslt,
						'contrat'=>array('numero'=>$contratData['numero'],'tva'=>$contratData['tva'])
					);
					echo json_encode($dta);	
				}
				else
				{
					throw new Exception("Aucun prix pour ce contrat");

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

	function addFacture()
	{
		try {

			$numeroContrat = pg_escape_string($this->input->post('contrat-nouvelle-facture', TRUE));
			$reelNumero = strpos($numeroContrat,'_pfx_') !== false?$numeroContrat:$this->session->entreprise.'_pfx_'.$numeroContrat;
			$date = pg_escape_string($this->input->post('date-nouvelle-facture', TRUE));
			$d = DateTime::createFromFormat('Y-m-d', $date);
			$responsable = $this->session->numeric_matricule;
			$prixJson = pg_escape_string($this->input->post('prixFacture', TRUE));

			if(!($d && $d->format('Y-m-d') == $date))
			{
				throw new Exception("Date Effet invalide!");
			}

			/********************************Valider le numero***********************/
			if(strlen($numeroContrat)>50)
			{
				throw new Exception("Le numéro du contrat est trop long");
			}
			$numExist = $this->contrats->getcontratData($reelNumero);
			if(!is_array($numExist))
			{
				throw new Exception("Le numéro du contrat est invalide");
				
			}
			$prixArray = json_decode($prixJson);
			if(count($prixArray)==0)
			{
				throw new Exception("La liste des prix est vide!");
			}
			$facutreprixArray = $this->validateFacturePrix($prixArray,$reelNumero);
			if($facutreprixArray->empty)
			{
				throw new Exception('la Liste des prix est vide');
			}
			elseif(!$facutreprixArray->validprice)
			{
				throw new Exception($facutreprixArray->msg);
			}
			/*****************************Proceder à l'insertion dans la BD************************/

			$FactureArray = array(
				
				'numero_contrat'=>$reelNumero,
				'date_edition'=>date("Y-m-d H:i:s", time()),
				'matricule_editeur'=>$responsable,
				'date_effet'=>$date,
				'paye'=>'f',
				'confirmNum'=>$reelNumero,
				'confirmEntreprise'=>$this->session->entreprise
				
			);
			
			$fullArray = array(
				'facture'=>$FactureArray,
				'toutprixFacture'=>$facutreprixArray->dta
			);
			$rslt = $this->NouvelleFacture->insertFacture($fullArray);
			if($rslt!=0)
			{
				
				echo 'ListeFacture/downloadCopy?facture='.$rslt.'&contrat='.$numeroContrat;
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

	public function validateFacturePrix($objectArray,$contratNum)
	{

		
		
		$rslt = new stdClass();
		$rslt->msg='';
		$rslt->validprice=true;
		$rslt->empty = true;
		$rslt->dta = [];
		foreach ($objectArray as $key => $value) {
			$rslt->empty = false;
			$quanttite =$value->quantite_prix;
			$prix =$value->numero_prix;
			
			if(in_array("",[$prix,$quanttite]))
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
			
			

			else
			{
				

				$row = array(
					'prix' =>$prix ,
					'contrat' =>$contratNum,
					'quantite' =>$quanttite,
				);
				array_push($rslt->dta, $row);

			}
		}
		return $rslt;

	}

}
?>
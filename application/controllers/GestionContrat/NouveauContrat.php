<?php

class NouveauContrat extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		

		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		$this->load->model('M_GestionContrat/M_nouveauContrat','nouveauContrat');
		$this->load->model('M_GestionContrat/M_contrats','contrats');
		$this->load->model('M_GestionContrat/M_clients','clients');	
		//$this->load->model('M_GestionAffaire/M_affaires','M_affaires');	
		$this->load->library('form_validation');
	}
	
	function loadSectors($toJson=true)
	{
		$ville = isset($_POST['ville'])?$this->input->post('ville', TRUE):'';
		$sectores = $this->nouveauContrat->load_Sectors($ville);
		if($toJson)
		{
			echo json_encode($sectores);
		}
		else
		{
			return $sectores;
		}
		
	}
	function loadDomaineSectors($toJson=true)
	{
		$domaine=isset($_POST['domaine'])?$this->input->post('domaine', TRUE):'';
		$DomaineSectors = $this->nouveauContrat->load_DomaineSectors($domaine);
		if($toJson)
		{
			echo json_encode($DomaineSectors);
		}
		else
		{
			return $DomaineSectors;
		}
	}

	function addContrat()
	{
		try {


			
			$folderName = $this->normalizeString(pg_escape_string($this->input->post('numero', TRUE)));
			

			if($this->form_validation->run('ajouterContrat')== FALSE)
			{
				throw new Exception(validation_errors());


			}

			$prixJson = pg_escape_string($this->input->post('prixArray', TRUE));
			$numeroContrat = pg_escape_string($this->input->post('numero', TRUE));
			$libelle = pg_escape_string($this->input->post('libelle', TRUE));
			$villeSecteur = pg_escape_string($this->input->post('secteur-ville', TRUE)); 
			$domaineSecteur = pg_escape_string($this->input->post('secteur-contrat', TRUE)); 
			$client =  pg_escape_string($this->input->post('client-contrat', TRUE));
			$delai =  pg_escape_string($this->input->post('delai', TRUE));
			$date_signature = pg_escape_string($this->input->post('date-signature', TRUE));
			$observation = pg_escape_string($this->input->post('contrat-observations', TRUE));
			$tva = pg_escape_string($this->input->post('contrat-tva', TRUE));
			$wktCoord = pg_escape_string($this->input->post('geom-coordonnees', TRUE));
			$folderName = $this->normalizeString($numeroContrat);
			$responsable = $this->session->numeric_matricule;
			$entreprise = $this->session->entreprise;
			/********************************Valider le numero***********************/
			$reelNumero = strpos($numeroContrat,'_pfx_') !== false?$numeroContrat:$this->session->entreprise.'_pfx_'.$numeroContrat;
			$numExist = $this->contrats->getcontratData($reelNumero);
			if(is_array($numExist))
			{
				throw new Exception("Le numéro du contrat existe Déja");
				
			}
			/*****Valiate domaines secteurs et client si sont ans la BD************/

			$sectorDomaines = $this->loadDomaineSectors(false);
			$sectorsVille = $this->loadSectors(false);
			$clientsList = $this->clients->clientsList($this->session->entreprise,false);
			$valiSectorD = false;
			foreach ($sectorDomaines as $value) {
				if ($domaineSecteur== $value['code'])
				{
					$valiSectorD = true;
					break;
				}
			}
			if (!$valiSectorD) {
				throw new Exception('le Secteur/Domaine invalide');

			}
			$valiSectorV = false;
			foreach ($sectorsVille as $value) {
				if ($villeSecteur== $value['code'])
				{
					$valiSectorV = true;
					break;
				}
			}
			if (!$valiSectorV) {
				throw new Exception('La ville invalide');

			}
			$validclient = false;
			foreach ($clientsList as $value) {
				if ($client== $value['identifiant'])
				{
					$validclient = true;
					break;
				}
			}
			if (!$validclient) {
				throw new Exception('Client invalide'.$client);

			}
			

			/***************************Valider la liste des prix***********************************/
			$prixArray = json_decode($prixJson);
			$rsltValiation = $this->validateContratPrix($prixArray,$reelNumero);
			if($rsltValiation->empty)
			{
				throw new Exception('la Liste des prix est vide');
			}
			elseif(!$rsltValiation->validprice)
			{
				throw new Exception($rsltValiation->msg);
			}
			

			/*****************************Proceder à l'insertion dans la BD************************/

			$contratArray = array(
				'numero'=>$numeroContrat,
				'libelle'=>$libelle, 
				'delai'=>$delai , 
				'unite_delai'=>'jour', 
				'date_signature'=>$date_signature, 
				'id_secteur'=>$domaineSecteur, 
				'id_adresse'=>$villeSecteur, 
				'observation'=>$observation,
				'client'=>$client,
				'matricule_editeur'=>$responsable, 
				'tva'=>$tva,
				'dossier'=>$folderName,
				'etatcontrat'=>'ENCOURS',
				'id_entreprise'=>$entreprise,
				'date_edition'=>date("Y-m-d H:i:s", time())
				
			);
			if($wktCoord!=''){$contratArray['geometrie'] = 'SRID=4326;'.$wktCoord;}
			$fullArray = array(
				'contrat'=>$contratArray,
				'toutprix'=>$rsltValiation->dta
			);
			$rslt = $this->nouveauContrat->insertContrat($fullArray);
			if($rslt==1)
			{
				mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/contrats/'.$folderName);
				mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/contrats/'.$folderName.'/factures');
				echo 'Contrat enregistré';
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
	public function valiateInputs($inputsDta)
	{
		foreach ($inputsDta as $key => $value) {
			switch ($key) {
				case 'value':
					# code...
				break;
				
				default:
					# code...
				break;
			}
		}
	}
	public function validateContratPrix($objectArray,$contratNum)
	{

		$unitesArray = $this->nouveauContrat->load_unites();
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
						'contrat' =>$contratNum,
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
	
	public static function normalizeString ($str = '')
	{
		$str = strip_tags($str); 
		$str = preg_replace('/[\r\n\t ]+/', '_', $str);
		$str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', '_', $str);
		$str = strtolower($str);
		$str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
		$str = htmlentities($str, ENT_QUOTES, "utf-8");
		$str = preg_replace("/(&)([a-z])([a-z]+;)/i", '_', $str);
		$str = str_replace(' ', '_', $str);
		$str = rawurlencode($str);
		$str = str_replace('%', '_', $str);
		return $str;
	}

	
}
?>
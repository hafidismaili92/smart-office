<?php

class M_listeFactures extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);

	}
	function etatFactureList()
	{

		$query ="SELECT code, designation FROM contrats.etatfacture order by numero asc;";
		return $this->userDB->query($query)->result_array();
	}
	function modePayement()
	{

		$query ="SELECT code, designation FROM contrats.voie_reglement order by serial_num asc;";
		return $this->userDB->query($query)->result_array();
	}
	function getLien($facture,$key)
	{
		$query="select lien,key,b.dossier from contrats.facture a  LEFT JOIN contrats.contrat b on a.numero_contrat= b.numero where a.numero=? and a.key=?";
		$rslt = $this->userDB->query($query,array($facture,$key));
		if($rslt)
		{
			return $rslt->result_array()[0];
		}
		else
		{
			return 0;
		}
	}
	function addFacture_accusee($facture,$contrat,$fileName,$key)
	{
		$query = "UPDATE contrats.facture SET   lien=?,key=? WHERE numero=? and numero_contrat = ?";
		if($this->userDB->query($query,array($fileName,$key,$facture,$contrat)))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function update_FactureState($dta)
	{
		$query ='';
		$arrDta = array($dta['etat']);
		switch ($dta['etat']) {
			case 'ENATTENTE':
			$query = "UPDATE contrats.facture set etat=?,date_payement=null,motif_refus=null,num_annee=null  where numero=? and paye='false' and numero_contrat=?";
			array_push($arrDta,$dta['numeroFacture']);
			array_push($arrDta,$dta['numeroContrat']);
			break;
			case 'REGLEE':
			/*$query = "with  A as (select concat(count(f.numero)+1,'/',extract(year from to_timestamp('".$dta['dateReglement']."','YYYY-MM-DD'))) as numannee from contrats.facture f LEFT JOIN contrats.contrat c ON f.numero_contrat = c.numero where numero_contrat ='".$dta['numeroContrat']."' and extract(year from date_payement) = extract(year from to_timestamp('".$dta['dateReglement']."','YYYY-MM-DD')) and c.id_entreprise =".$dta['entreprise'].")
			UPDATE contrats.facture set etat=?,paye='true',date_payement=?,voie_encaissement=?,motif_refus=null,num_annee= (select numannee from A) where numero=? and numero_contrat=?";*/
			$query = "with  A as (select concat(count(f.numero)+1,'/',extract(year from to_timestamp('".$dta['dateReglement']."','YYYY-MM-DD'))) as numannee from contrats.facture f LEFT JOIN contrats.contrat c ON f.numero_contrat = c.numero where extract(year from date_payement) = extract(year from to_timestamp('".$dta['dateReglement']."','YYYY-MM-DD')) and c.id_entreprise =".$dta['entreprise'].")
			UPDATE contrats.facture set etat=?,paye='true',date_payement=?,voie_encaissement=?,motif_refus=null,num_annee= (select numannee from A) where numero=? and paye='false' and numero_contrat=?";
			array_push($arrDta,$dta['dateReglement']);
			array_push($arrDta,$dta['modePayement']);
			array_push($arrDta,$dta['numeroFacture']);
			array_push($arrDta,$dta['numeroContrat']);
			break;
			case 'REFUSEE':
			$query = "UPDATE contrats.facture set etat=?,motif_refus=?,date_payement=null,num_annee=null where numero=? and paye='false' and numero_contrat=?";
			array_push($arrDta,$dta['motif']);
			array_push($arrDta,$dta['numeroFacture']);
			array_push($arrDta,$dta['numeroContrat']);

			break;
			default:
			throw new Exception("Etat invalide");
			
			break;
			
		}
		$updateQUery = $this->userDB->query($query,$arrDta);
		if($updateQUery !== FALSE){
			return 1;
		}
		else
		{

			throw new Exception("une erreur s'est produite");
		}

	}
	/*function update_FactureState($facture,$contrat,$state,$entreprise)
	{
		$query = "UPDATE contrats.facture SET   paye=? WHERE numero=? and numero_contrat = (select numero from  contrats.contrat a where a.numero=?  and a.id_entreprise=?)";
		if($this->userDB->query($query,array($state,$facture,$contrat,$entreprise)))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}*/
	function getFacturedata($facture,$entreprise)
	{
		$query = "select a.numero as numfacture,a.num_annee as numannee, to_char(a.date_effet,'dd-mm-yyyy') as datefacture,to_char(a.date_payement,'dd-mm-yyyy') as datepayement,to_char(a.date_payement,'yyyy') as anneefacture,a.paye as paye,
		REPLACE(b.numero,'".$this->session->entreprise."_pfx_', '' )  as numerocontrat,b.libelle as libellecontrat,b.tva,
		c.numero as numeroentreprise,c.nom,c.adresse,c.tel,c.mail,c.fax,c.ice,
		d.libelle as libelleclient,d.adresse as adresseclient,d.ice as iceclient
		from contrats.facture a
		LEFT JOIN contrats.contrat b on a.numero_contrat=b.numero
		LEFT JOIN rh.entreprise c on b.id_entreprise = c.numero
		LEFT JOIN contrats.client d on b.client = d.identifiant
		where a.numero=? and c.numero=?";
		$rslt = $this->userDB->query($query,array($facture,$entreprise));
		if($rslt)
		{
			$dtaFacture = $rslt->result_array();
			return $dtaFacture[0];
		}
		else
		{
			return 0;
		}
	}
	function removeFacture($numeroFacture,$numeroContrat)
	{
		$query = "delete from contrats.facture a  where a.numero = ? and a.numero_contrat=? and a.paye='false'";
		 $exec = $this->userDB->query($query,array($numeroFacture,$numeroContrat));
		 if($exec && $this->userDB->affected_rows()>0)
	return 1;
else
	return 0;
	}
	function getFacturePrix($facture,$contrat=null,$todatable=false)
	{
		$query = "select a.prix,a.quantite,b.prix_unitaire as pu,b.code_unite as unite,b.libelle from contrats.facture_prix a 
		LEFT JOIN contrats.prix b on  a.prix=b.numero and a.contrat=b.contrat
		WHERE a.facture = ? order by b.serial_num asc";
		if(!$todatable)
		{
			$dtaFacture = $this->userDB->query($query,array($facture))->result_array();
			return $dtaFacture;
		}
		else
		{
			$data = array();
			$dtaFacture = $this->userDB->query($query,array($facture));
			foreach($dtaFacture->result() as $key=>$r) {

				$data[] = array(
					$key+1,
					html_escape($r->prix),
					html_escape($r->libelle),
					html_escape($r->unite),
					html_escape($r->pu),
					html_escape($r->quantite),
					html_escape($r->quantite)*html_escape($r->pu)
				);

			}


			return array('factures'=>$data) ;
		}
		
		
	}
	public function loadFactureListe($contrat,$entreprise)
	{
		$queryFacture = "SELECT a.numero,a.num_annee,TO_CHAR(a.date_effet, 'DD-MM-YYYY')as dateeffet,TO_CHAR(a.date_payement, 'DD-MM-YYYY')as datepayement,sum(c.prix_unitaire*b.quantite) as total,numero_contrat, date_edition,a.paye, date_effet,et.code as payement,et.designation as etat,key FROM contrats.facture a 
		LEFT JOIN contrats.facture_prix b on a.numero=b.facture 
		LEFT JOIN contrats.prix c on b.prix=c.numero and b.contrat=c.contrat
		LEFT JOIN contrats.etatfacture et on a.etat=et.code
		where a.numero_contrat = ? Group by a.numero,et.code order by a.numero asc";
		$queryContrat = "SELECT Replace(a.numero,'".$this->session->entreprise."_pfx_','') as numero,a.tva/100 as tva,sum(b.prix_unitaire*b.quantiteTotale)*(1+(a.tva/100)) as totalettc from contrats.contrat a
		LEFT JOIN contrats.prix b on a.numero =b.contrat
		where a.numero=? and a.id_entreprise=? Group by a.numero ";
		$factures = $this->userDB->query($queryFacture,array($contrat));
		$contrat = $this->userDB->query($queryContrat,array($contrat,$entreprise))->result_array();
		if(count($contrat)==1)
		{
			
			$data = array();
			$cumul = 0;
			$cumulPaye=0;
			$cumulnonPaye=0;
			$etaticon='';
			$removeIcon ='';
			foreach($factures->result() as $key=>$r) {

				
				switch (html_escape($r->payement)) {
					case 'ENATTENTE'://
					$cumul+=html_escape($r->total)*(1+$contrat[0]['tva']);
					$cumulnonPaye+=html_escape($r->total)*(1+$contrat[0]['tva']);
					$etaticon='<i class="fa  fa-hourglass-start" style="color:rgba(0, 0, 0, 0.5)"></i>';
					$removeIcon ='<i class="fa  fa-trash facture-actions facture-remove text-danger" style="cursor:pointer;"></i>';
					break;
					case 'REGLEE':
					$cumul+=html_escape($r->total)*(1+$contrat[0]['tva']);
					$cumulPaye+=html_escape($r->total)*(1+$contrat[0]['tva']);
					$etaticon='<i class="fa  fa-check-circle" style="color:rgba(110, 247, 133, 1)"></i>';
					$removeIcon ='<i class="fa  fa-trash facture-actions " style="color:#d2d2d2;"></i>';
					break;
					case 'REFUSEE':
					$etaticon='<i class="fa  fa-exclamation-triangle" style="color:rgba(245, 67, 61, 1)"></i>';
					$removeIcon ='<i class="fa  fa-trash facture-actions facture-remove text-danger" style="cursor:pointer;"></i>';
					break;

				}
				
				$data[] = array(

					$etaticon,
					$key,
					html_escape($r->numero),
					html_escape($r->num_annee),
					html_escape($r->dateeffet),
					html_escape($r->datepayement),
					html_escape($r->total)*(1+$contrat[0]['tva']),
					$cumul,
					round($cumul*100/$contrat[0]['totalettc'],2).' %',
					html_escape($r->etat),
					html_escape($r->key)==''?'<i class="fa  fa-download fa-lg" style="color: #1212131a;"></i>':'<a href="ListeFacture/downloadfacture?file='.$r->key.'&facture='.$r->numero.'"><i class="fa  fa-download fa-lg" style="color: #0e96ca;cursor:pointer;"></i></a>',
					'<div class="table-action" style="display: flex;justify-content: space-evenly;width: 100%;"><a href="ListeFacture/downloadCopy?facture='.$r->numero.'"><i class="fa  fa-copy facture-actions facture-copy" ></i></a><i class="fa  fa-cogs facture-actions facture-settings " style="cursor:pointer;"></i>'.$removeIcon.'</div>',
				);
			//$cumul+=html_escape($r->total)*(1+$contrat[0]['tva']);
			}

			$contrat[0]['totalpaye'] = $cumulPaye;
			$contrat[0]['nonpaye'] = $cumulnonPaye;
			return array('factures'=>$data,'contrat'=>$contrat[0]) ;

		}
		else
		{
			return 0;
		}
		
	}

}
?>
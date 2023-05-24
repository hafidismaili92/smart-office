<?php

class M_devis extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function load_unites()
	{
		$query ="SELECT code, libelle FROM contrats.unite order by categorie,serial_num asc;";
		return $this->userDB->query($query)->result_array();
	} 

	function DevisList($entreprise,$todatable=true)
	{
		$listContrat = "SELECT c.numero,c.num as num,c.tva,c.objet,to_char(c.date_edition,'dd-mm-yyyy') as date_edition,c.client,
		sum(p.prix_unitaire*p.quantitetotale)*(1+(c.tva/100)) as montant_ttc
		FROM contrats.devis c 
		LEFT JOIN contrats.prix_devis p on c.numero = p.devis 
		where c.id_entreprise=? and c.isdeleted='false'
		Group by c.numero";
		$rslt = $this->userDB->query($listContrat,array($entreprise));
		if($todatable)
		{
			$data = array();
			
			foreach($rslt->result() as $r) {
				
				$data[] = array(
					html_escape($r->numero),
					html_escape($r->num),
					html_escape($r->objet),
					html_escape($r->montant_ttc),
					html_escape($r->client),
					html_escape($r->date_edition),
					'<div style="display: flex;justify-content: space-evenly;width: 100%;"><a href="Devis/downloadCopy?numero='.$r->numero.'"><i class="fa fa-copy devis-actions devis-copy"> </i> </a><i class="fa  fa-cogs devis-actions devis-edit " style="cursor:pointer;"></i><i class="fa  fa-trash devis-actions devis-remove text-danger" style="cursor:pointer;"></i> </div>'

				);
			}
			
			$output = array(

				"data" => $data,
				//"statistics"=>$statistics
			);

			return $output;	
		}
		else
		{
			return $rslt->result_array();
		}
		
	}
	function addPrix($numero,$dta,$entreprise)
	{
				
		$q = "INSERT INTO contrats.prix_devis(numero, devis, quantitetotale,libelle, prix_unitaire, code_unite ) SELECT ?, ?, ?, ?, ?, ? FROM contrats.devis d where  d.numero =? and d.id_entreprise = ? ;";
		$exec = $this->userDB->query($q,array($dta['numero'],$numero,$dta['quantitetotale'],$dta['libelle'],$dta['prix_unitaire'],$dta['code_unite'],$numero,$entreprise));
		if($exec && $this->userDB->affected_rows()>0)
			return 1;
		else
			return 0;
	
	}
	function DevisListePrix($numero,$entreprise)
	{
		$listprix = "SELECT * from contrats.prix_devis p LEFT JOIN contrats.devis d on p.devis=d.numero 
		where p.devis = ? and d.id_entreprise = ? order by serial_num asc";
		$rslt = $this->userDB->query($listprix,array($numero,$entreprise));
		if($rslt)
		{
			$data = array();
			
			foreach($rslt->result() as $r) {
				
				$data[] = array(
					html_escape($r->serial_num),
					html_escape($r->devis),
					html_escape($r->numero),
					html_escape($r->libelle),
					html_escape($r->code_unite),
					html_escape($r->prix_unitaire),
					html_escape($r->quantitetotale),
					html_escape($r->quantitetotale)*html_escape($r->prix_unitaire),
					'<div style="display: flex;justify-content: space-evenly;width: 100%;"><i class="fa  fa-trash devisprix-actions devisprix-remove text-danger" style="cursor:pointer;"></i> </div>'

				);
			}
			
			$output = array(

				"data" => $data,
				//"statistics"=>$statistics
			);

			return $output;	
		}
		else
		{
			return $rslt->result_array();
		}
	}
	function editDevis($numero,$data,$entreprise)
	{
		$query = "update contrats.devis set objet=?,client=?,tva=?  where numero = ? and id_entreprise=?";
		$exec = $this->userDB->query($query,array($data['objet'],$data['client'],$data['tva'],$numero,$entreprise));
		 if($exec && $this->userDB->affected_rows()>0)
	return 1;
else
	return 0;
	}
	function removeDevis($numeroDevis,$entreprise)
	{
		$query = "update contrats.devis set isdeleted=true  where numero = ? and id_entreprise=?";
		 $exec = $this->userDB->query($query,array($numeroDevis,$entreprise));
		 if($exec && $this->userDB->affected_rows()>0)
	return 1;
else
	return 0;
	}
	function removePrix($numeroPrix,$numeroDevis)
	{
		$query = "Delete from contrats.prix_devis where serial_num=? and devis=?";
		 $exec = $this->userDB->query($query,array($numeroPrix,$numeroDevis));
		 if($exec && $this->userDB->affected_rows()>0)
	return 1;
else
	return 0;
	}
	function getDevisPrix($devis,$entreprise)
	{
		$query ="Select a.numero,a.libelle,a.prix_unitaire as pu,a.code_unite as unite,a.quantitetotale as quantite,a.prix_unitaire*a.quantitetotale as totale 
		from contrats.devis b LEFT JOIN contrats.prix_devis a on b.numero = a.devis
		where b.numero=? and b.id_entreprise=? order by a.serial_num asc";
		$rslt = $this->userDB->query($query,array($devis,$entreprise))->result_array();
		if(count($rslt)>0)
		{
			return $rslt;	
		}
		else
		{
			return 0;
		}

	}
	function getallDevisData($devis,$entreprise)
	{
		$query = "select b.num as numero_officiel,b.numero as numerodevis,b.objet,b.tva,
		c.numero as numeroentreprise,c.nom,c.adresse,c.tel,c.mail,c.fax,c.ice,
		b.client,b.validite_mois,extract(year from b.date_edition) as annee_edition
		from contrats.devis b 
		LEFT JOIN rh.entreprise c on b.id_entreprise = c.numero
		where  b.numero=? and b.id_entreprise=?";
		$rslt = $this->userDB->query($query,array($devis,$entreprise));
		if($rslt)
		{
			$dtaContrat = $rslt->result_array();
			return $dtaContrat[0];
		}
		else
		{
			return 0;
		}
	}
	function insertDevis($Array)
	{
		
		$queryInsertDevis  = "

		with A as (select concat(count(num)+1,'/',EXTRACT(year FROM current_date)) as compteur from contrats.devis d LEFT JOIN rh.entreprise e on d.id_entreprise = e.numero where EXTRACT(year FROM date_edition)=EXTRACT(year FROM current_date) and e.numero=".$Array['devis']['id_entreprise'].")
		insert into contrats.devis(num,id_entreprise,objet,tva,date_edition,client,matricule_editeur,validite_mois) values((select compteur from A),?,?,?,?,?,?,?) returning num,numero";
		$this->userDB->trans_begin();
		$addDevisQUery = $this->userDB->query($queryInsertDevis,$Array['devis']);
		for ($i=0; $i < count($Array['toutprix']); $i++) { 
			$Array['toutprix'][$i]['devis']=$addDevisQUery->result_array()[0]['numero'];
		}
		
		$this->userDB->insert_batch('contrats.prix_devis', $Array['toutprix']);
		
		if ($this->userDB->trans_status() === FALSE)
		{
			$this->userDB->trans_rollback();
			return 0;
		}
		else
		{
			$this->userDB->trans_commit();
			return $addDevisQUery->result_array()[0]['numero'];
			
		}
		

	}
}
?>
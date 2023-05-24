<?php

class M_nouvelleFacture extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);

	}

	public function loadFactureData($contrat)
	{
		$query = "select a.serial_num,a.numero,a.libelle,a.quantitetotale,a.prix_unitaire,a.code_unite,coalesce(sum(b.quantite),0) as quantite_anterieur from contrats.prix a 
		Left JOIN contrats.facture_prix b on a.numero=b.prix and a.contrat=b.contrat 
		where a.contrat=? group by (a.serial_num,a.numero,a.libelle,a.quantitetotale,a.prix_unitaire,a.code_unite) order by a.serial_num asc;";
		$rslt = $this->userDB->query($query,array($contrat));
		$data = array();

		foreach($rslt->result() as $r) {

			$data[] = array(

				html_escape($r->numero),
				html_escape($r->libelle),
				html_escape($r->code_unite),
				html_escape($r->prix_unitaire),
				html_escape($r->quantitetotale),
				html_escape($r->quantite_anterieur),
				'<input type ="number" step="0.01"  class="quante-prix-facture" style="outline: none;border:1px solid #efe6e6; font-size:1.1em; color:red;width:95%;">',
				0,
				'<i class="fa  fa-check-square" style="color:#9ba09b;"></i>'
			);
		}


		return  $data;
	}

	

	function insertFacture($Array)
	{
		
		/*$query ="with  A as (select concat(count(f.numero)+1,'/',extract(year from to_timestamp('".$Array['facture']['date_effet']."','YYYY-MM-DD'))) as numannee from contrats.facture f LEFT JOIN contrats.contrat c ON f.numero_contrat = c.numero where numero_contrat ='".$Array['facture']['numero_contrat']."' and extract(year from date_effet) = extract(year from to_timestamp('".$Array['facture']['date_effet']."','YYYY-MM-DD')) and c.id_entreprise =".$Array['facture']['confirmEntreprise'].") 
INSERT INTO contrats.facture(numero_contrat,date_edition,matricule_editeur,date_effet,paye,etat,num_annee)(SELECT ?, ?, ?, ?, ?,'ENATTENTE',(select numannee from A) FROM contrats.contrat a WHERE a.numero=? and a.id_entreprise=?) returning numero;";*/
$query ="INSERT INTO contrats.facture(numero_contrat,date_edition,matricule_editeur,date_effet,paye,etat)(SELECT ?, ?, ?, ?, ?,'ENATTENTE' FROM contrats.contrat a WHERE a.numero=? and a.id_entreprise=?) returning numero;";
		$this->userDB->trans_begin();
		$newFacture = $this->userDB->query($query,$Array['facture'])->result_array();
		if(count($newFacture)>0)
		{
			$numero = $newFacture[0]['numero'];
			for ($i=0; $i <count($Array['toutprixFacture']) ; $i++) { 
				$Array['toutprixFacture'][$i]['facture']=$numero;
			}
			
			$this->userDB->insert_batch('contrats.facture_prix', $Array['toutprixFacture']);
			if ($this->userDB->trans_status() === FALSE)
			{
				$this->userDB->trans_rollback();
				return 0;
			}
			else
			{
				$this->userDB->trans_commit();
				return $numero;

			}
		}
		else
		{
			$this->userDB->trans_rollback();
			return 0;
		}
		
		
		
		

	}
}
?>
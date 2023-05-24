<?php

class M_contrats extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function unpayedFacture($entreprise)
	{
		$query = "SELECT a.numero,TO_CHAR(a.date_effet, 'DD-MM-YYYY')as dateeffet,sum(c.prix_unitaire*b.quantite*(1+ctr.tva/100)) as totalttc,REPLACE(numero_contrat,'".$this->session->entreprise."_pfx_', '' ) as numero_contrat, to_char(date_effet,'dd-mm-yyyy') as dateeffet,replace(a.etat,'ENATTENTE','En Attente') as etat,concat(cl.identifiant,'(',cl.libelle,')') as client FROM contrats.facture a 
		LEFT JOIN contrats.facture_prix b on a.numero=b.facture 
		LEFT JOIN contrats.contrat ctr on a.numero_contrat=ctr.numero
		LEFT JOIN contrats.prix c on b.prix=c.numero and b.contrat=c.contrat
		LEFT JOIN contrats.etatfacture et on a.etat=et.code
		LEFT JOIN contrats.client cl on ctr.client=cl.identifiant
		where ctr.id_entreprise=? and et.code = 'ENATTENTE' Group by a.numero,cl.identifiant,cl.libelle order by date_effet desc";
		return $this->userDB->query($query,array($entreprise))->result_array();

	}
	function update_State($dta)
	{
		$query ='';

		if($dta['etatprecedente']=='ARRET')
		{
			$querysHistoriqueFin = "UPDATE contrats.historique_arret set date_fin='".$dta['date']."' where id_arret =(select max(id_arret) from contrats.historique_arret where contrat= ? )";
			$updatehistoQUery = $this->userDB->query($querysHistoriqueFin,array($dta['numero']));
		}
		switch ($dta['etat']) {
			case 'ENCOURS':
			$query = "UPDATE contrats.contrat set etatcontrat='ENCOURS', date_resiliation=null,date_fin=null where numero=?";
			break;
			case 'TERMINE':
			$query = "UPDATE contrats.contrat set etatcontrat='TERMINE', date_resiliation=null,date_fin='".$dta['date']."' where numero=?";
			break;
			case 'RESILIE':
			$query = "UPDATE contrats.contrat set etatcontrat='RESILIE', date_resiliation='".$dta['date']."',date_fin=null where numero=?";
			break;
			case 'ARRET':
			$query = "WITH A as (UPDATE contrats.contrat set etatcontrat='ARRET', date_resiliation=null,date_fin=null where numero=? returning numero) insert into contrats.historique_arret(date_debut,contrat) values('".$dta['date']."',(select numero from A)) ";
			break;
			
		}

		$updateQUery = $this->userDB->query($query,array($dta['numero']));
		if($updateQUery !== FALSE){
			return 1;
		}
		else
		{

			return 0;
		}
		
	}
	function etatList()
	{

		$query ="SELECT code, designation FROM contrats.etatcontrat order by numero asc;";
		return $this->userDB->query($query)->result_array();
	}
	function ContratsNumeros($filter,$entreprise)
	{
		$query = "select REPLACE(b.numero,'".$this->session->entreprise."_pfx_', '' ) as numerocontrat
		from contrats.contrat b  where b.id_entreprise=? and REPLACE(b.numero,'".$this->session->entreprise."_pfx_', '' ) like ?";
		$rslt = $this->userDB->query($query,array($entreprise,$filter."%"));
		if($rslt)
		{
			$dtaContrat = $rslt->result_array();
			return $dtaContrat;
		}
		else
		{
			return [];
		}
	}
	function getallContratData($contrat,$entreprise)
	{
		$query = "select REPLACE(b.numero,'".$this->session->entreprise."_pfx_', '' ) as numerocontrat,b.libelle as libellecontrat,b.tva,
		c.numero as numeroentreprise,c.nom,c.adresse,c.tel,c.mail,c.fax,c.ice,
		d.libelle as libelleclient,d.adresse as adresseclient,d.ice as iceclient
		from contrats.contrat b 
		LEFT JOIN rh.entreprise c on b.id_entreprise = c.numero
		LEFT JOIN contrats.client d on b.client = d.identifiant
		where  b.numero=? and b.id_entreprise=?";
		$rslt = $this->userDB->query($query,array($contrat,$entreprise));
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
	function getcontratData($contrat)
	{
		
		$query = "select Replace(numero,'".$this->session->entreprise."_pfx_','') as numero, libelle, delai, unite_delai, date_signature, id_secteur, id_adresse, observation, matricule_editeur, tva, dossier, date_edition, client, geometrie, etat, id_entreprise, etatcontrat, date_fin, date_resiliation, isdeleted, date_delete from contrats.contrat where numero =? and id_entreprise=?";
		$rslt = $this->userDB->query($query,array($contrat,$this->session->entreprise))->result_array();
		if(count($rslt)>0)
		{
			return $rslt[0];	
		}
		else
		{
			return 0;
		}
		
	}
	function getcontratAvancement($contrat,$entreprise)
	{
		$query ="select a.serial_num,a.numero,a.libelle,a.quantitetotale,a.prix_unitaire,a.code_unite,coalesce(sum(b.quantite),0) as quantiterealise from contrats.prix a 
		Left JOIN contrats.facture_prix b on a.numero=b.prix and a.contrat=b.contrat 
		where a.contrat=(select numero from  contrats.contrat a where a.numero=?  and a.id_entreprise=?) group by (a.serial_num,a.numero,a.libelle,a.quantitetotale,a.prix_unitaire,a.code_unite) order by a.serial_num asc;";
		$rslt = $this->userDB->query($query,array($contrat,$entreprise))->result_array();
		if(count($rslt)>0)
		{
			return $rslt;	
		}
		else
		{
			return 0;
		}

	}
	function getcontratPrix($contrat,$entreprise)
	{
		$query ="Select a.numero,a.libelle,a.prix_unitaire as pu,a.code_unite as unite,a.quantitetotale as quantite,a.prix_unitaire*a.quantitetotale as totale 
		from contrats.contrat b LEFT JOIN contrats.prix a on b.numero = a.contrat
		where b.numero=? and b.id_entreprise=? order by a.serial_num asc";
		$rslt = $this->userDB->query($query,array($contrat,$entreprise))->result_array();
		if(count($rslt)>0)
		{
			return $rslt;	
		}
		else
		{
			return 0;
		}

	}
	function update_ContratState($contrat,$entreprise,$state)
	{
		$query = "UPDATE contrats.contrat SET   etat=? WHERE numero=? and id_entreprise = ?";
		if($this->userDB->query($query,array($state,$contrat,$entreprise)))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function cotratDetail($contrat,$entreprise)
	{
		$query = "WITH A as (SELECT REPLACE(c.numero,'".$this->session->entreprise."_pfx_', '' ) as numero , c.libelle, c.delai,c.client, c.unite_delai,c.id_secteur,c.observation,c.id_adresse,c.etatcontrat, c.date_signature,c.observation,c.tva,to_char(c.date_signature,'dd-mm-yyyy') as date_signature,ST_AsText(c.geometrie) as geom,c.etat, round(sum(p.prix_unitaire*p.quantitetotale)*(1+(c.tva/100))::numeric,2) as montant_TTC FROM contrats.contrat c LEFT JOIN contrats.prix p on c.numero = p.contrat 
		where c.numero=? and c.id_entreprise=? Group by c.numero)
		select A.*,etat.designation as etatcontrat,cl.libelle as libelleclient,v.ville,v.secteur,se.libelle as secteurlibelle,dom.libelle domainelibelle,round(coalesce(B.paye,0)*(1+(A.tva/100))::numeric,2) as paye_ttc,round(coalesce(c.realise,0)*(1+(A.tva/100))::numeric,2) as realise from A LEFT JOIN (select sum(quantite*prix_unitaire) as paye,fp.contrat from contrats.facture_prix fp LEFT JOIN contrats.prix pr on fp.prix=pr.numero and fp.contrat=pr.contrat
		where fp.facture in (select numero from contrats.facture where paye='true') group by fp.contrat) B on A.numero=REPLACE(B.contrat,'".$this->session->entreprise."_pfx_', '' )
		LEFT JOIN (select sum(fp.quantite*pr.prix_unitaire) as realise,fp.contrat from contrats.facture_prix fp LEFT JOIN contrats.prix pr on fp.prix=pr.numero and fp.contrat=pr.contrat
		group by fp.contrat) C on A.numero=REPLACE(C.contrat,'".$this->session->entreprise."_pfx_', '' )
		LEFT JOIN contrats.etatcontrat etat on A.etatcontrat = etat.code 
		LEFT JOIN contrats.client cl on A.client = cl.identifiant
		LEFT JOIN contrats.ville_affaire v on A.id_adresse=v.code_postale
		LEFT JOIN contrats.secteur_affaire se on se.id=A.id_secteur
		LEFT JOIN contrats.domaine dom on se.domaine=dom.id;";
		$rslt = $this->userDB->query($query ,array($contrat,$entreprise));
		if($rslt and count($rslt->result_array())>0)
		{
			return $rslt->result_array()[0];
		}
		else
		{
			return 0;
		}
	}
	function entrepriseData($entreprise)
	{
		$query = "select c.numero as numeroentreprise,c.nom,c.adresse,c.tel,c.mail,c.fax,c.ice
		from rh.entreprise c where c.numero=?";
		$rslt = $this->userDB->query($query,array($entreprise));
		if($rslt and count($rslt->result_array())>0)
		{
			$dtaContrat = $rslt->result_array();
			return $dtaContrat[0];
		}
		else
		{
			return 0;
		}
	}
	function contratsList($entreprise,$todatable=true)
	{
		$listContrat = "WITH A as (SELECT c.numero,etc.code as etat,etc.designation as designationetat,c.tva,c.libelle,to_char(c.date_signature,'dd-mm-yyyy') as date_signature,c.client,
		sum(p.prix_unitaire*p.quantitetotale)*(1+(c.tva/100)) as montant_TTC
		FROM contrats.contrat c 
		LEFT JOIN contrats.prix p on c.numero = p.contrat 
		LEFT JOIN contrats.etatcontrat etc on c.etatcontrat = etc.code
		where c.id_entreprise=? and c.isdeleted=false 
		Group by c.numero,etc.code)
		select A.*,coalesce(B.paye,0)*(1+(A.tva/100)) as paye_ttc,coalesce(C.realise,0)*(1+(A.tva/100)) as realise from A LEFT JOIN (select sum(quantite*prix_unitaire) as paye,fp.contrat from contrats.facture_prix fp LEFT JOIN contrats.prix pr on fp.prix=pr.numero and fp.contrat=pr.contrat
		where fp.facture in (select numero from contrats.facture where etat='REGLEE') group by fp.contrat) B on A.numero=B.contrat
		LEFT JOIN (select sum(fp.quantite*pr.prix_unitaire) as realise,fp.contrat from contrats.facture_prix fp LEFT JOIN contrats.prix pr on fp.prix=pr.numero and fp.contrat=pr.contrat
		LEFT JOIN contrats.facture f on fp.facture=f.numero
		where f.etat!='REFUSEE'
		group by fp.contrat) C on A.numero=C.contrat ;";
		$rslt = $this->userDB->query($listContrat,array($entreprise));
		if($todatable)
		{
			$data = array();
			$sommeContrats =0;
			$sommePaye=0;
			$sommenonPaye=0; 
			$compteur = 0;
			foreach($rslt->result() as $r) {
				if(html_escape($r->etat)!='RESILIE' && html_escape($r->etat)!='TERMINE')
				{
					$compteur++;
					$sommeContrats +=html_escape($r->montant_ttc);
					$sommePaye+=html_escape($r->paye_ttc);
					$sommenonPaye+=html_escape($r->realise)-html_escape($r->paye_ttc); 
				}
				$data[] = array(

					html_escape(str_replace($this->session->entreprise.'_pfx_','',$r->numero)  ),
					html_escape($r->libelle),
					html_escape($r->date_signature),
					html_escape($r->montant_ttc),
					html_escape($r->realise),
					round(html_escape($r->realise)*100/html_escape($r->montant_ttc),2).' %',
					html_escape($r->paye_ttc),
					round(html_escape($r->paye_ttc)*100/html_escape($r->montant_ttc),2).' %',
					html_escape($r->designationetat),
					html_escape($r->client),
					'<div class="dropdown dropdown-action"><a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a><div class="dropdown-menu dropdown-menu-right"><span class="dropdown-item contrat-actions action-info">Détails</span><span class="dropdown-item contrat-actions action-liste-facture">Liste Factures</span><span class="dropdown-item contrat-actions action-nouvelle-facture">Nouvelle Facture</span><span class="dropdown-item contrat-actions action-delete-contrat">Supprimer</span></div></div>',
				);
			}
			/*$statistics = array(
				'nombre'=>$compteur.' Contrats',
				'montantTotal'=>number_format($sommeContrats,2,'.',' ').' DH TTC',
				'montantPaye'=>number_format($sommePaye,2,'.',' ').' DH TTC',
				'montantNonPaye'=>number_format($sommenonPaye,2,'.',' ').' DH TTC'
			);*/
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
function deleteContrat($numero,$entreprise)
{
	$query ='UPDATE contrats.contrat SET isdeleted=true,date_delete=current_date WHERE numero= ? and id_entreprise=? ';
	$exec= $this->userDB->query($query,array($numero,$entreprise));
if($exec && $this->userDB->affected_rows()>0)
	return 1;
else
	return 0;
}

}

?>
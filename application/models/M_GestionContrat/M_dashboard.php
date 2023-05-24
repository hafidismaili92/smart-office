<?php

class M_dashboard extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function geometriesListe($entreprise)
	{
		$requete = "select ST_AsText(geometrie) as geom from contrats.contrat where id_entreprise=?  and isdeleted=false and geometrie is not null ";
		return $this->userDB->query($requete,array($entreprise))->result_array();
	}
	function contratparEtat($entreprise,$yearsNombre=1)
	{
		$high=date('Y');
		$low=date('Y')-$yearsNombre+1;
		$requete = 'select et.designation as etat,et.code as code,count(ct.numero) as nombre from contrats.contrat ct
		LEFT JOIN contrats.etatcontrat et on ct.etatcontrat=et.code
		where id_entreprise = ? and ct.isdeleted=false and EXTRACT(year FROM ct.date_signature) BETWEEN '.$low.' AND '.$high.'
		group by et.code';
		$rslt = $this->userDB->query($requete,array($entreprise));
		$dta=array();
		$total=0;
		foreach ($rslt->result() as $r) {
			$total+=$r->nombre;
			$dta[$r->code]=$r->nombre;
		}
		$dta['totale']=$total;
		return $dta;
	}
	function contratsparMontant($entreprise,$monthOrYear='Month',$yearsNombre=1)
	{
		$requete="";
		switch ($monthOrYear) {
			case 'Month':
			$requete ="with A as(
			select ct.numero,EXTRACT(month FROM ct.date_signature) as mois,(sum(pr.prix_unitaire*pr.quantitetotale)*(1+(ct.tva/100))) as totalttc from contrats.prix pr
			Left join contrats.contrat ct on pr.contrat=ct.numero
			where ct.id_entreprise=? and ct.isdeleted=false and EXTRACT(year FROM ct.date_signature)=".date("Y")."
			group by ct.numero,mois
			)
			select sum(Case when mois=1 Then totalttc else 0 END ) as Janvier,
			sum(CASE WHEN mois=2  THEN totalttc ELSE 0 END) as Fevrier,
			sum(CASE WHEN mois=3  THEN totalttc ELSE 0 END) as Mars,
			sum(CASE WHEN mois=4  THEN totalttc ELSE 0 END) as Avril,
			sum(CASE WHEN mois=5  THEN totalttc ELSE 0 END) as Mai,
			sum(CASE WHEN mois=6  THEN totalttc ELSE 0 END) as Juin,
			sum(CASE WHEN mois=7  THEN totalttc ELSE 0 END) as Juillet,
			sum(CASE WHEN mois=8  THEN totalttc ELSE 0 END) as Aôut,
			sum(CASE WHEN mois=9  THEN totalttc ELSE 0 END) as Septembre,
			sum(CASE WHEN mois=10  THEN totalttc ELSE 0 END) as Octobre,
			sum(CASE WHEN mois=11  THEN totalttc ELSE 0 END) as Novembre,
			sum(CASE WHEN mois=12  THEN totalttc ELSE 0 END) as Decembre
			from A ";
			break;
			case 'Year':
			$high=date('Y');
			$low=date('Y')-$yearsNombre+1;
			$sumSeries= 'sum(Case when annee='.date('Y').' Then totalttc else 0 END ) as __'.date('Y');
			for ($i=1; $i < $yearsNombre ; $i++) { 
				$sumSeries=$sumSeries.',sum(Case when annee='.(date('Y')-$i).' Then totalttc else 0 END ) as __'.(date('Y')-$i);
			}
			$requete ='with A as (select ct.numero,EXTRACT(year FROM ct.date_signature) as annee,(sum(pr.prix_unitaire*pr.quantitetotale)*(1+(ct.tva/100))) as totalttc from contrats.prix pr
			Left join contrats.contrat ct on pr.contrat=ct.numero
			where ct.id_entreprise=? and ct.isdeleted=false and EXTRACT(year FROM ct.date_signature) BETWEEN '.$low.' AND '.$high.'
			group by ct.numero)
			select '.$sumSeries.' from A';
			break;
			default:
				# code...
			break;
		}
		if($requete!="")
		{
			$dta = $this->userDB->query($requete,array($entreprise))->result_array();
			if(count($dta)>0)
				return $dta[0];	
			else
				return 0;
		}
		else
		{
			return 0;
		}
		

	}
	function facturesRealise($entreprise,$monthOrYear='Month',$yearsNombre=1)
	{
		$requete="";
		$dtaset = array();
		$dta=array();
		$labels=array();
		switch ($monthOrYear) {
			case 'Month':
			$requete = "with A as (select extract(month from f.date_effet) as mois, sum(quantite*pr.prix_unitaire*(1+ct.tva/100)) as montant from contrats.facture_prix fp 
			LEFT JOIN contrats.contrat ct on fp.contrat=ct.numero
			LEFT JOIN contrats.prix pr on fp.prix=pr.numero and fp.contrat=pr.contrat
			LEFT JOIN contrats.facture f on fp.facture= f.numero
			where f.etat!='REFUSEE' and EXTRACT(year FROM f.date_effet)=".date("Y")." and ct.isdeleted=false and ct.id_entreprise=?  
			group by mois)
			select 
			sum(case when (mois=1) then montant else 0 END) as Janvier,
			sum(case when (mois=2) then montant else 0 END) as Fevrier,
			sum(case when (mois=3) then montant else 0 END) as Mars,
			sum(case when (mois=4) then montant else 0 END) as Avril,
			sum(case when (mois=5) then montant else 0 END) as Mai,
			sum(case when (mois=6) then montant else 0 END) as Juin,
			sum(case when (mois=7) then montant else 0 END) as Juillet,
			sum(case when (mois=8) then montant else 0 END) as Aôut,
			sum(case when (mois=9) then montant else 0 END) as Septembre,
			sum(case when (mois=10) then montant else 0 END) as Octobre,
			sum(case when (mois=11) then montant else 0 END) as Novembre,
			sum(case when (mois=12) then montant else 0 END) as Decembre,
			sum(montant) as somme_realisee
			from A";
			
			break;
			case 'Year':
			$high=date('Y');
			$low=date('Y')-$yearsNombre+1;
			$sumSeries= 'sum(Case when annee='.date('Y').' Then montant else 0 END ) as __'.date('Y');
			for ($i=1; $i < $yearsNombre ; $i++) { 
				$sumSeries=$sumSeries.',sum(Case when annee='.(date('Y')-$i).' Then montant else 0 END ) as __'.(date('Y')-$i);
			}
			$requete = "with A as (select extract(year from f.date_effet) as annee,sum(quantite*pr.prix_unitaire*(1+ct.tva/100)) as montant from contrats.facture_prix fp 
			LEFT JOIN contrats.contrat ct on fp.contrat=ct.numero
			LEFT JOIN contrats.prix pr on fp.prix=pr.numero and fp.contrat=pr.contrat
			LEFT JOIN contrats.facture f on fp.facture= f.numero
			where f.etat!='REFUSEE' and EXTRACT(year FROM f.date_effet) BETWEEN ".$low." AND ".$high."  and ct.isdeleted=false and ct.id_entreprise=? group by annee)
			select ".$sumSeries.",
			sum(montant) as somme_realisee
			from A";
			break;
			default:
				# code...
			break;
		}
		if($requete!="")
		{
			$dta = $this->userDB->query($requete,array($entreprise))->result_array();
			if(count($dta)>0)
			{
				$sommeRealisee = $dta[0]['somme_realisee'];
				array_pop($dta[0]);
				foreach ($dta[0] as $key => $value) {
					array_push($labels, str_replace('__','', $key));
					array_push($dtaset,$value);
				}
				
				return array(
					'labels'=>$labels,
					'dataset'=>$dtaset,
					'sommeRealisee'=>$sommeRealisee,
					
				);	
			}
			else
			{
				return 0;	
			}
			
		}
		else
		{
			return 0;
		}
	}
	function facturesPartime($entreprise,$monthOrYear='Month',$yearsNombre=1)
	{
		$requete="";
		$dtaset = array();
		$dta=array();
		$labels=array();
		switch ($monthOrYear) {
			case 'Month':
			$requete = "with A as (select extract(month from f.date_payement) as mois,f.etat as etat,sum(quantite*pr.prix_unitaire*(1+ct.tva/100)) as montant from contrats.facture_prix fp 
			LEFT JOIN contrats.contrat ct on fp.contrat=ct.numero
			LEFT JOIN contrats.prix pr on fp.prix=pr.numero and fp.contrat=pr.contrat
			LEFT JOIN contrats.facture f on fp.facture= f.numero
			where ((f.etat='REGLEE' and EXTRACT(year FROM f.date_payement)=".date("Y").") or f.etat='ENATTENTE') and ct.isdeleted=false  and ct.id_entreprise=?  
			group by mois,f.etat)
			select 
			sum(case when (mois=1) and (etat='REGLEE') then montant else 0 END) as Janvier,
			sum(case when (mois=2) and (etat='REGLEE') then montant else 0 END) as Fevrier,
			sum(case when (mois=3) and (etat='REGLEE') then montant else 0 END) as Mars,
			sum(case when (mois=4) and (etat='REGLEE') then montant else 0 END) as Avril,
			sum(case when (mois=5) and (etat='REGLEE') then montant else 0 END) as Mai,
			sum(case when (mois=6) and (etat='REGLEE') then montant else 0 END) as Juin,
			sum(case when (mois=7) and (etat='REGLEE') then montant else 0 END) as Juillet,
			sum(case when (mois=8) and (etat='REGLEE') then montant else 0 END) as Aôut,
			sum(case when (mois=9) and (etat='REGLEE') then montant else 0 END) as Septembre,
			sum(case when (mois=10) and (etat='REGLEE') then montant else 0 END) as Octobre,
			sum(case when (mois=11) and (etat='REGLEE') then montant else 0 END) as Novembre,
			sum(case when (mois=12) and (etat='REGLEE') then montant else 0 END) as Decembre,
			sum(case when etat='REGLEE' then montant else 0 END) as somme_reglee,
			sum(case when etat='ENATTENTE' then montant else 0 END) as somme_enattente
			from A";
			
			break;
			case 'Year':
			$high=date('Y');
			$low=date('Y')-$yearsNombre+1;
			$sumSeries= 'sum(Case when (annee='.date('Y').') and (etat=\'REGLEE\')  Then montant else 0 END ) as __'.date('Y');
			for ($i=1; $i < $yearsNombre ; $i++) { 
				$sumSeries=$sumSeries.',sum(Case when (annee='.(date('Y')-$i).') and (etat=\'REGLEE\') Then montant else 0 END ) as __'.(date('Y')-$i);
			}
			$requete = "with A as (select extract(year from f.date_payement) as annee,f.etat as etat,sum(quantite*pr.prix_unitaire*(1+ct.tva/100)) as montant from contrats.facture_prix fp 
			LEFT JOIN contrats.contrat ct on fp.contrat=ct.numero
			LEFT JOIN contrats.prix pr on fp.prix=pr.numero and fp.contrat=pr.contrat
			LEFT JOIN contrats.facture f on fp.facture= f.numero
			where ((f.etat='REGLEE' and EXTRACT(year FROM f.date_payement) BETWEEN ".$low." AND ".$high." ) or f.etat='ENATTENTE') and ct.isdeleted=false and ct.id_entreprise=? group by annee,f.etat)
			select ".$sumSeries.",
			sum(case when etat='REGLEE' then montant else 0 END) as somme_reglee,
			sum(case when etat='ENATTENTE' then montant else 0 END) as somme_enattente
			from A";
			break;
			default:
				# code...
			break;
		}
		if($requete!="")
		{
			$dta = $this->userDB->query($requete,array($entreprise))->result_array();
			if(count($dta)>0)
			{
				$sommeReglee = $dta[0]['somme_reglee'];
				$sommeEnattente =$dta[0]['somme_enattente'];
				array_splice($dta[0], -2,2);
				foreach ($dta[0] as $key => $value) {
					array_push($labels, str_replace('__','', $key));
					array_push($dtaset,$value);
				}
				
				return array(
					'labels'=>$labels,
					'dataset'=>$dtaset,
					'sommeReglee'=>$sommeReglee,
					'sommeEnattente'=>$sommeEnattente,
				);	
			}
			else
			{
				return 0;	
			}
			
		}
		else
		{
			return 0;
		}
	}
	function contratsparSecteur($entreprise,$monthOrYear='Month',$yearsNombre=1)
	{
		$requete="";
		$dta = array();
		$columns=array();
		switch ($monthOrYear) {
			case 'Month':
			
			$requete = "WITH A as (select d.libelle,EXTRACT(month FROM co.date_signature) as mois,count(numero) as nombre from contrats.contrat co
			LEFT JOIN contrats.secteur_affaire s on co.id_secteur = s.id
			LEFT JOIN contrats.domaine d on s.domaine=d.id
			where id_entreprise = ? and co.isdeleted=false and EXTRACT(year FROM co.date_signature)=".date("Y")."
			Group by d.libelle,mois)
			select libelle,
			sum(CASE WHEN mois=1  THEN nombre ELSE 0 END) as Janvier,
			sum(CASE WHEN mois=2  THEN nombre ELSE 0 END) as Fevrier,
			sum(CASE WHEN mois=3  THEN nombre ELSE 0 END) as Mars,
			sum(CASE WHEN mois=4  THEN nombre ELSE 0 END) as Avril,
			sum(CASE WHEN mois=5  THEN nombre ELSE 0 END) as Mai,
			sum(CASE WHEN mois=6  THEN nombre ELSE 0 END) as Juin,
			sum(CASE WHEN mois=7  THEN nombre ELSE 0 END) as Juillet,
			sum(CASE WHEN mois=8  THEN nombre ELSE 0 END) as Aôut,
			sum(CASE WHEN mois=9  THEN nombre ELSE 0 END) as Septembre,
			sum(CASE WHEN mois=10  THEN nombre ELSE 0 END) as Octobre,
			sum(CASE WHEN mois=11  THEN nombre ELSE 0 END) as Novembre,
			sum(CASE WHEN mois=12  THEN nombre ELSE 0 END) as Decembre,
			sum(nombre) as totale
			from A Group by libelle
			union 
			select 'Totale',
			sum(CASE WHEN mois=1  THEN nombre ELSE 0 END) as Janvier,
			sum(CASE WHEN mois=2  THEN nombre ELSE 0 END) as Fevrier,
			sum(CASE WHEN mois=3  THEN nombre ELSE 0 END) as Mars,
			sum(CASE WHEN mois=4  THEN nombre ELSE 0 END) as Avril,
			sum(CASE WHEN mois=5  THEN nombre ELSE 0 END) as Mai,
			sum(CASE WHEN mois=6  THEN nombre ELSE 0 END) as Juin,
			sum(CASE WHEN mois=7  THEN nombre ELSE 0 END) as Juillet,
			sum(CASE WHEN mois=8  THEN nombre ELSE 0 END) as Aôut,
			sum(CASE WHEN mois=9  THEN nombre ELSE 0 END) as Septembre,
			sum(CASE WHEN mois=10  THEN nombre ELSE 0 END) as Octobre,
			sum(CASE WHEN mois=11  THEN nombre ELSE 0 END) as Novembre,
			sum(CASE WHEN mois=12  THEN nombre ELSE 0 END) as Decembre,
			sum(nombre) as totale
			from A";
			
			break;
			case 'Year':
			$high=date('Y');
			$low=date('Y')-$yearsNombre+1;
			$sumSeries= 'sum(Case when annee='.date('Y').' Then nombre else 0 END ) as __'.date('Y');
			for ($i=1; $i < $yearsNombre ; $i++) { 
				$sumSeries=$sumSeries.',sum(Case when annee='.(date('Y')-$i).' Then nombre else 0 END ) as __'.(date('Y')-$i);
			}

			$requete ="WITH A as (select d.libelle,EXTRACT(year FROM co.date_signature) as annee,count(numero) as nombre from contrats.contrat co
			LEFT JOIN contrats.secteur_affaire s on co.id_secteur = s.id
			LEFT JOIN contrats.domaine d on s.domaine=d.id
			where id_entreprise = ? and co.isdeleted=false and EXTRACT(year FROM co.date_signature) BETWEEN ".$low." AND ".$high."
			Group by d.libelle,annee)
			select libelle,".$sumSeries.",sum(nombre) as totale
			from A Group by libelle
			union 
			select 'Totale',".$sumSeries.",sum(nombre) as totale
			from A";
			break;
			default:
				# code...
			break;
		}
		if($requete!="")
		{
			$dta = $this->userDB->query($requete,array($entreprise))->result_array();
			if(count($dta)>0)
			{
				foreach ($dta[0] as $key => $value) {
					$columns[]=array('data'=>$key,'name'=>$key=="libelle"?"Secteur d'activité":str_replace('__','', $key));
				}
				$totaleArray = array_pop($dta);
				return array('data'=>$dta,'columns'=>$columns,'totaleRow'=>$totaleArray);	
			}
			else
			{
				return 0;	
			}
			
		}
		else
		{
			return 0;
		}
	}
}
?>
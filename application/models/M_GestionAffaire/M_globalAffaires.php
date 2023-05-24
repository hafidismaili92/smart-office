<?php
class M_globalAffaires extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function globalAffairesList($user_codeEtablissement,$entreprise,$categorie,$period=11)
	{
		$periodExpression="af.date_creation::date BETWEEN now()::date-interval '".$period." month' and  now()::date ";
		$filter = ''; 
			switch ($categorie) {
				
				case 'acheve':
					$filter ="af.terminee='true'";
					break;
					case 'encours':
					$filter ="(af.date_creation+ interval '1 day'*af.delai>=current_date and af.terminee != 'true')";
					break;
					case 'ensouffrance':
					$filter ="(af.date_creation+ interval '1 day'*af.delai<current_date and af.terminee != 'true') ";
					break;
				default:
					$filter = '';
					break;
			}
			$filter = $filter!=''? $filter." and ":$filter;
		$globalAffaires = "WITH RECURSIVE tableR (code_etabli_mere, code_etablissement,libelle)
		AS
		(
		SELECT e.code_etabli_mere, e.code_etablissement, e.libelle
		FROM rh.etablissement AS e   
		WHERE code_etablissement = ? and id_entreprise=?
		UNION all
		SELECT e.code_etabli_mere, e.code_etablissement, e.libelle
		FROM rh.etablissement AS e
		INNER JOIN tableR AS d
		ON e.code_etabli_mere = d.code_etablissement
		)
		SELECT tableR.libelle as etablissementlibelle,char_matricule,nom,prenom,
		(select rh.fonction.libelle as fonctionlebelle from rh.fonction where fonction.id_fonction=em.id_fonction) as fonct,
		af.numero_affaire,af.date_creation,af.libelle,round(sum(t.avancement::decimal*t.delai)/sum(t.delai),2) as avancement,case when af.terminee='true' then 'Terminee' when (af.date_creation+ interval '1 day'*af.delai<current_date) then 'En souffrance'  else 'En cours' end as etat
		FROM tableR inner join rh.employee em on tableR.code_etablissement=em.code_etablissement
		INNER JOIN affaires.affaire af  on em.numeric_matricule = af.creer_par
		LEFT JOIN affaires.taches t on af.numero_affaire = t.numero_affaire
		where ".$filter." af.isdeleted='false' and t.iid_tache_mere is null and ".$periodExpression."
		group by etablissementlibelle,char_matricule,nom,prenom,fonct,af.numero_affaire";
		$rslt = $this->userDB->query($globalAffaires,array($user_codeEtablissement,$entreprise));
		$data = array();

		foreach($rslt->result() as $r) {
			$myDateTime = new DateTime(html_escape($r->date_creation));
			$data[] = array(
				html_escape(str_replace($this->session->entreprise.'_pfx_','',$r->numero_affaire)),
				html_escape($r->libelle),
				html_escape($r->etat),
				html_escape($r->nom).' '.html_escape($r->prenom),
				html_escape($r->char_matricule),
				$myDateTime->format('d-m-Y'),
				html_escape($r->avancement)!=''?html_escape($r->avancement).' %':'0 %',
				
				html_escape($r->etablissementlibelle),
				html_escape($r->fonct),);
		}

		$output = array(

		//"recordsTotal" => $rslt->num_rows(),
		//"recordsFiltered" => $rslt->num_rows(),
			"data" => $data
		);

		return $output;
	}
	function affairesByEtat($user_codeEtablissement,$entreprise,$period=11)
	{
		$periodExpression="af.date_creation::date BETWEEN now()::date-interval '".$period." month' and  now()::date ";
		
		$q = "WITH RECURSIVE tableR (code_etabli_mere, code_etablissement,libelle)
		AS
		(
		SELECT e.code_etabli_mere, e.code_etablissement, e.libelle
		FROM rh.etablissement AS e   
		WHERE code_etablissement = ? and id_entreprise=?
		UNION all
		SELECT e.code_etabli_mere, e.code_etablissement, e.libelle
		FROM rh.etablissement AS e
		INNER JOIN tableR AS d
		ON e.code_etabli_mere = d.code_etablissement
		)
		SELECT  case when af.isdeleted='true' then 'Supprimée' when af.terminee='true' then 'Achevé' when (af.date_creation+ interval '1 day'*af.delai<current_date) then 'En Souffrance'  else 'En Cours' end as etat,count(*) as nbr
		FROM tableR inner join rh.employee em on tableR.code_etablissement=em.code_etablissement
		INNER JOIN affaires.affaire af  on em.numeric_matricule = af.creer_par
		
		where af.isdeleted='false' and ".$periodExpression."  group by etat";
		$rslt = $this->userDB->query($q,array($user_codeEtablissement,$entreprise))->result_array();
		return $rslt;
	}
	function affairesByMonths($user_codeEtablissement,$entreprise)
	{
		$q = "WITH RECURSIVE tableR (code_etabli_mere, code_etablissement,libelle)
		AS
		(
		SELECT e.code_etabli_mere, e.code_etablissement, e.libelle
		FROM rh.etablissement AS e   
		WHERE code_etablissement = ? and id_entreprise=?
		UNION all
		SELECT e.code_etabli_mere, e.code_etablissement, e.libelle
		FROM rh.etablissement AS e
		INNER JOIN tableR AS d
		ON e.code_etabli_mere = d.code_etablissement
		), A as
		(SELECT count(*) as nbr,to_char(af.date_creation::date,'Mon-YYYY') as dte
		FROM tableR inner join rh.employee em on tableR.code_etablissement=em.code_etablissement
		INNER JOIN affaires.affaire af  on em.numeric_matricule = af.creer_par
		
		where af.isdeleted='false'  and af.date_creation::date BETWEEN now()::date-interval '11 month' and  now()::date    
		group by dte order by dte asc)
		select 
			1 as compteur,to_char(now()::date,'Mon-YYYY') as dte,sum(case when to_char(now()::date,'Mon-YYYY')=dte then nbr else 0 END) as nbr from A
		union
		select 
			2,to_char(now()::date-interval '1 month','Mon-YYYY') as dte,sum(case when to_char(now()::date-interval '1 month','Mon-YYYY')=dte then nbr else 0 END) as nbr from A
			union
			select 
			3,to_char(now()::date-interval '2 month','Mon-YYYY') as dte,sum(case when to_char(now()::date-interval '2 month','Mon-YYYY')=dte then nbr else 0 END) as nbr from A
			union
			select 
			4,to_char(now()::date-interval '3 month','Mon-YYYY') as dte,sum(case when to_char(now()::date-interval '3 month','Mon-YYYY')=dte then nbr else 0 END) as nbr from A
			union
			select 
			5,to_char(now()::date-interval '4 month','Mon-YYYY') as dte,sum(case when to_char(now()::date-interval '4 month','Mon-YYYY')=dte then nbr else 0 END) as nbr from A
			union
			select 
			6,to_char(now()::date-interval '5 month','Mon-YYYY') as dte,sum(case when to_char(now()::date-interval '5 month','Mon-YYYY')=dte then nbr else 0 END) as nbr from A
			union
			select 
			7,to_char(now()::date-interval '6 month','Mon-YYYY') as dte,sum(case when to_char(now()::date-interval '6 month','Mon-YYYY')=dte then nbr else 0 END) as nbr from A
			union
			select 
			8,to_char(now()::date-interval '7 month','Mon-YYYY') as dte,sum(case when to_char(now()::date-interval '7 month','Mon-YYYY')=dte then nbr else 0 END) as nbr from A
			union
			select 
			9,to_char(now()::date-interval '8 month','Mon-YYYY') as dte,sum(case when to_char(now()::date-interval '8 month','Mon-YYYY')=dte then nbr else 0 END) as nbr from A
			union
			select 
			10,to_char(now()::date-interval '9 month','Mon-YYYY') as dte,sum(case when to_char(now()::date-interval '9 month','Mon-YYYY')=dte then nbr else 0 END) as nbr from A
			union
			select 
			11,to_char(now()::date-interval '10 month','Mon-YYYY') as dte,sum(case when to_char(now()::date-interval '10 month','Mon-YYYY')=dte then nbr else 0 END) as nbr from A
			union
			select 
			12,to_char(now()::date-interval '11 month','Mon-YYYY') as dte,sum(case when to_char(now()::date-interval '11 month','Mon-YYYY')=dte then nbr else 0 END) as nbr from A
			order by compteur desc;";
			$rslt = $this->userDB->query($q,array($user_codeEtablissement,$entreprise))->result_array();
		return $rslt;
	}
// 	function confirmDeleteAffaire($numero,$createur,$etablissement,$entreprise)
// {
// 	$query ='WITH RECURSIVE tableR (code_etabli_mere, code_etablissement,libelle)
// 	AS
// 	(
// 	SELECT e.code_etabli_mere, e.code_etablissement, e.libelle
// 	FROM rh.etablissement AS e   
// 	WHERE code_etablissement = ? and id_entreprise=?
// 	UNION all
// 	SELECT e.code_etabli_mere, e.code_etablissement, e.libelle
// 	FROM rh.etablissement AS e
// 	INNER JOIN tableR AS d
// 	ON e.code_etabli_mere = d.code_etablissement
// 	)
// 	DELETE FROM affaires.affaire
// 	WHERE numero_affaire= ? and creer_par=? and creer_par IN (SELECT numeric_matricule FROM tableR inner join rh.employee on tableR.code_etablissement=rh.employee.code_etablissement)';
// 	$exec= $this->userDB->query($query,array($etablissement,$entreprise,$numero,$createur));
// if($exec && $this->userDB->affected_rows()>0)
// 	return 1;
// else
// 	return 0;
// }
}

?>
<?php
class M_EditGeoBusiness extends CI_Model
{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function insertNewAffaire($dtaAff,$dtaFields,$dtaComposantes)
	{
		$insertAffPart = 'INSERT INTO geobusiness.geobusiness(nom, srid,geomtype, datecreation, creerpar)
		VALUES (?, ?,?,CURRENT_DATE, ?) ON CONFLICT ON CONSTRAINT  uk_geoaffaire_nom_creerpar DO NOTHING returning idgeoaffaire,srid';
		$insertgeocomposantesPart = 'INSERT INTO geobusiness.geocomposante(geom,idgeoaffaire) VALUES (ST_GeomFromText(?,?), ?) returning idcomposante' ;
		$insertFiledsPart = "INSERT INTO geobusiness.fields(libelle, idgeoaffaire)VALUES (?, ?) ON CONFLICT ON CONSTRAINT  uk_field_geobusiness DO NOTHING returning id_field;";
		$this->userDB->trans_begin();
		$newAffaire = $this->userDB->query($insertAffPart,$dtaAff)->result_array();
		if($this->userDB->trans_status() === FALSE)
		{
			$this->userDB->trans_rollback();
			return 0;
		}
		else if(count($newAffaire)>0)
		{
			$idNewAff = $newAffaire[0]['idgeoaffaire'];
			$srid = $newAffaire[0]['srid'];
			$fieldsArray = array();
			if(!empty($dtaFields))
			{
				for ($i=0;$i<count($dtaFields);$i++)
				{
					if(strlen($dtaFields[$i])>25)
					{
						$this->userDB->trans_rollback();
						return "le nom de champs '".$dtaFields[$i]."' est trop long (max 25 cacartères)";
					}

					$newField = $this->userDB->query($insertFiledsPart,array($dtaFields[$i],$idNewAff))->result_array();
					if ($this->userDB->trans_status() === FALSE)
					{
						$this->userDB->trans_rollback();
						return 0;
					}
					else if(count($newField)>0)
					{
						array_push($fieldsArray,$newField[0]['id_field']);
					}
					else
					{
						$this->userDB->trans_rollback();
						return "le nom de champs '".$dtaFields[$i]."' existe déja,veuillez choisir un autre";
					}
				}
			}
			if(!empty($dtaComposantes))
			{
				for($i=0;$i<count($dtaComposantes);$i++)
				{
					$newComposante = $this->userDB->query($insertgeocomposantesPart,array($dtaComposantes[$i]['wktGeom'],$srid,$idNewAff))->result_array();
					if ($this->userDB->trans_status() === FALSE)
					{
						$this->userDB->trans_rollback();
						return 0;
					}
					else if(count($newComposante)>0)
					{
						$insertFieldsValues ="INSERT INTO geobusiness.fieldsvalue(idfield, idgeocomposante, value) VALUES (?, ?, ?) ON CONFLICT ON CONSTRAINT pk_fieldvalue Do NOTHING;";
						for($j=0;$j<count($fieldsArray);$j++)
						{
							if(strlen($dtaComposantes[$i]['fieldsValues'][$j])>50)
							{
								$this->userDB->trans_rollback();
								return "la valeur'".$dtaComposantes[$i]['fieldsValues'][$j]."' est trop long (max 50 cacartères)";
							}
							$newValue = $this->userDB->query($insertFieldsValues,array($fieldsArray[$j],$newComposante[0]['idcomposante'],$dtaComposantes[$i]['fieldsValues'][$j]));
						}
						$insertLabels ="INSERT INTO geobusiness.borne(libelle, idgeocomposante) VALUES (?, ?);";
						for($k=0;$k<count($dtaComposantes[$i]['labels']);$k++)
						{
							$newBorne = $this->userDB->query($insertLabels,array($dtaComposantes[$i]['labels'][$k],$newComposante[0]['idcomposante']));
							if ($this->userDB->trans_status() === FALSE)
							{
								$this->userDB->trans_rollback();
								return 0;
							}
						}
					}
				}
			}
			
			$this->userDB->trans_commit();
			$this->userDB->query('SELECT geobusiness.refresh_mvw()');
			return $newAffaire;
		}
		else
		{
			$this->userDB->trans_rollback();
			return "le nom d'affaire '".$dtaAff[0]."' existe déja,veuillez choisir un autre";
		}
	}

	function loadGeoAffaires($dta)
	{
		$query = "SELECT idgeoaffaire,CONCAT_WS(';',geomtype,nom,to_char(datecreation,'DD-MM-YYYY')) FROM geobusiness.geobusiness where creerpar = ? ";
		$affaires = $this->userDB->query($query,$dta)->result_array();
		$output = array(

			"data" => array_map(function($item){return array_values($item);},$affaires)
		);
		return $output;

	}
	function checkGeoAffExist($dta)
	{
		$query = "SELECT idgeoaffaire as id,nom  FROM geobusiness.geobusiness where creerpar = ? and nom= ? and idgeoaffaire=?";
		$affaire = $this->userDB->query($query,$dta);
		if($affaire && count($affaire->result_array())>0) return $affaire->result_array()[0];
		else return 0;
	}
	function getGeoaffaire($dta)
	{
		$query = "SELECT idgeoaffaire, nom, srid, to_char(datecreation,'DD-MM-YYYY') as date_creation, creerpar, geomtype, fill, strokecolor, strokewidth
		FROM geobusiness.geobusiness where creerpar = ? and idgeoaffaire = ? and nom = ?;";
		$affaire = $this->userDB->query($query,$dta);
		if($affaire && count($affaire->result_array())>0) return $affaire->result_array()[0];
		else return 0;
	}
	function setStyle($dta)
	{
		$query ="UPDATE geobusiness.geobusiness SET fill=?, strokecolor=?, strokewidth=? WHERE idgeoaffaire=? and creerpar=? returning fill,strokecolor,strokewidth;";
		$rslt = $this->userDB->query($query,$dta);
		if($rslt && $this->userDB->affected_rows()>0) return $rslt->result_array()[0];
		else return 0;

	}
}
?>
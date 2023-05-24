<?php
/**
 * 
 */
class M_Composantes extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}

	function getAttributeTable($dta)
	{
		$query = "SELECT attributes,idcomposante FROM geobusiness.attribute_table WHERE creerpar=? and idgeoaffaire=? and geoaffaire=? order by idcomposante;";
		$rslt = $this->userDB->query($query,$dta);
		if($rslt && count($rslt->result_array())>0)
		{
			return $rslt->result_array();
		}
		else
		{
			
			return 0;
		}
	}
	
	function getGeoComposantesInfo($dta)
	{
		$query = "SELECT idcomposante, coord, geomtype, srid, bornes, geomprop FROM geobusiness.geominfo where creerpar = ? and idgeoaffaire = ? order by idcomposante;";
		$rslt = $this->userDB->query($query,array($dta[0],$dta[1]));
		if($rslt && count($rslt->result_array())>0)
		{
			return $rslt->result_array();
		}
		else
		{
			
			return 0;
		}
	}
}
?>
<?php

/**
 * 
 */
class EditComoposantes extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Geobusiness/M_Composantes','Composantes');
		
	}
	function AttributesTable()
	{
		$affaire = pg_escape_string($this->input->post('geoaffaire', TRUE));
		$idgeoaffaire = pg_escape_string($this->input->post('id', TRUE));
		if(!isset($_POST['geoaffaire']) || !isset($_POST['id']) || strlen($affaire)>100 || !is_numeric($idgeoaffaire) || empty($affaire))
		{
			echo json_encode(array('data'=>array()));
			return;
		}
		$dta = array($this->session->numeric_matricule,$idgeoaffaire,$affaire);
		$rslt = $this->Composantes->getAttributeTable($dta);
		if(is_array($rslt) && count($rslt)>0)
		{
			$columns = array_keys(json_decode($rslt[0]['attributes'],true));
			$rows =array();
			foreach ($rslt as $item) {
				array_push($rows, array_merge(array('UniqueID'=>$item['idcomposante']),json_decode($item['attributes'],true)));
			}
			$cols = array_map(function($item){ return array('data'=>$item);},$columns);
			array_unshift($cols , array('data'=>'UniqueID'));
			array_unshift($cols , array('data'=>'Action'));
			$attributesTable = array(
				'col' =>$cols,
				'rows'=>$rows
			);
			echo json_encode($attributesTable);
		}

		
	}
	
	function GetLayer()
	{
		$idgeoaffaire = pg_escape_string($this->input->get('aff', TRUE));
		if(!isset($_GET['aff']) || !is_numeric($idgeoaffaire) || empty($idgeoaffaire) || strlen($idgeoaffaire)>50)
		{
			
			return;
		}
		$user = $this->session->numeric_matricule;
		$string= 'geoserver/geobusiness/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=geobusiness%3AuserGeocomposantes&maxFeatures=1000&t='.time().'&viewparams=u:'.$user.';aff:'.$idgeoaffaire.'&outputFormat=application%2Fjson';
		$domainName = $_SERVER['HTTP_HOST'] . '/';
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$domain = $protocol . $domainName;
		///$viewparams=u:1114;aff:15
		echo file_get_contents('http://127.0.0.1/'. $string);
		//echo file_get_contents($domain . $string);
	}
	function Getbmp($z,$x,$y)
	{
		
		$string= 'http://api.tomtom.com/map/1/tile/basic/main/'.$z.'/'.$x.'/'.$y.'.png?tileSize=512&view=MA&key=zJGTjkv8uPoyCdES0F0xxXH30YP0mC11';
		
		echo file_get_contents($string);
		//echo file_get_contents($domain . $string);
	}
	/*function getWMS()
	{

		$string = $this->input->server('QUERY_STRING');
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$domainName = $_SERVER['HTTP_HOST'] . '/';
		$domain = $protocol . $domainName;
		///$viewparams=u:1114;aff:15
		echo file_get_contents($domain.'geoserver/geobusiness/wms?'.$string);
		//redirect($domain.'geoserver/geobusiness/wms?'.$string);
	}*/

}
?>
<?php
$geobusiness = array(
//
'ajouterGeoAffaire'=>array(
	array(
		'field' => 'affName',
		'label' => 'Affaire',
		'rules' => array('trim','required','max_length[200]'),
		'errors'=> array(
			'required'=>'Veuillez ajouter {field}',
			'max_length'=>' {field} trop long'
		)
	),
	array(
		'field' => 'srid',
		'label' => 'système de projection',
		'rules' => array('trim','required','in_list[26191,26192,26194,26195,4326]'),
		'errors'=> array(
			'required'=>'Veuillez ajouter {field}',
			'in_list'=>' {field} invalide'
		)
	),
	array(
		'field' => 'geomType',
		'label' => 'Type de geometrie',
		'rules' => array('trim','required','in_list[Point,Polygon,LineString]'),
		'errors'=> array(
			'required'=>'Veuillez ajouter {field}',
			'in_list'=>' {field} invalide'
		)
	),
),
'exportAffaire'=>array(
	array(
		'field' => 'geoaffaire',
		'label' => 'Numero Affaire',
		'rules' => array('trim','required','max_length[200]'),
		'errors'=> array(
			'required'=>'Veuillez ajouter {field}',
			'max_length'=>' {field} trop long'
		)
	),
	array(
		'field' => 'id',
		'label' => 'numero affaire',
		'rules' => array('trim','required','numeric','max_length[15]'),
		'errors'=> array(
			'required'=>'Veuillez ajouter {field}',
			'numeric'=>'{field} non numérique',
			'max_length'=>'{field} trop long',
		)
	),
	array(
		'field' => 'format',
		'label' => 'Format de sortie',
		'rules' => array('trim','required','in_list[excel,shp]','max_length[25]'),
		'errors'=> array(
			'required'=>'Veuillez ajouter {field}',
			'in_list'=>'{field} invalide',
			'max_length'=>'{field} trop long',
		)
	),
),
//
'setStyle'=>array(
	array(
		'field' => 'style-fill',
		'label' => 'coleur de remplissage',
		'rules' => array('trim','required','max_length[25]','regex_match[/^rgba\(.*$/]'),
		'errors'=> array(
			'required'=>'Veuillez ajouter {field}',
			'max_length'=>'{field} trop long',
			'regex_match'=> '{field} invalide'
		)
	),
	array(
		'field' => 'style-strokecolor',
		'label' => 'coleur de conteur',
		'rules' => array('trim','required','max_length[25]','regex_match[/^rgb\(.*$/]'),
		'errors'=> array(
			'required'=>'Veuillez ajouter {field}',
			'max_length'=>'{field} trop long',
			'regex_match'=> '{field} invalide'
		)
	),
	array(
		'field' => 'style-strokewidth',
		'label' => 'épaisseur',
		'rules' => array('trim','required','less_than[6]','greater_than[0]','numeric'),
		'errors'=> array(
			'required'=>'Veuillez ajouter {field}',
			'numeric'=>'{field} non numérique',
			'less_than'=> 'valeur max pour {field} est 5',
			'greater_than'=> 'valeur  min pour {field} est 1',
		)
	),
),
//
);
	?>
	
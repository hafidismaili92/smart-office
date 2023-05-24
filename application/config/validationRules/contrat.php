<?php
$contrat = array('ajouterDevis' => array(
	array(
		'field' => 'objet-devis',
		'label' => 'Objet',
		'rules' => array('trim','max_length[500]','required'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter {field}',
			'max_length'=>'*{field} trop long',
		)
	),
	array(
		'field' => 'devis-tva',
		'label' => 'TVA',
		'rules' => array('trim','required','max_length[3]','numeric','greater_than[0]','less_than[101]'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter la {field}',
			'max_length'=>'*{field} trop long',
			'numeric'=>'*{field} invalide',
			'greater_than'=>'*{field} négatif',
			'less_than'=>'*{field} dépasse 10 ans !',
		)
	),
	array(
		'field' => 'prixArray',
		'label' => 'Liste des prix',
		'rules' => array('required'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter les prix',
		)
	),
	array(
		'field' => 'client-devis',
		'label' => 'Client',
		'rules' => array('trim','max_length[50]','required'),
		'errors'=> array(
			'max_length'=>'*{field} trop long',
			'required'=>'*Veuillez ajouter  {field}',
		)
	)
),
'editerDevis' => array(
	array(
		'field' => 'objet-devis',
		'label' => 'Objet',
		'rules' => array('trim','max_length[500]','required'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter {field}',
			'max_length'=>'*{field} trop long',
		)
	),
	array(
		'field' => 'devis-tva',
		'label' => 'TVA',
		'rules' => array('trim','required','max_length[3]','numeric','greater_than[0]','less_than[101]'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter la {field}',
			'max_length'=>'*{field} trop long',
			'numeric'=>'*{field} invalide',
			'greater_than'=>'*{field} négatif',
			'less_than'=>'*{field} dépasse 10 ans !',
		)
	),
	
	array(
		'field' => 'client-devis',
		'label' => 'Client',
		'rules' => array('trim','max_length[50]','required'),
		'errors'=> array(
			'max_length'=>'*{field} trop long',
			'required'=>'*Veuillez ajouter  {field}',
		)
	)
),
'ajouterContrat' => array(
	array(
		'field' => 'numero',
		'label' => 'Numero',
		'rules' => array('trim','required','max_length[20]'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter la {field}',
			'max_length'=>'*{field} trop long',
		)
	),
	array(
		'field' => 'libelle',
		'label' => 'Libelle',
		'rules' => array('trim','max_length[500]','required'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter {field}',
			'max_length'=>'*{field} trop long',
		)
	),
	array(
		'field' => 'delai',
		'label' => 'Delai',
		'rules' => array('trim','required','max_length[4]','numeric','greater_than[0]','less_than[3651]'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter la {field}',
			'max_length'=>'*{field} trop long',
			'numeric'=>'*{field} invalide',
			'greater_than'=>'*{field} négatif',
			'less_than'=>'*{field} dépasse 10 ans !',
		)
	),
	array(
		'field' => 'contrat-tva',
		'label' => 'TVA',
		'rules' => array('trim','required','max_length[3]','numeric','greater_than[0]','less_than[101]'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter la {field}',
			'max_length'=>'*{field} trop long',
			'numeric'=>'*{field} invalide',
			'greater_than'=>'*{field} négatif',
			'less_than'=>'*{field} dépasse 10 ans !',
		)
	),
	array(
		'field' => 'prixArray',
		'label' => 'Liste des prix',
		'rules' => array('required'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter les prix',
		)
	),
	array(
		'field' => 'secteur-ville',
		'label' => 'ville/Secteur',
		'rules' => array('trim','max_length[50]','required'),
		'errors'=> array(
			'max_length'=>'*{field} trop long',
			'required'=>'*Veuillez ajouter  {field}',
		)
	),
	array(
		'field' => 'secteur-contrat',
		'label' => 'Domaine/Secteur',
		'rules' => array('trim','max_length[150]','required'),
		'errors'=> array(
			'max_length'=>'*{field} trop long',
			'required'=>'*Veuillez ajouter  {field}',
		)
	),
	array(
		'field' => 'client-contrat',
		'label' => 'Client',
		'rules' => array('trim','max_length[50]','required'),
		'errors'=> array(
			'max_length'=>'*{field} trop long',
			'required'=>'*Veuillez ajouter  {field}',
		)
	),
	array(
		'field' => 'date-signature',
		'label' => 'Date Signature',
		'rules' => array('trim','required','validateDate','max_length[20]'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter la {field}',
			'max_length'=>'*{field} trop long',
			'validateDate'=>'{field} invalide'
		)
	),
	array(
		'field' => 'contrat-observations',
		'label' => 'Observation',
		'rules' => array('trim','max_length[200]'),
		'errors'=> array(
			'max_length'=>'*{field} trop long',
		)
	),
),
'ajouterClient' => array(
	array(
		'field' => 'client-nom',
		'label' => 'Nom',
		'rules' => array('trim','required','max_length[50]'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter {field}',
			'max_length'=>'*{field} trop long',
		)
	),
	array(
		'field' => 'client-representant',
		'label' => 'Nom',
		'rules' => array('trim','required','max_length[50]'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter {field}',
			'max_length'=>'*{field} trop long',
		)
	),
	array(
		'field' => 'client-email',
		'label' => 'Email',
		'rules' => array('trim','required','max_length[50]','valid_email'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter  {field}',
			'max_length'=>'*{field} trop long',
			'valid_email'=>'Email invalide'
		)
	),
	array(
		'field' => 'client-tel',
		'label' => 'Téléphone',
		'rules' => array('trim','required','max_length[15]','min_length[5]','numeric'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter {field}',
			'max_length'=>'*{field} trop long',
			'min_length'=>'*{field} invalide',
			'numeric'=>'*{field} invalide'
		)
	),
	array(
		'field' => 'client-fax',
		'label' => 'Fax',
		'rules' => array('trim','max_length[15]','min_length[5]','numeric'),
		'errors'=> array(
			'max_length'=>'*{field} trop long',
			'min_length'=>'*{field} invalide',
			'numeric'=>'*{field} invalide'
		)
	),
	array(
		'field' => 'client-identifiant',
		'label' => 'Identifiant',
		'rules' => array('trim','max_length[50]','required'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter {field}',
			'max_length'=>'*{field} trop long',
		)
	),
	array(
		'field' => 'client-adresse',
		'label' => 'Adresse',
		'rules' => array('trim','max_length[250]'),
		'errors'=> array(
			'max_length'=>'*{field} trop long'
		)
	),
	array(
		'field' => 'client-ice',
		'label' => 'ICE',
		'rules' => array('trim','max_length[40]','numeric','min_length[15]','required'),
		'errors'=> array(
			'required'=>'*Veuillez ajouter {field}',
			'max_length'=>'*{field} trop long',
			'min_length'=>'*{field} invalide',
			'numeric'=>'*{field} invalide'
		)
	)
));
?>
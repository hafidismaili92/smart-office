<?php
$moncompte = array('ajouterStache' => array(
        array(
            'field' => 'affaire-sTache-delai',
            'label' => 'Delai sous-tache',
            'rules' => array('trim','required','max_length[5]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),
        array(
            'field' => 'affaire-sTache-dossier',
            'label' => 'Nom dossier',
            'rules' => array('trim','max_length[30]'),
            'errors'=> array(

                'max_length'=>'*{field} trop long',
                
            )
        ),
        array(
            'field' => 'sTaches-Libelle',
            'label' => 'Libelle',
            'rules' => array('trim','required','max_length[100]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'affaire',
            'label' => 'affaire',
            'rules' => array('trim','required','max_length[50]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'tache',
            'label' => 'Tache-mère',
            'rules' => array('trim','required','max_length[50]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        
    ),
    'ajouterMission' => array(
        array(
            'field' => 'affaire-mission-delai',
            'label' => 'Delai mission',
            'rules' => array('trim','required','max_length[5]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),
        array(
            'field' => 'missions-Libelle',
            'label' => 'Libelle',
            'rules' => array('trim','required','max_length[150]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'affaire',
            'label' => 'affaire',
            'rules' => array('trim','required','max_length[50]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'info-supp',
            'label' => 'Information Supplémentaires',
            'rules' => array('trim', 'max_length[1000]'),
            'errors'=> array(
                
                'max_length'=>'*{field} trop long'
            )
        )
        
    )
    ,
    'editMission' => array(
        array(
            'field' => 'edit-num-mission',
            'label' => 'Numéro mission',
            'rules' => array('trim','required','numeric'),
            'errors'=> array(
                
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),
        array(
            'field' => 'edit-mission-delai',
            'label' => 'Delai mission',
            'rules' => array('trim','required','max_length[5]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),
        array(
            'field' => 'edit-missions-libelle',
            'label' => 'Libelle',
            'rules' => array('trim','required','max_length[100]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'affaire',
            'label' => 'affaire',
            'rules' => array('trim','required','max_length[50]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        )
        
    ),
    'updateMission' => array(
        array(
            'field' => 'avancement',
            'label' => 'Avancement',
            'rules' => array('trim','max_length[3]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),
         array(
            'field' => 'numero',
            'label' => 'numero Tâche',
            'rules' => array('trim','required','max_length[50]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'observation',
            'label' => 'Observation',
            'rules' => array('trim','max_length[300]'),
            'errors'=> array(
                
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'numero_affaire',
            'label' => 'numero Affaire',
            'rules' => array('trim','required','max_length[50]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter {field}',
                'max_length'=>'*{field} trop long'
            )
        )
        
    ),
    'ajouterAffaire' => array(
        array(
            'field' => 'numero',
            'label' => 'Numero',
            'rules' => array('trim','required','max_length[30]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                
            )
        ),
        array(
            'field' => 'libelle',
            'label' => 'Libelle',
            'rules' => array('trim','max_length[100]','required'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter {field}',
                'max_length'=>'*{field} trop long',
                
            )
        ),
        array(
            'field' => 'numero-contrat',
            'label' => 'Numero Contrat',
            'rules' => array('trim','max_length[100]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                
            )
        ),
        array(
            'field' => 'delai',
            'label' => 'Delai',
            'rules' => array('trim','required','max_length[5]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),
        array(
            'field' => 'observations',
            'label' => 'Observation',
            'rules' => array('trim','max_length[500]'),
            'errors'=> array(

                'max_length'=>'*{field} trop long',
                
            )
        ),
    ),
    'editAffaire' => array(
        array(
            'field' => 'edit-num-affaire',
            'label' => 'Numero',
            'rules' => array('trim','required','max_length[20]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                
            )
        ),
        array(
            'field' => 'edit-affaires-libelle',
            'label' => 'Libelle',
            'rules' => array('trim','max_length[100]','required'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter {field}',
                'max_length'=>'*{field} trop long',
                
            )
        ),

        array(
            'field' => 'edit-affaire-delai',
            'label' => 'Delai',
            'rules' => array('trim','required','max_length[5]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),
        array(
            'field' => 'edit-affaire-statut',
            'label' => 'Statut',
            'rules' => array('trim','required','in_list[0,1]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'numeric'=>'*{field} invalide',
                'in_list'=>'*{field} non valide'
            )
        ),
        array(
            'field' => 'edit-affaire-observations',
            'label' => 'Observation',
            'rules' => array('trim','max_length[500]'),
            'errors'=> array(

                'max_length'=>'*{field} trop long',
                
            )
        ),
       
    ));
?>
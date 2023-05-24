<?php

$rh = array(

    'ajouterEntreprise' => array(
        array(
            'field' => 'entreprise-nom',
            'label' => 'Nom Entreprise',
            'rules' => array('trim','required','max_length[50]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter {field}',
                'max_length'=>'*{field} trop long',
                
            )
        ),
        array(
            'field' => 'entreprise-domaine',
            'label' => 'Domaine d\'Activité',
            'rules' => array('trim','max_length[150]','required'),
            'errors'=> array(

                'max_length'=>'*{field} trop long',
                'required'=>'*Veuillez ajouter  {field}',
            )
        ),
        array(
            'field' => 'entreprise-email',
            'label' => 'Email Entreprise',
            'rules' => array('trim','required','max_length[50]','valid_email'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter  {field}',
                'max_length'=>'*{field} trop long',
                'valid_email'=>'Email invalide'
            )
        ),
        array(
            'field' => 'entreprise-tel',
            'label' => 'Téléphone Entreprise',
            'rules' => array('trim','max_length[15]','min_length[5]','numeric'),
            'errors'=> array(
                
                'max_length'=>'*{field} trop long',
                'min_length'=>'*{field} invalide',
                'numeric'=>'*{field} invalide'
            )
        ),
        /*array(
            'field' => 'salaire-base',
            'label' => 'Salaire de Base',
            'rules' => array('trim','required','max_length[15]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),*/
        array(
            'field' => 'entreprise-fax',
            'label' => 'Fax Entreprise',
            'rules' => array('trim','max_length[15]','min_length[5]','numeric'),
            'errors'=> array(
                
                'max_length'=>'*{field} trop long',
                'min_length'=>'*{field} invalide',
                'numeric'=>'*{field} invalide'
            )
        ),
        
        array(
            'field' => 'entreprise-adresse',
            'label' => 'Adresse Entreprise',
            'rules' => array('trim','max_length[250]'),
            'errors'=> array(
                
                
                'max_length'=>'*{field} trop long'
            )
        ),
         array(
            'field' => 'entreprise-ville',
            'label' => 'Ville Entreprise',
            'rules' => array('trim','required','max_length[30]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'greater_than_equal_to'=>'*{field} trop long',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'entreprise-ice',
            'label' => 'ICE',
            'rules' => array('trim','max_length[40]','numeric','min_length[15]'),
            'errors'=> array(
                
                'max_length'=>'*{field} trop long',
                'min_length'=>'*{field} invalide',
                'numeric'=>'*{field} invalide'
            )
        ),
        array(
            'field' => 'employe-prenom',
            'label' => 'Prenom Directeur',
            'rules' => array('trim','required','max_length[30]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'alpha'=>'* le {field} ne peut comporter que des caractères'
            )
        ),
        array(
            'field' => 'employe-nom',
            'label' => 'Nom Directeur',
            'rules' => array('trim','required','max_length[30]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter le {field}',
                'alpha'=>'* le {field} ne peut comporter que des caractères',
                'max_length'=>'*{field} trop long',
            )
        ),
        array(
            'field' => 'employe-email',
            'label' => 'Email Directeur',
            'rules' => array('trim','required','max_length[100]','valid_email'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'valid_email'=>'{field} invalide'
            )
        ),
        array(
            'field' => 'employe-tel',
            'label' => 'Telephone Directeur',
            'rules' => array('trim','max_length[20]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'{field} invalide'
            )
        ),

    ),
    'ajouterEmployee' => array(
        array(
            'field' => 'employe-prenom',
            'label' => 'Prenom',
            'rules' => array('trim','required','max_length[30]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'alpha'=>'* le {field} ne peut comporter que des caractères'
            )
        ),
        array(
            'field' => 'employe-nom',
            'label' => 'Nom',
            'rules' => array('trim','required','max_length[30]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter le {field}',
                'alpha'=>'* le {field} ne peut comporter que des caractères',
                'max_length'=>'*{field} trop long',
            )
        ),
        array(
            'field' => 'employe-cin',
            'label' => 'CIN',
            'rules' => array('trim','required','max_length[30]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'employe-situation',
            'label' => 'statut familial',
            'rules' => array('trim','in_list[Célebataire,Marié,Divorcé,Remarié,Veuf]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'greater_than_equal_to'=>'*{field} trop long',
                'in_list'=>'*{field} non valide'
            )
        ),
        array(
            'field' => 'employe-residence',
            'label' => 'Résidence',
            'rules' => array('trim','required','max_length[30]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'greater_than_equal_to'=>'*{field} trop long',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'employe-sexe',
            'label' => 'Sexe',
            'rules' => array('trim','required','in_list[M,F]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'greater_than_equal_to'=>'*{field} trop long',
                'in_list'=>'*{field} non valide'
            )
        ),
        array(
            'field' => 'employe-date-naissance',
            'label' => 'Date naissance',
            'rules' => array('trim','required','max_length[15]','validateDate'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'greater_than_equal_to'=>'*{field} trop long',
                'max_length'=>'*{field} trop long',
                'validateDate'=>'*{field} non valide'
            )
        ),
        array(
            'field' => 'employe-lieu-naissance',
            'label' => 'Lieu de naissance',
            'rules' => array('trim','max_length[30]'),
            'errors'=> array(
                
                'greater_than_equal_to'=>'*{field} trop long',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'employe-date-recrutement',
            'label' => 'Date de recrutement',
            'rules' => array('trim','required','max_length[15]','validateDate',[
                'check_date_less', 
                function( $date ) {
                    return $this->dateLess($date,[date('d-m-Y'),0]); 
                }
            ]),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'greater_than_equal_to'=>'*{field} trop long',
                'max_length'=>'*{field} trop long',
                'validateDate'=>'*{field} non valide',
                'check_date_less'=>'*{field} doit être inferieur à : '.date('d-m-Y'),
            )
        ),
        array(
            'field' => 'employe-adresse',
            'label' => 'Adresse',
            'rules' => array('trim','max_length[500]'),
            'errors'=> array(
                
                'greater_than_equal_to'=>'*{field} trop long',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'employe-type-contrat',
            'label' => 'Type de contrat',
            'rules' => array('trim','max_length[20]'),
            'errors'=> array(
                
                'greater_than_equal_to'=>'*{field} trop long',
                'max_length'=>'*{field} trop long'
            )
        ),
        
        array(
            'field' => 'employe-diplome',
            'label' => 'Diplome',
            'rules' => array('trim','max_length[40]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'greater_than_equal_to'=>'*{field} trop long',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'employe-etablissement',
            'label' => 'Etablissement',
            'rules' => array('trim','required','max_length[100]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'greater_than_equal_to'=>'*{field} trop long',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'employe-fonction',
            'label' => 'Fonction',
            'rules' => array('trim','required','max_length[100]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'greater_than_equal_to'=>'*{field} trop long',
                'max_length'=>'*{field} trop long'
            )
        ),
        
        array(
            'field' => 'employe-banque',
            'label' => 'banque',
            'rules' => array('trim','max_length[50]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'greater_than_equal_to'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'employe-rib',
            'label' => 'RIB',
            'rules' => array('trim','max_length[30]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'{field} invalide'
            )
        ),
        array(
            'field' => 'employe-email',
            'label' => 'Email',
            'rules' => array('trim','required','max_length[100]','valid_email'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'valid_email'=>'{field} invalide'
            )
        ),
        array(
            'field' => 'employe-tel',
            'label' => 'Telephone',
            'rules' => array('trim','max_length[20]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'{field} invalide'
            )
        ),

    ),
'updateEntrepriseConfig' => array(
array(
            'field' => 'conge_annee',
            'label' => 'Nbr Jours Congé',
            'rules' => array('trim','required','max_length[5]','numeric','greater_than[0]','less_than[366]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide',
                'greater_than'=>'*{field} doit être supérieur à 0',
                'less_than'=>'*{field} dépasse 365 Jours !',
            )
        ),
array(
            'field' => 'jour_semaine',
            'label' => 'Jour par semaine',
            'rules' => array('trim','required','max_length[5]','numeric','greater_than[0]','less_than[8]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide',
                'greater_than'=>'*{field} doit être supérieur à 0',
                'less_than'=>'*{field} dépasse 365 Jours !',
            )
        ),
array(
            'field' => 'heure_debut_travail',
            'label' => 'heure-debut',
            'rules' => array('trim','required','max_length[7]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
               
            )
        ),
array(
            'field' => 'heure_fin_travail',
            'label' => 'heure-debut',
            'rules' => array('trim','required','max_length[7]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
               
            )
        ),
),
    'ajouterFonction' => array(
        array(
            'field' => 'fonctions-Libelle',
            'label' => 'Fonction',
            'rules' => array('trim','required','max_length[50]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'fonction-classe',
            'label' => 'Classe',
            'rules' => array('trim','required','max_length[25]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'fonction-type',
            'label' => 'Tpe Fonction',
            'rules' => array('trim','required','max_length[20]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        
    ),
    'ajouterEtablissement' => array(
        array(
            'field' => 'etablissements-Libelle',
            'label' => 'Etablissement',
            'rules' => array('trim','required','max_length[50]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'etablissement-mere',
            'label' => 'Etablissement mère',
            'rules' => array('trim','required','max_length[50]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'etablissement-type',
            'label' => 'Tpe Etablissement',
            'rules' => array('trim','required','max_length[20]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter  {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        
    ),
    'ajouterClasse' => array(
        array(
            'field' => 'classe-Libelle',
            'label' => 'Classe',
            'rules' => array('trim','required','max_length[50]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'classe-salaire',
            'label' => 'Salaire',
            'rules' => array('trim','required','max_length[15]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        )
    ),
    'ajouterAbsence' => array(

        array(
            'field' => 'absence-justif',
            'label' => 'Justification',
            'rules' => array('trim','required','max_length[20]','in_list[sans,Bon-sortie]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter {field}',
                'max_length'=>'*{field} trop long',
                'in_list'=>'*{field} invalide'
            )
        ),
        array(
            'field' => 'time-debut-absence',
            'label' => 'heure-debut',
            'rules' => array('trim','required','max_length[7]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
               
            )
        ),
        array(
            'field' => 'time-fin-absence',
            'label' => 'heure Fin',
            'rules' => array('trim','required','max_length[7]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                
                'compareTime'=>'{field} doit être supérieure à heure de début'
            )
        ),
        array(
            'field' => 'date-absence',
            'label' => 'Date absence',
            'rules' => array('trim','required','validateDate','max_length[20]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'validateDate'=>'{field} invalide'
            )
        ),
        array(
            'field' => 'matricule-form-absence',
            'label' => 'matricule',
            'rules' => array('trim','required','max_length[10]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter  {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
    ),
    'ajouterConge' => array(

        array(
            'field' => 'conge-debut',
            'label' => 'Date début',
            'rules' => array('trim','required','validateDate','max_length[20]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'validateDate'=>'{field} invalide'
            )
        ),
        array(
            'field' => 'conge-fin',
            'label' => 'Date Fin',
            'rules' => array('trim','required','validateDate','max_length[20]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'validateDate'=>'{field} invalide'
            )
        ),
        array(
            'field' => 'conge-timedebut',
            'label' => 'heure-Debut',
            'rules' => array('trim','required','max_length[7]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                
            )
        ),
        array(
            'field' => 'conge-timefin',
            'label' => 'heure-Fin',
            'rules' => array('trim','required','max_length[7]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                
            )
        ),
        array(
            'field' => 'conge-exclure',
            'label' => 'Jour à exclure',
            'rules' => array('trim','max_length[3]','numeric'),
            'errors'=> array(
                
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),
        array(
            'field' => 'conge-matricule',
            'label' => 'matricule',
            'rules' => array('trim','required','max_length[10]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter  {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'type-conge',
            'label' => 'type congé',
            'rules' => array('trim','required','in_list[CR,ML,RP]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter  {field}',
                'in_list'=>'*{field} invalide'
            )
        ),
        array(
            'field' => 'conge-observation',
            'label' => 'Observation',
            'rules' => array('trim','max_length[100]'),
            'errors'=> array(

                'max_length'=>'*{field} trop long',
                
            )
        ),
    ),
    'ajouterDeplacement' => array(

        array(
            'field' => 'deplacement-matricule',
            'label' => 'matricule',
            'rules' => array('trim','required','max_length[10]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter  {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'deplacement-objet',
            'label' => 'Objet',
            'rules' => array('trim','required','max_length[100]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter  {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'deplacement-lieu',
            'label' => 'Lieu',
            'rules' => array('trim','required','max_length[30]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter  {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'deplacement-date',
            'label' => 'Date',
            'rules' => array('trim','required','validateDate','max_length[20]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'validateDate'=>'{field} invalide'
            )
        ),
        array(
            'field' => 'deplacement-designation',
            'label' => 'Designation travaux',
            'rules' => array('trim','max_length[100]','required'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                
            )
        ),
        array(
            'field' => 'deplacement-duree',
            'label' => 'Duree',
            'rules' => array('trim','required','max_length[5]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),
        array(
            'field' => 'deplacement-prix',
            'label' => 'Prix',
            'rules' => array('trim','required','max_length[5]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),
    ),
    'ajouterHeuresSup' => array(

        array(
            'field' => 'heureSup-matricule',
            'label' => 'matricule',
            'rules' => array('trim','required','max_length[10]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter  {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        
        array(
            'field' => 'heureSup-datedb',
            'label' => 'Date',
            'rules' => array('trim','required','validateDate','max_length[20]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'validateDate'=>'{field} invalide'
            )
        ),
        array(
            'field' => 'heureSup-datefn',
            'label' => 'Date',
            'rules' => array('trim','required','validateDate','max_length[20]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'validateDate'=>'{field} invalide'
            )
        ),
        array(
            'field' => 'heureSup-justif',
            'label' => 'Designation travaux',
            'rules' => array('trim','max_length[100]','required'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                
            )
        ),
        array(
            'field' => 'heureSup-nbr',
            'label' => 'Nombre heures',
            'rules' => array('trim','required','max_length[5]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),
        array(
            'field' => 'heureSup-prix',
            'label' => 'Prix',
            'rules' => array('trim','required','max_length[5]','numeric'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long',
                'numeric'=>'*{field} invalide'
            )
        ),
    ));
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
/*Affaires ROUTES*/
$route['default_controller'] = 'Main';/*'GeoBusiness_main'*/;
//$route['default_controller'] = 'GeoBusiness_main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['NouvelleAffaire/(:any)'] = 'GestionAffaire/UserSections/NouvelleAffaire/$1';
$route['Details/(:any)'] = 'GestionAffaire/UserSections/Details/$1';
$route['Documents/(:any)'] = 'GestionAffaire/UserSections/Documents/$1';
$route['Affaires/(:any)'] = 'GestionAffaire/UserSections/Affaires/$1';
$route['Taches/(:any)'] = 'GestionAffaire/UserSections/Taches/$1';
$route['Affaire_missions/(:any)'] = 'GestionAffaire/UserSections/Affaire_missions/$1';
$route['Tache_Staches/(:any)'] = 'GestionAffaire/UserSections/Tache_Staches/$1';
$route['User_Fiches_loader/(:any)'] = 'GestionAffaire/UserSections/User_Fiches_loader/$1';
$route['GlobalAffaires/(:any)'] = 'GestionAffaire/UserSections/GlobalAffaires/$1';
$route['Taches'] = 'Users_main/tachesView';
$route['MesDocuments'] = 'Users_main/mesDocuments';

$route['Edocuments'] = 'Users_main/eDocumentView';
$route['GlobalView'] ='Users_main/globalView';
$route['Entreprise'] = 'RH_main/entrepriseView';
/*Employee ROUTES*/
$route['Employes/(:any)'] = 'GestionRH/RhSections/Employes/$1';
$route['Fonctions/(:any)'] = 'GestionRH/RhSections/Fonctions/$1';
$route['Etablissements/(:any)'] = 'GestionRH/RhSections/Etablissements/$1';
$route['Classes/(:any)'] = 'GestionRH/RhSections/Classes/$1';
$route['GestionAbsence/(:any)'] = 'GestionRH/RhSections/GestionAbsence/$1';
$route['GestionConges/(:any)'] = 'GestionRH/RhSections/GestionConges/$1';
$route['GestionDeplacement/(:any)'] = 'GestionRH/RhSections/GestionDeplacement/$1';
$route['GestionHeuresSup/(:any)'] = 'GestionRH/RhSections/GestionHeuresSup/$1';
$route['ImgProfil'] = 'GestionRH/RhSections/Employes/ImgProfil';
$route['AddEmploye'] = 'RH_main/addEmpView';
$route['Organisation'] = 'RH_main/organisationView';
/*CONTRAT ROUTES*/
$route['NouveauContrat/(:any)'] = 'GestionContrat/NouveauContrat/$1';
$route['NouvelleFacture/(:any)'] = 'GestionContrat/NouvelleFacture/$1';
$route['ListeFacture/(:any)'] = 'GestionContrat/ListeFacture/$1';
$route['Contrats/(:any)'] = 'GestionContrat/Contrats/$1';
$route['ExcelOperations/(:any)'] = 'GestionContrat/ExcelOperations/$1';
$route['Clients/(:any)'] = 'GestionContrat/Clients/$1';
$route['Dashboard/(:any)'] = 'GestionContrat/Dashboard/$1';
$route['Devis/(:any)'] = 'GestionContrat/Devis/$1';
$route['Dashboard'] = 'Contrat_main/getDashboard';
$route['NewContrat'] = 'Contrat_main/newContratView';
$route['Devis'] = 'Contrat_main/devisView';
$route['Clients'] = 'Contrat_main/clientView';

/*geoBusiness Routes*/
$route['EditGeoBusiness/(:any)'] = 'GeoBusiness/EditGeoBusiness/$1';
$route['Attachements/(:any)'] = 'GeoBusiness/Attachements/$1';
$route['Bmap/(:any)/(:any)/(:any)'] = 'GeoBusiness/EditComoposantes/Getbmp/$1/$2/$3';
$route['EditComoposantes/(:any)'] = 'GeoBusiness/EditComoposantes/$1';
/*admin routes*/
$route['admin/(:any)'] = 'admin/AdminController/$1';
$route['admin'] = 'admin/AdminController/index';
$route['demandesView'] = $route['admin'];
$route['listeView'] = 'admin/AdminController/listeView';
$route['logOutAdmin'] = 'admin/AdminController/logOut';
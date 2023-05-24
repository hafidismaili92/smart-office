<?php
include_once('validationRules/contrat.php');
include_once('validationRules/rh.php');
include_once('validationRules/login.php');
include_once('validationRules/moncompte.php');
include_once('validationRules/geobusiness.php');
$config = array_merge($rh,$moncompte,$contrat,$login,$geobusiness);

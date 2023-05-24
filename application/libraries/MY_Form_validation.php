<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation{    
   function __construct($config = array()){
      parent::__construct($config);
  }
 



public function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}
/*public function dateLess($datestring,$referenceDate,$years=0)
{
    //$referenceDate = new DateTime('31-12-'.date('Y'));
    $date= new DateTime($datestring);
    $dateRef= new DateTime($referenceDate);
    if($years>0)
        $dateRef->sub(new DateInterval('P'.$years.'Y'));
    $interval = date_diff($date,$dateRef); 
    return $interval->format('%R%a') <0?false:true;
}*/

}

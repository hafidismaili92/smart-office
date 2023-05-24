<?php
/**
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Date_operations 
{
	
	public function daysCalculator($date_debut,$date_fin,$absolute=true)
	{
		/*les arguments sont de type datetime*/
		$interval = date_diff($date_debut, $date_fin); 

		// Display the result 
		return $absolute?$interval->format('%a'):$interval->format('%R%a');
		/*$reliquat = (12-date("n"));
		echo $reliquat;*/
	}
	public function compareDateTime($dtSup,$dtInf)
	{
		$fin = strtotime($dtSup);  
		$debut = strtotime($dtInf);

return ($fin-$debut)/(24*60*60); // en jours

}
public function validateTime($time,$hdebut,$hfin)
  {
        //Assume $str SHOULD be entered as HH:MM

    list($hh, $mm) = explode(':', $time);
    list($seuilHDB,$seuilMDB)=explode(':', $hdebut);
    list($seuilHFN,$seuilMFN)=explode(':', $hfin);
    if (!is_numeric($hh) || !is_numeric($mm))
    {

        return FALSE;
    }
    else if ((int) $hh > (int) $seuilHFN || (int) $hh < (int) $seuilHDB || (int) $mm > 59)
    {
        return FALSE;
    }
    else if (mktime((int) $hh, (int) $mm) === FALSE)
    {

        return FALSE;
    }
    
    return TRUE;

}
public function compareTwoTime($time,$timetoCompare)
{

	if($timetoCompare!=null)
	{
		list($hh, $mm) = explode(':', $time);
		
		if (!is_numeric($hh) || !is_numeric($mm))
		{

			return FALSE;
		}
		else if ((int) $hh > 23 || (int) $mm > 59)
		{
			return FALSE;
		}
		else if (mktime((int) $hh, (int) $mm) === FALSE)
		{

			return FALSE;
		}

		list($hhDb, $mmDb) = explode(':', $timetoCompare);
		if (!is_numeric($hhDb) || !is_numeric($mmDb))
		{

			return FALSE;
		}
		else if ((int) $hhDb > 23 || (int) $mmDb > 59)
		{
			return FALSE;
		}
		else if (mktime((int) $hhDb, (int) $mmDb) === FALSE)
		{

			return FALSE;
		}
		else
		{
			if(mktime((int) $hh, (int) $mm)<=mktime((int) $hhDb, (int) $mmDb))
			{
				return FALSE;
			}
		}

	}

	return TRUE;

}
public function compareTime($time,$timetoCompare,$hdebut,$hfin)
{

	if($timetoCompare!=null)
	{
		list($hh, $mm) = explode(':', $time);
		list($seuilHDB,$seuilMDB)=explode(':', $hdebut);
		list($seuilHFN,$seuilMFN)=explode(':', $hfin);
		if (!is_numeric($hh) || !is_numeric($mm))
		{

			return FALSE;
		}
		else if ((int) $hh > (int) $seuilHFN || (int) $hh < (int) $seuilHDB || (int) $mm > 59)
		{
			return FALSE;
		}
		else if (mktime((int) $hh, (int) $mm) === FALSE)
		{

			return FALSE;
		}

		list($hhDb, $mmDb) = explode(':', $timetoCompare);
		if (!is_numeric($hhDb) || !is_numeric($mmDb))
		{

			return FALSE;
		}
		else if ((int) $hhDb > (int) $seuilHFN || (int) $hhDb < (int) $seuilHDB || (int) $mmDb > 59)
		{
			return FALSE;
		}
		else if (mktime((int) $hhDb, (int) $mmDb) === FALSE)
		{

			return FALSE;
		}
		else
		{
			if(mktime((int) $hh, (int) $mm)<=mktime((int) $hhDb, (int) $mmDb))
			{
				return FALSE;
			}
		}

	}

	return TRUE;

}

function getweekEndesDates($start, $end, $weekdayArr = array(0,6)){
	$weekdays="Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday";
	$arr_weekdays=explode(",", $weekdays);
	$start= strtotime("+0 day", strtotime($start) );
	$end= strtotime($end);
	$dateArr = array();
	for ($i=0; $i <count($weekdayArr) ; $i++) { 
		$weekday = $arr_weekdays[$weekdayArr[$i]];
		if(!$weekday)
			die("Invalid Weekday!");
		$friday = strtotime($weekday, $start);
		while($friday <= $end) {
			$dateArr[] = date("Y-m-d", $friday);
			$friday = strtotime("+1 weeks", $friday);
		}
		
	}
	return $dateArr;
}
}


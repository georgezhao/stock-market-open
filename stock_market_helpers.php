<?php

/**
 * major holidays - stock market is closed
 * @author  George Zhao
 * @return array 
 */
function holidays () {
	$year = date("Y");
	$p = date("N", strtotime("February 1, $year")) == 1 ? 'second' : 'third';
	$easter = date("Y-m-d", easter_date($year));

	$holday_descriptions = array(
		"January 1, $year",
		"January $year third Monday",
		"February $year $p Monday",
		"$easter - 2 days",
		"last Monday of May $year",
		"July 4, $year",
		"september $year first monday",
		"fourth Thursday of November $year",
		"December 25, $year"
	);

	$holday_dates = array();

	foreach ($holday_descriptions as $d) {
		$holday_dates[] = date("Y-m-d", strtotime($d));
	}

	return $holday_dates;
}


/**
 * checks to see if stock market is open
 * @param  string  $date
 * @author  George Zhao
 * @return boolean
 */
function is_market_open ($date = NULL) {
	$date = $date ? $date : date('Y-m-d');
	
	if (date('N', strtotime($date)) == 6 || date('N', strtotime($date)) == 7) return FALSE;

	if (in_array($date, holidays())) return FALSE;

	return TRUE;
}

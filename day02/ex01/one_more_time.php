#!/usr/bin/php
<?php

date_default_timezone_set('Europe/Paris');

function isleapYear($year) {
	if($year % 4 == 0)
		return (true);
	return (false);
}

function checkCorrectDayNbrOfMonth($nbOfDay, $month, $year) {
	if (preg_match("/^[j|J]anvier|^m|M]ars|^[m|M]ai|^[j|J]uillet|^[a|A]out|^[o|O]ctobre|^[d|D]ecembre$/", $month) && $nbOfDay <= 31)
		return (true);
	else if (preg_match("/^[f|F]evrier$/", $month)) {
		if ($nbOfDay <= 28)
			return (true);
		else if ($nbOfDay == 29 && isleapYear($year) == true)
			return (true);
	}
	else if ($nbOfDay <= 30)
		return (true);
	return (false);
}

function getMonth($month) {
	if ($month == "janvier" || $month == "Janvier")
		return (1);
	else if ($month == "fevrier" || $month == "Fevrier")
		return (2);
	else if ($month == "mars" || $month == "Mars")
		return (3);
	else if ($month == "avril" || $month == "Avril")
		return (4);
	else if ($month == "mai" || $month == "Mai")
		return (5);
	else if ($month == "juin" || $month == "Juin")
		return (6);
	else if ($month == "juillet" || $month == "Juillet")
		return (7);
	else if ($month == "aout" || $month == "Aout")
		return (8);
	else if ($month == "septembre" || $month == "Septembre")
		return (9);
	else if ($month == "octobre" || $month == "Octobre")
		return (10);
	else if ($month == "novembre" || $month == "Novembre")
		return (11);
	else if ($month == "decembre" || $month == "Decembre")
		return (12);
}

function parseFormat($input) {
	$tab = explode(' ', $input);
	$dayOfTheWeek = $tab[0];
	$nbOfDay = $tab[1];
	$month = $tab[2];
	$year = $tab[3];
	$timeTab = explode(':', $tab[4]);
	$hours = $timeTab[0];
	$minutes = $timeTab[1];
	$seconds = $timeTab[2];
	if($year >= 1970 && checkCorrectDayNbrOfMonth($nbOfDay, $month, $year) == true && $hours < 24 && $minutes < 60 && $seconds < 60)
		echo mktime($hours, $minutes, $seconds, getMonth($month), $nbOfDay, $year)."\n";
	else
		echo "Wrong Time Format\n";
}

if ($argc == 2) {
	if (preg_match("/(^[l|L]undi|^[m|M]ardi|^[m|M]ercredi|^[j|J]eudi|^[v|V]endredi|^[s|S]amedi|^[d|D]imanche) [0-9]{1,2} ([j|J]anvier|[f|F]evrier|[m|M]ars|[a|A]vril|[m|M]ai|[j|J]uin|[j|J]uillet|[a|A]out|[s|S]eptembre|[o|O]ctobre|[n|N]ovembre|[d|D]ecembre) [0-9]{4} [0-9]{2}:[0-9]{2}:[0-9]{2}$/", $argv[1]))
		parseFormat($argv[1]);
	else
		echo "Wrong Format\n";
}

?>

<?php	
/**
 * @package Helpers
 * @category Concrete
 * @author Andrew Embler <andrew@concrete5.org>
 * @copyright  Copyright (c) 2003-2008 Concrete5. (http://www.concrete5.org)
 * @license    http://www.concrete5.org/license/     MIT License
 */

/**
 * Functions useful functions for working with dates.
 * @package Helpers
 * @category Concrete
 * @author Andrew Embler <andrew@concrete5.org>
 * @copyright  Copyright (c) 2003-2008 Concrete5. (http://www.concrete5.org)
 * @license    http://www.concrete5.org/license/     MIT License
 */

defined('C5_EXECUTE') or die("Access Denied.");

// Load a compatiblity class for pre php 5.2 installs
Loader::library('datetime_compat');

class DateHelper {

	/** 
	 * Gets the date time for the local time zone/area if user timezones are enabled, if not returns system datetime
	 * @param string $systemDateTime
	 * @param string $format
	 * @return string $datetime
	 */
	public function getLocalDateTime($systemDateTime = 'now', $mask = NULL) {
		if(!isset($mask) || !strlen($mask)) {
			$mask = 'Y-m-d H:i:s';
		}
		
		if(!isset($systemDateTime) || !strlen($systemDateTime)) {
			return NULL; // if passed a null value, pass it back
		} elseif(strlen($systemDateTime)) {
			$datetime = new DateTime($systemDateTime);
		} else {
			$datetime = new DateTime();
		}
		
		if(defined('ENABLE_USER_TIMEZONES') && ENABLE_USER_TIMEZONES) {
			$u = new User();
			if($u && $u->isRegistered()) {
				$utz = $u->getUserTimezone();
				if($utz) {
					$tz = new DateTimeZone($utz);
					$datetime->setTimezone($tz);
				}
			}
		}
		return $datetime->format($mask);
	}

	/** 
	 * Converts a user entered datetime to the system datetime
	 * @param string $userDateTime
	 * @param string $systemDateTime
	 * @return string $datetime
	 */
	public function getSystemDateTime($userDateTime = 'now', $mask = NULL) {
		if(!isset($mask) || !strlen($mask)) {
			$mask = 'Y-m-d H:i:s';
		}
		
		if(!isset($userDateTime) || !strlen($userDateTime)) {
			return NULL; // if passed a null value, pass it back
		} elseif(strlen($userDateTime)) {
			$datetime = new DateTime($userDateTime);
			
			if (defined('APP_TIMEZONE')) {
				$tz = new DateTimeZone(APP_TIMEZONE_SERVER);
				$datetime = new DateTime($userDateTime,$tz); // create the in the user's timezone 				
				$stz = new DateTimeZone(date_default_timezone_get()); // grab the default timezone
				$datetime->setTimeZone($stz); // convert the datetime object to the current timezone
			}
			
			if(defined('ENABLE_USER_TIMEZONES') && ENABLE_USER_TIMEZONES) {
				$u = new User();
				if($u && $u->isRegistered()) {
					$utz = $u->getUserTimezone();
					if($utz) {			
						$tz = new DateTimeZone($utz);
						$datetime = new DateTime($userDateTime,$tz); // create the in the user's timezone 
						
						$stz = new DateTimeZone(date_default_timezone_get()); // grab the default timezone
						$datetime->setTimeZone($stz); // convert the datetime object to the current timezone
					} 
				}
			}
		} else {
			$datetime = new DateTime();
		}
		return $datetime->format($mask);
	}

	/**
	 * returns a keyed array of timezone identifiers
	 * see: http://www.php.net/datetimezone.listidentifiers.php
	 * @return array:
	 */
	public function getTimezones() {
		return array_combine(DateTimeZone::listIdentifiers(),DateTimeZone::listIdentifiers());
	}

	
	public function timeSince($posttime,$precise=0){
		$timeRemaining=0;
		$diff=date("U")-$posttime;
		$days=intval($diff/(24*60*60));
		$hoursInSecs=$diff-($days*(24*60*60));
		$hours=intval($hoursInSecs/(60*60));
		if ($hours<=0) $hours=$hours+24;           
		if ($posttime>date("U")) return date(DATE_APP_GENERIC_MDY,$posttime);
		else{
			if ($diff>86400){
					$diff=$diff+86400;
					$days=date("z",$diff);
					$timeRemaining=$days.' ';
					if($days!=1) {
						$timeRemaining.=t('days');
					} else {
						$timeRemaining.=t('day');
					}
					if($precise==1) $timeRemaining.=', '.$hours.' '.t('hours');
				} else if ($diff>3600) {
					$timeRemaining=$hours.' ';
					if($hours!=1) {
						$timeRemaining.=t('hours');
					} else {
						$timeRemaining.=t('hour');
					}
					if($precise==1) $timeRemaining.=', '.date("i",$diff).' '.t('minutes');
				}else if ($diff>60){
					$minutes=date("i",$diff);
					if(substr($minutes,0,1)=='0') $minutes=substr($minutes,1);
					$timeRemaining=$minutes.' ';
					if($minutes!=1) {
						$timeRemaining.=t('minutes');
					} else {
						$timeRemaining.=t('minute');
					}
					if($precise==1) $timeRemaining.=', '.date("s",$diff).' '.t('seconds');
				}else{
					$seconds=date("s",$diff);
					if(substr($seconds,0,1)=='0') $seconds=substr($seconds,1);
					$timeRemaining=$seconds.' ';
					if($seconds!=1) {
						$timeRemaining.=t('seconds');
					} else {
						$timeRemaining.=t('second');
					}
				}
		}
		return $timeRemaining;
	}//end timeSince

}

?>
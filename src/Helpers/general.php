<?php
function isFrameworkDebug() {
	return defined('DEV') && constant('DEV');
}

function token($length = 32) {
	// Create random token
	$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	
	$max = strlen($string) - 1;
	
	$token = '';
	
	for ($i = 0; $i < $length; $i++) {
		$token .= $string[mt_rand(0, $max)];
	}	
	
	return $token;
}

function nowMySQLTimestamp() {
    return date(MYSQL_TIMESTAMP);
}

function strToMySQLTimestamp(string $str) {
    return date(MYSQL_TIMESTAMP, strtotime($str));
}

function dateIntervalToSeconds(\DateInterval $diff) {
    //Years to seconds
    $seconds = $diff->y * 12 * 30 * 24 * 60 * 60;
    //Monthes to seconds
    $seconds = $seconds + ($diff->m * 30 * 24 * 60 * 60);
    //Days to seconds
    $seconds = $seconds + ($diff->d * 24 * 60 * 60);
    //Hours to seconds
    $seconds = $seconds + (60 * 60 * $diff->h);
    //Minutes to seconds
    $seconds = $seconds + (60 * $diff->i);
    //Seconds
    $seconds = $seconds + $diff->s;

    return $seconds;
}

function getImageExtensions() {
    return array('png', 'jpg', 'jpeg', 'gif', 'webp');
}

function getImageMimeTypes() {
    return array(
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/x-png',
        'image/gif',
        'image/webp'
    );
}

function removeSpaces($string) {
    return str_replace(' ', '', $string);
}

function replaceSpaces($string, $replace = '-') {
    return str_replace(' ', $replace, $string);
}

function removeSymbols($string) {
    $symbols = array('!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '+', '-', '=', ',', '.');
    return str_replace($symbols, '', $string);
}

function getSeoUrlByName(string $name): string {
    return replaceSpaces(utf8_strtolower(removeSymbols($name)));
}

function getFileExt($file) {
    return strtolower(pathinfo($file, PATHINFO_EXTENSION));
}

function transliterate($textcyr = null, $textlat = null) {
    $cyr = array(
        'ж',  'ч',  'щ',   'ш',  'ю',  'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
        'Ж',  'Ч',  'Щ',   'Ш',  'Ю',  'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я', 'і', 'І', 'ї', 'Ї', 'є', 'Є');
    $lat = array(
        'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'q',
        'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Q', 'i', 'I', 'y', 'Y', 'e', 'E');
    if($textcyr) return str_replace($cyr, $lat, $textcyr);
    else if($textlat) return str_replace($lat, $cyr, $textlat);
    else return null;
}

function getUrlParamValue($url, $parameter) {
	$components = parse_url(str_replace('&amp;', '&', $url));
	$query = array();
	parse_str($components['query'], $query);
	return isset($query[$parameter]) ? $query[$parameter] : '';
};

function getUrlPathLast($url) {
	$array = explode('/', $url);
	return end($array);
};

function extractRoute($uri) {
	$route = '';
	if (($pos = utf8_strpos($uri, '?route=')) !== false) {
		$start = $pos + 7;
		if (($amp_pos = utf8_strpos($uri, '&')) !== false) {
			$length = $amp_pos - $start;
		} else {
			$length = utf8_strlen($uri) - $start;
		}
		$route = utf8_substr($uri, $start, $length);
	}
	return $route;
}
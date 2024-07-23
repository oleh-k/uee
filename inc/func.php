<?php

function protectEmail($email, $text=''){
	$encoded="";
	for ($n=0; $n<strlen($email); $n++) {
		$check=htmlentities($email[$n], ENT_QUOTES);
		$email[$n]==$check?$encoded.="&#".ord($email[$n]).";":$encoded.=$check;
	}
	return '<a href="&#109;&#x61;&#105;&#x6c;&#116;&#x6f;&#58;'.$encoded.'">'.($text?$text:$encoded).'</a>';
}

function translit($str){ // для букв украинского языка
	$str=trim(preg_replace('/\s+/u', '-', $str), '-');
	$l=array("а"=>"a", "б"=>"b", "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"e", "ж"=>"zh", "з"=>"z", "и"=>"y", "й"=>"j", "к"=>"k", "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p", "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f", "х"=>"h", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"sh", "ъ"=>"", "ы"=>"y", "ь"=>"", "э"=>"e", "ю"=>"yu", "я"=>"ya", "і"=>"i", "ї"=>"i", "є"=>"e", "А"=>"A", "Б"=>"B", "В"=>"V", "Г"=>"G", "Д"=>"D", "Е"=>"E", "Ё"=>"E", "Ж"=>"Zh", "З"=>"Z", "И"=>"Y", "Й"=>"J", "К"=>"K", "Л"=>"L", "М"=>"M", "Н"=>"N", "О"=>"O", "П"=>"P", "Р"=>"R", "С"=>"S", "Т"=>"T", "У"=>"U", "Ф"=>"F", "Х"=>"H", "Ц"=>"Ts", "Ч"=>"Ch", "Ш"=>"Sh", "Щ"=>"Sh", "Ъ"=>"", "Ы"=>"Y", "Ь"=>"", "Э"=>"E", "Ю"=>"YU", "Я"=>"Ya", "І"=>"I", "Ї"=>"I", "Є"=>"E");
	$str=preg_replace('/-+/', '-', strtolower(strtr($str, $l)));
	$str=preg_replace('/[^0-9a-zA-Z_-]/i', '', $str);
	return $str;
}

function get_agent_cols_array( $name ) {
	$result = [];
	for ( $i = 1; $i <= BROKER_COUNT; $i++ ) {
		$result[] = $name . $i;
	}
	return $result;
}

function get_agent_info_headers() {
	return get_agent_cols_array( 'agent_info' );
}

function get_agent_docs() {
	return get_agent_cols_array( 'agent_mobile_phone' );
}

function extract_number_from_end( $str ) {
	if ( preg_match( '/([0-9]+)$/', $str, $_matches ) ) {
		return (int) $_matches[1];
	}
	return 0;
}

function clear_hyphen( $str ) {
	return str_replace( '­', '', $str );
}

function db_set_array( $_set ) {
	$_sql = array();
	foreach( $_set AS $col => $val ) {
		$_sql[] = "$col = '$val'";
	}
	return implode( ', ', $_sql);
}
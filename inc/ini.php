<?php

define( 'BROKER_COUNT', 3 );

$_iban_fields = [ 'banking_account1', 'banking_account2', 'banking_account3' ];

$form_fieldtype_class = [
	'1' => 'form-control',
	'2' => 'form-control',
	'3' => 'custom-select',
	'4' => 'checkbox-multiple',
	'6' => 'form-check-input',
];

$hostname = '127.0.0.1';
$dbname = 'ueex_tt';
$dbusername = 'root';
$dbpassword = '';

$db_connect = @mysql_connect( $hostname, $dbusername, $dbpassword ) or die( 'DB connection failed!' );
mysql_select_db( $dbname ) or die( mysql_error() );
mysql_query( "SET NAMES utf8, character_set_results='utf8', collation_connection='utf8_general_ci'" );
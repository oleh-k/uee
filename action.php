<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/ini.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/func.php';

$info_text3 = NULL;
$db = false;
$_db_rows = array();
$type = isset( $_POST['registration_type'] ) ? $_POST['registration_type'] : 'exch';

$query = mysql_query( "SELECT `fieldtype`, `mandatory`, `name`, `regexp` FROM `inputs_$type`" );
while ( $_row = mysql_fetch_assoc( $query ) ) {
	$key = $_row['name'];
	if ( isset( $_POST[ $key ] ) ) {
		$val = $_POST[ $key ];
		$_row['fieldtype'] = (int) $_row['fieldtype'];
		if ( in_array( $_row['fieldtype'], [1, 2, 3, 4, 6], true ) ) {
			if ( $_row['fieldtype'] === 4 ) {
				$val = is_array( $val ) ? implode( ',', $val ) : '';
			}
			$val = clear_hyphen( str_replace( '’', "'", stripslashes( strip_tags( trim( $val ) ) ) ) );

			if ( $val == '' && $_row['mandatory'] ) {
				$_backend_failed[] = $key;
				continue;
			}

			$_db_rows[ $_row['name'] ] = $val;
		}
	}
}

if ( ! empty( $_db_rows ) && empty( $_backend_failed ) ) {
	$db = mysql_query( 'INSERT INTO users SET ' . db_set_array( $_db_rows ) );
	$info_text3 = 'Анкету отримано!';
} else {
	$info_text3 = 'Сталася помилка!';
}

?>
<!DOCTYPE html>
<html class="no-js" lang="uk-UA">

<head>
	<meta charset="utf-8">
	<title>Action</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" href="/font/iconsmind-s/css/iconsminds.css">
	<link rel="stylesheet" href="/font/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="/css/vendor/bootstrap.min.css">
	<link rel="stylesheet" href="/css/dore.light.blueyale.css">
	<link rel="stylesheet" href="/css/main.css">
	<script>(function (html) {
			html.className = html.className.replace(/\bno-js\b/, 'js')
		})(document.documentElement);</script>
	<script src="/js/vendor/jquery-3.3.1.min.js"></script>
</head>

<body id="app-container" class="menu-default">

<br><br>
<div class="form-wrapper form-wrapper-ap">

	<div class="row">

		<div class="col-12 form-content" style="margin: auto;">
			<div class="card">
				<div class="card-body">
					<h1><?php echo $info_text3; ?></h1>
				</div>
			</div> <!-- end .card -->
		</div> <!-- end .row -->

	</div> <!-- end form-wrapper -->

</div>
</body>

</html>
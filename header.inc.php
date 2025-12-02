<?php
declare(strict_types=1);
require_once __DIR__.'/config.inc.php';

setlocale(LC_TIME, 'da_DK.utf-8');
date_default_timezone_set('UTC');

require_once __DIR__.'/lib/heal-document/HealDocument.php';
require_once __DIR__.'/lib/boot-some/BootSome.php';
require_once __DIR__.'/lib/simple-auth/SimpleAuth.php';
require_once __DIR__.'/lib/ufo-ajax/ufo.php';
require_once __DIR__.'/lib/fancy-filter/FancyFilter.php';
require_once __DIR__.'/lib/wild-file/WildFile.php';

define('ACCEPTMIME',['image/jpeg','application/pdf','video/mp4']);

SimpleAuth::configure([
	'db_host' => DBHOST,
	'db_user' => DBUSER,
	'db_pass' => DBPASS,
	'db_base' => DBBASE,
	'cookie_path' => __ROOT__.'/',
	'onlogin' => function() {
		SimpleAuth::add_access('basic');
	},
]);

FancyFilter::set_option('path',__ROOT__.'/');

function authenticate($permission) {
	if(SimpleAuth::access($permission)) {
		global $mysqli;
		$mysqli = new mysqli(DBHOST,DBUSER,DBPASS,DBBASE);
		$mysqli->set_charset('utf8mb4');
	}
	else {
		if(empty($_GET['ufo'])) {
			header('location: '.__ROOT__.'/login/');
		}
		else {
			Ufo::call('alert','Access denied!');
		}
		exit;
	}
}

require_once __DIR__.'/design.inc.php';

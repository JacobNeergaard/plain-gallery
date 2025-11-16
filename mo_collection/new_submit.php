<?php
declare(strict_types=1);
require_once __DIR__.'/../header.inc.php';
authenticate('basic');

$text = trim($mysqli->real_escape_string($_POST['text']));
$sql = "INSERT INTO `collection` (`text`) VALUES ('$text')";
$mysqli->query($sql);
$collection_id = $mysqli->insert_id;

$upload = __ROOT__.'/mo_collection/new_upload.php?collection_id='.$collection_id;
$done = __ROOT__.'/mo_collection/new_done.php';

Ufo::call('upload',$upload,$done);

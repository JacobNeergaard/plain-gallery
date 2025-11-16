<?php
declare(strict_types=1);
require_once __DIR__.'/header.inc.php';
authenticate('basic');

BootSome::document(TITLE,'da');

head();
BootSome::$body->at(['onload'=>"FancyFilter.set_option('path','".__ROOT__."/');"],true);
navbar();

$container = BootSome::$body->container(false);

$sql = "SELECT `id`,`text` FROM `collection` ORDER BY `id` DESC";
$query = $mysqli->query($sql);
while($rs = $query->fetch_object()) {
	$card = $container->card();
	$card->header('primary')->te($rs->text);
	$body = $card->body();
	
	$sql = "SELECT `id`,`name` FROM `collection_file` WHERE `collection_id`='$rs->id' ORDER BY `id`";
	$query_file = $mysqli->query($sql);
	if($query_file->num_rows) {
		$row = $body->row_gutter('g-3');
		while($rs_file = $query_file->fetch_object()) {
			$col = $row->col('col-lg-3');
			$a = $col->a(__ROOT__.'/mo_collection/file.php?download&file_id='.$rs_file->id);
			$a->img(__ROOT__.'/mo_collection/file.php?file_id='.$rs_file->id,$rs_file->name)->at(['class'=>'rounded img-fluid']);
		}
	}
}

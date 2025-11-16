<?php
require_once __DIR__.'/../header.inc.php';
authenticate('basic');

if(!empty($_GET['file_id'])) {
	$file_id =  (int) $_GET['file_id'];
	
	$wf = new WildFile($mysqli,STORAGE,'collection_file');
	$file = $wf->get($_GET['file_id'],['name','size','mime']);
	
	if(!isset($_GET['preview'])) {
		WildFileHeader::type($file->mime);
		WildFileHeader::expires();
		WildFileHeader::size($file->size);
		WildFileHeader::filename($file->name);
		$file->output();
	}
	else {
		$image = new Imagick();
		$image->readImage($file->get_path());
		$image->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
		$image->cropThumbnailImage(320,320);
		$image->setImageFormat('jpeg');
		$image->setImageCompressionQuality(80);
		
		WildFileHeader::type('image/jpeg');
		WildFileHeader::expires();
		WildFileHeader::size(strlen((string) $image));
		echo (string) $image;
	}
}

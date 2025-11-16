<?php
declare(strict_types=1);
require_once __DIR__.'/../lib/wild-file/WildFileChunkedUpload.php';

$upload = WildFileChunkedUpload::from_input();

if($upload->complete()) {
	require_once __DIR__.'/../header.inc.php';
	authenticate('basic');

	$wf = new WildFile($mysqli,STORAGE,'collection_file');
	$wf->set_callback('store','filecheck');

	syslog(5,$upload->mime);

	$fields = [];
	$fields['collection_id'] = ['value'=>$_GET['collection_id']];
	$fields['name'] = ['value'=>$upload->name];
	$fields['mime'] = ['value'=>$upload->mime];
	$fields['size'] = ['value'=>$upload->file_size];
	$fields['checksum'] = ['value'=>$upload->checksum];

	$file_id = $wf->store_file($upload->file_uri, $fields);
}
else {
	$file_id = null;
}

$result = $upload->to_output($file_id);
echo json_encode($result);

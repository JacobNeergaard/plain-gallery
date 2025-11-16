<?php
declare(strict_types=1);
require_once __DIR__.'/../header.inc.php';
authenticate('basic');

$user_id = SimpleAuth::user_id();

$doc = new BootSome();

$java = "Ufo.post('dialog','".__ROOT__."/mo_collection/new_submit.php','dialogform');return false;";
$form = $doc->form()->at(['id'=>'dialogform','onsubmit'=>$java]);

$modal = $form->modal();

$header = $modal->header();
$header->title('Tilføj');
$header->close()->at(['onclick'=>"Ufo.abort('dialog')"]);

$mbody = $modal->body();

$row = $mbody->row_gutter('g-3');
$row->col('col-12')->floating_textarea('Beskrivelse','text')->required('Påkrævet');

$onchange = 'WildFile.list("BootSome").add(this);';
$row->col('col-12')->floating_file('Vælg media','file',true)->at(['accept'=>implode(',',ACCEPTMIME),'onchange'=>$onchange]);
$table = $mbody->table()->tbody()->at(['id'=>'chunked_upload_files']);

$footer = $modal->footer();
$footer->button('Upload','folder-plus')->at(['type'=>'submit']);

Ufo::output('dialog',$doc);

<?php
declare(strict_types=1);
require_once __DIR__.'/../header.inc.php';

if(SimpleAuth::user_id()) {
	header('location:'.__ROOT__.'/');
	exit;
}

BootSome::document(TITLE,'da');

head();
$container = BootSome::$body->container(false);
$col = $container->row()->col('col-sm-10','offset-sm-1','col-md-8','offset-md-2');

$col->el('h1',['class'=>'text-center'])->te(TITLE.' - Login');

$java = "Ufo.post('dialog','".__ROOT__."/mo_user/login.script.php','loginform');return false;";
$form = $col->form()->at(['id'=>'loginform','onsubmit'=>$java]);

$row = $form->row_gutter('g-3');

$input = $row->floating_input('E-mail','email',empty($_GET['email']) ? '' : $_GET['email']);
$input->at(['required','type'=>'email','autocapitalize'=>'none']);

$row->floating_password('Adgangskode','password')->at(['required']);

$row->button('Login','unlock')->at(['type'=>'submit']);

<?php
declare(strict_types=1);

function head() {
	BootSome::$head->link('shortcut icon','#');
	
	BootSome::$head->css(__ROOT__.'/lib/fontawesome/css/fontawesome.min.css');
	BootSome::$head->css(__ROOT__.'/lib/fontawesome/css/solid.min.css');
	BootSome::$head->css(__ROOT__.'/lib/boot-some/BootSome.css');
	
	BootSome::$head->el('script',['src'=>__ROOT__.'/lib/boot-some/bootstrap.bundle.min.js']);
	BootSome::$head->el('script',['src'=>__ROOT__.'/lib/ufo-ajax/ufo.js']);
	BootSome::$head->el('script',['src'=>__ROOT__.'/lib/wild-file/WildFile.js']);
	BootSome::$head->el('script',['src'=>__ROOT__.'/lib/boot-some/BootSomeForms.js']);
	BootSome::$head->el('script',['src'=>__ROOT__.'/lib/boot-some/BootSome.js']);
	BootSome::$head->el('script',['src'=>__ROOT__.'/lib/fancy-filter/fancyfilter.js']);
}
function navbar() {
	$navbar = BootSome::$body->navbar(false,'navbar-light bg-light');

	$navbar->brand()->te(TITLE);
	$navbar->button('Tilføj','plus')->at(['onclick'=>"Ufo.get('dialog','".__ROOT__."/mo_collection/new.php');"]);
	$dropdown = $navbar->dropdown('Account','secondary');
	$dropdown->a(__ROOT__.'/mo_user/logout.script.php','Log af');
}

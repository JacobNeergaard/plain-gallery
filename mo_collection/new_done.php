<?php
declare(strict_types=1);
require_once __DIR__.'/../header.inc.php';
authenticate('basic');

Ufo::call('alert','Færdig');
Ufo::abort('dialog');

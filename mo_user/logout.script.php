<?php
declare(strict_types=1);
require_once __DIR__.'/../header.inc.php';
SimpleAuth::logout();

header('location:'.__ROOT__.'/');

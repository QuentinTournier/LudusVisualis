<?php
require_once __DIR__ . '\\..\\..\\vendor\\autoload.php';

// include the prod configuration

require __DIR__.'/prod.php';


// enable the debug mode

$app['debug'] = true;

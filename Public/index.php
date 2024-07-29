<?php
ob_start();
session_start();

require_once dirname(__DIR__) . '/vendor/autoload.php';

include_once __DIR__ . '/includes/head.php';

if (!str_contains($_SERVER['REQUEST_URI'], 'admin')) {
    include_once __DIR__ . '/includes/nav.php';
}else{
    include_once dirname(__DIR__) . '/Admin/includes/nav.php';
}

include_once dirname(__DIR__) . '/Router/Routes.php';

if (!str_contains($_SERVER['REQUEST_URI'], 'admin')) {
    include_once __DIR__ . '/includes/footer.php';
}






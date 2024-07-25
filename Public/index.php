<?php
ob_start();
session_start();

require_once dirname(__DIR__) . '/vendor/autoload.php';

include_once __DIR__ . '/includes/head.php';

include_once __DIR__ . '/includes/nav.php';

include_once dirname(__DIR__) . '/Router/Routes.php';

include_once __DIR__ . '/includes/footer.php';




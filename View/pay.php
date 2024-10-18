<?php

require '../vendor/autoload.php';

use Controller\PaymentController;

require_once '../config.php';

$paymentController = new PaymentController(STRIPE_SECRET, '');
$paymentController->createPayment();
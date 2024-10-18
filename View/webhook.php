<?php

require '../vendor/autoload.php';
require '../config.php';

use Controller\PaymentController;

$paiementController = new PaymentController(STRIPE_SECRET, WEBHOOK_SECRET);

// Corps de la requête (payload = charge utile)
$payload = @file_get_contents('php://input');

// signature stripe
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
//file_put_contents('webhook_error.log', file_get_contents('php://input'), FILE_APPEND);

// Traitement de la requête
$paiementController->handle($payload,$sig_header);


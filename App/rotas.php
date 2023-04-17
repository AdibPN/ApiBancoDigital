<?php
use App\Controller\{
    CorrentistaController,
    ContaController,
    ChavePixController
    
};

$parse_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($parse_uri) {

    case '/correntista/save':
    //    CorrentistaController::getLogradouroByCep();
    break;

    case '/contra/extrato';
    //    CorrentistaController::getLogradouroByCep();
    break;

    case '/conta/pix/enviar';
    //    CorrentistaController::getLogradouroByCep();
    break;

    case'/conta/pix/receber';
    //    CorrentistaController::getLogradouroByCep();
    break;

    case '/correntista/entrar';
    //    CorrentistaController::getLogradouroByCep();
    break;

    
}
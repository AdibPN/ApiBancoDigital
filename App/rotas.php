<?php
use App\Controller\{
    CorrentistaController,
    ContaController,
    ChavePixController
    
};

$parse_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($parse_uri) {

    case '/correntista/save':
    //    CorrentistaController::save();
    break;

    case '/contra/extrato';
    //    ContaController::extrato();
    break;

    case '/conta/pix/enviar';
    //    ContaController::enviarpix();
    break;

    case'/conta/pix/receber';
    //    ContaController::receberpix();
    break;

    case '/correntista/entrar';
    //    CorrentistaController::entrar();
    break;

    
}
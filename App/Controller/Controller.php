<?php
namespace App\Controller;
use Exception;


abstract class Controller {
    protected static function getResponseAsJSON($data) {
        header("Acess-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidade");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($data));
    }

    protected static function LogError(Exception $e)
    {
        $f = fopen("erros.txt", "w");
        fwrite($f, $e->getTraceAsString());
    }
    protected static function setResponseAsJSON($data, $request_data = true) {
        $response = array('response_data' => $data, 'response_successful' => $request_data);
        
        header("Acess-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidade");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($response));
    }   

    protected static function getExceptionAsJSON(Exception $err) 
    {
        $exception = [
            'message' => $err->getMessage(),
            'code' => $err->getCode(),
            'file' => $err->getFile(),
            'line' => $err->getLine(),
            'traceAsString' => $err->getTraceAsString(),
            'previous' => $err->getPrevious()
        ];

        http_response_code(400);

        header("Acess-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidade");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($exception));
    }

    protected static function isGet() 
    {
        if($_SERVER['REQUEST_METHOD'] !== 'GET') 
            throw new Exception("O método de requisição deve ser GET");
    }

    protected static function isPost() 
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') 
            throw new Exception("O método de requisição deve ser POST");
    }

    protected static function getIntFromUrl($var_get, $var_name = null) : int
    {
        self::isGet();

        if(!empty($var_get))
            return (int) $var_get;
        else
            throw new Exception("Variável $var_name não identificada.");
    }

    protected static function getStringFromUrl($var_get, $var_name = null) : string
    {
        self::isGet();

        if(!empty($var_get))
            return (string) $var_get;
        else
            throw new Exception("Variável $var_name não identificada.");
    }

    
}
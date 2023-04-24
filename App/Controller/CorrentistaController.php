<?php
namespace App\Controller;
use App\Model\CorrentistaModel;
use App\Model\Model;
use Exception;

class CorrentistaController extends Controller {
	public static function salvar() 
	{
		try{
			$json_obj = json_decode(file_get_contents('php://input'));
			$model = new CorrentistaModel();
            $model->id = $json_obj->Id;
            $model->nome = $json_obj->Nome;
            $model->data_nascimento = $json_obj->Data_Nasc;
			$model->cpf = $json_obj->CPF;
			$model->senha = $json_obj->Senha;

            $model->save();
              
        } catch (Exception $e) {

            parent::getExceptionAsJSON($e);
        }

	}

	public static function listar()
	{
		try
        {
            $model = new CorrentistaModel();
            
            $model->getAllRows();

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::getExceptionAsJSON($e);
        }
	}

	public static function select() 
	{

	}

	public static function update() 
	{

	}

	public static function insert()
	{

	}

	public static function delete() 
	{
		try{
			$model = new CorrentistaModel();
			$model->id = parent::getIntFromUrl(isset($_GET['id']) ? $_GET['id']:null);
			##$model->delete();

		}
		catch (Exception $e){
			parent::getExceptionAsJSON($e);
		}
		

	}
}

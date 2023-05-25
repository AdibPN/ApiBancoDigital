<?php
namespace App\Controller;
use App\Model\CorrentistaModel;
use App\Model\Model;
use Exception;

class CorrentistaController extends Controller {

	
	public static function salvar() 
	{
		try
        {
            $data = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            // Copiando os valores de $data para $model
            foreach (get_object_vars($data) as $key => $value) 
            {
                $prop_letra_minuscula = strtolower($key);

                $model->$prop_letra_minuscula = $value;
            }

			//parent::getResponseAsJSON($model); 

            parent::getResponseAsJSON($model->save()); 

        } catch(Exception $e) {
            
            parent::LogError($e);
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

	

	public static function login()
    {
        try
        {
            // Transformando os dados da entrada enviada do app em
            // JSON para um objeto em PHP.
            $data = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            parent::getResponseAsJSON($model->getByCpfAndSenha($data->Cpf, $data->Senha)); 

        } catch(Exception $e) {
            
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }  

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

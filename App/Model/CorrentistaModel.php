<?php
namespace App\Model;
use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model {
	public $id;
	public $nome;
	public $data_nascimento;
	public $cpf;
	public $senha;

	public function save() : ?CorrentistaModel
    {
        return (new CorrentistaDAO())->save($this);     
    }

	public function getByCpfAndSenha($cpf, $senha) : CorrentistaModel
    {      
        return (new CorrentistaDAO())->selectByCpfAndSenha($cpf, $senha);
    }

	public function getAllRows() 
	{

	}

	public function delete(int $id) 
	{

	}

	public function getById(int $id) 
	{

	}
}

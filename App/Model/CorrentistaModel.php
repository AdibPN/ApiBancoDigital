<?php
namespace App\Model;
use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model {
	public $id;
	public $nome;
	public $data_nascimento;
	public $cpf;
	public $senha;

	public function save() 
	{
		if($this->id == null)
            (new CorrentistaDAO())->insert($this);
        else
            (new CorrentistaDAO())->update($this);

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

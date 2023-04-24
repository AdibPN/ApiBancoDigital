<?php
namespace App\DAO;
use App\Model\CorrentistaModel;

use \PDO;

class CorrentistaDAO extends DAO {

	public function __construct()
    {
        parent::__construct();      
    }

    public function insert(CorrentistaModel $m) : bool
    {
        $sql = "INSERT INTO Correntista (nome, data_nascimento, cpf, senha) VALUES (?, ?, ?, ?) ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->nome);
        $stmt->bindValue(2, $m->data_nascimento);
        $stmt->bindValue(3, $m->cpf);
        $stmt->bindValue(4, $m->senha);

        return $stmt->execute();

    }

    public function update(CorrentistaModel $m)
    {
        $sql = "UPDATE Correntista SET nome=?, data_nascimento=?, cpf=?, senha=?  WHERE id=? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->nome);
        $stmt->bindValue(2, $m->data_nascimento);
        $stmt->bindValue(3, $m->cpf);
        $stmt->bindValue(4, $m->senha);

        $stmt->bindValue(5, $m->id);

        return $stmt->execute();
    }

    public function select() 
    {
      

    }

    public function selectById() 
    {

    }

    public function delete() 
    {
        
    }
}

<?php
namespace App\DAO;
use App\Model\CorrentistaModel;

use \PDO;

class CorrentistaDAO extends DAO {

	public function __construct()
    {
        parent::__construct();      
    }

   
    private function insert(CorrentistaModel $model)
    {
        
        $sql = "INSERT INTO correntista (nome, data_nascimento, cpf, senha) VALUES (?, ?, ?, sha1(?) ) ";

   
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->data_nascimento);
        $stmt->bindValue(3, $model->cpf);
        $stmt->bindValue(4, $model->senha);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
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

    public function selectByCpfAndSenha($cpf, $senha) : CorrentistaModel
    {
        $sql = "SELECT * FROM correntista WHERE cpf = ? AND senha = sha1(?) ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->bindValue(2, $senha);
        $stmt->execute();

        /**
         * Aqui estamos organizando os dados vindos do banco como um Model CorrentistaModel
         * mas se a query não tiver nenhum resultado fetchObject retorna um bool false e portanto,
         * neste caso fetchObject pode retornar um objeto ou um bool.
         */
        $obj = $stmt->fetchObject("App\Model\CorrentistaModel");

        /**
         * Aqui verificamos se o retorno do banco foi um objeto do tipo model
         * (portando o usuário colocou CPF e Senha corretos e um resultado foi encontrado) ou
         * um bool false, que indica que nenhum resultado foi encontrado.
         * Se for um bool, nós iremos retornar um model Vazio (por padrão as propriedades são null)
         * e iremos verificar no App se a propriedade Id é null ou não.
         */
        return is_object($obj) ? $obj : new CorrentistaModel();
    }


    public function save(CorrentistaModel $m) : CorrentistaModel
    {
        return ($m->id == null) ? $this->insert($m) : $this->update($m);
    }


    
}

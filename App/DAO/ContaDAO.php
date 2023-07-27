<?php
namespace App\DAO;
use App\Model\ContaModel;
use \PDO;

class ContaDAO extends DAO {

	public function __construct()
    {
        parent::__construct();      
    }

    public function insert(ContaModel $model) : ?ContaModel
    {
        // Trecho de código SQL com marcadores ? para substituição posterior, no prepare
        $sql = "INSERT INTO conta 
                            (id_correntista, saldo, limite, tipo) 
                VALUES 
                            (?, ?, ?, ?) ";


        // Declaração da variável stmt que conterá a montagem da consulta. Observe que
        // estamos acessando o método prepare dentro da propriedade que guarda a conexão
        // com o MySQL, via operador seta "->". Isso significa que o prepare "está dentro"
        // da propriedade $conexao e recebe nossa string sql com os devidor marcadores.
        // Para saber mais sobre Preparated Statements, leia: https://www.codigofonte.com.br/artigos/evite-sql-injection-usando-prepared-statements-no-php
        $stmt = $this->conexao->prepare($sql);


        // Nesta etapa os bindValue são responsáveis por receber um valor e trocar em uma 
        // determinada posição, ou seja, o valor que está em 3, será trocado pelo terceiro ?
        // No que o bindValue está recebendo o model que veio via parâmetro e acessamos
        // via seta qual dado do model queremos pegar para a posição em questão.
        $stmt->bindValue(1, $model->id_correntista);
        $stmt->bindValue(2, $model->saldo);
        $stmt->bindValue(3, $model->limite);
        $stmt->bindValue(4, $model->tipo);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function update() 
    {

    }

    public function select(int $id_cidadao)
    {
        $sql = "SELECT * FROM Reclamacao WHERE id_cidadao = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id_cidadao);
        $stmt->execute();

        // Retorna um array com as linhas retornadas da consulta. Observe que
        // o array é um array de objetos. Os objetos são do tipo stdClass e 
        // foram criados automaticamente pelo método fetchAll do PDO.
        return $stmt->fetchAll(PDO::FETCH_CLASS);        
    }
    public function selectById() 
    {

    }

    public function delete() 
    {

    }
}

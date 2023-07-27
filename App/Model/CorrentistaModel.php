<?php
namespace App\Model;
use App\DAO\ContaDAO;
use App\Model\ContaModel;
use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model {
	public $id;
	public $nome;
	public $data_nascimento;
	public $cpf;
	public $senha;
	public $rows_contas;
	
	public function save() : ?CorrentistaModel
    {
		$dao_correntista = new CorrentistaDAO();
        
        $model_preenchido = $dao_correntista->save($this);

        // Se o insert do correntista deu certo
        // vamos inserir sua conta corrente e poupança
        if($model_preenchido->id != null)
        {
            $dao_conta = new ContaDAO();

            // Abrindo a conta corrente
            $conta_corrente = new ContaModel();
            $conta_corrente->id_correntista = $model_preenchido->id;
            $conta_corrente->saldo = 0;
            $conta_corrente->limite = 100;
            $conta_corrente->tipo = 'C';
            $conta_corrente = $dao_conta->insert($conta_corrente);

            $model_preenchido->rows_contas[] = $conta_corrente;

            // Abrindo a conta poupança
            $conta_poupanca = new ContaModel();
            $conta_poupanca->id_correntista = $model_preenchido->id;
            $conta_poupanca->saldo = 0;
            $conta_poupanca->limite = 0;
            $conta_poupanca->tipo = 'P';
            $conta_poupanca = $dao_conta->insert($conta_poupanca);

            $model_preenchido->rows_contas[] = $conta_poupanca;
        }

        return $model_preenchido;    
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

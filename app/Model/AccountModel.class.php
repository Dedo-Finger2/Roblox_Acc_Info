<?php

namespace App\Model;

require_once("../Config/Database.class.php");

use Exception;
use mysqli_sql_exception;

class AccountModel
{
    private $username;
    private $info;
    private $games;
    private $conexao;

    /**
     * Estabelece uma conexão com o banco de dados
     */
    public function __construct()
    {
        $this->conexao = (new \App\Config\Database())::conectar();
    }

    /**
     * Insere uma nova conta no banco de dados
     * @param string $username - Nome da conta
     * @param array $info - Array com informações do que a conta tem de raro em determinado jogo
     * @param array $games - Jogos em que essa conta tem algo de importante
     * @return int - ID da conta que acaba de ser cadastrada
     */
    public function createAccount($username, $info, $games)
    {

    }

    /**
     * Deleta uma conta do banco de dados
     * @param int $account_id - ID da conta que vai ser deletada
     * @return boolean - Se a ação foi feita com sucesso retorna TRUE, caso der algum problema retorna FALSE
     */
    public function deleteAccount($account_id)
    {
        
    }

    /**
     * Atualiza os dados de uma conta
     * @param int $account_id - ID da conta que vai ter seus dados atualizados
     * @param string $username - Novo nome para a conta
     * @param array $info - Novo array com informações para esse conta
     * @param array $games - Novo array com os jogos que essa conta possui algo de importante
     * @return boolean - TRUE se os dados foram atualizados e FALSE caso contrário
     */
    public function editAccount($account_id, $username, $info, $games)
    {
        
    }
}

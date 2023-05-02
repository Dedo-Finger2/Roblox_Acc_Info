<?php

namespace App\Model;

require_once("../Config/Database.class.php");

use Exception;
use mysqli_sql_exception;

class GameModel
{
    private $name;
    private $description;
    private $accounts = array();
    private $conexao;

    /**
     * Método que estabelece uma conexão com o banco de dados
     */
    public function __construct()
    {
        $this->conexao = (new \app\Config\Database())::conectar();
    }

    /**
     * Inserção de um novo jogo no banco de dados
     * @param string $name - Nome do jogo sendo inserido
     * @param string $description - Descrição do jogo sendo inserido
     * @param array $accounts - Contas importantes vinculadas a esse jogo
     * @return boolean - True se deu tudo certo, False se deu algo errado
     */
    public function createGame($name, $description, $accounts)
    {

    }

    /**
     * Deleta um jogo do banco de dados
     * @param int $game_id - ID do jogo que vai ser apagado do banco de dados
     * @return boolean - True se deu pra deletar, False caso o contrário
     */
    public function deleteGame($game_id)
    {

    }

    /**
     * Edita um jogo no banco de dados
     * @param int $game_id - ID do jogo que vai ser editado
     * @param string $name - Novo nome pro jogo sendo editado
     * @param string $description - Nova descrição pro jogo sendo editado
     * @param array $accounts - Novo array com as contas importantes que jogam esse jogo
     * @return boolean - True se deu para editar, False caso contrário
     */
    public function editGame($game_id, $name, $description, $accounts)
    {

    }

}

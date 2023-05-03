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
    public function createGame(string $name, string $description, array $accounts)
    {
        if (get_class($this->conexao) == "mysqli") {
            // Serializando os arrays para que sejam armazenados no banco de dados
            $serialized_accounts = serialize($accounts);

            // Instanciando um novo jogo
            $createGame = $this->conexao->prepare("INSERT INTO games (name, description, accounts) VALUES (?,?,?)");
            $createGame->bind_param("sss", $name, $description, $serialized_accounts);

            try {
                // Tentando executar o comando SQL $createGame
                $createGame->execute();

                // Pegand o ID do novo jogo que foi adicionado no banco de dados
                $id = \mysqli_insert_id($this->conexao);

                // Criando informações para o arquivo de LOG
                $sql = "SELECT * FROM games WHERE game_id = '$id'";
                $result = $this->conexao->query($sql);
                $row = $result->fetch_assoc();

                //Registrando ação no LOG
                \App\Config\Log::logGame("Novo jogo criado: ".$row['name'], $row['description'], $row['accounts']);
                return $id;
            } catch (Exception $e) {
                // Registrando erro no LOG
                \App\Config\Log::logGame("Ocorreu um erro na criação do jogo: ".$row['name']. $e->getMessage(), $row['description'], $row['accounts']);
                $errorMsg = "Ocorreu um erro na criação do jogo: ". $e->getMessage();

                // Exibindo o erro na tela
                echo "<div class='error'>$errorMsg</div>";
                return false;
            }

        }
    }

    /**
     * Deleta um jogo do banco de dados
     * @param int $game_id - ID do jogo que vai ser apagado do banco de dados
     * @return boolean - True se deu pra deletar, False caso o contrário
     */
    public function deleteGame($game_id)
    {
        if (get_class($this->conexao) == "mysqli") {

            // Instanciando a deleção do jogo
            $deleteGame = $this->conexao->prepare("DELETE FROM games WHERE game_id = ?");
            $deleteGame->bind_param("i", $game_id);

            // Gerando os dados para o LOG
            $sql = "SELECT * FROM games WHERE game_id = '$game_id'";
            $result = $this->conexao->query($sql);
            $row = $result->fetch_assoc();

            try {
                // Se o ID existir, deletar a conta
                if (isset($row['name'])) {
                    $deleteGame->execute();

                    // Registrando a ação no LOG
                    \App\Config\Log::logGame("Game deletado: ".$row['name'], $row['description'], $row['accounts']);
                    return true;
                } else {
                    // Se o ID do jogo não existir, essa mensagem vai ser exibida
                    echo "<div class='error'>O ID informado não consta no banco de dados!</div>";
                    exit();
                }
            } catch (Exception $e) {

                // Registrando o erro no LOG
                \App\Config\Log::logGame("Ocorreu um erro na deleção do game: ". $row['name'].$e->getMessage(), $row['description'], $row['accounts']);
                $errorMsg = "Ocorreu um erro na deleção do jogo: <b>" . $row['name'] . $e->getMessage(). "</b>";
                
                // Exibindo o erro na tela
                echo "<div class='error'>$errorMsg</div>";
                return false;
            }
        }
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
        if (get_class($this->conexao) == "mysqli") {

            // Obter dados antigos do jogo
            $sqlOld = "SELECT * FROM games WHERE game_id = '$game_id'";
            $resultOld = $this->conexao->query($sqlOld);
            $rowOld = $resultOld->fetch_assoc();

            // Serializando os arrays para serem postos no banco de dados como strings
            $serialized_accounts = serialize($accounts);

            // Instanciando edição do jogo
            $editGame = $this->conexao->prepare("UPDATE games SET name = ?, description = ?, accounts = ? WHERE game_id = ?");
            $editGame->bind_param("sssi", $name, $description, $serialized_accounts, $game_id);

            // Se o ID não existir, parar por aqui
            if (isset($rowOld['name'])) {
                
                // Registrando a ação no lOG: Dados antigos
                \App\Config\Log::logGame("Conta editada[ANTIGO]: ".$rowOld['name'], $rowOld['description'], $rowOld['accounts']);
            } else {
                echo "<div class='error'>O ID não consta no banco de dados!</div>";
                exit();
            }
            try {
                
                // Executa a edição dos dados do jogo
                $editGame->execute();

                // Obter dados atualizados do jogo
                $sqlNew = "SELECT * FROM games WHERE game_id = '$game_id'";
                $resultNew = $this->conexao->query($sqlNew);
                $rowNew = $resultNew->fetch_assoc();

                // Registrar a ação no LOG: Dados novos
                \App\Config\Log::logGame("Conta editada[NOVA]: ".$rowNew['name'],$rowNew['description'], $rowNew['accounts']);
                return true; 
            } catch (Exception $e) {

                // Registrando o erro no LOG
                \App\Config\Log::logGame("Ocorreu um erro na edição do jogo: ".$rowOld['name'] . $e->getMessage(), $rowOld['description'], $rowOld['accounts']);
                $errorMsg = "Ocorreu um erro na edição do jogo: <b>".$rowOld['name'] . $e->getMessage()."</b>";

                // Exibindo o erro na tela
                echo "<div class='error'>$errorMsg</div>";
                return false;
            }
        }
    }

}

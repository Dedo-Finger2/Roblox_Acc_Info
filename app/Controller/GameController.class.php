<?php

namespace App\Controller;

use Exception;

class GameController
{

    /**
     * Cria um formulário para criação de um novo jogo
     * @param boolean $editar
     */
    public function createForm($editar)
    {
        if ($editar != true) {
            $form =
                '<form method="post" action="processform.test.php">
                <label for="name">Name:</label>
                <input type="text" name="gameName" id="name">

                <label for="description">Description:</label>
                <textarea name="gameDescription" id="description"></textarea>

                <input type="submit" value="Submit" name="submitGame">
            </form>';

            // É necessário dar um ECHO nesse método para que o form seja exibido
            return $form;
        } else {
            $form =
                '<form method="post" action="processform.test.php">
            <label for="name">Name:</label>
            <input type="text" name="gameName" id="name">

            <label for="description">Description:</label>
            <textarea name="gameDescription" id="description"></textarea>

            <label for="accounts">Accounts:</label>
            <textarea name="gameAccounts" id="accounts"></textarea>

            <input type="submit" value="Editar" name="editGame">
        </form>';

            // É necessário dar um ECHO nesse método para que o form seja exibido
            return $form;
        }
    }

    /**
     * Processa os dados na adição de um novo jogo
     * @param array $data - Dados para criação de um novo jogo
     * @return  int - ID do novo game criado 
     */
    public function storeData($data)
    {
        require_once("../Config/Conexao.php");

        try {
            // Verifica se tudo foi preenchido
            if (empty($data['gameName']) || empty($data['gameDescription'])) {
                throw new Exception('Por favor, preencha todos os campos obrigatórios');
            } else {
                if (($data['gameName']) && ($data['gameDescription'])) {

                    // Fazendo uma varedura no banco de dados
                    $sql = "SELECT * FROM accounts";
                    $resultado = mysqli_query($conexao, $sql);

                    if (mysqli_num_rows($resultado) > 0) {

                        // Array com as contas registradas no banco de dados que tem ligação com o jogo
                        $accountsWithTheGame = array();

                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $accountsGames = unserialize($row['games']);

                            // Se na coluna GAMES da conta tiver o nome do jogo, então adicionar o nome da conta no array $accountWithGame
                            if (is_array($accountsGames) && in_array($data['gameName'], $accountsGames)) {
                                $accountsWithTheGame[] = $row['username'];
                            }
                        }

                        // Se o array não for vazio...
                        if (!empty($accountsWithTheGame)) {
                            $createGame = ((new \App\Model\GameModel()))->createGame($data['gameName'], $data['gameDescription'], $accountsWithTheGame);
                        } else {
                            $accountsWithTheGame = ['Sem contas no momento'];
                            $createGame = ((new \App\Model\GameModel()))->createGame($data['gameName'], $data['gameDescription'], $accountsWithTheGame);
                            // echo "[ATENÇÃO] Não existe contas com esse jogo no banco de dados!";
                        }


                        if (is_integer($createGame)) {
                            return $createGame;
                        } else {
                            throw new Exception("[ATENÇÃO] Ocorreu um erro ao criar a conta.");
                        }
                    } else {
                        echo "[ATENÇÃO] Nenhum resultado encontrado";
                    }
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Cria um formulário para edição de um jogo
     * @param int $game_id - ID do jogo que vai ser editado
     */
    public function editForm($game_id)
    {

    }

    /**
     * Processa os dados na edição de um jogo
     * @param array $dados - Novos dados que vão substituir os antigos dados do game
     * @param int $game_id - ID do jogo que vai ser editado
     */
    public function updateData($game_id, $dados)
    {

    }

    /**
     * Abre um modal para confirmar deleção do game
     * @param int $game_id - ID do jogo que vai ser deletado
     */
    public function deleteForm()
    {

    }

    /**
     * Remove um jogo do banco de dados
     * @param int $game_id
     */
    public function deleteData($game_id)
    {

    }

    /**
     * Retorna as informações do jogo selecionado no banco de dados
     * @param int $game_id - ID do jogo que vai ser mostrado as informações
     * @return array - Array associativo com as informações do jogo selecionado
     */
    public function getGameInfo($game_id)
    {
        if (empty($game_id)) {
            echo "[ATENÇÃO] ID inválido!";
            exit();
        }

        try {
            $game_info = (new \App\Model\GameModel())->getAll($game_id);
            foreach ($game_info as $key => $value) {
                echo "<br>";
                echo $key . " => ";
                if (is_array($value)) {
                    foreach ($value as $conta) {
                        echo $conta .", ";
                    }
                } else {
                    echo $value;
                }
                
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
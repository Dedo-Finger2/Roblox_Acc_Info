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
                '<form method="post" action="../app/Tests/processform.test.php">
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
                '
                <div class="container-fluid vh-100">
                <div class="row align-items-center justify-content-center vh-100">
                    <div class="col-md-4">
                        <div class="bg-primary shadow-sm p-4" style="background-image: linear-gradient(to bottom, #007bff, #4d94ff); border-radius: 15px;">
                            <form method="post" action="../app/Tests/processform.test.php">
                                <h3 class="text-center text-white">Roblox Account Info</h3>
                                <div class="d-flex align-items-center">
                                    <img src="../assets/img/whiteLogo.png" alt="Logo" width="105" height="98" class="mx-auto">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label text-white fw-bold">Name</label>
                                    <input type="text" name="gameName" class="form-control" id="exampleFormControlInput1" placeholder="dadeds2..." aria-labelledby="passwordHelpBlock">
                                    <div id="passwordHelpBlock" class="form-text text-white text">
                                        The name of the game.
                                    </div>
                                </div>
            
                                <input type="hidden" name="id">
            
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label text-white fw-bold">Description</label>
                                    <textarea name="gameDescription" placeholder="JOGO: ITEM, JOGO2: ITEM2" class="form-control" id="exampleFormControlTextarea1" rows="3" aria-labelledby="passwordHelpBlock"></textarea>
                                    <div id="passwordHelpBlock" class="form-text text-white">
                                        Description of the game.
                                    </div>
                                </div>
            
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label text-white fw-bold">Accounts</label>
                                    <textarea name="gameAccounts" placeholder="JOGO: ITEM, JOGO2: ITEM2" class="form-control" id="exampleFormControlTextarea1" rows="3" aria-labelledby="passwordHelpBlock"></textarea>
                                    <div id="passwordHelpBlock" class="form-text text-white">
                                        Accounts with something important in this game.
                                    </div>
                                </div>
            
                                <button type="submit" class="btn btn-success text-white" value="Submit" name="editGame">Edit</button>
                                <button class="btn btn-danger float-end" name="cancel">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';

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
        // Requirindo a conexão com o banco de dados
        require_once("../app/Config/Conexao.php");

        // Instanciando a seleção dos dados para serem exibidos dentro dos inputs
        $sql = $conexao->prepare("SELECT * FROM games WHERE game_id = ?");
        $sql->bind_param("i", $game_id);
        $sql->execute();

        $resultado = $sql->get_result();

        // Verifica se a consulta foi executada com sucesso
        if ($resultado) {
            $dados = $resultado->fetch_assoc();
        } else {
            echo "<div class='error'>Ocorreu um erro na hora de fazer a consulta!</div>";
            exit();
        }

        if ($dados !== null):

            // Formata a saída do array associativo como uma string
            $accounts = unserialize($dados['accounts']);

            $dados['accounts'] = $accounts;

            ?>
            <script>
                window.onload = function () {
                    var localData = <?= json_encode($dados); ?>;
                    document.querySelector('input[name="gameName"]').value = localData['name'];
                    document.querySelector('input[name="id"]').value = localData['game_id'];
                    document.querySelector('textarea[name="gameDescription"]').value = localData['description'];
                    document.querySelector('textarea[name="gameAccounts"]').value = localData['accounts'];
                };
            </script>
            <?php
        endif;
    }

    /**
     * Processa os dados na edição de um jogo
     * @param array $dados - Novos dados que vão substituir os antigos dados do game
     * @param int $game_id - ID do jogo que vai ser editado
     */
    public function updateData($game_id, $dados)
    {
        // Requirindo a conexão com o banco
        require_once("../Config/Conexao.php");

        try {
            // Se os inputs forem vazios ele joga essa Exeception
            if (empty($dados['gameName']) || empty($dados['gameDescription'])) {
                throw new Exception('Por favor, preencha todos os campos obrigatórios.');
            }

            if (($dados['gameName']) && ($dados['gameDescription'])) {

                // Fazendo uma varedura no banco de dados
                $sql = "SELECT * FROM accounts";
                $resultado = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($resultado) > 0) {

                    // Array com as contas registradas no banco de dados que tem ligação com o jogo
                    $accountsWithTheGame = array();

                    while ($row = mysqli_fetch_assoc($resultado)) {
                        $accountsGames = unserialize($row['games']);

                        // Se na coluna GAMES da conta tiver o nome do jogo, então adicionar o nome da conta no array $accountWithGame
                        if (is_array($accountsGames) && in_array($dados['gameName'], $accountsGames)) {
                            $accountsWithTheGame[] = $row['username'];
                        }
                    }

                    // Edita os dados do jogo e retorna o ID
                    $result = (new \App\Model\GameModel())->editGame($game_id, $dados['gameName'], $dados['gameDescription'], $accountsWithTheGame);
                    return $result;
                }
            }
        } catch (Exception $e) {

            // Se der um problema exibe esse erro
            return '[ATENÇÃO] Ocorreu um erro ao tentar atualizar: ' . $e->getMessage();
        }
    }

    /**
     * Abre um modal para confirmar deleção do game
     * @param int $game_id - ID do jogo que vai ser deletado
     * @return mixed - Formulário de confirmação de deleção
     */
    public function deleteForm($game_id)
    {
        // Requirindo a conexão com o banco de dados
        require_once("../app/Config/Conexao.php");

        $form =
            '<form method="post" action="../app/Tests/processform.test.php">
                <h1>Deseja realmente apagar esse jogo?</h1>
                <input type="submit" value="Deletar" name="deleteGame">
                <input type="hidden" name="id" value="'.$game_id.'">
            </form>';
        echo $form;

        // Instanciando a seleção dos dados
        $sql = $conexao->prepare("SELECT * FROM games WHERE game_id = ?");
        $sql->bind_param("i", $game_id);
        $sql->execute();

        $resultado = $sql->get_result();
        $row = $resultado->fetch_assoc();

        $accounts = unserialize($row['accounts']);
        $name = $row['name'];
        $description = $row['description'];

        echo "<div>";
        echo "<b>Jogo:</b> $name";
        echo "<br><br><b>Description: $description</b><br>";
        echo "<br><b>Accounts:</b><br>";
        foreach ($accounts as $conta) {
            echo ($conta . "<br>");
        }
        ;
        echo "</div>";

        // É necessário dar um ECHO nesse método para que o form seja exibido
        //return $form;
    }

    /**
     * Remove um jogo do banco de dados
     * @param int $game_id
     */
    public function deleteData($game_id)
    {
        try {
            $deleteGame = (new \App\Model\GameModel())->deleteGame($game_id);

            if (!empty($deleteGame)) {
                return $deleteGame;
            } else {
                return ("[ATENÇAÕ] Ocorreu um erro ao tentar deletar a conta.");
            }
        } catch (\mysqli_sql_exception $e) {
            return "[ATENÇÃO]: Ocorreu um erro no banco ao deletar o jogo: " . $e->getMessage();
        }
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
                        echo $conta . ", ";
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
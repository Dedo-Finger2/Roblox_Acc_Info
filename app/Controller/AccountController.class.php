<?php

namespace App\Controller;


use Exception;

class AccountController
{
    /**
     * Cria um formulário para criação de uma nova conta
     */
    public function createForm($editar)
    {
        if ($editar != true) {
            $form =
                '<form method="post" action="processform.test.php">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">

                <label for="info">Info:</label>
                <textarea name="info" id="info"></textarea>

                <label for="games">Games:</label>
                <textarea name="games" id="games"></textarea>

                <input type="submit" value="Submit" name="submitAccount">
            </form>';

            // É necessário dar um ECHO nesse método para que o form seja exibido
            return $form;
        } else {
            $form =
                '<form method="post" action="processform.test.php">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">

                <label for="info">Info:</label>
                <textarea name="info" id="info"></textarea>

                <label for="games">Games:</label>
                <textarea name="games" id="games"></textarea>

                <input type="submit" value="Editar" name="editAccount">
            </form>';

            // É necessário dar um ECHO nesse método para que o form seja exibido
            return $form;
        }
    }

    /**
     * Processa os dados na adição de um nova conta
     * @param array $data - Dados para criação de um nova conta
     * @return  int - ID da nova conta criado 
     */
    public function storeData($data)
    {
        try {
            // Verifica se tudo foi preenchido
            if (empty($data['username']) || empty($data['info'])) {
                throw new Exception('Por favor, preencha todos os campos obrigatórios');
            } else {
                if (($data['username']) && ($data['info'])) {

                    // Transforma a string de info em um array separado por vírgula
                    $array_info = explode(",", $_POST['info']);

                    // Array final com a info
                    $array_infoFinal = array();

                    // Separando jogos de informações
                    foreach ($array_info as $value) {
                        // Separando chave de valor do array
                        $chave_valor = explode(':', $value);
                        // Chave
                        $chave = trim($chave_valor[0]);
                        // Valor
                        $valor = trim($chave_valor[1]);
                        // Resultado final
                        $array_infoFinal[$chave] = $valor;
                    }

                    // Array de jogos: Chaves do array de info final
                    $array_gamesFinal = array_keys($array_infoFinal);

                    // instanciando um nova conta
                    $createAccount = ((new \App\Model\AccountModel()))->createAccount($data['username'], $array_infoFinal, $array_gamesFinal);
                    if (is_integer($createAccount)) {
                        // Retorna o ID da conta criada se ele existir
                        return $createAccount;
                    } else {
                        throw new Exception("[ATENÇÃO] Ocorreu um erro ao criar a conta.");
                    }
                }
            }
        } catch (Exception $e) {
            // Exibir mensagem de erro para o ususário
            return $e->getMessage();
        }
    }

    /**
     * Cria um formulário para edição de uma conta
     * @param int $account_id - ID da conta que vai ser editado
     * @param array $dados - Dados recebidos via POST
     */
    public function editForm($account_id)
    {
        // Requirindo a conexão com o banco de dados
        require_once("../Config/Conexao.php");

        // instanciando a seleção dos dados para serem exibidos dentro dos inputs
        $sql = $conexao->prepare("SELECT * FROM accounts WHERE acc_id = ?");
        $sql->bind_param("i", $account_id);
        $sql->execute();

        $resultado = $sql->get_result();

        // Verifica se a consulta foi executada com sucesso
        if ($resultado) {
            $dados = $resultado->fetch_assoc();
        } else {
            echo "<div class='error'>Ocorreu algum problema na hora de fazer a consulta!</div>";
            exit();
        }

        if ($dados !== null):

            // Formata a saída do array associativo como uma string
            $info = unserialize($dados['info']);
            $games = unserialize($dados['games']);

            // Verifica se $info é um array
            $info_array = is_array($info) ? $info : explode(',', $info);

            // String com a info
            $info_str = '';
            foreach ($info_array as $key => $value) {
                $info_str .= $key . ': ' . $value . ', ';
            }
            $info_str = rtrim($info_str, ', ');

            // Remove as aspas da string formatada
            $info_str = str_replace('"', '', $info_str);

            // Substitui o valor de 'info' pela string formatada sem as aspas
            $dados['info'] = $info_str;
            $dados['games'] = $games;

            // Preenche os valores dos campos do formulário com os dados de $localData
            ?>
            <script>
                window.onload = function () {
                    var localData = <?= json_encode($dados); ?>;
                    document.querySelector('input[name="username"]').value = localData['username'];
                    document.querySelector('textarea[name="info"]').value = localData['info'];
                    document.querySelector('textarea[name="games"]').value = localData['games'];
                };
            </script>
            <?php
        endif;
    }

    /**
     * Processa os dados na edição de uma conta
     * @param array $dados - Novos dados que vão substituir os antigos dados da conta
     * @param int $account_id - ID da conta que vai ser editado
     */
    public function updateData($account_id, $dados)
    {
        try {
            // Se os iputs forem vazios ele joga essa Exception
            if (empty($dados['username']) || empty($dados['info'])) {
                throw new Exception('Por favor, preencha todos os cmapos obrigatórios.');
            }

            if (($dados['username']) && ($dados['info'])) {

                // Convertendo a string de $dados['games'] em um array associativo
                $games_array = array();
                if (!empty($dados['games'])) {
                    $games_pairs = explode(',', $dados['games']);
                    foreach ($games_pairs as $pair) {
                        $pair_parts = explode(':', $pair);
                        if (count($pair_parts) == 2) {
                            $key = trim($pair_parts[0]);
                            $value = trim($pair_parts[1]);
                            if (!empty($value)) {
                                $games_array[$key] = $value;
                            }
                        }
                    }
                }

                // Convertendo a string de $dados['info'] em um array associativo e gerando uma string com suas chaves
                $info_array = array();
                if (!empty($dados['info'])) {
                    $info_pairs = explode(',', $dados['info']);
                    foreach ($info_pairs as $pair) {
                        $pair_parts = explode(':', $pair);
                        if (count($pair_parts) == 2) {
                            $key = trim($pair_parts[0]);
                            $value = trim($pair_parts[1]);
                            if (!empty($value)) {
                                $info_array[$key] = $value;
                            }
                        }
                    }
                }
                $info_keys_string = implode(',', array_keys($info_array));

                $result = (new \App\Model\AccountModel())->editAccount($account_id, $dados['username'], $info_array, $info_keys_string);

                return $result;
            }
        } catch (Exception $e) {
            return '[ATENÇÃO] Ocorreu um erro ao tentar atualizar: ' . $e->getMessage();
        }
    }

    /**
     * Vai para a tela de confirmação de deleção de conta
     * @param int $account_id - ID da conta que vai ser deletado
     */
    public function deleteForm($account_id)
    {
        // Requirindo a conexão com o banco de dados
        require_once("../Config/Conexao.php");

        $form =
            '<form method="post" action="processform.test.php">
                <h1>Deseja realmente apagar essa conta?</h1>
                <input type="submit" value="Deletar" name="delete">
            </form>';
        echo $form;
        // instanciando a seleção dos dados
        $sql = $conexao->prepare("SELECT * FROM accounts WHERE acc_id = ?");
        $sql->bind_param("i", $account_id);
        $sql->execute();

        $resultado = $sql->get_result();
        $row = $resultado->fetch_assoc();

        $info = unserialize($row['info']);
        $games = unserialize($row['games']);
        $username = $row['username'];
        
        echo "<div>";
        echo "<b>Conta:</b> $username";
        echo "<br><br><b>Info:</b><br>";
        foreach ($info as $jogo => $item) {
            echo($jogo . " - " . $item . "<br>");
        };
        echo "<br><b>Games:</b> $games";
        echo "</div>";

        // É necessário dar um ECHO nesse método para que o form seja exibido
        //return $form;
    }

    /**
     * Remove uma conta do banco de dados
     * @param int $account_id - ID da conta que vai ser removida
     */
    public function deleteData($account_id)
    {
        $deleteAccount = (new \App\Model\AccountModel())->deleteAccount($account_id);

        if (empty($deleteAccount)) {
            return $deleteAccount;
        } else {
            return ("[ATENÇÃO] Ocorreu um erro ao tentar deletar a conta.");
        }

        // Volta para tela de listagem
    }
}
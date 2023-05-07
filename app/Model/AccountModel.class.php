<?php

namespace App\Model;

require_once("../Config/Database.class.php");
require_once("../Config/Log.class.php");

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
    public function createAccount(string $username, array $info, array $games)
    {
        if (get_class($this->conexao) == "mysqli") {
            // Serializando os arrays para que seja transformado numa string para o banco de dados, essa string pode ser decodificada de volta pra array se necessário
            $serialized_info = serialize($info);
            $serialized_games = serialize($games);

            // Instanciando a nova conta
            $createAccount = $this->conexao->prepare("INSERT INTO accounts (username, info, games) VALUES (?,?,?)");
            $createAccount->bind_param("sss", $username, $serialized_info, $serialized_games);

            try {
                // Tentando executar o comando SQL $createAccount
                $createAccount->execute();

                // Pegando o ID da nova conta criada
                $id = \mysqli_insert_id($this->conexao);

                // Criando informações para o arquivo de LOG
                $sql = "SELECT * FROM accounts WHERE acc_id = '$id'";
                $result = $this->conexao->query($sql);
                $row = $result->fetch_assoc();

                // Registrando ação no LOG
                \App\Config\Log::logAccount("Nova conta criada: " . $row['username'], $row['info'], $row['games']);
                return $id;
            } catch (Exception $e) {
                // Registrando erro no LOG
                \App\Config\Log::logAccount("Ocorreu um erro na criação da conta: " . $row['username'] . " " . $e->getMessage(), $row['info'], $row['games']);
                $errorMsg = "Ocorreu um erro na criação da conta: <b>" . $e->getMessage() . "</b>";

                // Exibindo o erro na tela
                echo "<div class='error'>$errorMsg</div>";
            }
        }
    }

    /**
     * Deleta uma conta do banco de dados
     * @param int $account_id - ID da conta que vai ser deletada
     * @return mixed - ID da conta deletada
     */
    public function deleteAccount($account_id)
    {
        if (get_class($this->conexao) == "mysqli") {

            // Instanciando a deleção da conta
            $deleteAccount = $this->conexao->prepare("DELETE FROM accounts WHERE acc_id = ?");
            $deleteAccount->bind_param("i", $account_id);

            // Gerando os dados para o LOG
            $sql = "SELECT * FROM accounts WHERE acc_id = '$account_id'";
            $result = $this->conexao->query($sql);
            $row = $result->fetch_assoc();

            try {
                // Se o ID existir, deletar a conta
                if (isset($row['username'])) {
                    $deleteAccount->execute();

                    // Registrando a ação no LOG
                    \App\Config\Log::logAccount("Conta deletada: " . $row['username'], $row['info'], $row['games']);
                    return $account_id;
                } else {
                    // Se o ID da conta tentando ser deletada não existir, essa mensagem será exibida
                    echo "<div class='error'>O ID informado não consta no banco de dados!</div>";
                    exit();
                }
            } catch (Exception $e) {

                // Registrando o erro no LOG
                \App\Config\Log::logAccount("Ocorreu um erro na deleção da conta: " . $row['username'] . $e->getMessage(), $row['info'], $row['games']);
                $errorMsg = "Ocorreu um erro na deleção da conta: <b>" . $row['username'] . $e->getMessage() . "</b>";

                // exibindo o erro na tela
                echo "<div class='error'>$errorMsg</div>";
                return $account_id;
            }
        }
    }

    /**
     * Atualiza os dados de uma conta
     * @param int $account_id - ID da conta que vai ter seus dados atualizados
     * @param string $username - Novo nome para a conta
     * @param array $info - Novo array com informações para esse conta
     * @param array $games - Novo array com os jogos que essa conta possui algo de importante
     * @return mixed - ID da conta que foi editada
     */
    public function editAccount($account_id, $username, $info, $games)
    {
        if (get_class($this->conexao) == "mysqli") {

            // Obter os dados antigos da conta
            $sqlAntigo = "SELECT * FROM accounts WHERE acc_id = '$account_id'";
            $resultAntigo = $this->conexao->query($sqlAntigo);
            $rowAntigo = $resultAntigo->fetch_assoc();

            // Serializando os arrays para serem postos no banco de dados como strings
            $serialized_info = serialize($info);
            $serialized_games = serialize($games);

            // instanciando edição da conta
            $editAccount = $this->conexao->prepare("UPDATE accounts SET username = ?, info = ?, games = ? WHERE acc_id = ?");
            $editAccount->bind_param("sssi", $username, $serialized_info, $serialized_games, $account_id);

            if (isset($rowAntigo['username'])) {
                // Registrar a ação no LOG: Dados antigos
                \App\Config\Log::logAccount("Conta editada[ANTIGO]: " . $rowAntigo['username'], $rowAntigo['info'], $rowAntigo['games']);
            } else {
                echo "ID não encontrado no banco de dados!";
                exit();
            }

            // Executa a edição dos dados da conta
            if ($editAccount->execute()) {

                // Obter os dados atualizados da conta
                $sqlNovo = "SELECT * FROM accounts WHERE acc_id = '$account_id'";
                $resultNovo = $this->conexao->query($sqlNovo);
                $rowNovo = $resultNovo->fetch_assoc();

                // registrar a ação no LOG: Dados novos
                \App\Config\Log::logAccount("Conta editada[NOVA]: " . $rowNovo['username'], $rowNovo['info'], $rowNovo['games']);

                return $account_id;

            } else {
                // Registrando o erro no LOG
                \App\Config\Log::logAccount("Ocorreu um erro na edição da conta: " . $rowAntigo['username'] . $this->conexao->error, $rowAntigo['info'], $rowAntigo['games']);
                throw new Exception("Ocorreu um erro na edição da conta: " . $this->conexao->error);
            }
        }
    }
}
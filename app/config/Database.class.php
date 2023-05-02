<?php

namespace App\Config;

require_once("../../autoload.php");

use Exception;

class Database
{
    protected static $conexao;

    /**
     * Método estático que retorna a conexão com o banco de dados, caso ela já existir, ou cria uma nova.
     * @return \mysqli - Objeto de conexão com o banco de dados MySQL
     */
    public static function conectar()
    {
        // Verifica se a conexão com o banco já existe
        if (!isset(self::$conexao)) {
            // Tenta criar uma conexão com o banco de dados
            try {
                self::$conexao = new \mysqli("localhost", "root", "", "roblox_acc");
            } catch (Exception $e) {
                // Joga o erro que deu no log
                Log::logGeral("Ocorreu um erro na conexão com o banco de dados: " . $e->getMessage());
                $errorMsg = "Ocorreu um erro na conexão com o banco de dados: <b>" . $e->getMessage() . "</b>";
                echo "<div class='error'>$errorMsg</div>";
            }
        }
        // Se tudo der certo, retorna a conexão
        return self::$conexao;
    }
}

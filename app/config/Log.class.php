<?php

namespace App\Config;

class Log
{

    /**
     * Método que registra uma ação no arquivo LOG de Game
     * @param string $action - Ação feita
     */
    public static function logGeral($action)
    {
        // Código do método
        date_default_timezone_set('America/Sao_Paulo');
        $hourNow = date("H:i:s");
        $dateNow = date("d-m-Y");
        $log = fopen("../docs/logs/general/generallog.txt", "a+");
        $text = "[DATA]: $dateNow \n<br>[HORA]: $hourNow \n<br>[AÇÃO]: $action\n\n<hr>";
        fwrite($log, $text);
        fclose($log);
    }

    /**
     * Método que registra uma ação no arquivo LOG de Account
     * @param string $action - Ação feita
     * @param string $info - Informação da conta
     * @param string $games - Jogos da conta
     */
    public static function logAccount($action, $info, $games)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $hourNow = date("H:i:s");
        $dateNow = date("d-m-Y");
        $unserialized_info = unserialize($info);
        $unserialized_games = unserialize($games);

        $info_array = is_array($unserialized_info) ? $unserialized_info : explode(',', $unserialized_info);
        $info_string = '';
        foreach ($info_array as $key => $value) {
            $info_string .= "$key: $value, ";
        }
        $info_string = rtrim($info_string, ', ');

        $games_array = is_array($unserialized_games) ? $unserialized_games : explode(',', $unserialized_games);
        $games_string = implode(', ', $games_array);

        $log = fopen("../docs/logs/account/accountlog.txt", "a+");
        $text = "[DATA]: $dateNow \n<br>[HORA]: $hourNow \n<br>[AÇÃO]: $action\n<br>[INFO]: $info_string \n<br>[GAMES]: $games_string\n\n<hr>";
        fwrite($log, $text);
        fclose($log);
    }

    /**
     * Método que registra uma ação no arquivo LOG de Game
     * @param string $action - Ação feita
     */
    public static function logGame($action, $description, $accounts)
    {
        // Código do método
        date_default_timezone_set('America/Sao_Paulo');
        $hourNow = date("H:i:s");
        $dateNow = date("d-m-Y");
        $unserialized_accounts = unserialize($accounts);

        $accounts_string = implode(',', $unserialized_accounts);

        $log = fopen("../docs/logs/game/gamelog.txt", "a+");
        $text = "[DATA]: $dateNow \n<br>[HORA]: $hourNow \n<br>[AÇÃO]: $action \n<br>[DESCRIPTION]: $description \n<br>[ACCOUNTS]: $accounts_string\n\n<hr>";
        fwrite($log, $text);
        fclose($log);
    }
}
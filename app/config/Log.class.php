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
        $text = "[DATA]: $dateNow \n[HORA]: $hourNow \n[AÇÃO]: $action\n\n";
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
        // Código do método
        date_default_timezone_set('America/Sao_Paulo');
        $hourNow = date("H:i:s");
        $dateNow = date("d-m-Y");
        $unserialized_info = unserialize($info);
        $unserialized_games = unserialize($games);

        $info_string = '';
        foreach ($unserialized_info as $key => $value) {
            $info_string .= "$key: $value, ";
        }

        $games_string = implode(',', $unserialized_games);

        $log = fopen("../docs/logs/account/accountlog.txt", "a+");
        $text = "[DATA]: $dateNow \n[HORA]: $hourNow \n[AÇÃO]: $action\n[INFO]: $info_string \n[GAMES]: $games_string\n\n";
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
        $text = "[DATA]: $dateNow \n[HORA]: $hourNow \n[AÇÃO]: $action \n[DESCRIPTION]: $description \n[ACCOUNTS]: $accounts_string\n\n";
        fwrite($log, $text);
        fclose($log);
    }
}
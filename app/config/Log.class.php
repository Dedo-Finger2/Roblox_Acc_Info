<?php

namespace App\Model;

    class Log
    {
        /**
         * Método que registra uma ação no arquivo LOG de Account
         * @param string $message
         */
        public static function logAccount($message)
        {
            // Código do método
            date_default_timezone_set('America/Sao_Paulo');
            $hourNow = date("H:i:s");
            $dateNow = date("d-m-Y");
            $log = fopen("../docs/logs/account/accountlog.txt", "a+");
            $text = "[DATA]: $dateNow \n[HORA]: $hourNow \n[AÇÃO]: $message\n\n";
            fwrite($log, $text);
            fclose($log);
        }

        /**
         * Método que registra uma ação no arquivo LOG de Game
         * @param string $message
         */
        public static function logGame($message)
        {
            // Código do método
            date_default_timezone_set('America/Sao_Paulo');
            $hourNow = date("H:i:s");
            $dateNow = date("d-m-Y");
            $log = fopen("../docs/logs/game/gamelog.txt", "a+");
            $text = "[DATA]: $dateNow \n[HORA]: $hourNow \n[AÇÃO]: $message\n\n";
            fwrite($log, $text);
            fclose($log);
        }
    }

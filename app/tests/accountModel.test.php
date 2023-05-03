<?php
use App\Config\Database;
use App\Config\Log;
use App\Model\AccountModel;
    require_once("../../autoload.php");
    require_once("../Config/Conexao.php");

    $info = [
        'Wisteria2' => 'Kamado',
        'GPO' => 'Tori-Tori',
        'Shinobi Life' => 'Naruto',
        'Deepwoken' => 'Kamui Bell'
    ];

    $games = array_keys($info);


    //$account = (new AccountModel())->createAccount("Dedo", $info, $games);

    $sql = "SELECT * FROM accounts";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $serialized_info = $row['info'];
        $serialized_games = $row['games'];

        $info = unserialize($serialized_info);
        $games = unserialize($serialized_games);

        print_r($info);
        echo "<hr>";
        print_r($games);
    }

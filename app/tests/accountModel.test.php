<?php
use App\Config\Database;
use App\Config\Log;
use App\Model\AccountModel;
    require_once("../../autoload.php");
    require_once("../Config/Conexao.php");

    $info = [
        'Wisteria2' => 'Kamado',
        'GPO' => 'Venom-Venom',
        'Shinobi Life' => 'Kamui kekegenkai',
        'Deepwoken' => 'Kamui bell',
        'Project Mugetsu' => 'Aizens orb',
        'A one piece game' => 'Tori'
    ];

    $games = array_keys($info);

    //$accountEdit = (new AccountModel())->editAccount(16, "Spider", $info, $games);

    //$accountDelete = (new AccountModel())->deleteAccount(6);

    /*echo $accountCreate = (new AccountModel())->createAccount("Dedo", $info, $games);

    $sql = "SELECT * FROM accounts WHERE acc_id = '$accountCreate'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $serialized_info = $row['info'];
        $serialized_games = $row['games'];

        $info = unserialize($serialized_info);
        $games = unserialize($serialized_games);

        //print_r($info);
        echo "<hr>";
        //print_r($games);
    }
    */
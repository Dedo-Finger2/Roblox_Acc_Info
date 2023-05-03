<?php
use App\Model\GameModel;
    require_once("../../autoload.php");

    $accounts = [
        'keydo_finger',
        'dedo_finger',
        'dedo_ff'
    ];

    //$newGame = (new GameModel())->createGame("Project Mugetsu", "Um jogo de bleach", $accounts);

    //$deleteGame = (new GameModel())->deleteGame(1);

    $editGame = (new GameModel())->editGame(2, "Shinobi life2", "Jogo de naruto lá", $accounts);

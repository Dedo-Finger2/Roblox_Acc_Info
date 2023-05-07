<?php
    use App\Controller\GameController;
    require_once("../autoload.php");
    
    $dados = [
        'gameName' => '',
        'gameDescription' => '',
    ];

    $gameForm = (new GameController())->updateData($_GET['id'], $dados);
    header('Location: list.php');
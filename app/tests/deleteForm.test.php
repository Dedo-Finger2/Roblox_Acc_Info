<?php
use App\Controller\AccountController;
use App\Controller\GameController;

    require_once("../../autoload.php");

    if (isset($_GET['acc'])) {
        echo $deleteForm = (new AccountController())->deleteForm(42);
        exit();
    } elseif (isset($_GET['game'])) {
        echo $deleteForm = (new GameController())->deleteForm(5);
        exit();
    }
    
    echo "[ATENÇÃO] Você está tendando deletar um dado inexistente! <a href='accountController.test.php'>Voltar</a>";

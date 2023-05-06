<?php
use App\Controller\AccountController;
use App\Controller\GameController;
    require_once("../../autoload.php");

    if (isset($_GET['acc'])) {
        $form = new AccountController();
        echo $form->createForm(true);
        $form->editForm(42);
        exit();
    } elseif (isset($_GET['game'])) {
        $formGame = new GameController();
        echo $formGame->createForm(true);
        $formGame->editForm(8);
        exit();
    }

    echo "[ATENÇÃO] Você está tendando editar um dado inexistente! <a href='accountController.test.php'>Voltar</a>";


<?php
use App\Controller\AccountController;
    require_once("../../autoload.php");

    if (!empty($_POST)) {
        $form = new AccountController();
        echo $form->createForm(true);
        $form->editForm(36);
        exit();
    } 

    echo "[ATENÇÃO] Você está tendando editar um dado inexistente! <a href='accountController.test.php'>Voltar</a>";


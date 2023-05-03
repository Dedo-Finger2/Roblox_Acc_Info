<?php
use App\Controller\AccountController;

    require_once("../../autoload.php");

    if (!empty($_POST)) {
        echo $deleteForm = (new AccountController())->deleteForm(36);
        exit();
    } 
    
    echo "[ATENÇÃO] Você está tendando deletar um dado inexistente! <a href='accountController.test.php'>Voltar</a>";

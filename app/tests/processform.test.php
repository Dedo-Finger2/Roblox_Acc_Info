<?php
use App\Controller\AccountController;
use App\Controller\GameController;
    require_once("../../autoload.php");
    //var_dump($_POST);
    
    if (isset($_POST['submitGame'])) {
        $id = $gameForm = (new GameController())->storeData($_POST);
        echo "Dados salvos com sucesso! ID: ". $id;
        exit();
    } elseif ($_POST['submitAccount']) {
        $id = $form = (new AccountController())->storeData($_POST);
        echo "Dados salvos com sucesso! ID: " . $id;
        exit();
    }
    

    if (isset($_POST['editGame'])) {
        // método de edição de jogo
    }  elseif (isset($_POST['editAccount'])) {
        // Se clicar em edidtar, usar o método que edita os dados
        $id =  $form = (new AccountController())->updateData(36, $_POST);
        echo "Dados editados com sucesso! ID: " . $id;
        exit();
    }
    
    if (isset($_POST['delete'])) {
        // método de deletar data
        $id = $form = (new AccountController())->deleteData(36);
        exit();
    } 

    echo "Algo deu errado";
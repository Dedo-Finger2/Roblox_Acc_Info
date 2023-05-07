<?php
use App\Controller\AccountController;
use App\Controller\GameController;
    require_once("../../autoload.php");
    //var_dump($_POST);
    
    if (isset($_POST['submitGame'])) {
        $id = $gameForm = (new GameController())->storeData($_POST);
        echo "Dados salvos com sucesso! ID: ". $id;
        exit();
    } elseif (isset($_POST['submitAccount'])) {
        $id = $form = (new AccountController())->storeData($_POST);
        echo "Dados salvos com sucesso! ID: " . $id;
        exit();
    }
    

    if (isset($_POST['editGame'])) {
        $id = $gameForm = (new GameController())->updateData(8, $_POST);
        echo "Dados editados com sucesso! ID: ". $id;
        exit();

    }  elseif (isset($_POST['editAccount'])) {
        // Se clicar em edidtar, usar o método que edita os dados
        $id =  $form = (new AccountController())->updateData(42, $_POST);
        echo "Dados editados com sucesso! ID: " . $id;
        exit();
    }
    
    if (isset($_POST['delete'])) {
        // método de deletar conta
        $id = $form = (new AccountController())->deleteData(42);
        echo "Dados apagaos com sucesso! ID: ". $id;
        exit();
    } elseif (isset($_POST['deleteGame'])) {
        // Método de deletar jogo
        $id = $gameForm = (new GameController())->deleteData(5);
        echo "Dados apagados com sucesso! ID: ".$id;
        exit();
    }

    echo "Algo deu errado";
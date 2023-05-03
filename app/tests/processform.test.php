<?php
use App\Controller\AccountController;
    require_once("../../autoload.php");
    //var_dump($_POST);

    if (isset($_POST['Editar'])) {
        $id =  $form = (new AccountController())->updateData(36, $_POST);
        echo "Dados editados com sucesso! ID: " . $id;
        exit();
    } else {
        $id = $form = (new AccountController())->storeData($_POST);
        echo "Dados salvos com sucesso! ID: " . $id;
        exit();
    } 

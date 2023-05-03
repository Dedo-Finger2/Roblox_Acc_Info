<?php
    use App\Controller\AccountController;
    require_once("../../autoload.php");

    $form = new AccountController();
    echo $form->createForm(false);
    echo "<a href='editForm.test.php'>Editar</a><hr>";
    echo "<a href='deleteForm.test.php'>Deletar</a>";
    //echo $form->storeData();

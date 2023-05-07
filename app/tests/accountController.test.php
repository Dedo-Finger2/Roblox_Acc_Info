<?php
    use App\Controller\AccountController;
    require_once("../../autoload.php");

    $form = new AccountController();
    echo $form->createForm(false);
    echo "<a href='editForm.test.php?acc=true'>Editar</a><hr>";
    echo "<a href='deleteForm.test.php?acc=true'>Deletar</a><hr>";
    echo "<a href='gameController.test.php'>Game</a>";
    //echo $form->storeData();

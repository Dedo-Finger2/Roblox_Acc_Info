<?php
    use App\Controller\AccountController;
    require_once("../../autoload.php");

    $form = new AccountController();
    echo $form->createForm(false);
    echo "<a href='processEditForm.test.php'>Editar</a>";
    //echo $form->storeData();

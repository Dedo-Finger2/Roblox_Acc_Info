<?php
use App\Controller\AccountController;
    require_once("../../autoload.php");

    $form = new AccountController();
        echo $form->createForm(true);
        $form->editForm(36);

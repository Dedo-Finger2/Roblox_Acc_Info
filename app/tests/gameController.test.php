<?php
use App\Controller\GameController;

    require_once("../../autoload.php");

    $gameForm = new GameController();
    echo $gameForm->createForm(false);
    echo "<a href='editForm.test.php?game=true'>Editar</a><hr>";
    echo "<a href='deleteForm.test.php?game=true'>Deletar</a><hr>";
    echo "<a href='accountController.test.php'>Account</a>";

    // $gameForm->getGameInfo(2);

<?php
use App\Controller\GameController;

    require_once("../../autoload.php");

    $gameForm = new GameController();
    echo $gameForm->createForm(false);
    echo "<a href='#'>Editar</a><hr>";
    echo "<a href='#'>Deletar</a>";

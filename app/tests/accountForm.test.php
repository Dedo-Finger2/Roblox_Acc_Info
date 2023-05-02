<?php
use App\View\AccountFormView;
use App\View\GameFormView;

    require_once("../../autoload.php");

    $dados = [
        'username' => 'dedo',
        'info' => 'Wisteria2: Kamado, GPO: Tori-Tori',
        'games' => 'Wisteria2, GPO',
    ];

    $game = [
        'name' => 'Wisteria 2',
        'description' => 'um bom jogo',
        'accounts' => 'dadeds2, dadeds3',
    ];

    //$form = (new AccountFormView())->displayAccountForm($dados);
    //$formGame = (new GameFormView())->displayGameForm($game);

<?php
use App\Controller\AccountController;
use App\Controller\GameController;

require_once("../../autoload.php");
//var_dump($_POST);

if (isset($_POST['submitGame'])) {
    $id = $gameForm = (new GameController())->storeData($_POST);
    echo "Dados salvos com sucesso! ID: " . $id;
    exit();


} elseif (isset($_POST['submitAccount'])) {
    $id = $form = (new AccountController())->storeData($_POST);
    echo "Dados salvos com sucesso! ID: " . $id;
    exit();
}


if (isset($_POST['editGame'])) {
    $id = $gameForm = (new GameController())->updateData($_POST['id'], $_POST);
    echo "Dados editados com sucesso! ID: " . $id;
    ?>
    <script>
        setTimeout(function () {
            window.location.href = '../../pages/list.php';
        }, 3000); // 5000 milissegundos = 5 segundos
    </script>
    <?php
    exit();

    
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conexao = new mysqli("localhost", "root", "", "roblox_acc_info");

    // Fazendo uma varedura no banco de dados
    $sql = "SELECT * FROM games WHERE game_id='$id'";
    $resultado = mysqli_query($conexao, $sql);
    $row = $resultado->fetch_assoc();

    $dados = [
        'gameName' => ''.$row['name'].'',
        'gameDescription' => ''.$row['description'].'',
    ];

    $gameForm = (new GameController())->updateData($_GET['id'], $dados);
    header('Location: ../../pages/list.php');
    exit();


} elseif (isset($_POST['editAccount'])) {
    // Se clicar em edidtar, usar o método que edita os dados
    $id = $form = (new AccountController())->updateData($_POST['id'], $_POST);
    echo "Dados editados com sucesso! ID: " . $id;
    ?>
    <script>
        setTimeout(function () {
            window.location.href = '../../pages/list.php';
        }, 3000); // 5000 milissegundos = 5 segundos
    </script>
    <?php
    exit();
}


if (isset($_POST['delete'])) {
    // método de deletar conta
    $id = $form = (new AccountController())->deleteData($_POST['id']);
    echo "Dados apagaos com sucesso! ID: " . $id;
    ?>
    <script>
        setTimeout(function () {
            window.location.href = '../../pages/list.php';
        }, 3000); // 5000 milissegundos = 5 segundos
    </script>
    <?php
    exit();


} elseif (isset($_POST['deleteGame'])) {
    // Método de deletar jogo
    $id = $gameForm = (new GameController())->deleteData($_POST['id']);
    echo "Dados apagados com sucesso! ID: " . $id;
    ?>
    <script>
        setTimeout(function () {
            window.location.href = '../../pages/list.php';
        }, 3000); // 5000 milissegundos = 5 segundos
    </script>
    <?php
    exit();
}

echo "Algo deu errado";
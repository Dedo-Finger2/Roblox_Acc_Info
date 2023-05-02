<style>
    .error {
        background-color: rgba(50, 50, 50, 0.9);
        color: #fff;
        padding: 10px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-size: 20px;
        text-align: center;
    }

    b {
        color: red;
    }
</style>
<?php
    require_once("../../autoload.php");
    use App\Config\Database;

    $conexao = new Database();
    $conexao::conectar();
?>
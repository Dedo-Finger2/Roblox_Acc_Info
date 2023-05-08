<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RAI - Visualization</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="icon" href="../assets/img/logo.png" type="image/png">
<link rel="stylesheet" href="../assets/css/all.min.css">
<!-- CSS da tabela -->
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/css/buttons.bootstrap4.min.css">
<!-- Tema da tabela -->
<link rel="stylesheet" href="../assets/css/adminlte.min.css">
<style>
    body {
        background-color: #555;
    }
</style>
<?php

require_once("../app/Config/Conexao.php");

if (isset($_GET['type']) && $_GET['type'] == 'acc') {

    $id = $_GET['id'];
    $resultado = $conexao->query("SELECT * FROM accounts WHERE acc_id='$id'");
    $row = $resultado->fetch_assoc();

    ?>
    <div class="container-fluid vh-100">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-md-5">
                <div class="bg-primary shadow-sm p-4"
                    style="background-image: linear-gradient(to bottom, #007bff, #4d94ff); border-radius: 15px;">
                    <form method="post" action="../app/Tests/processForm.test.php">
                        <h3 class="text-center text-white">Roblox Account Info</h3>
                        <div class="d-flex align-items-center">
                            <img src="../assets/img/whiteLogo.png" alt="Logo" width="105" height="98" class="mx-auto">
                        </div>
                        <div class="mb-3">
                            <h3 class="form-label text-white fw-bold text-center">Username -
                                <?= $row['username'] ?>
                            </h3>
                        </div>

                        <div class="mb-3">
                            <h3 class="form-label text-white fw-bold">Info</h3>
                            <?php
                            $info = unserialize($row['info']);
                            foreach ($info as $jogo => $item) {
                                echo "<li>" . $jogo . ": " . $item . "</li>";
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <h3 for="exampleFormControlTextarea1" class="form-label text-white fw-bold">Games</h3>
                            <?php
                            $games = unserialize($row['games']);
                            foreach ($games as $jogo) {
                                echo "<li>" . $jogo . "</li>";
                            }
                            ?>
                        </div>

                        <button class="btn btn-success" name="cancel">Go back</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php

} elseif (isset($_GET['type']) && $_GET['type'] == 'game') {

    $id = $_GET['id'];
    $resultado = $conexao->query("SELECT * FROM games WHERE game_id='$id'");
    $row = $resultado->fetch_assoc();

    ?>
    <div class="container-fluid vh-100">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-md-5">
                <div class="bg-primary shadow-sm p-4"
                    style="background-image: linear-gradient(to bottom, #007bff, #4d94ff); border-radius: 15px;">
                    <form method="post" action="../app/Tests/processForm.test.php">
                        <h3 class="text-center text-white">Roblox Account Info</h3>
                        <div class="d-flex align-items-center">
                            <img src="../assets/img/whiteLogo.png" alt="Logo" width="105" height="98" class="mx-auto">
                        </div>
                        <div class="mb-3">
                            <h3 class="form-label text-white fw-bold text-center">Name -
                                <?= $row['name'] ?>
                            </h3>
                        </div>

                        <div class="mb-3">
                            <h3 class="form-label text-white fw-bold">Description</h3>
                            <?php
                            echo $row['description'];
                            ?>
                        </div>
                        <div class="mb-3">
                            <h3 for="exampleFormControlTextarea1" class="form-label text-white fw-bold">Accounts</h3>
                            <?php
                            $accounts = unserialize($row['accounts']);
                            foreach ($accounts as $account) {
                                echo "<li>" . $account . "</li>";
                            }
                            ?>
                        </div>
                        <button class="btn btn-success" name="cancel">Go back</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php
}
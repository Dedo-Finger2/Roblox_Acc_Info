<?php
require_once("../app/Config/Conexao.php");

$resultado = $conexao->query("SELECT * FROM accounts");
$resultadoGames = $conexao->query("SELECT * FROM games");

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAI - Table list</title>
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
        .fas {
            font-size: 25px;
            margin: 5px;
            text-align: center;
        }

        .fas:hover {
            color: rgba(50, 160, 90, 1);
        }

        .fa-trash {
            color: crimson;
        }
        
        .fa-pencil-alt {
            color: blue;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../assets/img/logo.png" alt="Logo" width="34" height="32"
                    class="d-inline-block align-text-top">R.A.I</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item me-auto">
                            <a class="nav-link" aria-current="page" href="index.php"><i class="fas fa-home"></i>
                                Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php"><i class="fas fa-info-circle"></i> About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="list.php"><i class="fas fa-list"></i> Table list</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logview.php"><i class="fas fa-file-alt"></i> Log-view</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item btn btn-primary" href="accountCreateForm.php">New
                                        account</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="gameCreateForm.php">New game</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="../assets/img/logo.png" alt="Logo" width="225" height="215"
                    class="d-inline-block align-text-top">
                <h1 class="display-4 mb-4">Table list</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="lead mb-5">Roblox Account Info (RAI) is a web application that allows me to get information
                    about a Roblox account, such as its username, games you play on that account, and what you have on
                    that game with that account.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-5 table-responsive"></div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="container-fluid">
                            <!-- CORPO DA TABELA -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <!-- TÍTULOS DAS COLUNAS -->
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Useranme</th>
                                            <th style="text-align: center;">Info</th>
                                            <th style="text-align: center;">Games</th>
                                            <th style="text-align: center;">Options</th>
                                        </tr>
                                    </thead>
                                    <!-- CONTEÚDO DA TABELA -->
                                    <tbody>
                                        <?php
                                        while ($row = $resultado->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $row['username'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!is_array(unserialize($row['info']))) {
                                                        echo unserialize($row['info']);
                                                    } elseif (is_string($row['info'])) {
                                                        $info = unserialize($row['info']);
                                                        foreach ($info as $jogo => $item) {
                                                            echo "<i><b>" . $jogo . "</b>: " . $item . "</i>, ";
                                                        }
                                                        //var_dump($info);
                                                    } else {
                                                        echo "Deu erro :)";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (is_array(unserialize($row['games']))) {
                                                        foreach (unserialize($row['games']) as $jogo) {
                                                            echo $jogo . ", ";
                                                        }
                                                    } elseif (is_string($row['games'])) {
                                                        echo unserialize($row['games']);
                                                    } else {
                                                        echo "Deu erro :)";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="width: 130px; text-align: center;">
                                                    <a href="accountEditForm.php?id=<?= $row['acc_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="accountDeleteForm.php?id=<?= $row['acc_id'] ?>"><i class="fas fa-trash"></i></a>
                                                    <a href="#?id=<?= $row['acc_id'] ?>?type=acc"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <!-- FOOTER DA TABELA -->
                                    <tfoot>
                                        <tr>
                                            <th style="text-align: center;">Useranme</th>
                                            <th style="text-align: center;">Info</th>
                                            <th style="text-align: center;">Games</th>
                                            <th style="text-align: center;">Options</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /FIM DO CORPO DA TABELA -->
                        </div>
                        <!-- /FIM DO CARD -->
                    </div>
                    <!-- /FIM DO COL -->
                </div>
                <!-- /FIM DO ROW -->

                <!-- /FIM DO CONTAINER FLUID -->
            </section>
        </div>
        <!-- /FIM DE TUDO DA TABELA-->

        <div class="row">
            <div class="col-md-12 mb-5 table-responsive"></div>
                <section class="content">
                <div class="container-fluid mb-5 table-responsive">
                    <div class="row">
                        <div class="container-fluid">
                            <!-- CORPO DA TABELA -->
                            <div class="card-body">
                                <table id="games1" class="table table-bordered table-striped">
                                    <!-- TÍTULOS DAS COLUNAS -->
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Name</th>
                                            <th style="text-align: center;">Description</th>
                                            <th style="text-align: center;">Accounts</th>
                                            <th style="text-align: center;">Options</th>
                                        </tr>
                                    </thead>
                                    <!-- CONTEÚDO DA TABELA -->
                                    <tbody>
                                        <?php
                                        while ($row = $resultadoGames->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= "<b>" . $row['name'] . "</b>" ?>
                                                </td>
                                                <td>
                                                    <?= "<i>" . $row['description'] . "</i>" ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $accounts = unserialize($row['accounts']);

                                                    foreach ($accounts as $account) {
                                                        echo "$account, ";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="gameEditForm.php?id=<?= $row['game_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="gameDeleteForm.php?id=<?= $row['game_id'] ?>"><i class="fas fa-trash"></i></a>
                                                    <a href="../app/Tests/processform.test.php?id=<?= $row['game_id'] ?>"><i class="fas fa-sync"></i></a>
                                                    <a href="#?id=<?= $row['game_id'] ?>?type=game"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <!-- FOOTER DA TABELA -->
                                    <tfoot>
                                        <tr>
                                            <th style="text-align: center;">Name</th>
                                            <th style="text-align: center;">Description</th>
                                            <th style="text-align: center;">Accounts</th>
                                            <th style="text-align: center;">Options</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /FIM DO CORPO DA TABELA -->
                        </div>
                        <!-- /FIM DO CARD -->
                    </div>
                    <!-- /FIM DO COL -->
                </div>
                <!-- /FIM DO ROW -->

                <!-- /FIM DO CONTAINER FLUID -->
            </section>
        </div>
        <!-- /FIM DE TUDO DA TABELA-->

        <!-- INICIO DO JS -->

        <script src="../assets/js/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../assets/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/js/dataTables.responsive.min.js"></script>
        <script src="../assets/js/responsive.bootstrap4.min.js"></script>
        <script src="../assets/js/dataTables.buttons.min.js"></script>
        <script src="../assets/js/buttons.bootstrap4.min.js"></script>
        <script src="../assets/js/jszip.min.js"></script>
        <script src="../assets/js/pdfmake.min.js"></script>
        <script src="../assets/js/vfs_fonts.js"></script>
        <script src="../assets/js/buttons.html5.min.js"></script>
        <script src="../assets/js/buttons.print.min.js"></script>
        <script src="../assets/js/buttons.colVis.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../assets/js/adminlte.min.js"></script>

        <!-- ALGUMAS COISAS EXTRAS -->
        <script>
            // Coloquei aqui constantes de data para exportarmos arquivos com a data de hora de exportação
            const now = new Date();
            const day = now.getDate();
            const month = now.getMonth() + 1; // Os meses são indexados a partir de 0
            const year = now.getFullYear();
            const hour = now.getHours();
            const minutes = now.getMinutes();
            const dateString = `Roblox Account Info ${day}-${month}-${year} às ${hour}-${minutes}`;

            $(function () {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": [
                        "copy", // botão
                        {
                            extend: 'excel', // botão
                            filename: dateString, // nome do arquivo
                        },
                        {
                            extend: 'pdf',
                            filename: dateString,
                        },
                        "csv",
                        "print",
                        "colvis"
                    ]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });

            $(function () {
                $("#games1").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": [
                        "copy", // botão
                        {
                            extend: 'excel', // botão
                            filename: dateString, // nome do arquivo
                        },
                        {
                            extend: 'pdf',
                            filename: dateString,
                        },
                        "csv",
                        "print",
                        "colvis"
                    ]
                }).buttons().container().appendTo('#games1_wrapper .col-md-6:eq(0)');

                $('#games2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });

        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
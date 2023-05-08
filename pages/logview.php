<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About RAI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="../assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">
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
                            <a class="nav-link" href="list.php"><i class="fas fa-list"></i> Table list</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="logview.php"><i class="fas fa-file-alt"></i> Log-view</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">New account</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">New game</a></li>
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
                <h1 class="display-4 mb-4">Log-view</h1>
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
                <div class="container-fluid p-4 bg-dark mb-5" style="border-radius: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5    );" >
                    <h1 class="text-center">Account Log</h1>
                    <?php
                    $arquivo = "../app/docs/logs/account/accountlog.txt";
                    $conteudo = file_get_contents($arquivo);
                    
                    echo $conteudo;
                    ?>
                </div>
                <div class="container-fluid p-4 bg-dark mb-5" style="border-radius: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5    );" >
                    <h1 class="text-center">Games Log</h1>
                    <?php
                    $arquivo = "../app/docs/logs/game/gamelog.txt";
                    $conteudo = file_get_contents($arquivo);
                    
                    echo $conteudo;
                    ?>
                </div>
                <div class="container-fluid p-4 bg-dark mb-5" style="border-radius: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5    );" >
                    <h1 class="text-center">General Log</h1>
                    <?php
                    $arquivo = "../app/docs/logs/general/generallog.txt";
                    $conteudo = file_get_contents($arquivo);
                    
                    echo $conteudo;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
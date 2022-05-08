<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Red Social</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="build/css/app.css">
</head>

<body>
    <nav class="navbar navbar-expand bg-light fixed-bottom container-fluid">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav d-flex justify-content-evenly w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="/pagina-principal"><img src="../build/img/002-home.png"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mi-cuenta">
                        <img loading="lazy" src="../build/img/004-user.png" alt="imagen-post" class="imagen-post img-responsive">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cerrar-sesion"><img src="../build/img/003-exit.png"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="main_layout">
        <?php echo $contenido; ?>
    </main>

    <?php echo $script ?? '' ?>

</body>

</html>
<?php require_once '../base.php';
?>
<!--    Navbar-->

<header class="navbar navbar-expand-lg bg-dark-subtle border-bottom border-2 border-danger-subtle" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand fs-5" href="../index.php">CineNote</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active fw-bold text-danger" href="../index.php">Accueil
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../listes_films.php">Films</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../ajouter_films.php">Ajouter un Film</a>
                </li>
                </li>
                <li class="nav-item dropdown">
                    <div class="dropdown-menu">
                    </div>
                </li>
                </ul>
            <form class="d-flex" role="search">
                    <button class="btn btn-danger" type="submit"><a href="./connexion.php" class="text-decoration-none text-white">Se connecter</button>
                </a>
            </form>
        </div>
    </div>
</header>

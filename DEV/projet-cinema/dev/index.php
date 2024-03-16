<?php
// Récupérer la liste des étudiants dans la table etudiant

// 1. Connexion à la base de donnée db_intro
/**
 * @var PDO $pdo
 */
require 'db-config.php';

// 2. Préparation de la requête
$requete = $pdo->prepare(query: "SELECT * FROM film");

// 3. Exécution de la requête
$requete->execute();

// 4. Récupération des enregistrements
// Un enregistrement = un tableau associatif
$films = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.cyborg.css">
    <title>Cinema</title>
</head>
<body>

<!--    Navbar-->

<header class="navbar navbar-expand-lg bg-dark-subtle border-bottom border-2 border-danger-subtle" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand fs-5" href="../dev/index.php">CineNote</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active fw-bold text-danger" href="../dev/index.php">Accueil
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../dev/films.php">Films</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ajouter un Film</a>
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

<!--    Presentation top films-->
<div>
    <h1 class="text-center fs-4 mt-5 mb-5">Bienvenue sur CineNote
    </h1>
    <p class="mt-5 mb-5 text-center fs-5 text-white-25">A l'affiche :</p>
</div>
<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="./recup-param.php?id_film=1">
            <img src="./assets/images/fight-club-caroussel.png" class="d-block w-50 mx-auto" alt="...">
            <div class="carousel-caption d-none d-md-block">
            </a>
                <p class="text-white-75 fs-4">Fight Club</p>
            </div>
        </div>
        <div class="carousel-item">
            <a href="./recup-param.php?id_film=5">
            <img src="./assets/images/pulp-fiction-carousel.png" class="d-block w-50 mx-auto" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <p class="text-white-75 fs-4">Pulp Fiction</p
                </a>
            </div>
        </div>
        <div class="carousel-item">
            <a href="./recup-param.php?id_film=17">
            <img src="./assets/images/shutter-carousel.png" class="d-block w-50 mx-auto" alt="...">
            <div class="carousel-caption d-none d-md-block"></a>
                <p class="text-white-75 fs-4">Shutter Island</p
                </a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!--    Contenu-->



<!--    Pied de page-->

<footer class="text-white text-center py-4 mt-5">
    <div class="container">
        <p class="mb-0 text-decoration-none" style="text-decoration: none;">&copy; <?= date('Y') ?> CineNote. Tous droits réservés.</p>
    </div>
</footer>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
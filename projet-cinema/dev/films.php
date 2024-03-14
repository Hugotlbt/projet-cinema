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

<header class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand fs-5" href="../dev/index.php">CineNote</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active text-secondary-emphasis" href="../dev/index.php">Accueil
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="fw-bold text-white nav-link" href="../dev/films.php">Films</a>
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
                    <button class="btn btn-outline-danger" type="submit"><a href="./connexion.php" class="text-decoration-none">Se connecter</button>
                </a>
            </form>
        </div>
    </div>
</header>


<!--    Contenu-->

<div class="d-flex mt-2">
    <div class=" rounded-4 p-3 flex-fill">
        <div class="container ">
            <h1 class="text-center fw-bold fs-3 mt-3 mb-5">Tout les films :</h1>
            <!-- Votre code -->

            <div class="row text-center">
                <?php foreach ($films as $film) : ?>
                    <div class=" d-flex mb-5 mx-sm-auto" style="max-width: 20rem;">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title fs-4 fw-bold">
                                <img class="w-100" src="<?= $film["image_film"]?>" alt="">
                            </h4>
                            <p class="card-text mt-3 fw-bold text-white fs-4"><?= ucfirst($film["titre_film"]) ?></p>
                            <p class="fs-6 fst-italic text-white-50 "><?= $film["duree_film"] . " minutes" ?></p>
                            <div class="mt-auto">
                                <a class="btn btn-danger align-bottom" role="button"
                                   href="recup-param.php?id_film=<?= $film['id_film'] ?>">Détails du film</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

<!--    Pied de page-->
<div>

</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Récupère le paramètre d'URL 'prenom'
// Tester la présence du paramètre
// Récupère le paramètre d'URL 'prenom'
// Tester la présence du paramètre
if (isset($_GET['id_film'])) {
$id_film = $_GET['id_film'];

// 1. Connexion à la base de donnée db_cinema
require 'db-config.php';

// 2. Préparation de la requête
$requete = $pdo->prepare(query: "SELECT * FROM film WHERE id_film = :id");

// 3. Lier le paramètre
$requete->bindParam(':id', $id_film);

// 4. Exécution de la requête
$requete->execute();

// 5. Récupération du film (vérifier si trouvé)
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./assets/css/bootstrap.min.cyborg.css" rel="stylesheet">
    <title>Detail film</title>
</head>
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
<div class="container">
    <div>
        <div class="card mb-3 mt-5" >
            <div class="row g-0">
                <div class="col-md-4">
                    <?php
                    if ($film = $requete->fetch(PDO::FETCH_ASSOC)) {
                    echo "<img src='{$film['image_film']}' alt='' class='img-fluid mt-5 mb-5 w-100 ps-5' />";
                    ?>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php
                            echo "<p class='fs-1 fw-bold pt-4 ms-4 text-capitalize'>{$film['titre_film']}</p>";
                            ?>
                        </h5>
                        <p class="card-text"><?php
                            echo "<p class='fs-5 pt-4 ms-4 text-capitalize'>Pays : {$film['pays_film']}</p>";
                            ?></p>
                        <p class="card-text"><small class="text-body-secondary"><?php
                            echo "<p class='fs-5 fst-italic pt-4 ms-4 text-capitalize'>Date de sortie : {$film['date_sortie_film']}</p>";
                            ?></p></small></p>
                        <p class="card-text fs-3"><?php
                            echo "<p class='fs-5 pt-4 ms-4 fw-bold text-capitalize'>Durée du film : {$film['duree_film']} minutes</p>";
                            ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="fw-bold fs-3 text-white">Synopsis :</p>
    <div class="col-md-12 row-cols-md-auto">
        <?php
        echo "<p class='fs-5'>{$film['resume_film']}</p>"; // Assuming you have a "resume" attribute in your table
        } else {
            echo "Film introuvable";
        }
        } else {
            echo "Aucun ID de film fourni";
        }
        ?>
    </div>
</div>


<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
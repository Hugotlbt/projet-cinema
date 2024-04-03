<?php

$id_film=null;
if (isset($_GET['id_film'])) {
    $id_film = $_GET['id_film'];
}

require_once '../base.php';
require_once BASE_PROJET . '/src/database/film-db.php';

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./assets/css/bootstrap.min.cyborg.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <title>Detail film</title>
</head>
<!--   menu en francais-->

<?php require_once BASE_PROJET . '/src/_partials/header.php';
?>


<?php if ($id_film):?>
    <?php $film=getDetailsFilms($id_film); ?>
    <?php if ($film!=null):?>
        <div class="container">
            <div>
                <div class="card mb-3 mt-5" >
                    <div class="row g-0">
                        <div class="col-md-4">
                           <?php echo "<img src='{$film['image_film']}' alt='' class='img-fluid mt-5 mb-5 w-100 ps-5' />";
                            ?>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php
                                    echo "<p class='fs-1 fw-bold pt-4 ms-4 text-capitalize'>{$film['titre_film']}</p>";
                                    ?>
                                </h5>
                                <p class="card-text">
                                    <?php
                                    echo "<i class='bi bi-flag text-danger ms-4 fs-5'></i> <span class='fs-5 pt-4 ms-2 text-capitalize'>Pays : {$film['pays_film']}</span>";
                                    ?>
                                </p>
                                <p class="card-text">
                                    <?php
                                    echo "<i class='bi bi-calendar text-danger ms-4 fs-5'></i>";
                                    echo "<span class='fs-5 pt-5 ms-2 fst-italic text-capitalize'>Date de sortie : {$film['date_sortie_film']}</span>";
                                    ?>
                                </p>
                                <p class="card-text fs-3"><?php
                                    $duree_minutes = $film['duree_film'];
                                    $heures = floor($duree_minutes / 60);
                                    $minutes = $duree_minutes % 60;
                                    echo "<i class='bi bi-clock-history text-danger ms-4 fs-5'></i>";
                                    echo "<span class='fs-5 pt-4 ms-2 fw-bold text-capitalize'>Durée du film : {$heures} heures {$minutes} minutes</span>";
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <p class="fw-bold fs-3 text-white">Synopsis :</p>
                <div class="col-md-12 row-cols-md-auto">
                    <?php
        echo
        "<p class='fs-5'>{$film['resume_film']}</p>";?>
            </div>
        </div>
    <?php else : ?>
    <div class="container">
        <p class='fs-1 text-center mt-5'><i class="bi bi-exclamation-circle text-danger"></i>Aucun film trouvé</p>
    </div>
    <?php endif;?>
<?php else : ?>
            <div class="container">
                <p class='fs-1 text-center mt-5'><i class="bi bi-exclamation-circle text-danger"></i> Aucun film trouvé</p>
            </div>
<?php endif;?>




<!--    Pied de page-->
<?php require_once BASE_PROJET . '/src/_partials/footer.php';
?>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// 1. Connexion à la base de donnée db_intro
/**
 * @var PDO $pdo
 */
require_once '../base.php';
require_once BASE_PROJET . '/src/config/db-config.php';


$erreurs = [];
$nom_film = "";
$duree_film = "";
$resume_film = "";
$date_de_sortie_film= "";
$pays_film= "";
$image_film= "";

//test utilisateur
//Determiner si le formulaire a été soumis
// Utilisation d'un variable proposé par PHP superglobale $_SERVER
// $_SERVEUR : tableau associatif contenant des informations sur la requete http

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire a etait soumis !
    // Traiter les données du formulaire
    // Recuperer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif
    $nom_film = $_POST['nom_film'];
    $duree_film = $_POST['duree_film'];
    $resume_film = $_POST['resume_film'];
    $date_de_sortie_film = $_POST['date_de_sortie-film'];
    $pays_film = $_POST['pays_film'];
    $image_film= $_POST['image_film'];

    // Validation des données
    if (empty($nom_film)) {
        $erreurs['nom_film'] = "Le nom du film est obligatoire";
    }
    if (empty($duree_film)) {
        $erreurs['duree_film'] = "La durée du film est obligatoire";
    }
    if (empty($resume_film)){
        $erreurs['resume_film'] = "Le resume du film est obligatoire";
    }
    if (empty($date_de_sortie_film)) {
        $erreurs['mdp_utilisateurCheck'] = "Écrire la date de sortie est obligatoire";
    }
    if (empty($pays_film)) {
        $erreurs['pays_film'] = "Écrire le pays du film est obligatoire";
    }
    if (empty($image_film)) {
        $erreurs['image_film'] = "Le lien de l'image du film est obligatoire";
    }


// Traiter les données
    if (empty($erreurs)) {
//Traitement des données (insertion dans une base de données)
// 2. Préparation de la requête
        $requete = $pdo->prepare(query: "INSERT INTO FILM (titre_film,duree_film,resume_film,date_sortie_film,pays_film,image_film) VALUES (?,?,?,?,?,?)");

//envoi de la requette
        $requete->bindParam(1, $nom_film);
        $requete->bindParam(2, $duree_film);
        $requete->bindParam(3, $resume_film);
        $requete->bindParam(4, $date_de_sortie_film);
        $requete->bindParam(5, $pays_film);
        $requete->bindParam(6, $image_film);

// 3. Exécution de la requête
        $requete->execute();

// 4. Récupération des enregistrements
// Un enregistrement = un tableau associatif
        $utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);


// Rediriger l'utilisateur vers une autre page (la page d'accueil)
        header("Location: ./index.php");
        exit();
    }
}
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.cyborg.css">
    <title>Connexion</title>
</head>
<body>

<!--    Navbar-->
<?php require_once BASE_PROJET . '/src/_partials/header.php';
?>

<div class="container">
    <h1 class="text-center mt-5">Ajouter un film</h1>
    <div class="w-50 mx-auto shadow p-4 bg-gradient my-5">
        <form action="" method="post" novalidate>
            <div class="mb-3">
                <label for="nom_film" class="form-label">Nom du film*</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['nom_film'])) ? "border border-2 border-danger" : "" ?>"
                       id="nom_film"
                       name="nom_film"
                       value="<?= $nom_film ?>"
                       placeholder="Saisir votre nom de film"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['nom_film'])): ?>
                    <p class="form-text text-danger"><?= $erreurs['nom_film'] ?></p>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="duree_film" class="form-label">Renseigner la durée du film*</label>
                    <input
                            type="text"
                            class="form-control <?= (isset($erreurs['duree_film'])) ? "border border-2 border-danger" : "" ?>"
                            id="duree_film"
                            name="duree_film"
                            value="<?=$duree_film?>"
                            placeholder="Saisir la durée du film"
                            aria-describedby="emailHelp">
                    <?php if (isset($erreurs['duree_film'])): ?>
                        <p class="form-text text-danger"><?= $erreurs['duree_film'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="resume_film" class="form-label">Renseigner le résumer du film*</label>
                    <input
                            type="text"
                            class="form-control <?= (isset($erreurs['resume_film'])) ? "border border-2 border-danger" : "" ?>"
                            id="resume_film"
                            name="resume_film"
                            value="<?=$resume_film?>"
                            placeholder="Saisir le résumé du film"
                            aria-describedby="emailHelp">
                    <?php if (isset($erreurs['resume_film'])): ?>
                        <p class="form-text text-danger"><?= $erreurs['resume_film']?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="date_de_sortie_film" class="form-label">Renseigner la date de sortie</label>
                    <input
                            type="date"
                            class="form-control <?= (isset($erreurs['date_de_sortie_film'])) ? "border border-2 border-danger" : "" ?>"
                            id="date_de_sortie_film"
                            name="date_de_sortie_film"
                            value="<?=$date_de_sortie_film?>"
                            placeholder="Saisir la date de sortie du film"
                            aria-describedby="emailHelp">
                    <?php if (isset($erreurs['date_de_sortie_film'])): ?>
                        <p class="form-text text-danger"><?= $erreurs['date_de_sortie_film']?></p>
                    <?php endif; ?>
                    <div class="mb-3">
                    <label for="pays_film" class="form-label">Renseigner le pays du film</label>
                    <input
                            type="text"
                            class="form-control <?= (isset($erreurs['pays_film'])) ? "border border-2 border-danger" : "" ?>"
                            id="pays_film"
                            name="pays_film"
                            value="<?=$pays_film?>"
                            placeholder="Saisir le pays du film"
                            aria-describedby="emailHelp">
                    <?php if (isset($erreurs['pays_film'])): ?>
                        <p class="form-text text-danger"><?= $erreurs['pays_film']?></p>
                    <?php endif; ?>
                        <div class="mb-3">
                    <label for="image_film" class="form-label">Renseigner le lien de l'image du site</label>
                    <input
                            type="text"
                            class="form-control <?= (isset($erreurs['image_film'])) ? "border border-2 border-danger" : "" ?>"
                            id="image_film"
                            name="image_film"
                            value="<?=$image_film?>"
                            placeholder="Saisir l'image du film"
                            aria-describedby="emailHelp">
                    <?php if (isset($erreurs['image_film'])): ?>
                        <p class="form-text text-danger"><?= $erreurs['image_film']?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-outline-danger">Valider</button>
            </div>
        </form>
    </div>
</div>
<!--    Pied de page-->
<div>
    <?php require_once BASE_PROJET . '/src/_partials/footer.php';
    ?>
</div>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
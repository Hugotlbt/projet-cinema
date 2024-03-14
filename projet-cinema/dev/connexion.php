
<?php
// Récupérer la liste des utilisateurs dans la table utilisateur

// 1. Connexion à la base de donnée db_intro
/**
 * @var PDO $pdo
 */
require 'db-config.php';

// 2. Préparation de la requête
$requete = $pdo->prepare(query: "SELECT * FROM utilisateur");

// 3. Exécution de la requête
$requete->execute();

// 4. Récupération des enregistrements
// Un enregistrement = un tableau associatif
$utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);

//Determiner si le formulaire a été soumis
// Utilisation d'un variable proposé par PHP superglobale $_SERVER
// $_SERVEUR : tableau associatif contenant des informations sur la requete http

$email = "";
$motDePasse="";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire a etait soumis !
    // Traiter les données du formulaire
    // Recuperer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif
    $email = $_POST['email'];;
    // Validation des données
    if (empty($email)) {
        $erreurs['email'] = "L'email est obligatoire";
    }
    if (empty($motDePasse)){
        $erreurs['motDePasse'] = "Le mot de passe est obligatoire";
    }
    // Traiter les données
    else if (empty($erreurs)) {
        //traitement des données (insertion dans une base de données)
        // Rediriger l'utilisateur vers une autre page (la page d'acceuil)
        header("Location: ../dev/index.php");
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
<header class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">CineNote</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Accueil
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Films</a>
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

<!--    Contenu / page de connexion-->
<div class="container">
    <h1>Formulaire</h1>
    <div class="w-50 mx-auto shadow p-4 bg-gradient my-5">
        <form action="" method="post" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <input
                    type="email"
                    class="form-control <?= (isset($erreurs['email'])) ? "border border-2 border-danger" : "" ?>
                    id=" email"
                name="email"
                value="<?=$email?>"
                placeholder="Saisir votre email"
                aria-describedby="emailHelp">
                <?php if (isset($erreurs['email'])): ?>
                    <p class="form-text text-danger"><?= $erreurs['email'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="motDePasse" class="form-label">Mot de passe*</label>
                <input
                        type="password"
                        class="form-control <?= (isset($erreurs['motDePasse'])) ? "border border-2 border-danger" : "" ?>
                    id=" motDePasse"
                name="email"
                value="<?=$motDePasse?>"
                placeholder="Saisir votre email"
                aria-describedby="emailHelp">
                <?php if (isset($erreurs['motDePasse'])): ?>
                    <p class="form-text text-danger"><?= $erreurs['motDePasse'] ?></p>
                <?php endif; ?>
            </div>
            </div>
            <button type="submit" class="btn btn-outline-danger">Valider</button>
    <button type="submit" class="btn btn-outline-danger"><a href="./sinscrire.php" class="text-decoration-none">S'inscrire</a></button>
        </form>
    </div>
</div>
<!--    Pied de page-->
<div>

</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
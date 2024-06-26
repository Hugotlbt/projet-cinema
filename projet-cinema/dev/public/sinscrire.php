<?php
// 1. Connexion à la base de donnée db_intro
/**
 * @var PDO $pdo
 */
require_once '../base.php';
require_once BASE_PROJET . '/src/config/db-config.php';


$erreurs = [];
$email_utilisateur = "";
$pseudo_utilisateur = "";
$mdp_utilisateur = "";
$mdp_utilisateurCheck="";

//test utilisateur
//Determiner si le formulaire a été soumis
// Utilisation d'un variable proposé par PHP superglobale $_SERVER
// $_SERVEUR : tableau associatif contenant des informations sur la requete http

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire a etait soumis !
    // Traiter les données du formulaire
    // Recuperer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif
    $mdp_utilisateur = $_POST['mdp_utilisateur'];
    $pseudo_utilisateur = $_POST['pseudo_utilisateur'];
    $email_utilisateur = $_POST['email_utilisateur'];
    $mdp_utilisateurCheck = $_POST['mdp_utilisateurCheck'];

    // Validation des données
    if (empty($pseudo_utilisateur)) {
        $erreurs['pseudo_utilisateur'] = "Le nom est obligatoire";
    }
    if (empty($email_utilisateur)) {
        $erreurs['email_utilisateur'] = "L'email est obligatoire";
    } elseif (!filter_var($email_utilisateur, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email_utilisateur'] = "L'email n'est pas valide";
    }
    if (empty($mdp_utilisateur)){
        $erreurs['mdp_utilisateur'] = "Le mot de passe est obligatoire";
    }
    if (empty($mdp_utilisateurCheck)) {
        $erreurs['mdp_utilisateurCheck'] = "ecrire le mdp est obligatoire";
    }
    if ($mdp_utilisateur!=$mdp_utilisateurCheck){
        $erreurs['mdp_utilisateurCheck'] = "le mot de passe n'est pas exacte";
        $erreurs['mdp_utilisateur'] = "le mot de passe n'est pas exacte";
    }

// Traiter les données
    if (empty($erreurs)) {
//Traitement des données (insertion dans une base de données)
// 2. Préparation de la requête
        $requete = $pdo->prepare(query: "INSERT INTO utilisateur (pseudo_utilisateur,email_utilisateur,mdp_utilisateur) VALUES (?,?,?)");

//envoi de la requette
        $requete->bindParam(1, $pseudo_utilisateur);
        $requete->bindParam(2, $email_utilisateur);
        $requete->bindParam(3, password_hash($mdp_utilisateur,PASSWORD_ARGON2I));

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
    <h1 class="text-center mt-5">Inscription</h1>
    <div class="w-50 mx-auto shadow p-4 bg-gradient my-5">
        <form action="" method="post" novalidate>
            <div class="mb-3">
                <label for="pseudo_utilisateur" class="form-label">Definir un pseudo*</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['pseudo_utilisateur'])) ? "border border-2 border-danger" : "" ?>"
                       id="pseudo_utilisateur"
                       name="pseudo_utilisateur"
                       value="<?= $pseudo_utilisateur ?>"
                       placeholder="Saisir votre pseudo"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['pseudo_utilisateur'])): ?>
                    <p class="form-text text-danger"><?= $erreurs['pseudo_utilisateur'] ?></p>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="email_utilisateur" class="form-label">Renseigner votre mail*</label>
                    <input
                            type="email"
                            class="form-control <?= (isset($erreurs['email_utilisateur'])) ? "border border-2 border-danger" : "" ?>"
                            id="email_utilisateur"
                            name="email_utilisateur"
                            value="<?=$email_utilisateur?>"
                            placeholder="Saisir votre email"
                            aria-describedby="emailHelp">
                    <?php if (isset($erreurs['email_utilisateur'])): ?>
                        <p class="form-text text-danger"><?= $erreurs['email_utilisateur'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="mdp_utilisateur" class="form-label">Definir un mot de passe*</label>
                    <input
                            type="password"
                            class="form-control <?= (isset($erreurs['mdp_utilisateur'])) ? "border border-2 border-danger" : "" ?>"
                            id="mdp_utilisateur"
                            name="mdp_utilisateur"
                            value="<?=$mdp_utilisateur?>"
                            placeholder="Saisir un mot de passe"
                            aria-describedby="emailHelp">
                    <?php if (isset($erreurs['mdp_utilisateur'])): ?>
                        <p class="form-text text-danger"><?= $erreurs['mdp_utilisateur']?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="mdp_utilisateurCheck" class="form-label">Confirmer le mot de passe*</label>
                    <input
                            type="password"
                            class="form-control <?= (isset($erreurs['mdp_utilisateurCheck'])) ? "border border-2 border-danger" : "" ?>"
                            id="mdp_utilisateurCheck"
                            name="mdp_utilisateurCheck"
                            value="<?=$mdp_utilisateurCheck?>"
                            placeholder="Ressaisir un mot de passe"
                            aria-describedby="emailHelp">
                    <?php if (isset($erreurs['mdp_utilisateurCheck'])): ?>
                        <p class="form-text text-danger"><?= $erreurs['mdp_utilisateurCheck']?></p>
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
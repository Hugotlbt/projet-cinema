
<?php

/**
 * @var PDO $pdo
 */
require_once '../base.php';
require_once BASE_PROJET . '/src/database/utilisateur-db.php';

$erreurs = [];
$email = "";
$motDePasse="";



// connexion à la BDD
if ($_SERVER["REQUEST_METHOD"] === "POST") {
// Le formulaire a etait soumis !
// Traiter les données du formulaire
// Recuperer les valeurs saisies par l'utilisateur
// Superglobale $_POST : tableau associatif
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
    if (empty($email)) {
        $erreurs['email'] = "L'email est obligatoire";
    }
    if (empty($motDePasse)) {
        $erreurs['motDePasse'] = "Le mot de passe est obligatoire";
    } else if (empty($erreurs)) {
    $utilisateurs=getUser($email);
    foreach ($utilisateurs as $utilisateur){
        if ($utilisateur==$email){
            $mdps=getMdp($email);
            foreach ($mdps as $mdp){
               if (password_verify(password_hash($motDePasse,PASSWORD_ARGON2I),$mdps)==$motDePasse)
                echo "ca marche ";
            }
        }else {
            echo "ca marche pas";
            }
        }
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
<?php require_once BASE_PROJET . '/src/_partials/header.php';?>



<!--    Contenu / page de connexion-->
<div class="container">
    <h1 class="text-center mt-5">Connexion</h1>
    <div class="w-50 mx-auto shadow p-4 bg-gradient my-5">
        <form action="" method="post" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <input
                    type="email"
                    class="form-control <?= (isset($erreurs['email'])) ? "border border-2 border-danger" : "" ?>
                    id=email"
                    name="email"
                    value="<?=$email?>"
                    placeholder="Saisir votre email"
                    aria-describedby="emailHelp">
                <?php if (isset($erreurs['email'])): ?>
                    <p class="form-text text-danger"><?= $erreurs['email']?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="motDePasse" class="form-label">Mot de passe*</label>
                <input
                        type="password"
                        class="form-control <?= (isset($erreurs['motDePasse'])) ? "border border-2 border-danger" : "" ?>
                id=motDePasse"
                name="motDePasse"
                value="<?=$motDePasse?>"
                placeholder="Saisir votre mot de passe"
                aria-describedby="emailHelp">
                <?php if (isset($erreurs['motDePasse'])): ?>
                    <p class="form-text text-danger"><?= $erreurs['motDePasse']?></p>
                <?php endif; ?>
            </div>
            <div class="text-end">
            <button type="submit" class="btn btn-outline-danger text-white">Valider</button>
            <button type="submit" class="btn btn-outline-danger"><a href="./sinscrire.php" class="text-decoration-none text-danger">S'inscrire</a></button>
            </div>
        <div>
    </div>
    </div>
</div>
<?php require_once BASE_PROJET . '/src/_partials/footer.php';?>
<div>

</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
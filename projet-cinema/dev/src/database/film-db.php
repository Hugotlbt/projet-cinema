<?php
require_once '../base.php';
require_once BASE_PROJET . '/src/config/db-config.php';
// Fonction permettant de récupérer tous les films
function getFilms(): array
{
$pdo = getConnexion();
$requete = $pdo->query("SELECT * FROM film");
return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function getDetailsFilms($id_film)
{
$pdo = getConnexion();
$requete = $pdo->prepare(query: "SELECT * FROM film WHERE id_film = $id_film");
$requete->execute();
return $requete->fetch(PDO::FETCH_ASSOC);
}

?>

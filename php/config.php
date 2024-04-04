<?php
require_once "membre.php";

// Définition des constantes pour les informations de la base de données
define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','mairie_patte_doie');

try {
    // Connexion à la base de données en utilisant PDO
    $connexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Configuration des attributs de la connexion PDO pour afficher les erreurs
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données <br>";
    $matricule=1;
    $nom="mendy";
    $prenom="celine";
    $sexe="f";
    $situation_matrimoniale="divorce";
    // Instanciation d'un objet membre
    $membre = new Membre($connexion, $matricule, $nom, $prenom,  $sexe, $situation_matrimoniale);
    
    // Validation du prénom et du nom
    if (!$membre->validerPrenom($prenom)) {
        echo "Le prénom est invalide.";
    }

    if (!$membre->validerNom($nom)) {
        echo "Le nom est invalide.";
    }
    
    // Appel de la méthode readMembre
    $resultat = $membre->readMembre();
} catch (PDOException $e) {
    // Affichage d'un message d'erreur et arrêt du script en cas d'échec de la connexion
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

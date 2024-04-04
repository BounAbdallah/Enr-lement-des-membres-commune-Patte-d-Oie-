<?php
require_once "config.php";
// require_once "Membre.php";

// Vérifier si le matricule du membre à supprimer est passé en paramètre dans l'URL
if(isset($_GET['matricule']) && !empty($_GET['matricule'])) {
    $matricule = $_GET['matricule'];

    try {
        // Création d'une instance de la classe Membre avec seulement le matricule
        $membre = new Membre($connexion, $matricule, null, null,  null, null);

        // Supprimer le membre de la base de données
        if($membre->deleteMembre($matricule)) {
            // Redirection vers la page d'affichage des membres après la suppression
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur : impossible de supprimer le membre.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Si le matricule du membre à supprimer n'est pas spécifié, afficher un message d'erreur
    echo "Matricule du membre à supprimer non spécifié.";
}
?>

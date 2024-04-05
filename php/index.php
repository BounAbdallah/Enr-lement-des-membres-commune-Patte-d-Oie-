<?php
require_once "membre.php";
require_once "config.php";
?>
<?php
// Inclure le fichier contenant la classe Membre
//require_once "membre.php";

$liste_membres = array(); // Initialisation de la variable $liste_membres

try {
    // Connexion à la base de données
    $connexion = new PDO("mysql:host=localhost;dbname=mairie_patte_doie", "root", ""); // Modifier avec vos informations de connexion
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer tous les membres de la base de données
    $query = "SELECT * FROM membres"; // Changer "membres" avec le nom de votre table membres
    $result = $connexion->query($query);

    // Vérifier si des membres ont été récupérés
    if ($result !== false) {
        $liste_membres = $result->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Aucun membre trouvé.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Membres</title>
    <!-- Inclusion du CSS Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Inclusion du JavaScript Bootstrap 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>-->
</head>
<body>
    <div class="container">
        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <h1>Liste des Membres</h1>
        <!-- Bouton pour ajouter un nouveau membre -->
        <a href="ajouter_membre.php" class="btn btn-primary">Ajouter</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Matricule</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Sexe</th>
                    <th scope="col">Situation matrimoniale</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultat as $membre) : ?>
                    <tr class="trow">
                        
                        <td><?php echo $membre['matricule']; ?></td>
                        <td><?php echo $membre['nom']; ?></td>
                        <td><?php echo $membre['prenom']; ?></td>
                        <td><?php echo $membre['sexe']; ?></td>
                        <td><?php echo $membre['situation_matrimoniale']; ?></td>
                        <td>
                            <!-- Bouton pour supprimer les données avec un lien vers delete.php -->
                            <a href="delete.php?matricule=<?php echo $membre['matricule']; ?>" class="btn btn-danger">Supprimer</a>
                            <!-- Bouton pour ajouter un nouveau membre -->
                            <a href="modifier_membre.php?matricule=<?php echo $membre['matricule']; ?>"class="btn btn-primary">Modifier</a>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
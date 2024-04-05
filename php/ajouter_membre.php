<?php
require_once "config.php";

if(isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];

    // Vérification si les champs ne sont pas vides
    if ($nom != "" && $prenom != "" && $sexe != "" && $situation_matrimoniale != "") {
        // Création d'un nouvel objet Membre
        $nouveauMembre = new Membre($connexion, null, $nom, $prenom, $sexe, $situation_matrimoniale);

        // Appel de la méthode pour ajouter le membre
        $nouveauMembre->addMembre($nom,$prenom,$sexe,$situation_matrimoniale);

        // Redirection vers la page principale après l'ajout
        header("Location: index.php");
        exit();
    }
    
}
?>

<!DOCTYPE html>
<html lang="fr"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Membre</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un Membre</h1>
        <!-- Formulaire pour ajouter un membre -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="sexe">Sexe:</label>
                <select class="form-control" id="sexe" name="sexe" required>
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="situation_matrimoniale">Situation Matrimoniale:</label>
                <input type="text" class="form-control" id="situation_matrimoniale" name="situation_matrimoniale" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Ajouter</button>
        </form>
    </div>
</body>
</html>

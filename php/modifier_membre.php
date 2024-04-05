<?php
require_once "config.php";

// Vérifier si un matricule est passé en paramètre dans l'URL
if(isset($_GET['matricule'])) {
    $matricule = $_GET['matricule'];

    // Récupérer les données du membre à modifier depuis la base de données
    $sql = "SELECT * FROM membres WHERE matricule = :matricule";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':matricule', $matricule, PDO::PARAM_INT);
    $stmt->execute();
    $membre = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le membre existe
    if(!$membre) {
        die("Membre non trouvé.");
    }
} else {
    die("Matricule du membre non spécifié.");
}

// Vérifier si le formulaire de modification est soumis
if(isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];

    // Mettre à jour les données du membre dans la base de données
    $sql = "UPDATE membres SET nom = :nom, prenom = :prenom, sexe = :sexe, situation_matrimoniale = :situation_matrimoniale WHERE matricule = :matricule";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':situation_matrimoniale', $situation_matrimoniale);
    $stmt->bindParam(':matricule', $matricule, PDO::PARAM_INT);
    $stmt->execute();

    // Rediriger vers la page principale après la modification
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Membre</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Modifier un Membre</h1>
        <!-- Formulaire pour modifier les données du membre -->
        <fieldset>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?matricule=' . $membre['matricule']; ?>" method="POST">
        <fieldset>
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $membre['nom']; ?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $membre['prenom']; ?>" required>
            </div>
            <div class="form-group">
                <label for="sexe">Sexe:</label>
                <select class="form-control" id="sexe" name="sexe" required>
                    <option value="M" <?php if($membre['sexe'] == 'M') echo 'selected'; ?>>Masculin</option>
                    <option value="F" <?php if($membre['sexe'] == 'F') echo 'selected'; ?>>Féminin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="situation_matrimoniale">Situation Matrimoniale:</label>
                <input type="text" class="form-control" id="situation_matrimoniale" name="situation_matrimoniale" value="<?php echo $membre['situation_matrimoniale']; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </fieldset>
        </form>
    </div>
</body>
</html>

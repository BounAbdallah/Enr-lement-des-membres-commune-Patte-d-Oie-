<?php
//inclusion du fichier de connexion à la base de donnée
// require_once "config.php";

class Membre {
    private $connexion;
    private $matricule;
    private $nom;
    private $prenom;
    private $sexe;
    private $situation_matrimoniale;
    

    public function __construct($connexion, $matricule, $nom, $prenom, $sexe, $situation_matrimoniale){
        $this->connexion = $connexion;
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->sexe = $sexe;
        $this->situation_matrimoniale = $situation_matrimoniale;
        
    }
    // Méthode pour valider le prénom
    public function validerPrenom($prenom) {
        // Vérifier si le prénom ne contient que des lettres et des espaces
        if (!preg_match("/^[a-zA-ZÀ-ÿ\s]*$/", $prenom)) {
            return false; // Le prénom est invalide
        }
        return true; // Le prénom est valide
    }

    // Méthode pour valider le nom
    public function validerNom($nom) {
        // Vérifier si le nom ne contient que des lettres et des espaces
        if (!preg_match("/^[a-zA-ZÀ-ÿ\s]*$/", $nom)) {
            return false; // Le nom est invalide
        }
        return true; // Le nom est valide
    }

    
    // Getters et setters ici...
    public function getMatricule (){
        return $this->matricule ;
    }
    public function setMatricule ($matricule){
        $this->matricule =$matricule  ;
    }
    public function getNom(){
        return $this->Nom;
    }
    public function setNom($nom){
        $this->nom=$nom ;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function setPrenom($prenom){
        $this->prenom=$prenom ;
    }
    
    public function getSexe(){
        return $this->sexe;
    }
    public function setSexe($sexe){
        $this->sexe=$sexe ;
    }
    public function getSituation_matrimoniale(){
        return $this->situation_matrimoniale;
    }
    public function setSituation_matrimoniale($situation_matrimoniale){
        $this->situation_matrimoniale=$situation_matrimoniale ;
    }

    // Méthode pour ajouter un membre
    public function addMembre() {
        try {
            $sql = "INSERT INTO membres (nom, prenom, sexe, situation_matrimoniale) VALUES (:nom, :prenom, :sexe, :situation_matrimoniale)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':prenom', $this->prenom);
            $stmt->bindParam(':sexe', $this->sexe);
            $stmt->bindParam(':situation_matrimoniale', $this->situation_matrimoniale);
            $stmt->execute();
            // Vous pouvez ajouter ici des messages de succès ou de redirection si nécessaire
        } catch (PDOException $e) {
            die("Erreur : impossible d'ajouter le membre" . $e->getMessage());
        }
    }
   
    //création de la methode d'exécution de la réquete sql pour récupérer tous les membres
    public function readMembre(){
        try {
            $sql= "SELECT * FROM membres";
            $stmt=$this->connexion->prepare($sql);
            $stmt->execute();
            $resultat= $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        } catch (PDOException $e) {
            die("Erreur : impossible de se connecter à la base de donnée" .$e->getMessage());
        }
    }

    // Méthode pour modifier les données d'un membre
    public function updateMembre($nom, $prenom, $sexe, $situation_matrimoniale, $matricule) {
        try {
            $sql = "UPDATE membres SET nom = :nom, prenom = :prenom, sexe = :sexe, situation_matrimoniale = :situation_matrimoniale WHERE matricule = :matricule";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':sexe', $sexe);
            $stmt->bindParam(':situation_matrimoniale', $situation_matrimoniale);
            $stmt->bindParam(':matricule', $matricule, PDO::PARAM_INT);
            $stmt->execute();
            // Vous pouvez ajouter ici des messages de succès ou de redirection si nécessaire
        } catch (PDOException $e) {
            die("Erreur : impossible de modifier le membre" . $e->getMessage());
        }
    }

    public function deleteMembre($matricule)
    {
        try {
            $sql = "DELETE FROM membres WHERE matricule = :matricule";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':matricule', $matricule, PDO::PARAM_INT);
            $stmt->execute();
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            die("Erreur : impossible de supprimer le membre" . $e->getMessage());
        }
    }


}
?>
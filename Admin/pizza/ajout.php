<?php
$page_title="Ajouter un produit";
include("../header1.php");

//Récupération des données
if (!isset($_POST['nom']) || !isset($_POST['prix'])) {
	echo "<p class='alert'>Ajouter un produit: </p>";
    include("aj_form.php");
} else {
    $nom = $_POST['nom'];
    $prix= $_POST['prix'];

    
//Vérification des données
    if ($nom=="" || !is_numeric($prix) || !$prix>0) {
    	echo "<p class='alert'>Error. Rajouter.</p>";
        include("aj_form.php");
    } else {

//Insertion des données
    // connexion a la BD
        require("../db_config.php");
        try {
            $db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
        	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	$SQL = "INSERT INTO recettes VALUES (DEFAULT,?,?)";
        	$st = $db->prepare($SQL);
        	$res = $st->execute(array($nom, $prix));
        	if (!$res) // ou if ($st->rowCount() ==0)
            	echo "<p>Erreur d’ajout</p>";
        	else echo "<p>L'ajout a été effectué</p>\n";
        	
        	$db=null;
    	}catch (PDOException $e){
        echo "Erreur SQL: ".$e->getMessage();
		}
	}
}
echo "<a href='../listPizza.php'>Liste</a> des pizza";
include("../footer.php");
?>
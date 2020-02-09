<?php
$page_title = "Suppression produit";
include("../header1.php");

if (!isset($_GET["id"])) {
	echo "<p>Erreur</p>\n";
}else if (!isset($_POST["supprimer"]) && !isset($_POST["annuler"])){
	include("del_form.php");
} else if (isset($_POST["annuler"])){
	echo "Operation annulee";
}else{
//suppression
	require("../../db_config.php");
	try {
		$rid =$_GET["id"];
		$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$SQL = "DELETE FROM recettes WHERE rid=?";
		$st = $db->prepare($SQL);
		$st->execute([$rid]);
		if (!$st){ // ou if ($st->rowCount() ==0)
			echo "<p>Erreur de suppression<p>\n";
		}else{ 
			echo "<p>La suppression a été effectuée</p>";
		}
		$db=null;
	}catch (PDOException $e){
		echo "Erreur SQL: ".$e->getMessage();
	}
}


	echo "<a href='../listPizza.php'>Liste</a> des pizza";
include("../footer.php");
?>
<?php
$page_title = "Suppression supplement";
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
		$sid =$_GET["id"];
		$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$SQL = "DELETE FROM supplements WHERE sid=?";
		$st = $db->prepare($SQL);
		$st->execute([$sid]);
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


	echo "<a href='../listSupplement.php'>Liste</a> des supplements";
include("../footer.php");
?>
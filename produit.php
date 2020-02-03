<?php
session_start();
$title = "Produit";
include("header.php");
//require("../trame_auth/auth/EtreAuthentifie.php");


?>

<div id="#">
	<h1> Liste des pizza: </h1>
		<table>
			<tr>
				<th style="width: 400px">Rid</th>
				<th style="width: 500px">Nom</th>
				<th style="width: 400px">Prix</th>
				<th style="width: 500px">Selection</th>
			</tr>

			<?php
		try {
			require("Admin/db_config.php");
    		$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
    		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$SQL = "SELECT * FROM recettes";
    		$res = $db->query($SQL);
    		if ($res->rowCount()==0){
        		echo "<P>La liste est vide";
    		}else {
    		echo "<table>\n";
    		foreach($res as $row) {
			?>
			
   			<tr>
    			<td style="width: 400px"><?php echo htmlspecialchars($row['rid'])?></td>
    			<td style="width: 500px"><?php echo $row['nom']?></td>
    			<td style="width: 400px"><?php echo $row['prix']?></td>
    			<td style="width: 500px"><a href="supplement.php?id=<?php echo $row['rid']?>">Ajouter au panier</a></td>
    			
    		</tr>
    		
			<?php
			};
			


    		$db=null;
		}
		}catch (PDOException $e){
   			echo "Erreur SQL: ".$e->getMessage();
		}
		
			?>
</table>
</div>	
	<br>
	<p style="font-size: 40px"><a href='panier.php'>Panier</a></p> 

	<p style="font-size: 40px"><a href='home.php'>Aller</a> à la home</p>



<?php
include ("footer.php");
?>


<?php
require("../auth/EtreAuthentifie.php");
if($idm->getRole() == 'admin' ) {
	require("header.php");
?>
	<div id="wrapper">
		<table>
			<tr>
				<td colspan="3"></td>
				<td colspan="2"><a href="pizza/ajout.php">Ajouter</a></td>
			</tr>
			<tr style="background: #c65353;color: #FFF;">
				<th style="width: 100px;">Rid</th>
				<th>Nom</th>
				<th style="width: 100px;">Prix</th>
				<th style="width: 100px;">Supprimer</th>
				<th style="width: 100px;">Modifier</th>
				
			</tr>
			<tr>
			<?php
			// connexion à la BD
			require ("db_config.php");
			try {
   			$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
   			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$SQL = "SELECT * FROM recettes";
   			$res = $db->query($SQL);
   			if ($res->rowCount()==0){
        		echo "<P>La liste est vide";
    		}else {echo "<table>\n";
    		foreach($res as $row) {
			?>
   		   		<tr>
    			<td style="width: 100px"><?php echo htmlspecialchars($row['rid'])?></td>
   				<td><?php echo $row['nom']?></td>
    			<td  style="width: 100px;"><?php echo $row['prix']?></td>
    			<td style="width: 100px"><a href="pizza/del.php?id=<?php echo $row['rid']?>">Supprimer</a></td>
    			<td style="width: 100px"><a href="pizza/mod.php?id=<?php echo $row['rid']?>">Modifier</a></td>
    			</tr>
			<?php
			};
				echo "</table>\n";

    		$db=null;
		}
		}catch (PDOException $e){
   				echo "Erreur SQL: ".$e->getMessage();
		}
     ?>
		
			</tr>
		</table>
	</div>
	<br>
	<br>

	<a href='../home.php'>Revenir</a> à la page d'accueil

<?php
	require("footer.php");
}else{
	echo "Vous n'avez pas le droit d'accès à cette page.<br>";
}
?>
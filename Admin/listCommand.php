<?php
require("../auth/EtreAuthentifie.php");
if($idm->getRole() == 'admin' ) {
	require("header.php");


?>

	<div id="wrapper">
		<table>
			<tr style="background: #c65353;color: #FFF;">
				<th style="width: 150px">Ref</th>
				<th style="width: 80px">Uid</th> 
				<th style="width: 80px">Rid</th>
				<th style="width: 180px">Date</th>
				<th style="width: 180px">Status</th>
				<th>Prix total</th>
			</tr>
			<tr>
				<?php
				// connexion à la BD
				require ("db_config.php");
				try {
   		 		$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
    			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    			$SQL = "SELECT * FROM commandes";
    			$res = $db->query($SQL);
    			if ($res->rowCount()==0)
        			echo "<P>La liste est vide";
    			else {echo "<table>\n";
    			foreach($res as $row) {
				?>
    				<tr>
    				<td style="width: 150px"><?php echo htmlspecialchars($row['ref'])?></td>
    				<td style="width: 80px"><?php echo $uid=$row['uid']?>
    				</td>
    				<td style="width: 80px"><?php echo $rid=$row['rid']?></td>
    				<td style="width: 180px"><?php echo $row['date']?></td>
    				<td style="width: 180px"><?php echo $row['statut']?></td>
    				<td>
    					<?php
    					$cid = $row['cid'];
    					
    					$SQL1 = "SELECT recettes.prix FROM commandes INNER JOIN recettes ON commandes.rid = recettes.rid WHERE commandes.rid = $rid ";
    					$res1 = $db->query($SQL1);
    					foreach($res1 as $row) {
								$prix_rid = $row['prix'];
						}
						
						
						$prix_sid=0;
						$SQL2 = "SELECT supplements.prix FROM supplements INNER JOIN extras ON supplements.sid = extras.sid WHERE extras.cid = $cid";
						$res2 = $db->query($SQL2);
						foreach($res2 as $row) {
								$prix_sid = $prix_sid+$row['prix'];
						}

						echo $prix_sid+$prix_rid;

    					?>
    				</td>
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
	<br>
	<br>
	<?php
	require("footer.php");
}else{
	echo "Vous n'avez pas le droit d'accès à cette page.<br>";
}
?>
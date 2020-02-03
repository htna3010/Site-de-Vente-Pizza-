<?php
$title = "Espace Client";
include("headerEC.php");
require("auth/EtreAuthentifie.php");
$uid = $idm->getUid();
?>
<h1>Liste des achats effectués</h1>
	<table>
			<tr >
				<th style="width: 250px">Ref</th>
				<th style="width: 200px">Uid</th> 
				<th style="width: 200px">Rid</th>
				<th style="width: 350px">Date</th>
				<th style="width: 350px">Statut</th>
				<th style="width: 250px">Prix total</th>

			</tr>
			<tr>
				<?php
				// connexion à la BD
				require ("db_config.php");
				try {
   		 		$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
    			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    			$SQL = "SELECT * FROM commandes WHERE uid = '$uid'";
    			$res = $db->query($SQL);
    			if ($res->rowCount()==0){
    				?>
        			<p style="font-size: 35px"><?php echo "Vous avez fait aucun d'achat";?></p>
        			<p style="font-size: 35px"><a href="produit.php">Commencez</a> votre premier d'achat</p>
        			<p style="font-size: 35px"><a href="home.php">Revenir</a> à la page d'acceuil</p>
        		<?php
    			}else {
    				echo "<table>\n";
    			}
    			foreach($res as $row) {
				?>
    				<tr>
    				<td style="width: 250px"><?php echo htmlspecialchars($row['ref'])?></td>
    				<td style="width: 200px"><?php echo $row['uid']?></td>
    				<td style="width: 200px"><?php echo $row['rid']?></td>
    				<td style="width: 350px"><?php echo $row['date']?></td>
    				<td style="width: 350px"><?php echo $row['statut']?></td>
    				<td style="width: 250px">
    					<?php

    					$cid = $row['cid'];
    					$rid = $row['rid'];
    					
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
				
				}catch (PDOException $e){
   				 	echo "Erreur SQL: ".$e->getMessage();
				}

				?>
			</tr>
		
		</table>
<?php
include("footer.php");
?>
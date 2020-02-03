<?php
$page_title="Modifier un produit";
require("../header1.php");

if (!isset($_GET["id"])) {
			echo "<p class='alert'>Erreur<p>\n";
		} else {
			$test = 0;
			$rid = $_GET["id"];
			try {
				require("../db_config.php");
				$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SQL = "SELECT * FROM recettes WHERE rid = ?";
				$st = $db->prepare($SQL);
				$res = $st->execute(array($rid));
				if ($st->rowCount() == 0) {
					echo "<p class='alert'>Erreur de rid</p>\n";
				} else if (!isset($_POST['nom']) || !isset($_POST['prix']) ) {
					include("mod_form.php"); 
				} else {  
					$nom = $_POST['nom']; 
					$prix=  $_POST['prix']; 
					if ($nom=="" || !is_numeric($prix) || $prix<0) {
						include("mod_form.php");   
					} else {
						$SQL = "SELECT * FROM recettes";
						$res = $db->query($SQL);
						foreach($res as $row) {
							if ($row['nom'] == $nom && $row['prix'] ==$prix) {
								echo "<p class='alert'>Ce produit déjà existant.</p>";
								echo "Produit ".$row['nom'].", prix: ".$row['prix'].".<br>";
								?>
								<br>
								<p>Voulez-vous le modifier?</p>
								<a href="mod.php?id=<?php echo $row['rid']?>">Oui</a>
								<a href="../listPizza.php">Non</a>
								<br>

								<?php
								$test = 1;
							}
						}
						if($test == 0) {
							$SQL ="UPDATE recettes SET nom=?, prix=? WHERE rid=? ";
							$st = $db->prepare($SQL);
							$res = $st->execute(array($nom, $prix, $rid));
						if (!$res) {
							echo "<p class='alert'>Erreur de modification</p>";
						} else  echo "<p>La modification a été effectuée</p>";
					}
				}
				$db=null;
			}
		} catch (PDOException $e) {
			echo "Erreur SQL: ".$e->getMessage();
		}
	}
	?>
	<br>
	<br>	
	<a href='../listPizza.php'>Liste</a> des pizza

<?php
require("../footer.php");
?>
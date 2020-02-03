<?php

$title = "Payment";
include("header.php");
require("auth/EtreAuthentifie.php");

?>

	<?php
	
	
		function rand_string( $length ) {
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$str = "";
			$size = strlen( $chars );
			for( $i = 0; $i < $length; $i++ ) {
				$str .= $chars[ rand( 0, $size - 1 ) ];
			}
			return $str;
		}
		$uid = $idm->getUid();
		
		$letter = rand_string(6);
		$date = date("Y-m-d h:i:s");
		if(!isset($_SESSION['rid']) && !isset($_SESSION['supplement'])) {
			?>
			<p style="font-size: 30px"><?php echo "Votre panier est vide.<br>";?></p>
			<?php
		} else {
			try {
				require("Admin/db_config.php");
				$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
   				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				if(isset($_SESSION['rid'])) {
					$rid = $_SESSION['rid'];
					$SQL = "INSERT INTO commandes(ref,uid,rid,date) VALUES (?,?,?,?)"; 
					$st = $db->prepare($SQL);
					$res = $st->execute(array($letter,$uid,$rid,$date));
					if (!$res) { 
						echo "Erreur de connection.";
					}
					else {
						if(!isset($_SESSION['supplement'])) {
							?>
							<p style="font-size: 30px"><?php echo "Votre commande ".$letter." a été prise en compte.<br>"; ?></p>
							<?php
						}
						unset($_SESSION['rid']); 
					}
				}
				$SQL = "SELECT * FROM commandes WHERE ref = ?"; 
				$st = $db->prepare($SQL);
				$st->execute(array($letter));
				$result = $st->fetchAll(PDO::FETCH_ASSOC);
				foreach ($result as $row) { 
					$cid = $row['cid'];
				}
				if(isset($_SESSION['supplement'])) {
					$SQL = "SELECT * FROM supplements WHERE sid IN(";
					foreach($_SESSION['supplement'] as $sid => $value) {
						$SQL.=$sid.",";
					}
					$SQL = substr($SQL,0,-1).")";
					$res = $db->query($SQL);
					
					foreach($res as $row) {
						$SQL = "INSERT INTO extras VALUES (?,?)"; 
						$st = $db->prepare($SQL);
						$result = $st->execute(array($cid,$row['sid']));
					}
					if (!$res) { 
						echo "Erreur de connection.";
					}
					else {
						?>
						<p style="font-size: 30px"><?php echo "Votre commande ".$letter." a été prise en compte.<br>";?></p> 
						<?php
						unset($_SESSION['supplement']);
						unset($_SESSION['supplement_sid']);
						unset($_SESSION['rid']);
					}
				}
				$db=null;
			}
			catch (PDOException $e) {
				echo "Erreur SQL: ".$e->getMessage(); 
			}
		}
	
	?>

	<br>
	<br>
	<p style="font-size: 30px"><a href='home.php'>Revenir</a> à la home</p>
</div>
<?php
include("footer.php");
?>




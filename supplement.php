<?php
session_start();
$title = "Supplement";
include("header.php");
$_SESSION['rid'] = $_GET['id'];

?>
<div id="#">

	<h1>Liste de supplement:</h1>
		<table>
			<tr>
			
				<th style="width: 550px">Nom</th>
				<th style="width: 450px">Prix</th>
				<th style="width: 550px">Selection</th>
			</tr>
			<?php
			// connexion à la BD
			require ("Admin/db_config.php");
			try {
   			$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
   			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$SQL = "SELECT * FROM supplements";
   			$res = $db->query($SQL);
   			if ($res->rowCount()==0){
        		echo "<P>La liste est vide";
    		}else {echo "<table>\n";
    		foreach($res as $row) {
			?>
			<form action="panier.php" method="post">
   		   		<tr>
    			
   				<td style="width: 550px"><?php echo $row['nom']?></td>
    			<td style="width: 450px"><?php echo $row['prix']?></td>
    			<td style="width: 550px"><input type="checkbox" name="supplement[]" value="<?php echo $row['nom'] ?>"></td>
    			
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
      <br>
      <br>
      <td><input type="submit" name="Panier" value="Panier"></td>
      
     	</form>
     	<br>
   
     </table>
</div>
    
<br>

		<p style="font-size: 35px"><a href='home.php'>Aller</a> à la home</p>

<?php
include "footer.php";
?>
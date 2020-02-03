
<?php
session_start();
$title = "Panier";
include("header.php");



if(isset($_GET['supprimer'])){

 		if ($_GET['supprimer'] == 'recette'){
				unset($_SESSION['rid']);
				if(isset($_SESSION['supplement'])){
					unset($_SESSION['supplement']);
				}
		}else{
			if(isset($_SESSION['supplement']) && isset($_GET['sidSupp'])){
				
				unset($_SESSION['supplement'][$_GET['sidSupp']]);
			}
		}
}

if(isset($_SESSION['rid'])){
$rid = $_SESSION['rid'];


		if(isset($_POST['supplement'])){
	?>
		

			
			<?php
			
			require ("Admin/db_config.php");
			try {
					foreach ($_POST['supplement'] as $selection){
						$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
   						$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						//echo $selection."</br>";
						$SQL = "SELECT * FROM supplements WHERE nom ='$selection'";
   						$res = $db->prepare($SQL);
						$res->execute(['$nom']);
   						if ($res->rowCount()==0){
        					echo "<P>La liste est vide";
    					}else {echo "<table>\n";
    					
    					foreach ($res as $row) {
    					?>
    					<?php
    					$_SESSION['supplement'][$row['sid']]=$row['prix'];
    					
    				
						
						
    					$db=null;
						}
					}			
				}
			}catch (PDOException $e){
   				echo "Erreur SQL: ".$e->getMessage();
			}

			
	}
			?>
		</table>
		<br>



<h1> Pizza</h1>

			<?php

	?>
	<table>
			<tr>
				<th style="width: 550px">Rid</th>
				<th style="width: 550px">Nom</th>
				<th style="width: 450px">Prix</th>
				<th style="width: 550px">Action</th>
			</tr>
			<?php
			try{
				require ("Admin/db_config.php");
				$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
   				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   				$SQL = "SELECT * FROM recettes WHERE rid ='$rid'";
   				$res = $db->prepare($SQL);
				$res->execute(['$nom']);
				if ($res->rowCount()==0){
        			echo "<P>La liste est vide";
    			}else {echo "<table>\n";
    			foreach ($res as $row) {
    				$sommePizza = $row['prix'];
    				?>
					<tr>
    					<td style="width: 550px"><?php echo $row['rid']?></td>
    					<td style="width: 550px"><?php echo $row['nom']?></td>
    					<td style="width: 450px"><?php echo $row['prix']?></td>
    					<td style="width: 550px"><a href="panier.php?supprimer=recette&rid=$rid">Supprimer</a></td>
    				</tr>
    			
    			<?php

					echo "</table>\n";
    				$db=null;
    			}
    		}
    		}catch (PDOException $e){
   				echo "Erreur SQL: ".$e->getMessage();
			}
			?>
			

			<p style="font-size: 35px;text-align: center"><?php echo "Le prix de pizza est: $sommePizza"; ?></p>

			
		</table>




 <h1> Supplement</h1>
    <?php
    if(isset($_SESSION['supplement'])){
    	?>
    	<table>

    		<th style="width: 550px">Sid</th>
    		<th style="width: 550px">Nom</th>
    		<th style="width: 450px">Prix</th>
    		<th style="width: 550px">Action</th>
    		
    	<?php
    	$sommeSupp =0;
    	foreach ($_SESSION['supplement'] as $sid =>$value) {
    		$sommeSupp = $sommeSupp +$value;
            ?>
                <tr>
                    <td style="width: 550px"><?php echo $sid?></td>
                    <td style="width: 550px">
                    	<?php
                    	$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
   						$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                		$SQL1 = "SELECT nom FROM supplements WHERE sid = $sid ";
    					$res1 = $db->query($SQL1);
    					foreach($res1 as $row) {
								$nom = $row['nom'];
						}
						echo $nom;
                    	?>
                    </td>
                    <td style="width: 450px"><?php echo $value?></td>
                    <td style="width: 550px"><a href="panier.php?supprimer=supplement&sidSupp=<?php echo $sid?>">Supprimer</a></td>
                </tr>
                      
          <?php  
          
        }
    
    	?>
    	</table>
<?php
    }
    if(isset($sommeSupp)){
    ?>
    <p style="font-size: 35px;text-align: center"><?php echo "Le prix de supplements est: $sommeSupp"; ?></p>
    <?php
	}else{
		?>
		<p style="font-size: 35px;text-align: center"><?php echo "Vous avez aucun de supplements"?></p>
	<?php
	}
    ?>
    

			

	<h1>Total</h1>
<?php
if(isset($sommePizza) && isset($sommeSupp)){	
	
	$somme = $sommeSupp + $sommePizza;
	?>
	<p style="font-size: 35px;text-align: center"><?php echo "La total de votre commande est: $somme";?></p>
	<?php 
}else if(isset($sommePizza)){
	$somme =  $sommePizza;
	?>
	<p style="font-size: 35px;text-align: center"><?php echo "La total de votre commande est: $somme"; ?></p>
	<?php
}else{
	?>
	<p style="font-size: 35px;text-align: center"><?php echo "Votre panier est vide";  ?></p>
	<?php

}
}else{
	?>
	<p style="font-size: 35px;text-align: center"><?php echo "Votre panier est vide"; ?></p>
	<?php 
}
	?>
	<br>
	<br>
	<form action="addCommand.php?somme=<?php echo $somme?>"method="post">
		<td><input type="submit" name="Payment" value="Payment"></td>
	</form>

	<br>
	<br>	
	<form action="panier.php?supprimer=recette&rid=$rid" method="post">
		<td><input type="submit" name="Supprimer la command" value="Supprimer la command"></td>
	</form>
	<br>
	
		<p style="font-size: 40px"><a href='home.php'>Aller</a> à la home</p>

<?php
include("footer.php");

?>
<?php

	require("../auth/EtreAuthentifie.php");
	require('../db_config.php');
	
		if($idm->getRole() == 'admin' ) {
			require("header.php");
			?>
			<a href='../home.php'>Revenir</a> à la page d'accueil
			<?php
			require("footer.php");
		} else { 
			echo "Vous n'avez pas le droit d'accès à cette page.<br>";
		}
			
	
?>


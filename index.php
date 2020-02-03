<!DOCTYPE html>
<html>
<head>
    <title>NANA'S PIZZA</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
	<style>
		body, html {height: 100%}
		body,h1,h2,h3,h4,h5,h6 {font-family: "Amatic SC", sans-serif}
		.menu {display: none}
		.bgimg {
  			background-repeat: no-repeat;
  			background-size: cover;
  			background-image: url("img_main.jpg");
 			 min-height: 90%;
		}

	</style>
</head>


	<!-- Navbar (sit on top) -->
	<div class="w3-top w3-hide-small">
  		<div class="w3-bar w3-xlarge w3-black w3-opacity w3-hover-opacity-off" id="myNavbar">
  		<a href="home.php" class="w3-bar-item w3-button">HOME</a>
    	<a href="produit.php" class="w3-bar-item w3-button">MENU</a>
   		<a href="panier.php" class="w3-bar-item w3-button">PANIER</a>
    	<a href="home.php" class="w3-bar-item w3-button">CONNECTER</a>
  		</div>
	</div>
	<!-- Header with image -->
	
	<header class="bgimg w3-display-container" id="home">
		<img src="img_main.jpg" alt>
  		<div class="w3-display-bottomleft w3-padding">
   		<span class="w3-tag w3-xlarge">Open from 10am to 12pm</span>
  		</div>
  		<div class="w3-display-middle w3-center">
    	<span class="w3-text-white w3-hide-small" style="font-size:100px">NANA'S PIZZA<br>Testez-moi</span>
    	<p><a href="produit.php" class="w3-button w3-xxlarge w3-black">Let me see the menu</a></p>

  		</div>
	</header>


</html>
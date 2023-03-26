<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<h1>GESTION DES SOUTENANCES</h1>
		</div>
		<div class="login-content">
			<form method="POST" action="login.php">
				<img src="img/avatar.svg">
				<h2 class="title">Bienvenue</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Utilisateur</h5>
           		   		<input id="utilisateur" type="text" class="input" name="Utilisateur">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Mot de passe</h5>
           		    	<input id="mot_de_passe" type="password" class="input" name="mot_de_passe">
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="connecter">
				<input onclick="location.href='index.php';" type="buton" class="annuler" value="retour">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>

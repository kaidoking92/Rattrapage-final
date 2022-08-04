<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
        <meta name="description" content="Description de ma page">
		<title>Template BACK</title>
		<link rel="stylesheet" type="text/css" href="/public/dashboard.css">
		<script src="https://kit.fontawesome.com/f3633012bb.js" crossorigin="anonymous"></script>
		<script
			src="https://code.jquery.com/jquery-3.6.0.min.js"
			integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			crossorigin="anonymous"></script>
		<script type="text/javascript" src="/public/richtext/jquery.richtext.min.js"></script>
		<script type="text/javascript" src="/public/main.js"></script>
	</head>
	
	<body>
        
		<header>
			<!--<span class="title_navbar">Nom du site</span>
			<span class="profil_pic">
				photo
				<?php //echo $user->getFirstname() ?>
			</span>-->
		</header>

		<div class="flexRow">

			<div class="sidebar">
				<ul>
					<li><a href="/dashboard"> <i class="fa-solid fa-house"></i> Accueil </a></li> 
					<li><a href="/checkouts"><i class="fa-solid fa-dollar-sign"></i> Commandes </a></li> 
					<li><a href="/products"><i class="fa-solid fa-box"></i> Produits </a> </li>
					<li><a href="/categories"><i class="fa-solid fa-tags"></i> Categories </a> </li>
					<li><a href="/users"> <i class="fa-solid fa-user"></i> Utilisateurs </a> </li>
					<li> <a href="/comments"><i class="fas fa-comment"></i> Commentaires </a> </li>
					<li> <a href="/list"><i class="fa-solid fa-file"></i> Pages </a> </li>
					<li> <a href="/templates"><i class="fa-solid fa-file-code"></i> Templates </a> </li>
				</ul>
			</div>
			<div class="container">
					<?php include "View/".$this->view.".view.php"; ?> 
			</div>
		
		</div>
	</body>



</html>
<?php

echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<!-- TITRE ET MENUS -->
<html lang="fr">
<title>Festival</title>
<meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="bootstrap/css/style.css" rel="stylesheet"> 
<link href="bootstrap/css/bootstrap.css" rel="stylesheet"> 

<!-- Barre de navigation -->
<div class="navbar navbar-inverse">
<div class="navbar-inner">
<!-- Bouton apparaissant sur les résolutions mobiles afin de faire apparaître le menu de navigation -->
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>
<a class="brand" href="index2.php"><img src="bootstrap/img/M2Logo.png" alt="RSS" style="border:none"/> M2L </a>
<!-- Structure du menu -->
<div class="nav-collapse collapse">
<ul class="nav">
<li><a href="index2.php">Accueil</a></li>
<li class="divider-vertical"></li>
<li><a href="listeEtablissements.php">Gestion établissements</a></li>
<li class="divider-vertical"></li>
<li><a href="consultationAttributions.php">Attributions chambres</a></li>
<li class="divider-vertical"></li>
<li><a href="apropos.php">A-propos</a></li>
<li class="divider-vertical"></li>
</ul>
</div>
</div>
</div>

<!-- <div class="navbar navbar-inverse fixed-bottom"><div class="navbar-inner"> --!>

<div id="footer" class="container">	
<nav class="navbar navbar-default navbar-fixed-bottom">
<div class="navbar-default navbar-content-center">
<p style="text-align:center">BTS SIO - <a href="apropos.php">Auteurs</a> - Option SLAM</p>
</div>
</nav>
</div>

<!-- Intégration de la libraire jQuery -->
<script src="bootstrap/js/jquery-1.8.3.min.js"></script>
<!-- Intégration de la libraire de composants du Bootstrap -->
<script src="bootstrap/js/bootstrap.min.js"></script>
';



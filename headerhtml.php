<!DOCTYPE>

<!--
  FLOTTE - Gestion de flotte.

   Copyright (C) 2023 Thierry HUCHARD <thierryh@vivaldi.net>

   This file is part of the FLOTTE.

   FLOTTE is free software; you can redistribute it and/or modify it under
   the terms of the GNU General Public License as published by the Free
   Software Foundation; either version 3 of the License, or (at your
   option) any later version.

   FLOTTE is distributed in the hope that it will be useful, but WITHOUT
   ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
   FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License
   for more details.

   You should have received a copy of the GNU General Public License
   along with sane; see the file COPYING.
   If not, see <https://www.gnu.org/licenses/>.
   -->
<html class="h-100" lang=en-US">
   <head>
       <title>Vehicules</title>
       <meta name="csrf-param" content="_csrf">
       <meta name="csrf-token" content="AUMexNroziSBj9kbN1WIVRnpBh6N1uZAapeomfeoWBx5E3qG7KKYVN7cqy5SAr0kaMQ1dMW8vCsi_5ndjekyRA==">

       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       <meta name="description" content="">
       <meta name="keywords" content="">
       <link type="image/x-icon" href="favicon.ico" rel="icon">
       <link href="assets/9a468c62/dist/css/bootstrap.css" rel="stylesheet">
       <link href="css/site.css" rel="stylesheet"><link id="nordvpn-contentScript-extension-fonts" rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato">
       <link rel="stylesheet" href="css/style.css" media="screen" type="text/css"/>
       <link rel="stylesheet" href="css/menu.css" media="all" type="text/css" />
   </head>
   <body>
       <header id="header">
           <nav id="w1" class="navbar-expand-md navbar-dark bg-dark fixed-top navbar">
              <div class="container">


<div id="mySidenav" class="sidenav">
  <a id="closeBtn" href="#" class="close">&times;</a>
  <ul>
<?php
if (isset($_SESSION['role']) && $_SESSION['role'] == 0) {
?>
                        <li><a href="<?php echo $BASE_PATH;?>/index.php">Tableau de bord</a></li>
                        <li><a active href="<?php echo $BASE_PATH;?>/vehicule.php">Véhicule</a></li>
                        <li><a href="<?php echo $BASE_PATH;?>/incident.php">Incident</a></li>
                        <li><a href="<?php echo $BASE_PATH;?>/marque.php?action=create">Marque</a></li>
                        <li><a href="<?php echo $BASE_PATH;?>/model.php?action=create">Model</a></li>
                        <li><a href="<?php echo $BASE_PATH;?>/user.php?action=create">Utilisateur</a></li>
<?php
}
else if (!isset($_SESSION['role'])) {
?>
                        <li><a href="<?php echo $BASE_PATH;?>/admin.php">Admin</a></li>
<?php
}
?>
                        <li><a href="<?php echo $BASE_PATH;?>/logout.php">Déconnection</a></li>
  </ul>
</div>

<a href="#" id="openBtn">
  <span class="burger-icon">
    <span></span>
    <span></span>
    <span></span>
  </span>
</a>
</div>
</nav>
</header>
<script type="text/javascript" src="<?php echo $BASE_PATH;?>/assets/script.js"></script>

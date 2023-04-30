<?php
/* FLOTTE - Gestion de flotte.

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
   */


include_once('common.php');

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update') {
   $_id = $_REQUEST['id'];
   $sql = "UPDATE releve_kilometrique SET ".
          "`id_suivi`=0 ".
          " WHERE id='".$_REQUEST['id']."';";
   $conn->query($sql);
   if ($conn->errno) {
      die("Could not insert record into table: %s<br />". $conn->error);
   }
}

include_once('headerhtml.php');
?>
       <main id="main" class="flex-shrink-0" role="main">
           <div class="container">
              <div class="vehicule-index">
                 <h1>Intervention à prévoir</h1>
                 <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
                   <div id="w0" class="grid-view"><table class="table table-striped table-bordered">
                         <thead>
                            <tr>
                               <th>Plaque</th>
                               <th>Intervention</th>
                               <th>Date</th>
                               <th class="action-column">&nbsp;</th>
			    </tr>
                         </thead>
			 <tbody>
<?php
// On détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}

// On détermine le nombre d'articles par page
$parPage = 10;

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;


$sql = "SELECT COUNT(id) AS count FROM releve_kilometrique WHERE id_suivi > 0 AND DATE(date_suivi) <= '".dateplus2()."';";
// $sql = "SELECT COUNT(id) AS count FROM releve_kilometrique WHERE id_suivi > 0;";
$result = $conn->query($sql);

if ($result->num_rows == 0)
   die('Aucun enregistrement trouvé.<br>');
// output data of each row
$row = $result->fetch_assoc();

$nbArticles = $row['count'];
// die($nbArticles);
// On calcule le nombre de pages total
$pages = ceil($nbArticles / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

$page_link = 'index.php?page=';
$sql = "SELECT rk.id, v.plaque, i.nom, rk.date_suivi FROM releve_kilometrique AS rk, intervention AS i, vehicule AS v WHERE " .
       "rk.id_suivi = i.id AND id_vehicule = v.id AND DATE(rk.date_suivi) < '".dateplus2()."' ORDER BY rk.date_suivi DESC  LIMIT ". $premier .",". $parPage .";";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
	       echo '<tr><td data-label="Plaque">'.$row["plaque"].'</td><td data-label="Intervention">'.$row["nom"].'</td><td data-label="Date">'.datealerte($row["date_suivi"], date_fr($row["date_suivi"])).'</td><td data-label="Action"><a href="index.php?action=update&id='.$row['id'].'">Fait</a></td></tr>';
       }
    }

?>
                         </tbody>
                      </table>
<nav>
    <ul class="pagination">
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item <?php echo (($currentPage == 1) ? 'disabled' : '') ?>">
            <a href="<?php echo "$page_link".($currentPage - 1); ?>" class="page-link">Précédente</a>
        </li>
        <?php for($page = 1; $page <= $pages; $page++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?php echo (($currentPage == $page) ? 'active' : ''); ?>">
                <a href="<?php echo "$page_link".$page; ?>" class="page-link"><?= $page ?></a>
            </li>
        <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?php echo (($currentPage == $pages) ? "disabled" : ""); ?>">
            <a href="<?php echo "$page_link".($currentPage + 1); ?>" class="page-link">Suivante</a>
        </li>
    </ul>
</nav>
<!-- revision -->
              <div class="vehicule-index">
                 <h1>Révision à prévoir</h1>
                 <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
                   <div id="w0" class="grid-view"><table class="table table-striped table-bordered">
                         <thead>
                            <tr>
                               <th>Plaque</th>
                               <th>Intervention</th>
                               <th>Date</th>
			    </tr>
                         </thead>
			 <tbody>
<?php
// On détermine sur quelle page on se trouve
if(isset($_GET['page2']) && !empty($_GET['page2'])){
    $currentPage2 = (int) strip_tags($_GET['page2']);
}else{
    $currentPage2 = 1;
}

// On détermine le nombre d'articles par page
$parPage2 = 10;

// Calcul du 1er article de la page
$premier2 = ($currentPage2 * $parPage2) - $parPage2;

// select id_vehicule, date FROM releve_kilometrique WHERE DATE(date) < '2023-02-24' AND id_intervention=4 UNION select id, '2021-07-01' AS date FROM vehicule WHERE id NOT IN (select id_vehicule FROM releve_kilometrique WHERE id_intervention=4) ORDER BY date DESC LIMIT 1,3;


$sql2 = "SELECT (SELECT COUNT(DISTINCT id_vehicule) FROM releve_kilometrique WHERE DATE(date) < '".datemoins2()."' AND id_intervention=4) + (SELECT COUNT(DISTINCT id) FROM vehicule WHERE id NOT IN (select id_vehicule FROM releve_kilometrique WHERE id_intervention=4)) AS count";	
	// $sql = "SELECT COUNT(id) AS count FROM releve_kilometrique WHERE id_suivi > 0;";
$result2 = $conn->query($sql2);

if ($result2->num_rows == 0)
   die('Aucun enregistrement trouvé.<br>');
// output data of each row
$row2 = $result2->fetch_assoc();

$nbArticles2 = $row2['count'];
// die($nbArticles);
// On calcule le nombre de pages total
$pages2 = ceil($nbArticles2 / $parPage2);

// Calcul du 1er article de la page
$premier2 = ($currentPage2 * $parPage2) - $parPage2;

$page_link2 = 'index.php?page=';
$sql2 = "(select plaque, date FROM releve_kilometrique, vehicule WHERE id_vehicule = vehicule.id AND DATE(date) < '".datemoins2()."' AND id_intervention=4 AND date in (select MAX(date) FROM releve_kilometrique WHERE id_intervention=4 GROUP BY id_vehicule)) UNION (select plaque, '2021-07-01' AS date FROM vehicule WHERE id NOT IN (select id_vehicule FROM releve_kilometrique WHERE id_intervention=4)) ORDER BY plaque ASC  LIMIT ". $premier2 .",". $parPage2 .";";	
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
       // output data of each row
       while($row2 = $result2->fetch_assoc()) {
	       echo '<tr><td data-label="Plaque">'.$row2["plaque"].'</td><td data-label="Type">Entretien</td><td data-label="Date">'.datealerte($row2["date"], date_fr($row2["date"])).'</td></tr>';
       }
    }

?>
                         </tbody>
                      </table>
<nav>
    <ul class="pagination">
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item <?php echo (($currentPage2 == 1) ? 'disabled' : '') ?>">
            <a href="<?php echo "$page_link2".($currentPage2 - 1); ?>" class="page-link">Précédente</a>
        </li>
        <?php for($page2 = 1; $page2 <= $pages2; $page2++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?php echo (($currentPage2 == $page2) ? 'active' : ''); ?>">
                <a href="<?php echo "$page_link2".$page2; ?>" class="page-link"><?= $page2 ?></a>
            </li>
        <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?php echo (($currentPage2 == $pages2) ? "disabled" : ""); ?>">
            <a href="<?php echo "$page_link2".($currentPage2 + 1); ?>" class="page-link">Suivante</a>
        </li>
    </ul>
</nav>
                   </div>
                    </div>
                </div>
	    </div>

       </main>
   </body>
</html>

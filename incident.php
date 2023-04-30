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
                 <h1>Incidents</h1>
		 <p><a class="btn btn-success" href="<?php echo $BASE_PATH;?>incident_form.php?action=create"> + </a></p>
                 <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
                   <div id="w0" class="grid-view"><table class="table table-striped table-bordered">
                         <thead>
                            <tr>
                               <th>Plaque</th>
                               <th>Incident</th>
                               <th>Déclarant</th>
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


$sql = "SELECT COUNT(id) AS count FROM incident;";
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

$page_link = $BASE_PATH.'incident.php?page=';
$sql = "SELECT ix.id, v.plaque, a.nom AS type_accident,u.username, ix.date FROM incident AS ix, accident AS a, vehicule AS v, users AS u WHERE " .
	"ix.id_user = u.id AND ix.id_vehicule = v.id AND ix.id_accident = a.id ORDER BY ix.date DESC  LIMIT ". $premier .",". $parPage .";";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
	       echo '<tr><td data-label="Plaque">'.$row["plaque"].'</td><td data-label="Type">'.$row["type_accident"].'</td><td data-label="Déclarant">'.$row['username'].'</td><td data-label="Date">'.date_fr($row["date"]).'</td><td><a href="'.$BASE_PATH.'incident_details.php?id='.$row['id'].'">Details</a></td></tr>';
       }
    }

?>
                         </tbody>
                      </table>
<nav>
    <ul class="pagination">
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item <?php echo (($currentPage == 1) ? 'disabled' : '') ?>">
            <a href="<?php echo $page_link.($currentPage - 1); ?>" class="page-link">Précédente</a>
        </li>
        <?php for($page = 1; $page <= $pages; $page++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?php echo (($currentPage == $page) ? 'active' : ''); ?>">
                <a href="<?php echo $page_link.$page; ?>" class="page-link"><?= $page ?></a>
            </li>
        <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?php echo (($currentPage == $pages) ? "disabled" : ""); ?>">
            <a href="<?php echo $page_link.($currentPage + 1); ?>" class="page-link">Suivante</a>
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

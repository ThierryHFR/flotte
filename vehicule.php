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
include_once('headerhtml.php');
?>
       <main id="main" class="flex-shrink-0" role="main">
           <div class="container">
              <div class="vehicule-index">
		 <h1>Vehicules</h1>
<?php 
if ($_SESSION["role"] == 0) {
?>
                 <p><a class="btn btn-success" href="<?php echo $BASE_PATH;?>/vehicule_form.php?action=create">Ajouter un véhicule</a></p>
<?php 
}
?>
                 <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
                   <div id="w0" class="grid-view"><table class="table table-striped table-bordered">
                         <thead>
                            <tr>
			    <th><a href="<?php echo $BASE_PATH;?>/index.php?r=vehicule%2Findex&amp;sort=plaque" data-sort="plaque">Plaque</a></th>
                               <th><a href="<?php echo $BASE_PATH;?>/index.php?r=vehicule%2Findex&amp;sort=id_marque" data-sort="id_marque">Marque</a></th>
                               <th><a href="<?php echo $BASE_PATH;?>/index.php?r=vehicule%2Findex&amp;sort=id_model" data-sort="id_model">Model</a></th>
                               <th><a href="<?php echo $BASE_PATH;?>/index.php?r=vehicule%2Findex&amp;sort=date1_immatriculation" data-sort="date1_immatriculation">Date 1er immatriculation</a></th>
<?php 
if ($_SESSION["role"] == 0) {
?>
                               <th class="action-column">&nbsp;</th>
                               <th class="action-column">&nbsp;</th>
<?php 
}
?>
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

$sql = "SELECT COUNT(id) AS count FROM vehicule";
$result = $conn->query($sql);

if ($result->num_rows == 0)
   die('Aucun enregistrement trouvé.<br>');
// output data of each row
$row = $result->fetch_assoc();

$nbArticles = $row['count'];    
// On calcule le nombre de pages total
$pages = ceil($nbArticles / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

$page_link = $BASE_PATH.'/vehicule.php?page=';

    $sql = "SELECT v.id, v.plaque, ma.nom AS marque, mo.nom AS model, v.date1_immatriculation FROM vehicule AS v, model AS mo, marque AS ma WHERE v.id_marque = ma.id AND v.id_model = mo.id ORDER BY v.plaque ASC LIMIT ".$premier.",".$parPage.";";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
	       echo '<tr><td data-label="Plaque">'.$row["plaque"].'</td><td data-label="Marque">'.$row["marque"].'</td><td data-label="Model">'.$row["model"].'</td><td data-label="Date Imat.">'.date_fr($row['date1_immatriculation']).'</td>';

               if ($_SESSION['role'] == 0)
		   echo '<td><a href="'.$BASE_PATH.'/vehicule_details.php?action=detail&id='.$row['id'].'">Détail</a></td><td><a href="'.$BASE_PATH.'/vehicule_form.php?action=update&id='.$row['id'].'">Modifier</a></td><td><a href="?action=delete&id='.$row['id'].'">Supprimer</a></td></tr>';
	       else
                   echo '<td><a href="'.$BASE_PATH.'/incident.php?id='.$row['id'].'">Incident</a></td></tr>';
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
                   </div>
                    </div>
                </div>
            </div>
       </main>
   </body>
</html>

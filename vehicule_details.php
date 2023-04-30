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

$page_limit = 10;
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}

////// Releve Kilometrique /////////////////////

$query_count = 'SELECT count(id) AS count FROM releve_kilometrique WHERE id_vehicule = '.$_REQUEST['id'].' ';
$res_obj = $conn->query($query_count);
$results_count = $res_obj->fetch_assoc();
$nbArticles = (int)$results_count['count'];

// On détermine le nombre d'articles par page
$parPage = 10;

// On calcule le nombre de pages total
$pages = ceil($nbArticles / $parPage);

$page_link = $BASE_PATH.'/vehicule_details.php?id='.$_REQUEST['id'].'&page=';

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;


/////////////////   INCIDENT /////////////////
if(isset($_GET['page2']) && !empty($_GET['page2'])){
    $currentPage2 = (int) strip_tags($_GET['page2']);
}else{
    $currentPage2 = 1;
}

$query_count2 = 'SELECT count(id) AS count FROM incident WHERE id_vehicule = '.$_REQUEST['id'].' ';
$res_obj2 = $conn->query($query_count2);
$results_count2 = $res_obj2->fetch_assoc();
$nbArticles2 = (int)$results_count2['count'];

// On détermine le nombre d'articles par page
$parPage2 = 10;

// On calcule le nombre de pages total
$pages2 = ceil($nbArticles2 / $parPage2);

$page_link2 = $BASE_PATH.'/vehicule_details.php?id='.$_REQUEST['id'].'&page2=';

// Calcul du 1er article de la page
$premier2 = ($currentPage2 * $parPage2) - $parPage2;

include_once('headerhtml.php');
?>
       <main id="main" class="flex-shrink-0" role="main">
           <div class="container">


<?php
    $sql = 'SELECT v.plaque, ma.nom AS marque, mo.nom AS model, v.date1_immatriculation, v.date_cate_grise FROM vehicule AS v, marque AS ma, model AS mo WHERE v.id_marque = ma.id AND v.id_model = mo.id AND v.id = '.$_REQUEST['id'].' ';
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
       die('Aucun enregistrement trouvé.');
    }
       // output data of each row
    $row = $result->fetch_assoc();
?>








              <div class="vehicule-index">
		 <h1>Vehicule</h1>
                 <p><a class="btn btn-success" href="vehicule.php">Retour</a></p>
              <div class="vehicule-view">

                <div class="form-group field-vehicule-plaque">
                   <label class="control-label">Plaque</label>
                   <label class="form-control hasDatepicker"><?php echo $row['plaque'];?></label>
                </div>
                <div class="form-group field-vehicule-marque">
                   <label class="control-label">Marque</label>
                   <label class="form-control hasDatepicker"><?php echo $row['marque'];?></label>
                </div>
                <div class="form-group field-vehicule-model">
                   <label class="control-label">Model</label>
                   <label class="form-control hasDatepicker"><?php echo $row['model'];?></label>
                </div>
                <div class="form-group field-vehicule-date1_immatriculation">
                   <label class="control-label">Date 1er immatriculation</label>
                   <label class="form-control hasDatepicker"><?php echo date_fr($row['date1_immatriculation']);?></label>
                </div>
                <div class="form-group field-vehicule-date_carte_grise">
                   <label class="control-label">Date carte grise</label>
                   <label class="form-control hasDatepicker"><?php echo date_fr($row['date_cate_grise']);?></label>
                </div>


              </div>
                 <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
		 <h3>Suivi intervention</h3>
		 <p><a class="btn btn-success" href="releve_kilometrique_form.php?action=create&id_vehicule=<?php echo $_REQUEST['id'];?>"> + </a></p>
                   <table class="table table-striped table-bordered">
                         <thead>
                            <tr>
			    <th><a href="<?php echo $BASE_PATH;?>/index.php?r=vehicule%2Findex&amp;sort=plaque" data-sort="plaque">Date</a></th>
                               <th><a href="<?php echo $BASE_PATH;?>/index.php?r=vehicule%2Findex&amp;sort=id_marque" data-sort="id_marque">Intervention</a></th>
                               <th><a href="<?php echo $BASE_PATH;?>/index.php?r=vehicule%2Findex&amp;sort=id_model" data-sort="id_model">Km</a></th>
                               <th class="action-column">&nbsp;</th>
                               <th class="action-column">&nbsp;</th>
			    </tr>
                         </thead>
			 <tbody>
<?php
    $sql = 'SELECT rk.id, rk.km, i.nom, rk.date, rk.facture FROM releve_kilometrique AS rk, intervention AS i WHERE rk.id_intervention = i.id AND id_vehicule = '.$_REQUEST['id'].' ORDER BY rk.date DESC  LIMIT '. $premier .','. $parPage .';';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
           echo '<tr><td>'.date_fr($row["date"]).'</td><td>'.$row["nom"].'</td><td>'.$row["km"].'</td><td><a href="'.$BASE_PATH.'/releve_kilometrique_details.php?action=detail&id='.$row['id'].'&id_vehicule='.$_REQUEST['id'].'">Détail</a></td><td><a href="'.$BASE_PATH.'/releve_kilometrique_form.php?action=update&id='.$row['id'].'&id_vehicule='.$_REQUEST['id'].'">Modifier</a></td></tr>';
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
            <a href="./?page=<?php echo "$page_link".($currentPage + 1); ?>" class="page-link">Suivante</a>
        </li>
    </ul>
</nav>

                   </div>
		    </div>
<!-- incident -->
                 <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
		 <h3>Suivi incident</h3>
		 <p><a class="btn btn-success" href="incident_form.php?action=create&id_vehicule=<?php echo $_REQUEST['id'];?>"> + </a></p>
<?php
    $sql = 'SELECT i.id, i.km, a.nom, i.date FROM incident AS i, accident AS a WHERE i.id_accident = a.id AND i.id_vehicule = '.$_REQUEST['id'].' ORDER BY i.date DESC  LIMIT '. $premier2 .','. $parPage2 .';';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
?>
                   <table class="table table-striped table-bordered">
                         <thead>
                            <tr>
                               <th>Date</a></th>
                               <th>Incident</a></th>
                               <th>Km</a></th>
                               <th class="action-column">&nbsp;</th>
                               <th class="action-column">&nbsp;</th>
			    </tr>
                         </thead>
			 <tbody>
<?php
       // output data of each row
       while($row = $result->fetch_assoc()) {
           echo '<tr><td>'.date_fr($row["date"]).'</td><td>'.$row["nom"].'</td><td>'.$row["km"].'</td><td><a href="'.$BASE_PATH.'/incident_details.php?action=detail&id='.$row['id'].'&id_vehicule='.$_REQUEST['id'].'">Détail</a></td><td><a href="'.$BASE_PATH.'/incident_form.php?action=update&id='.$row['id'].'&id_vehicule='.$_REQUEST['id'].'">Modifier</a></td></tr>';
       }
    echo '</tbody></table>';
?>
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
            <a href="./?page=<?php echo "$page_link2".($currentPage2 + 1); ?>" class="page-link">Suivante</a>
        </li>
    </ul>
</nav>
<?php
    }
?>

                   </div>
                    </div>

                </div>
            </div>
       </main>
   </body>
</html>

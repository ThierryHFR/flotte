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


<?php
    $sql = 'SELECT v.plaque, a.nom AS type_accident, u.username, ix.incident, ix.date FROM vehicule AS v, incident AS ix, accident AS a, users AS u WHERE '.
	   'v.id = ix.id_vehicule AND ix.id_accident = a.id AND u.id = ix.id_user AND ix.id = '. $_GET['id'] .';';
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
       die('Aucun enregistrement trouvé.');
    }
       // output data of each row
    $row = $result->fetch_assoc();
?>








              <div class="vehicule-index">
		 <h1>Déclaration incident</h1>
                 <p><a class="btn btn-success" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a></p>
              <div class="vehicule-view">
                <div class="form-group field-vehicule-plaque">
                   <label class="control-label">Plaque</label>
                   <label class="form-control hasDatepicker"><?php echo $row['plaque'];?></label>
                </div>
                <div class="form-group field-vehicule-plaque">
                   <label class="control-label">Déclarant</label>
                   <label class="form-control hasDatepicker"><?php echo $row['username'];?></label>
                </div>
                <div class="form-group field-vehicule-plaque">
                   <label class="control-label">Type</label>
                   <label class="form-control hasDatepicker"><?php echo $row['type_accident'];?></label>
                </div>
                <div class="form-group field-vehicule-plaque">
                   <label class="control-label">Détails</label>
                   <label class="form-control hasDatepicker"><?php echo $row['incident'];?></label>
                </div>
                <div class="form-group field-vehicule-plaque">
                   <label class="control-label">Date</label>
                   <label class="form-control hasDatepicker"><?php echo dateheure_fr($row['date']);?></label>
                </div>
              </div>
                 <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
		 <h3>Photos</h3>
		 <p><a class="btn btn-success" href="capture.php?id=<?php echo $_REQUEST['id'];?>"> + </a></p>
                   <table class="table table-striped table-bordered">
                         <thead>
                            <tr>
                               <th class="action-column">&nbsp;</th>
			    </tr>
                         </thead>
			 <tbody>
<?php
    $folderPath = 'uploadImages/';
    $i = 1;

    $file = $_SERVER['DOCUMENT_ROOT'].'/'.$folderPath . 'i' .  $_REQUEST['id'] . '-' . $i . '.png' ;
    while (file_exists($file)) {
	echo '<tr><td><img src="'.$folderPath . 'i' .  $_REQUEST['id'] . '-' . $i . '.png"></mtd></tr>';
        $i = $i + 1;
        $file = $_SERVER['DOCUMENT_ROOT'].'/'.$folderPath . 'i' .  $_REQUEST['id'] . '-' . $i . '.png' ;
    }

?>
                         </tbody>
		      </table>

                   </div>
                    </div>

                </div>
            </div>
       </main>
   </body>
</html>

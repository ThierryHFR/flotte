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

if (isset($_POST['btn-sav'])) {
   if ($_REQUEST['action'] == 'update') {
      $plaque = addslashes ($_POST['plaque']);
      $marque = $_POST['id_marque'];
      $model = $_POST['id_model'];
      $datec = $_POST['date1_immatriculation'];
      $datea = $_POST['date_cate_grise'];
      $sql = "UPDATE vehicule SET ".
	     "`plaque`='$plaque', `id_marque`='$marque', `id_model`='$model', `date1_immatriculation`='$datec', `date_cate_grise`='$datea'".
	     " WHERE id='".$_POST['id']."';";
      $conn->query($sql);
      if ($conn->errno) {
         die("Could not insert record into table: %s<br />". $conn->error);
      }
      header('Location: '.$BASE_PATH.'/vehicule.php');
   }
   else if ($_REQUEST['action'] == 'create') {
      $plaque = addslashes ($_POST['plaque']);
      $marque = $_POST['id_marque'];
      $model = $_POST['id_model'];
      $datec = $_POST['date1_immatriculation'];
      $datea = $_POST['date_cate_grise'];
      $sql = "INSERT INTO vehicule ".
	 "(`plaque`, `id_marque`, `id_model`, `date1_immatriculation`, `date_cate_grise`) "."VALUES ".
         "('$plaque','$marque','$model', '$datec', '$datea')";
      $conn->query($sql);
      if ($conn->errno) {
         die("Could not insert record into table: %s<br />". $conn->error);
      }
      header('Location: '.$BASE_PATH.'/vehicule.php');
   }
}

$row['id'] = '';
$row['plaque'] = '';
$row['id_marque'] = '';
$row['id_model'] = '';
$row['date1_immatriculation'] = '';
$row['date_cate_grise'] = '';
if (isset($_REQUEST['id'])) {
  $sql = "SELECT id, plaque, id_marque, id_model, date1_immatriculation, date_cate_grise FROM vehicule WHERE id = ".$_REQUEST['id']." ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
  }
}

include_once('headerhtml.php');
?>
<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
       <div class="vehicule-update">
          <div class="vehicule-form">
             <form id="w0" method="post">
                <input type="hidden" name="_csrf" value="7GnmJ-sjEoaIUJzj-HHy4sCSwZU_ZI9jR3fASliurqqUOYJl3WlE9tcD7tadJseTsb_y_3cO1QgPH_EOIu_E8g==">
                <div class="form-group field-vehicule-plaque required has-success">
                    <label class="control-label" for="plaque">Plaque</label>
		    <input type="text" id="plaque" class="form-control" name="plaque" value="<?php echo get_value($row['plaque']); ?>" maxlength="100" aria-required="true" aria-invalid="false"  required>
                    <div class="help-block"></div>
                </div>
                <div class="form-group field-vehicule-id_marque required has-success">
                    <label class="control-label" for="id_marque">Marque</label>
                        <select id="id_marque" class="form-control" name="id_marque" aria-required="true" aria-invalid="false"  required>
                           <?php
		           list_options($conn, 'marque', get_value($row['id_marque'])); //(isset($row['model']) ? $row['model'] : -1));
                           ?>
                        </select>

                    <div class="help-block"></div>
                </div>
                <div class="form-group field-vehicule-id_model required has-success">
                    <label class="control-label" for="id_model">Model</label>
		    <select id="id_model" class="form-control" name="id_model" aria-required="true" aria-invalid="false"  required>
                       <?php
		       list_options($conn, 'model', get_value($row['id_model']));
                       ?>
                    </select>

                    <div class="help-block"></div>
                </div>
                <div class="form-group field-vehicule-date1_immatriculation">
                   <label class="control-label" for="date1_immatriculation">Date de première immatriculation</label>
		   <input type="date" id="date1_immatriculation" class="form-control hasDatepicker" name="date1_immatriculation" value="<?php echo get_value($row['date1_immatriculation']);?>" required>
		   <div class="help-block"></div>
                </div>
                <div class="form-group field-vehicule-date_cate_grise">
                   <label class="control-label" for="date_cate_grise">Date de la carte grise</label>
                   <input type="date" id="date_cate_grise" class="form-control hasDatepicker" name="date_cate_grise" value="<?php echo get_value($row['date_cate_grise']);?>" required>
                   <div class="help-block"></div>
                </div>
<br>
                <div class="form-group">
		   <p>
		   <a class="btn btn-success" href="<?php echo $BASE_PATH;?>/vehicule.php">Retour</a>
                      <button type="submit" class="btn btn-success" id="btn-save" name="btn-sav">Sauvegarder</button>
                   </p>
                </div>
                <input type="hidden" id="action" name="action" value="<?php echo $_REQUEST['action'];?>">
                <input type="hidden" id="id" name="id" value="<?php echo (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');?>">
             </form>
          </div>
       </div>
    </div>
</main>


   </body>
</html>

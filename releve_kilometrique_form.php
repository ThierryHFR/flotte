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
      $id_vehicule = $_POST['id_vehicule'];
      $km = $_POST['km'];
      $id_inter = $_POST['id_intervention'];
      $inter = htmlspecialchars($_POST['intervention'],  ENT_QUOTES);
      $date = $_POST['date'];
      $adate = date_parse_from_format('Y-m-d',$date); 
      $sql = "UPDATE releve_kilometrique SET ".
	     "`id_vehicule`='$id_vehicule', `km`='$km', `id_intervention`='$id_inter', `intervention`='$inter', `date`='$date'";
      if ($id_inter == 2) {
	 $adate['year'] += 1;
         $id_inter = 3;
	 $date2 = $adate['year'].'-'.($adate['month'] < 10 ? '0' : '').$adate['month'].'-'.($adate['day'] < 10 ? '0' : '').$adate['day'];
         $sql .= ",id_suivi='$id_inter', date_suivi='$date2'";
      }
      else if ($id_inter == 3) {
	 $adate['year'] += 1;
         $id_inter = 2;
	 $date2 = $adate['year'].'-'.($adate['month'] < 10 ? '0' : '').$adate['month'].'-'.($adate['day'] < 10 ? '0' : '').$adate['day'];
         $sql .= ",id_suivi'$id_inter', date_suivi'$date2'";
      }
      $sql .= " WHERE id='".$_POST['id']."';";
      $conn->query($sql);
      if ($conn->errno) {
         die("Could not insert record into table: %s<br />". $conn->error);
      }
      $result = $conn->query($sql);
      if ($conn->errno) {
         die("Could not insert record into table: %s<br />". $conn->error);
      }
      if (isset($_FILES['facture']) && !empty($_FILES['facture']['name'])) {
          // Where the file is going to be stored
	  $target_dir = "suivi/";
	  $file = $_FILES['facture']['name'];
	  $path = pathinfo($file);
	  $filename = $path['filename'];
	  $ext = $path['extension'];
	  $temp_name = $_FILES['facture']['tmp_name'];
	  $nfile = 'suivi-'.$_POST['id'].'-';
          $count = 1;
	  $path_filename_ext = $target_dir.$nfile.$count.'.'.$ext;
 
          // Check if file already exists
          while (file_exists($path_filename_ext)) {
              $count = $count + 1;
	      $path_filename_ext = $target_dir.$nfile.$count.'.'.$ext;
          }
          move_uploaded_file($temp_name,$path_filename_ext);
      }
      header('Location: vehicule_details.php?action=detail&id='.$_POST['id_vehicule']);
   }
   if ($_REQUEST['action'] == 'create') {
      $id_vehicule = $_POST['id_vehicule'];
      $km = $_POST['km'];
      $id_inter = $_POST['id_intervention'];
      $inter = htmlspecialchars($_POST['intervention'],  ENT_QUOTES);
      $date = $_POST['date'];
      $facture= '';
      $adate = date_parse_from_format('Y-m-d',$date); 
      $sql = "INSERT INTO releve_kilometrique ".
             "(`id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`";
      if ($id_inter == 2) {
          $sql .= ", `id_suivi`, `date_suivi`";
      }
      else if ($id_inter == 3) {
          $sql .= ", `id_suivi`, `date_suivi`";
      }
      $sql .= ") "."VALUES ".
         "('$id_vehicule','$km','$id_inter', '$inter', '$date', '$facture'";
      if ($id_inter == 2) {
	 $adate['year'] += 1;
         $id_inter = 3;
	 $date2 = $adate['year'].'-'.($adate['month'] < 10 ? '0' : '').$adate['month'].'-'.($adate['day'] < 10 ? '0' : '').$adate['day'];
         $sql .= ",'$id_inter', '$date2'";
      }
      else if ($id_inter == 3) {
	 $adate['year'] += 1;
         $id_inter = 2;
	 $date2 = $adate['year'].'-'.($adate['month'] < 10 ? '0' : '').$adate['month'].'-'.($adate['day'] < 10 ? '0' : '').$adate['day'];
         $sql .= ",'$id_inter', '$date2'";
      }
      $sql .= ")";
      $conn->query($sql);
      if ($conn->errno) {
         die("Could not insert record into table: %s<br />". $conn->error);
      }
      if (isset($_FILES['facture']) && !empty($_FILES['facture']['name'])) {
          // Where the file is going to be stored
	  $target_dir = "suivi/";
	  $file = $_FILES['facture']['name'];
	  $path = pathinfo($file);
	  $filename = $path['filename'];
	  $ext = $path['extension'];
	  $temp_name = $_FILES['facture']['tmp_name'];
	  $nfile = 'suivi-'.$_POST['id'].'-';
          $count = 1;
	  $path_filename_ext = $target_dir.$nfile.$count.'.'.$ext;
 
          // Check if file already exists
          while (file_exists($path_filename_ext)) {
              $count = $count + 1;
	      $path_filename_ext = $target_dir.$nfile.$count.'.'.$ext;
          }
          move_uploaded_file($temp_name,$path_filename_ext);
      }
      header('Location: vehicule_details.php?action=detail&id='.$_POST['id_vehicule']);
   }
}
$row['id']='';
$row['id_vehicule']=(isset($_REQUEST['id_vehicule']) ? $_REQUEST['id_vehicule'] : '');
$row['km']='';
$row['id_intervention']='';
$row['intervention']='';
$row['date']='';
$row['facture']='';
if (isset($_REQUEST['id'])) {
  $sql = "SELECT id, id_vehicule, km, id_intervention, intervention, date, facture FROM releve_kilometrique WHERE id = ".$_REQUEST['id']." ";
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
     <div class="releve-kilometrique-create">

     <h1>Releve Kilometrique</h1>

     <div class="releve-kilometrique-form">

        <form id="w0"  method="post" enctype="multipart/form-data">
           <input type="hidden" name="_csrf" value="_EJNFd81s0xFDg49XhIonaB-nU8nEx-0VdxsxMNuAJ2EEilX6X_lPBpdfAg7RR3s0VOuJW95Rd8dtF2AuS9qxQ==">
           <div class="form-group field-relevekilometrique-id_vehicule required has-error">
              <label class="control-label" for="id_vehicule">Id Vehicule</label>
                  <select id="id_vehicule" class="form-control" name="id_vehicule" aria-required="true" aria-invalid="true" required>
                  <?php
	          list_plaque_options($conn, get_value($row['id_vehicule']));
                  ?>
                  </select>

                  <div class="help-block">Id Vehicule cannot be blank.</div>
           </div>
           <div class="form-group field-relevekilometrique-km required">
                  <label class="control-label" for="km">Km</label>
                  <input type="number" id="km" class="form-control" name="km" aria-required="true" value="<?php echo get_value($row['km']);?>">

                  <div class="help-block"></div>
           </div>
           <div class="form-group field-relevekilometrique-id_intervention required has-success">
               <label class="control-label" for="id_intervention">Intervention</label>
	       <select id="id_intervention" class="form-control" name="id_intervention" aria-required="true" aria-invalid="false"  required>
                  <?php
	          list_options($conn, 'intervention', get_value($row['id_intervention']));
                  ?>
               </select>

               <div class="help-block"></div>
           </div>
           <div class="form-group field-relevekilometrique-intervention required">
                  <label class="control-label" for="intervention">Intervention</label>
                  <textarea id="intervention" class="form-control" name="intervention" rows="6" aria-required="true"><?php echo get_value($row['intervention']);?></textarea>

                  <div class="help-block"></div>
           </div>
           <div class="form-group field-relevekilometrique-date">
                  <label class="control-label" for="date">Date de la carte grise</label>
		  <input type="date" id="date" class="form-control hasDatepicker" name="date" value="<?php echo get_value($row['date']);?>" required>

                  <div class="help-block"></div>
           </div>
           <div class="form-group field-relevekilometrique-facture">
                  <label class="control-label" for="facture">Facture</label>
                  <input type="file" id="facture" class="form-control" name="facture" maxlength="4096">

                  <div class="help-block"></div>
           </div>
<br>

                <div class="form-group">
		   <p>
                      <a class="btn btn-success" href="vehicule.php">Retour</a>
                      <input type="submit" class="btn btn-success" id="btn-save" name="btn-sav" value="Sauvegarder"/>
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

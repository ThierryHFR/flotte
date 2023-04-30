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
      $id_accident = $_POST['id_accident'];
      $incident = $_POST['incident'];
      $km = $_POST['km'];
      $sql = "UPDATE incident SET `km`='$km', `id_accident`='$id_accident', `incident`='$incident' WHERE id='".$_POST['id']."';";
      $conn->query($sql);
      if ($conn->errno) {
         die("Could not insert record into table: ".$conn->error."<br>");
      }
      // print($sql);
      $result = $conn->query($sql);
      header('Location: '.$BASE_PATH.'/ncident_details.php?id='.$_POST['id']);
   }
   else if ($_REQUEST['action'] == 'create') {
      $id_vehicule = ($_SESSION['id_plaque'] > 0 ? $_SESSION['id_plaque'] : $_POST['id_vehicule']);
      $id_user = $_SESSION['id'];
      $id_accident = $_POST['id_accident'];
      $incident = $_POST['incident'];
      $km = $_POST['km'];
      $sql = "INSERT INTO incident (`id_vehicule`, `km`, `id_accident`, `incident`, `id_user`) VALUES ('$id_vehicule','$km','$id_accident', '$incident', '$id_user');";
      $conn->query($sql);
      if ($conn->errno) {
         die("Could not insert record into table: ".$conn->error."<br>");
      }
      $sql = "SELECT MAX(id) AS max FROM incident";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
         // output data of each row
         $row = $result->fetch_assoc();
         header('Location: '.$BASE_PATH.'/incident_details.php?id='.$row['max']);
      }
   }
}

$row['id']='';
$row['km']='';
$row['id_accident']='';
$row['incident']='';
if (isset($_REQUEST['id'])) {
  $sql = "SELECT id, km, id_accident, incident FROM incident WHERE id = ".$_REQUEST['id']." ";
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

     <h1>Déclaration incident</h1>

     <div class="incident-form">

        <form id="w0"  method="post">
           <input type="hidden" name="_csrf" value="_EJNFd81s0xFDg49XhIonaB-nU8nEx-0VdxsxMNuAJ2EEilX6X_lPBpdfAg7RR3s0VOuJW95Rd8dtF2AuS9qxQ==">
           <div class="form-group field-incident-id_accident required has-error">
              <label class="control-label" for="id_accident">Id Vehicule</label>
                  <select id="id_accident" class="form-control" name="id_accident" aria-required="true" aria-invalid="true" required>
                  <?php
	          list_options($conn, 'accident', get_value($row['id_accident']));
                  ?>
                  </select>

                  <div class="help-block">Choisir le type d'incident.</div>
           </div>
           <div class="form-group field-incident-incident required">
                  <label class="control-label" for="incident">Incident</label>
                  <textarea id="incident" class="form-control" name="incident" rows="6" aria-required="true"><?php echo get_value($row['incident']);?></textarea>

                  <div class="help-block"></div>
           </div>
           <div class="form-group field-relevekilometrique-km required">
                  <label class="control-label" for="km">Km</label>
                  <input type="number" id="km" class="form-control" name="km" aria-required="true" value="<?php echo get_value($row['km']);?>">

                  <div class="help-block"></div>
           </div>
<br>
                <div class="form-group">
		   <p>
                      <a class="btn btn-success" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a>
                      <button type="submit" class="btn btn-success" id="btn-save" name="btn-sav">Sauvegarder</button>
                   </p>
                </div>
                <input type="hidden" id="action" name="action" value="<?php echo $_REQUEST['action'];?>">
                <input type="hidden" id="id" name="id" value="<?php echo (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');?>">
                <input type="hidden" id="id_vehicule" name="id_vehicule" value="<?php echo (isset($_REQUEST['id_vehicule']) ? $_REQUEST['id_vehicule'] : '');?>">

        </form>
     </div>

     </div>
  </div>
</main>


   </body>
</html>

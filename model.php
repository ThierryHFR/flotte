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
      $id = $_POST['id'];
      $nom = $_POST['nom'];
      $sql = "UPDATE model SET nom = '$nom' WHERE id='$id';";
      $conn->query($sql);
      if ($conn->errno) {
         die("Could not insert record into table: %s<br />". $conn->error);
      }
      $result = $conn->query($sql);
      $conn->close();
      header('Location: vehicule.php');
   }
   if ($_REQUEST['action'] == 'create') {
      $nom = $_POST['nom'];
      $sql = "INSERT INTO model (`nom`) VALUES ('$nom');";
      $conn->query($sql);
      if ($conn->errno) {
         die("Could not insert record into table: %s<br />". $conn->error);
      }
      $conn->close();
      header('Location: vehicule.php');
   }
}
$row['id']='';
$row['nom']='';
if (isset($_REQUEST['id'])) {
  $sql = "SELECT id, nom FROM model WHERE id = ".$_REQUEST['id']." ";
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
     <div class="model-create">

     <h1>Model</h1>

     <div class="model-form">

        <form id="w0"  method="post">
           <input type="hidden" name="_csrf" value="_EJNFd81s0xFDg49XhIonaB-nU8nEx-0VdxsxMNuAJ2EEilX6X_lPBpdfAg7RR3s0VOuJW95Rd8dtF2AuS9qxQ==">
           <div class="form-group field-model-nom required">
                  <label class="control-label" for="nom">Nom</label>
                  <input type="text" id="nom" class="form-control" name="nom" aria-required="true" value="<?php echo get_value($row['nom']);?>">

                  <div class="help-block"></div>
           </div>
<br>

                <div class="form-group">
		   <p>
                      <a class="btn btn-success" href="vehicule.php">Retour</a>
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

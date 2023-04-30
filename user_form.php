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
      $username = $_POST['username'];
      if (isset($_POST['password']) && $_POST['password'] != '') 
          $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      else
	  $password = '';
      $role = ($_POST['role'] === 'on' ? 1 : 0);
      $actif = ($_POST['actif'] === 'on' ? 1 : 0);
      $sql = "UPDATE users SET ".
	     "`username`='$username', `role`='$role', `actif`='$actif'";
      if ($password != '')
	 $sql .= ", `password`='$password' ";
      $sql .= " WHERE id='".$_POST['id']."';";
      $conn->query($sql);
      if ($conn->errno) {
         die("Could not insert record into table: %s<br />". $conn->error);
      }
      header('Location: '.$BASE_PATH.'/user.php');
   }
   else if ($_REQUEST['action'] == 'create') {
      $username = $_POST['username'];
      if (isset($_POST['password']) && $_POST['password'] != '') 
          $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      else
	  $password = '';
      $role = $_POST['role'];
      $actif = $_POST['actif'];
      $sql = "INSERT INTO users ".
	 "(`username`, `password`, `role`, `actif`) VALUES ".
         "('$username','$password','".($role ? 1 : 0)."', '".($actif ? 1 : 0)."')";
      $conn->query($sql);
      if ($conn->errno) {
         die("Could not insert record into table: %s<br />". $conn->error);
      }
      header('Location: '.$BASE_PATH.'/user.php');
   }
}

$row['id'] = '';
$row['username'] = '';
$row['role'] = '';
$row['actif'] = '';
if (isset($_REQUEST['id'])) {
  $sql = "SELECT id, username, role, actif FROM users WHERE id = ".$_REQUEST['id']." ";
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
                    <label class="control-label" for="username">Nom utilisateur</label>
		    <input type="text" id="username" class="form-control" name="username" value="<?php echo get_value($row['username']); ?>" maxlength="100" aria-required="true" aria-invalid="false"  required>
                    <div class="help-block"></div>
                </div>
                <div class="form-group field-vehicule-plaque required has-success">
                    <label class="control-label" for="password">Mot de passe</label>
		    <input type="text" id="password" class="form-control" name="password" value="" aria-required="true" aria-invalid="false">
                    <div class="help-block"></div>
                </div>
                <div class="form-group field-vehicule-id_marque required has-success">
                    <label class="control-label" for="role">Invité</label>
		    <input type="checkbox" id="role" name="role" value="on" <?php echo ($row['role'] == 1 ? 'checked' : '');?>>
                    <div class="help-block"></div>
                </div>
                <div class="form-group field-vehicule-id_marque required has-success">
                    <label class="control-label" for="actif">Actif</label>
		    <input type="checkbox" id="actif" name="actif" value="on" <?php echo ($row['actif'] == 1 ? 'checked' : '');?>>
                    <div class="help-block"></div>
                </div>
<br>
                <div class="form-group">
		   <p>
                      <a class="btn btn-success" href="<?php echo $BASE_PATH; ?>/user.php">Retour</a>
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

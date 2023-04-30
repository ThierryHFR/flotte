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

$row['id']='';
$row['id_vehicule']=(isset($_REQUEST['id_vehicule']) ? $_REQUEST['id_vehicule'] : '');
$row['km']='';
$row['id_intervention']='';
$row['intervention']='';
$row['date']='';
$row['facture']='';
if (isset($_REQUEST['id'])) {
//   $sql = "SELECT v.plaque, r.km, i.nom, r.intervention, .r.date, r.facture FROM releve_kilometrique AS r, vehicule AS v, intervention AS i WHERE v.id = r.id_vehicule AND r.id_intervention = i.id AND r.id = ".$_REQUEST['id']." ";

  $sql = "SELECT vehicule.plaque, releve_kilometrique.km, intervention.nom, releve_kilometrique.intervention, releve_kilometrique.date, releve_kilometrique.facture FROM releve_kilometrique, vehicule, intervention WHERE vehicule.id = releve_kilometrique.id_vehicule AND releve_kilometrique.id_intervention = intervention.id AND releve_kilometrique.id = ".$_REQUEST['id']." ";
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

           <div class="form-group field-relevekilometrique-id_vehicule required has-error">
              <label class="control-label" for="id_vehicule">Id Vehicule</label>
                  <label class="form-control">
                  <?php
	          echo $row['plaque'];
                  ?>
                  </label>

                  <div class="help-block">Id Vehicule cannot be blank.</div>
           </div>
           <div class="form-group field-relevekilometrique-km required">
                  <label class="control-label" for="km">Km</label>
                  <label class="form-control"><?php echo $row['km'];?></label>
           </div>
           <div class="form-group field-relevekilometrique-id_intervention required has-success">
               <label class="control-label" for="id_intervention">Intervention</label>
	       <label class="form-control">
                  <?php
	          echo $row['nom'];
                  ?>
               </label>
           </div>
           <div class="form-group field-relevekilometrique-intervention required">
                  <label class="control-label" for="intervention">Intervention</label>
                  <label class="form-control"><?php echo get_value($row['intervention']);?></label>
           </div>
           <div class="form-group field-relevekilometrique-date">
                  <label class="control-label" for="date">Date de la carte grise</label>
		  <label class="form-control hasDatepicker"><?php echo get_value($row['date']);?></label>
           </div>
<?php
	  $nfile = 'suivi-'.$_REQUEST['id'].'-';
          $count = 1;
	  $path_filename_ext = 'suivi/'.$nfile.$count.'.pdf';
          // Check if file already exists
          while (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$path_filename_ext)) {
              if ($count == 1) {
                 echo '<div class="form-group field-relevekilometrique-facture">';
                 echo '<label class="control-label">Documents</label>';
              }
	      echo '<label class="form-control hasDatepicker"><a href="'.$path_filename_ext.'">Document '.$count.'</a></label>';
              $count = $count + 1;
	      $path_filename_ext = 'suivi/'.$nfile.$count.'.pdf';
          }
          if ($count > 1)
             echo '</div>';
?>
<br>

                <div class="form-group">
		   <p>
                      <a class="btn btn-success" href="vehicule_details.php?action=detail&id=<?php echo $_REQUEST['id_vehicule']; ?>">Retour</a>
                   </p>
                </div>
     </div>

     </div>
  </div>
</main>
   </body>
</html>

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


    $img = $_POST['image'];
    $id = $_POST['id'];
    $folderPath = $_SERVER['DOCUMENT_ROOT'].'/uploadImages/';
    $i = 1;

    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];

    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';

    $file = $folderPath . 'i' .  $id . '-' . $i . '.png' ;
    while (file_exists($file)) {
	$i = $i + 1;
        $file = $folderPath . 'i' .  $id . '-' . $i . '.png' ;
    }

    file_put_contents($file, $image_base64);
    header('Location: incident_details.php?id='.$id);
?>

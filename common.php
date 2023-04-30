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


// Initialize the session
session_start();

// https://www.monsite.com/garage
// $BASE_PATH='/garage';
$BASE_PATH='';

$servername = "localhost";
$username = "myusername";
$password = "mypassword";
$dbname = "database";


// Check if the user is already logged in, if yes then redirect him to welcome page
if($_SERVER['SCRIPT_NAME'] != $BASE_PATH.'/login.php' && $_SERVER['SCRIPT_NAME'] != $BASE_PATH.'/admin.php' && (!isset($_SESSION["username"]) || $_SESSION["username"] == "")){
    header("location: ".$BASE_PATH."/login.php");
    exit;
}
else if($_SERVER['SCRIPT_NAME'] != $BASE_PATH.'/incident.php' &&
	$_SERVER['SCRIPT_NAME'] != $BASE_PATH.'/incident_details.php' &&
	$_SERVER['SCRIPT_NAME'] != $BASE_PATH.'/incident_form.php' &&
	$_SERVER['SCRIPT_NAME'] != $BASE_PATH.'/capture.php' &&
	isset($_SESSION["role"]) && $_SESSION["role"] != 0){
    header('location: '.$BASE_PATH.'/incident.php');
    exit;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

function date_fr($date) {
   $adate = date_parse_from_format('Y-m-d',$date);
   $date2 = ($adate['day'] < 10 ? '0' : '').$adate['day'].'/'.($adate['month'] < 10 ? '0' : '').$adate['month'].'/'.$adate['year'];
   return $date2;
}

function dateheure_fr($date) {
   $adate = date_parse_from_format('Y-m-d H:i:s',$date);
   $date2 = ($adate['day'] < 10 ? '0' : '').$adate['day'].'/'.($adate['month'] < 10 ? '0' : '').$adate['month'].'/'.$adate['year'].' à '.$adate['hour'].':'.$adate['minute'].':'.$adate['second'];
   return $date2;
}

function datemoins2() {
   $date = date('Y-m-d', strtotime('-2 month'));
   $adate = date_parse_from_format('Y-m-d',$date);
   $date2 = $adate['year'].'-'.($adate['month'] < 10 ? '0' : '').$adate['month'].'-'.($adate['day'] < 10 ? '0' : '').$adate['day'];
   return $date2;
}

function dateplus2() {
   $date = date('Y-m-d', strtotime('+2 month'));
   $adate = date_parse_from_format('Y-m-d',$date);
   $date2 = $adate['year'].'-'.($adate['month'] < 10 ? '0' : '').$adate['month'].'-'.($adate['day'] < 10 ? '0' : '').$adate['day'];
   return $date2;
}

function datealerte($date, $label) {
   $datec = date('Y-m-d');
   if ($datec >= $date)
     return '<label style="color: red;">'.$label.'</labe>';
   else
     return $label;
}


function list_options($con, $table, $val=-1) {
    $sql = 'select id, nom from '. $table .' order by nom asc;';
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
       // output data of each row
       echo '<option value=""';
       if ($val == -1)
           echo ' selected';
       echo '>faire un choix ...</option>';
       while($row = $result->fetch_assoc()) {
           echo '<option value="'.$row['id'].'"';
           if ($val == $row['id'])
              echo ' selected';
           echo '>'.$row['nom'].'</option>';
       }
    }
}

function list_plaque_options($con, $val=-1) {
    $sql = 'select id, plaque from vehicule order by plaque asc;';
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
       // output data of each row
       echo '<option value=""';
       if ($val == -1)
           echo ' selected';
       echo '>faire un choix ...</option>';
       while($row = $result->fetch_assoc()) {
           echo '<option value="'.$row['id'].'"';
           if ($val == $row['id'])
              echo ' selected';
           echo '>'.$row['plaque'].'</option>';
       }
    }
}

function get_value($val) {
   if (isset($val))
      return $val;
   return '';
}

?>

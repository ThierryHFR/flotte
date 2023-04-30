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

 
// Include config file
require_once "common.php";
 
// Define variables and initialize with empty values
$username = "";
$username_err = $login_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Validate credentials
    if(empty($username_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, role FROM users WHERE username = ?";
        
        if(($stmt = $conn->prepare($sql))){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('s', $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                // Check if username exists, if yes then verify password
                if($stmt->num_rows() == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $username, $role);
                    if($stmt->fetch()){
                        if($_POST['id_vehicule']){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username; 
                            $_SESSION["role"] = 1;
                            $_SESSION["id_plaque"] = $_POST['id_vehicule'];
                            
                            // Redirect user to welcome page
                            header("location: ".$BASE_PATH."/incident_form.php?action=create");
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
		        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
		    }
		}
	    }
        }
    }
}

include_once('headerhtml.php');
?>
       <main id="main" class="flex-shrink-0" role="main">
           <div class="container">
              <div class="vehicule-index">
                 <h1>Déclarer un incident</h1>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Nom utilisateur</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
           <div class="form-group field-relevekilometrique-id_vehicule required has-error">
              <label class="control-label" for="id_vehicule">Plaque</label>
                  <select id="id_vehicule" class="form-control" name="id_vehicule">
                  <?php
	          list_plaque_options($conn, -1);
                  ?>
                  </select>
           </div><br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</div>
</div>
</main>
</body>
</html>


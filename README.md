# flotte
Gestion de flotte automobile

Pour test (la gestion des utilisateur est desactivé): http://flotte.atspace.eu/ <vb
                                                                      
Administration :                                                                                
   login : admin / 
   mdp :   admin
   
Chauffeur :
   login : demon
   Plaque : au choix

Pour l"instalation : 
  1 ) clonner le depot sur votre serveur
  2 ) Reseigne les variables :
        $BASE_PATH='';

        $servername = "localhost";
        $username = "myusername";
        $password = "mypassword";
        $dbname = "database";
  3 ) la base de données (MySql) est générée à l'aide du fichier data/flotte.sql
  4 ) pour un jeux de test utiliser les données de fichier data/test.sql 

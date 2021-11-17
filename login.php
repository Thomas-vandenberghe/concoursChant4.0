<?php


session_start();

$db = new PDO('mysql:host=localhost;dbname=concoursChant;', 'chant' , '01021991');


if(isset($_POST['formconnexion'])) {
    $mailconnect = /* htmlspecialchars */($_POST['mailconnect']);
    $mdpconnect = /*sha1*/($_POST['mdpconnect']);
    if(!empty($mailconnect) AND !empty($mdpconnect)) {
       $requser = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
       $requser->execute(array($mailconnect, $mdpconnect));
       $userexist = $requser->rowCount();
       if($userexist == 1) {
          $userinfo = $requser->fetch();
          $_SESSION['id'] = $userinfo['id'];
          $_SESSION['nom'] = $userinfo['nom'];
          $_SESSION['prenom'] = $userinfo['prenom'];
          $_SESSION['mail'] = $userinfo['mail'];
          header("Location: index.html");
       } else {
          $erreur = "Mauvais mail ou mot de passe !";
          
       }
    } else {
       $erreur = "Tous les champs doivent être complétés !";

    }
 }
 ?>
 <html>
	   <head>
	      <title>TUTO PHP</title>
	      <meta charset="utf-8">
	   </head>
	   <body>
	      <div align="center">
	         <h2>Connexion</h2>
	         <br /><br />
	         <form method="POST" action="">
	            <input type="email" name="mailconnect" placeholder="Mail" />
	            <input type="password" name="mdpconnect" placeholder="Mot de passe" />
	            <br /><br />
	            <input type="submit" name="formconnexion" value="Se connecter !" />
	         </form>
	         <?php
	         if(isset($erreur)) {
	            echo '<font color="red">'.$erreur."</font>";
	         }
	         ?>
	      </div>
	   </body>
	</html>
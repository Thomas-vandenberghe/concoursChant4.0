<?php
session_start();
$db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_7caa586e0380adf', 'b41a5dc6242a82' , 'df1cc1fa');
  //$db = new PDO('mysql:host=localhost; dbname=concoursChant', 'chant', '01021991');
//$db = new PDO('mysql:host=localhost:3307;dbname=concoursChant;', 'chant' , '01021991');

$titre=$_POST['songs'];
$pseudoSession=$_SESSION['pseudo'];

// $_SESSION['song']=$titre;

$requser = $db->prepare("SELECT * FROM songs WHERE song = ?");
$requser->execute(array($titre));
$songexist = $requser->rowCount();

if($songexist != 0) {
  echo '<script>alert("Chanson déjà demandée par un participant." );window.location.href = "./profil.php";</script>';
  
}else{ $sql ="UPDATE songs SET song= '$titre' WHERE pseudo = '$pseudoSession'";
  $req = $db->prepare($sql);
  $req -> execute();

  $sql1 ="UPDATE songs SET rejeter= 'NON' WHERE pseudo = '$pseudoSession'";
  $req1 = $db->prepare($sql1);
  $req1 -> execute();

  echo'<script>alert("Demande envoyée");window.location.href = "./profil.php";</script>'; 

}
?>
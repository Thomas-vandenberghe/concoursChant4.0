<?php
session_start();
$db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_7caa586e0380adf', 'b41a5dc6242a82' , 'df1cc1fa');
  //$db = new PDO('mysql:host=localhost;dbname=concoursChant;', 'chant' , '01021991');
//$db = new PDO('mysql:host=localhost:3307;dbname=concoursChant;', 'chant' , '01021991');



$pseudo=$_POST['pseudo'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$age=$_POST['age'];
$sexe=$_POST['sexe'];
$email=$_POST['email'];
$password=$_POST['password'];
$telephone=$_POST['telephone'];
$adresse=$_POST['adresse'];
$codepostal=$_POST['codepostal'];
$ville=$_POST['ville'];
          
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT email FROM users WHERE email='$email'"; 
  $result = $db->prepare($sql);
  $result-> execute();

 
$checkpseudo = "SELECT pseudo FROM users WHERE pseudo='$pseudo'";
  $resultat = $db->prepare($checkpseudo);
  $resultat-> execute();

$checktel = "SELECT telephone FROM users WHERE telephone ='$telephone'";
$resultat1 = $db->prepare($checktel);
$resultat1->execute();

if($result->rowCount() > 0 or $resultat->rowCount() > 0 or $resultat1->rowCount() > 0){
  echo '<script>alert("Adresse mail ou pseudo déja utilisée" );window.location.href = "./inscription.php";</script>'; 
}
else{
  $sql = "INSERT INTO users (pseudo,nom,prenom,age,sexe,email,password,telephone,adresse,codepostal,ville) VALUES ('$pseudo','$nom','$prenom','$age','$sexe','$email','$hashed_password','$telephone','$adresse','$codepostal','$ville')";
  $req = $db->prepare($sql);
  $req -> execute();
   echo '<script>alert("Enregistrement réussi" );window.location.href = "./index.php";</script>'; 
   
   $sql1 = "INSERT INTO songs (pseudo) VALUES ('$pseudo')";
   $req1 = $db->prepare($sql1);
   $req1 -> execute();

  exit();

}
?>
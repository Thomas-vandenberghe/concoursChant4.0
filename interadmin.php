<?php
session_start();
$db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_7caa586e0380adf;', 'b41a5dc6242a82' , 'df1cc1fa');
	//$db = new PDO('mysql:host=localhost;dbname=concoursChant', 'chant', '01021991');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concours de chant</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js" defer></script>
</head>
<body>

<?php
if($_SESSION['pseudo']!='admin'){
    $erreur = '<script>alert("Accès interdit");</script>';
       echo"$erreur";
}else{
?>
    
<nav class = "ongletsAdmin">
   <span class = "admin" style="font-size: 40px;">Administration</span>
</nav>

<div class="container"> 
    <div class="menuDadmin" id="menuDeconnecte">
    <html>
	   <head>
	      <title>Profil</title>
	      <meta charset="utf-8">
	   </head>
	   <body>
	      <div class="infos">
		  <h2 class="souligne">Profil de <?php echo $_SESSION['pseudo']; ?></h2>
	         <br />
	         Mail : <?php echo $_SESSION['email']; ?>
             
	         <a  class="deco" id="deco"><button>Se déconnecter</button></a>
	        
	      </div>
        </div>

        <div class = "bodyContainer"> 
    <h2>Interface d'administration <br> <br> Gestion des candidatures</h2><br>
</div>
        <div class= "tabData">
<?php
          if($_SESSION['pseudo']=='admin')
$query=$db->prepare('SELECT * FROM songs');
$query->execute();
echo'<table><tr><td>Pseudo</td><td>Chanson</td><td>Valider</td><td>Rejeter</td><td>Fichier</td><td>ValidFichier</td><td>RejetFichier</td></tr>';
while($data=$query->fetch())
{
   $pseudotab= $data['pseudo'];

?>
   <form  method="POST" action="">

<?php
echo'<tr><td id='.$pseudotab.'>'.$data['pseudo'].'</td><td>'.$data['song'].'</td><td>  <input type="checkbox" id='.btn.$pseudotab.' name='.btn.$pseudotab.' >'.$data['verif1'].'</td> <td>  <input type="checkbox" id='.btn2.$pseudotab.' name='.btn2.$pseudotab.' >'.$data['rejeter'].'</td><td>'.$data['fichier'].'</td><td>  <input type="checkbox" id='.btn.$pseudotab.' name='.btn.$pseudotab.' >'.$data['verif2'].'</td> <td>  <input type="checkbox" id='.btn2.$pseudotab.' name='.btn2.$pseudotab.' >'.$data['rejeter2'].'</td></tr>';

if($_POST["btn$pseudotab"]){
$query2=$db->prepare("UPDATE songs SET verif1= 'OUI', rejeter='NON' WHERE pseudo ='$pseudotab'");
$query2->execute();
// $query3=$db->prepare("UPDATE users SET verif1= 'OUI', rejeter='NON' WHERE pseudo ='$pseudotab'");
// $query3->execute();

echo'<script>window.location.href="./interadmin.php"</script>';
}

if(($_POST["btn2$pseudotab"])){
	$query4=$db->prepare("UPDATE songs SET rejeter= 'OUI',verif1= 'NON' WHERE pseudo ='$pseudotab'");
	$query4->execute();
	// $query5=$db->prepare("UPDATE users SET rejeter= 'OUI',verif1= 'NON' WHERE pseudo ='$pseudotab'");
	// $query5->execute();
	
	echo'<script>window.location.href="./interadmin.php"</script>';

}
}
?>
<?php
echo'</table>';
            
?>
<input type="submit" style=" background-color:gold; color:green" value="Soumettre les modifications" class="soumettre">
</form>


</div>
</div>
 </div>
	   </body>
	</html>  




<script>
	const deco= document.querySelector("#deco");

	deco.addEventListener("click",()=>{
		if ( confirm("Souhaitez-vous vraiment vous déconnecter")){
			window.location.href="./deconnexion.php";
		}else{
			window.location.href="./profil.php"
		}

	})

	</script>

    <?php
};
?>
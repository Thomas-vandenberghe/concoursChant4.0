<?php
session_start();
$db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_7caa586e0380adf','b41a5dc6242a82' , 'df1cc1fa');
	// $db = new PDO('mysql:host=localhost;dbname=concoursChant', 'chant', '01021991');
	//$db = new PDO('mysql:host=localhost:3307;dbname=concoursChant', 'chant', '01021991');
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
<a href ="index.php" ><header>CONCOURS DE CHANT</header></a>
    
<nav class = "onglets">
   <a href="index.php";> <span class = "active onglet1">Présentation</span></a>
    <span class = "barre onglet0">|</span>
    <span class = "active onglet2"><div class="testback">Mon profil</div></span>
</nav>



<div class="container"> 
    <div class="menuD" id="menuDeconnecte">
    <html>
	   <head>
	      <title>Profil</title>
	      <meta charset="utf-8">
	   </head>
	   <body>
	      <div class="infos">
		  <h2 class="souligne">Profil de <?php echo $_SESSION['pseudo']; ?></h2>
	         <br />
	         Nom : <?php echo $_SESSION['nom']; ?>
	         <br />
			 Prénom : <?php echo $_SESSION['prenom']; ?>
	         <br />
			 Age : <?php echo $_SESSION['age']; ?> ans
	         <br />
			 <?php echo $_SESSION['sexe']; ?>
	         <br />
	         Mail : <?php echo $_SESSION['email']; ?>
	         <br />
             Téléphone : <?php echo $_SESSION['telephone']; ?>
	         <br />
             Adresse : <?php echo $_SESSION['adresse']; ?>
	         <br />
             Code Postal : <?php echo $_SESSION['codepostal']; ?>
	         <br />
             Ville : <?php echo $_SESSION['ville']; ?>
	         <br />
	        
	         <a  class="deco" id="deco"><button>Se déconnecter</button></a>
	        
	      </div>
	   </body>
	</html>
	<?php   
	
	?>
            
            </div>
        </div>
        
    </div>

    <div class = "bodyContainer"> 
    <h2>Mon profil</h2><br>
     <p> dolor sit amet consectetur adipisicing elit. Aperiam officia necessitatibus beatae architecto expedita reiciendis 
         Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, sit? Dicta sapiente hic corrupti suscipit. Consequuntur vel sed unde, fugiat numquam explicabo iusto ducimus, odio id provident consectetur iste iure
         Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt ea, commodi pariatur sit ut ipsam quaerat aut fugiat. Nam, vero vitae. Est, eveniet repellendus tempora voluptatem corporis necessitatibus excepturi assumenda.
         
        </p>

<?php
if($_SESSION['id']!= 0){
?>	

<?php
if($_SESSION['pseudo']== "admin"){ 
    header("Location: interadmin.php");
  
}
?>


<?php 
$dejaChoisi = $db->prepare("SELECT * FROM songs WHERE pseudo = ?");
          $dejaChoisi->execute(array($_SESSION['pseudo']));
          $fichierDB = $dejaChoisi->fetch();
          $fichierCheck=$fichierDB['verif2'];
          $fichierRejet=$fichierDB['rejeter2'];

if($fichierCheck != "NON" ){ 
?>

<p style="font-size: 29px; color:darkgreen; font-weight:bold">Votre inscription est quasiment terminée, il ne vous reste plus qu'à déposer votre chèque à la mairie de Longuenesse afin de valider votre participation.</p> 

<?php
}else{

          ?>
<?php if ($_SESSION['verif1'] != "NON" ){ ?>
    <?php
         $dejaChoisi = $db->prepare("SELECT * FROM songs WHERE pseudo = ?");
         $dejaChoisi->execute(array($_SESSION['pseudo']));
         $chansonDB = $dejaChoisi->fetch();
         $chansonCheck=$chansonDB['song'];
echo"
<p>Vous allez chanter la chanson: <b> $chansonCheck</b>. </p>";
  ?>

<?php
if($fichierRejet == "OUI"){
    ?>
    <p style=" color:red; font-size:19px;"><b>CETTE CHANSON A ETE REJETEE PAR L'ADMINISTRATEUR, VOUS POUVEZ FAIRE UNE NOUVELLE DEMANDE.</b>. </p>

    <?php
}
?>

    <h2>Envoyez-nous votre bande son</h2>
<div class ="formUpload">
    <form  method="POST"  enctype="multipart/form-data">
        <input class="formUploadInput" type="file" name="uploaded_file"> 
       <div class="valider"><input class="formUploadButton" type="submit" name="submitsong"> </div> 
       
    
</form>
 <?php
  
 
 if($_POST['submitsong']){
     $nomfichier=$_SESSION['song'];
    $pseudoSession=$_SESSION['pseudo'];
    $query=$db->prepare("UPDATE songs SET fichier = '$nomfichier' WHERE pseudo='$pseudoSession'");
    $query->execute();
    }
     ?>
</div>
</div>
<?php }else{ ?>

    <?php
     $dejaChoisi = $db->prepare("SELECT * FROM songs WHERE pseudo = ?");
     $dejaChoisi->execute(array($_SESSION['pseudo']));
     $chansonDB = $dejaChoisi->fetch();
     $chansonCheck=$chansonDB['song'];
        if ($chansonCheck != NULL){

    ?>

<p>Vous avez demandé à chanter la chanson <b><?php echo $chansonCheck ?></b>. </p>

    <?php }
     $requser1 = $db->prepare("SELECT * FROM songs WHERE pseudo = ?");
     $requser1->execute(array($_SESSION['pseudo']));
        $userinfo1 = $requser1->fetch();
        if($userinfo1['rejeter']=="OUI"){
        
    ?>
    <p style=" color:red; font-size:19px;"><b>CETTE CHANSON A ETE REJETEE PAR L'ADMINISTRATEUR, VOUS POUVEZ FAIRE UNE NOUVELLE DEMANDE.</b>. </p>

    <?php } ?>


    <h2>Choix de votre chanson pour le concours.</h2>  
<div class="submitContainer">
<div class="containerFormChant">
<form class = "formChant" name="formJS" id="formJS">
<label for="nom">Artiste</label><input type="text" id="queryArtists" class="inputSearch" require>
<label for="nom">Titre</label><input type="text" id="querySongs" class="inputSearch" require>
<div class="valider">
<button type="submit" class="btnValider"> Trouver ma chanson </button>
</div>
</form>
</div>
    <div class="containerFormChant">
		<Form class="formChant" id="formChanson"   onsubmit= "return confirm('Voulez-vous vraiment chanter cette chanson ?')"method="POST" action="stockInfoChansons.php"> 

			<label for="nom">Titre</label><select placeholder="morceaux correspondants à votre recherche" name="songs" id="songs" class="inputSearch" required>  <option value="neutre" disabled selected>Titres correspondants à la recherche</option></select>
			<div class="valider">
			<button type="submit" id="validationChanson" name="submit" class="btnValider">Valider ma chanson</button>
            </div>
		</Form>
	</div>
</div>

    <?php

}



} ?>

</div>

<?php
}
else{

}
?>

</body>

</html>

<?php
if (isset($_POST['submitsong'])) 
{
    $maxSize = 8000000;
    $validtext = array('.mp3', 'mp4');

    if ($_FILES['uploaded_file']['error'] > 0) 
    {
        echo "Une erreur est survenue lors du transfert";
        die;
    }

    $fileSize = $_FILES['uploaded_file']['size'];
    if ($fileSize > $maxSize) 
    {
        echo "le fichier est trop gros";
        die;
    }

    $fileName = $_FILES['uploaded_file']['name'];

    $fileExt = "." . strtolower(substr(strrchr($fileName, "."), 1));

    if (!in_array($fileExt, $validtext)) {
        echo "le fichier n'est pas au bon format !";
        die;
    }

    $tmpName = $_FILES['uploaded_file']['tmp_name'];
    
    $fileName = "upload/" . $_SESSION['pseudo'] . $fileExt;
    $resultat = move_uploaded_file($tmpName, $fileName);

    if ($resultat) 
    {
        echo "Transfert terminé ! ";
    }
}
?>

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

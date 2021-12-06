<?php
session_start();
// phpinfo();
$db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_7caa586e0380adf;', 'b41a5dc6242a82' , 'df1cc1fa');
 //$db = new PDO('mysql:host=localhost;dbname=concoursChant;', 'chant' , '01021991');
//$db = new PDO('mysql:host=localhost:3307;dbname=concoursChant;', 'chant' , '01021991');


if(isset($_POST['formconnexion'])) {
    $pseudoconnect = /*htmlspecialchars */($_POST['pseudoconnect']);
    $mdpconnect = /*sha1*/($_POST['mdpconnect']);
      $requser = $db->prepare("SELECT password FROM users WHERE pseudo = ?");
      $requser->execute(array($pseudoconnect));
      $userexist = $requser->rowCount();

      if($userexist == 1) {
          $userinfo = $requser->fetch();
         $verifmdp = $userinfo['password'];

         }
    if(password_verify($mdpconnect, $verifmdp) == TRUE) {
       $requser = $db->prepare("SELECT * FROM users WHERE pseudo = ?");
       $requser->execute(array($pseudoconnect));
       $userexist = $requser->rowCount();

       if($userexist == 1) {
          $userinfo = $requser->fetch();
          $_SESSION['id'] = $userinfo['id'];
          $_SESSION['pseudo'] = $userinfo['pseudo'];
          $_SESSION['nom'] = $userinfo['nom'];
          $_SESSION['prenom'] = $userinfo['prenom'];
          $_SESSION['age'] = $userinfo['age'];
          $_SESSION['sexe'] = $userinfo['sexe'];
          $_SESSION['email'] = $userinfo['email'];
          $_SESSION['telephone'] = $userinfo['telephone'];
          $_SESSION['adresse'] = $userinfo['adresse'];
          $_SESSION['codepostal'] = $userinfo['codepostal'];
          $_SESSION['ville'] = $userinfo['ville'];
          header("Location: profil.php");
       }
         

          $requser1 = $db->prepare("SELECT * FROM songs WHERE pseudo = ?");
       $requser1->execute(array($pseudoconnect));
       $userexist1 = $requser1->rowCount();
       

       if($userexist1 == 1) {
          $userinfo1 = $requser1->fetch();
      $_SESSION['verif1'] = $userinfo1['verif1'];
       $_SESSION['rejeter'] = $userinfo1['rejeter'];
       $_SESSION['song'] = $userinfo1['song'];
          header("Location: profil.php");

       } else {
          $erreur = "Tous les champs doivent être complétés !";
          echo"$erreur";
       }
    } else {
       $erreur = '<script>alert("Adresse ou mot de passe érroné");</script>';
       echo"$erreur";
    }
 }
 ?>

<!DOCTYPE html>
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
    
    <?php
if($_SESSION['id'] ==0) { ?>

<nav class = "onglets">
   <span class = "active onglet1"><div class="testback">Présentation</div></span>
    <span class = "barre onglet0" >|</span>
   <a href="inscription.php"> <span class = "active onglet2">Je m'inscris !</span></a>
</nav>

<div class="container"> 
    <div class="menuD" id="menuDeconnecte">
        <form class="connexion" method="POST" action=""> <h3>Connexion</h3>
            <div class="innerMenu">
             <p>Pseudo*</p>
                <input type="text" name="pseudoconnect" required placeholder="Pseudo"></input>
             <p>Mot de passe*</p>
                <input type="password" name="mdpconnect"  required placeholder="Mot de passe"></input>
                <div class="btnSpot">
                <button type="submit" name="formconnexion" class="btnConnexion">Connexion</button>
                </div>
            <a class="mdpOublie" id="resetMDP">  Mot de passe oublié ?</a>
            <br>
            <p class="inscrit">Pas encore inscrit ?</p>
        </form> 
            <div class="btnInscription"></div>
               <a href="./inscription.php"><input type="button"  value ="S'inscrire"class="inscription"></input></a>
                </div>
        </form>
    </div> 
<?php
}else{ ?>
<nav class = "onglets">
   <span class = "active onglet1"><div class="testback">Présentation</div></span>
    <span class = "barre onglet0" >|</span>
   <a href="profil.php"> <span class = "active onglet2">Mon profil </span></a>
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
     <h2 class="souligne" >Profil de <?php echo $_SESSION['pseudo']; ?></h2>
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

<?php 
};
    ?>

</div>
    <h2>Présentation</h2><br>
     <p class = "justify"> dolor sit amet consectetur adipisicing elit. Aperiam officia necessitatibus beatae architecto expedita reiciendis 
         Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, sit? Dicta sapiente hic corrupti suscipit. Consequuntur vel sed unde, fugiat numquam explicabo iusto ducimus, odio id provident consectetur iste iure
         Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt ea, commodi pariatur sit ut ipsam quaerat aut fugiat. Nam, vero vitae. Est, eveniet repellendus tempora voluptatem corporis necessitatibus excepturi assumenda.
         Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde tempora dolorum cumque laudantium molestiae libero ipsam, asperiores soluta ullam ex id dolorem quo veritatis facilis cum illum quaerat quae. Quos?
         Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam suscipit cum at nulla enim nobis, nam dolorem tenetur rerum mollitia commodi nostrum consequatur fuga eos iusto, nemo illo rem consectetur?
         Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio laboriosam tenetur, error id harum labore sunt fuga perferendis quae quasi beatae accusamus dolorum eaque aut saepe facilis deserunt nobis. Eveniet!
        obcaecati quia ipsa est quo sunt omnis accusamus similique, odio, laboriosam unde assumenda quas suscipit.</p>
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
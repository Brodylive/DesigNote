<?php
	 //ini_set('display_errors', 1);
	 //error_reporting(E_ALL);



	
try {
    $bdd = new PDO('mysql:host=mysql51-99.perso;dbname=mathieugmmod1', 'mathieugmmod1', 'nJhJ7q2EbksX');
}

catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
}






    session_start();

		$email = $_POST['email'];
		$password = $_POST['password'];


		if($email && $password) {

			
			$reponse = $bdd->query("SELECT id, pseudo, name, img FROM user WHERE email='$email' AND password=password('$password')");
			$donnees = $reponse->fetch();

			if($donnees['id']) {
				$_SESSION['designote'] = $donnees['id'];
				$_SESSION['designoteuser'] = $donnees['pseudo'];
				$_SESSION['designotename'] = $donnees['name'];
				$_SESSION['designoteimg'] = $donnees['img'];
			}

		}



	
	


		if($_GET['action']=='deauth') {
			$_SESSION['designote']='';

			echo "
				<script type='text/javascript'>
					window.location.href='index.php';
				</script>
			";

		}


		if($_GET['action']=='reloadname') {

			$iduser = $_GET['iduser'];
    		$newpseudo = $_GET['newpseudo'];

			$_SESSION['designoteuser']=$newpseudo;
			$reponseiduser = $bdd->query("UPDATE user SET pseudo='$newpseudo' WHERE id=$iduser");

		}


		if($_GET['action']=='reloadimg') {

			$iduser = $_GET['iduser'];
    		$newimg = $_GET['newimg'];

			$_SESSION['designoteimg']=$newimg;
			$reponseiduser = $bdd->query("UPDATE user SET img='$newimg' WHERE id=$iduser");

		}


		



?>




<!DOCTYPE html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="user-scalable=no, initial-scale=1" />
	<meta name="mobile-web-app-capable" content="yes">

	<title>DesigNote</title>

	<meta name="apple-mobile-web-app-title" content="DesigNote">

	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">


	<link rel="stylesheet" type="text/css" href="daxline_font/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="webfont/stylesheet.css">

	<link rel="shortcut icon" href="img/favicon.ico">
	<link rel="icon" type="image/png" href="img/favicon.png">

		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/designote-icone-57px.png">

	<link rel="apple-touch-startup-image" href="img/startup-iphone4.jpg" media="(device-height:480px)">
	<link rel="apple-touch-startup-image" href="img/startup-iphone5.jpg" media="(device-height:568px)">
	
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js?ver=1.7.1'></script>

	<script type="text/javascript" src="js/farbtastic.js"></script>
	<script type="text/javascript" src="js/farbtasticbckgr.js"></script>

	<script type="text/javascript" src="js/scripthead.js"></script>

	<script type="text/javascript" src="js/canvas2image.js"></script>

	
  <link rel='stylesheet prefetch' href='http://dimsemenov-static.s3.amazonaws.com/dist/magnific-popup.css'>

  <script src="js/prefixfree.min.js"></script>
    <script src="js/hammer.min.js"></script>


</head>

<?php





	if ($_SESSION['designote']=='') {

			$nom=$_POST['nom'];
			$username=$_POST['username'];
			$mdp=$_POST['mdp'];
			$email=$_POST['email'];


			if ($_POST['action']=='adduser') {
				
				if ($nom && $username && $mdp && $email) {
					
					$addinguser = $bdd->query("INSERT INTO user (pseudo, name, email, password, img) VALUES ('$username','$nom','$email',password('$mdp'), 'img/user.jpg')");
					echo "<p class='message'>Your account has been created</p>";
				} else {
					echo "<p class='message'>Something wrong appened</p>";
				} 
				
			}

		
?>

<body id="start-up">

	<header>
	
		<h1>DesigNote</h1>
		<p>Let's note!</p>
	
		<div id="social">
			<a href="#" class="fb"><img src="img/fb.png" alt=""></a>
			<a href="#" class="tw"><img src="img/tw.png" alt=""></a>
		</div>
	</header>
	


	<div id="connexion">
		

	<form method="post">
		<div id="co">
			<input type="text" class="name" name='email' placeholder="your@email.com">
			<input type="password" class="password" name='password' placeholder="Password">
		
		</div>
		
		
		<input type="submit" id="log" value="Log In">
		
		
	</form>
		
				<div id="plus">
			<!--a href="#"><div id="forgot">
				<p>Forgot Password?</p>
			</div></a-->
			
		<div id="inline-popups">
			<a href="#test-popup" data-effect="mfp-zoom-in">
			
			<div id="signup">
				<p>sign up</p>
			</div></a>
			
			
		</div>
		</div>
	</div>
	
	
	
	
	
	
	
	
<!-- Popup itself -->
<div id="test-popup" class="white-popup mfp-with-anim mfp-hide">
	
	
	<p class="titrepopup">CREATE A NEW ACCOUNT</p>
	
	
	<form method="post">
		
		
		

			<p class="infotext">Your Name</p>
			<input type="text" class="nom" name='nom' placeholder="Name">
			
			<p class="infotext">Your Username</p>
			<input type="text" class="username" name='username' placeholder="Username">
			
			<p class="infotext">Your Password</p>
			<input type="password" class="mdp" name='mdp' placeholder="Password">
			
			<p class="infotext">Your Email</p>
			<input type="text" class="email" name='email' placeholder="your@email.com">
		

		<input type="hidden" name="action" value="adduser">
		<input type="submit" id="signin" value="Sign In">
		

		
	</form>
	
	
</div>
	

  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
  <script src='http://dimsemenov-static.s3.amazonaws.com/dist/jquery.magnific-popup.min.js'></script>

  <script src="js/index.js"></script>



	

</body>



<?php
	} else { 



		?>

<body id="app" class="clearfix">

<script type='text/javascript' src="js/jquery.sidr.min.js"></script>

 
<div id="sidr" class="menu-reveal">
  <?php echo "<img src='".$_SESSION['designoteimg']."'>"; ?>

  <?php echo "<h2> ".$_SESSION['designoteuser']."</h2>"; ?>
  <?php echo "<h3> ".$_SESSION['designotename']."</h3>"; ?>

  <ul class="menu-reveal" id="nav">
    <li id="home" class="active"><a href="javascript:DisplayPages('index', 'home');" class="menu-reveal-link">Home</a></li>
    <li id="gallery"><a href="javascript:DisplayPages('gallerie', 'gallery');" class="menu-reveal-link">Gallery</a></li>
    <li id="favorites"><a href="javascript:DisplayPages('favorisuser', 'favorites');" class="menu-reveal-link">Favorites</a></li>
    <li id="mynotes"><a href="javascript:DisplayPages('notesuser', 'mynotes');" class="menu-reveal-link">My notes</a></li>
    <li id="about"><a href="javascript:DisplayPages('aboutapp', 'about');" class="menu-reveal-link">About</a></li>
    <li id="settings"><a href="javascript:DisplayPages('settingsuser', 'settings');" class="menu-reveal-link">Settings</a></li>
  </ul>

  <a href="?action=deauth" id="logout">Log Out</a>
</div>

<div id="page">

	<header>
		<a id="simple-menu" href="#sidr" onclick="activemenu();">Toggle menu</a>

		<a id="account" href="javascript:DisplayPages('accountuser', '');">Account menu</a>

		<h1>DesigNote</h1>


	</header>

<?php
		if($_GET['action']=='deleteuser') {

			$id=$_SESSION['designote'];
			
			$delete = $bdd->query("DELETE FROM user WHERE id=$id");

			$_SESSION['designote']='';

			echo "<p class='message'>Your account has been deleted</p>";
			



			echo "
				<script type='text/javascript'>

				setTimeout(function(){
					window.location.href='index.php';
				}, 2000);

				</script>
			";

		}



?>


	<div id="index" class="clearfix page">

		<h2><img src="img/time.png" width="20px">Latest Notes</h2>

		<div id="portfolio">

			<div class="bloc unfold">
				<a class="thumb" href="#projet01">
					<img src="img/note/1.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/1.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet02">
					<img src="img/note/2.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/2.jpg" alt="">
				</div>
			</div>


			<div class="bloc">
				<a class="thumb" href="#projet03">
					<img src="img/note/3.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/3.jpg" alt="">
				</div>
			</div>


			<div class="bloc">
				<a class="thumb" href="#projet04">
					<img src="img/note/4.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/4.jpg" alt="">
				</div>
			</div>

						<div class="bloc">
				<a class="thumb" href="#projet05">
					<img src="img/note/5.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/5.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet06">
					<img src="img/note/6.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/6.jpg" alt="">
				</div>
			</div>


			<div class="bloc">
				<a class="thumb" href="#projet07">
					<img src="img/note/7.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/7.jpg" alt="">
				</div>
			</div>


			<div class="bloc">
				<a class="thumb" href="#projet08">
					<img src="img/note/8.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/8.jpg" alt="">
				</div>
			</div>
	



		</div>

		<h2 class="mostviewed"><img src="img/coeur.png"> Most Viewed</h2>


		<div id="portfolio2">
			<div class="bloc">
				<a class="thumb" href="#projet01">
					<img src="img/note/1.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/1.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet02">
					<img src="img/note/1.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/1.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet03">
					<img src="img/note/2.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/2.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet04">
					<img src="img/note/3.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/3.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet05">
					<img src="img/note/4.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/4.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet06">
					<img src="img/note/5.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/5.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet07">
					<img src="img/note/6.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/6.jpg" alt="">
				</div>
			</div>
			
			<div class="bloc">
				<a class="thumb" href="#projet08">
					<img src="img/note/7.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/7.jpg" alt="">
				</div>
			</div>

			
			
	</div>

	</div>

	<div id="searchrandom">


		<h2><img src="img/minirandom.png" width="20px">Random</h2>


		<img id="randomdisplay" src="" alt="random image">

		<script type="text/javascript">

		function createXhrObject()
	{
	    if (window.XMLHttpRequest)
		return new XMLHttpRequest();

	    if (window.ActiveXObject)
	    {
		var names = [
		    "Msxml2.XMLHTTP.6.0",
		    "Msxml2.XMLHTTP.3.0",
		    "Msxml2.XMLHTTP",
		    "Microsoft.XMLHTTP"
		];
		for(var i in names)
		{
		    try{ return new ActiveXObject(names[i]); }
		    catch(e){}
		}
	    }
	    window.alert("Votre navigateur ne prend pas en charge l'objet XMLHTTPRequest.");
	    return null; // non supporté
	}

		xhr=createXhrObject();

    function displaynoterandom(imgsrc){
    	
    	document.getElementById('randomdisplay').src=imgsrc;
    }


    function randomdisplay() {

		xhr.open("GET","random.php",true);
		xhr.onreadystatechange=function(){
		  if(xhr.readyState==4)
		    if(xhr.status==200) {
				eval(xhr.responseText);
		    }
		}

		xhr.send();
		
	}


		</script>

	</div>


	<div id="searchnote">
			<h2><img src="img/miniloupe.png" width="20px">Research</h2>

	<script type="text/javascript">


	    function findnotes(varsearch){
	    	
	    	document.getElementById('findnotes').innerHTML=varsearch;
	    }


	    function search() {

	    	var pattern = document.getElementById("searchpattern").value;

	    	if(pattern.length >= 1) {
			xhr.open("GET","search.php?pattern="+pattern,true);
			xhr.onreadystatechange=function(){
			  if(xhr.readyState==4)
			    if(xhr.status==200) {
					eval(xhr.responseText);
			    }
			}

			xhr.send();
			}
		}


	</script>

		<form>
			<input type="text" id="searchpattern" onkeyup="search();">
		</form>

		<div id='findnotes'>
		</div>

	</div>


<div id="accountuser">



	
	<div id="avatar">
	  



	<?php echo "<img src='".$_SESSION['designoteimg']."'>"; ?>
  <?php echo "<h2> ".$_SESSION['designoteuser']."</h2>"; ?>
  <?php echo "<h3> ".$_SESSION['designotename']."</h3>"; ?>

	  
	 
	  
	</div>
	
	
	<div id="infosuser">
		
		<div class="case prem"> 
			<p class="nb">35</p>
			<p class="lt">Notes</p>
		</div>
		
		<div class="case deu"> 
			<p class="nb">58</p>
			<p class="lt">Favorites</p>
		</div>
		
		
		<div class="case tro"> 
			<p class="nb">86</p>
			<p class="lt">Likes</p>
		</div>		
		
	</div>
	
	
	
	
	<div class="mylatestnotes">
	<h2><img src="img/coeur.png" width="20px">My Latest Notes</h2>
	</div>
		<div id="portfolio">

			<div class="bloc unfold">
				<a class="thumb" href="#projet01">
					<img src="img/note/1.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/1.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet02">
					<img src="img/note/2.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/2.jpg" alt="">
				</div>
			</div>


			<div class="bloc">
				<a class="thumb" href="#projet03">
					<img src="img/note/3.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/3.jpg" alt="">
				</div>
			</div>


			<div class="bloc">
				<a class="thumb" href="#projet04">
					<img src="img/note/4.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/4.jpg" alt="">
				</div>
			</div>

						<div class="bloc">
				<a class="thumb" href="#projet05">
					<img src="img/note/5.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/5.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet06">
					<img src="img/note/6.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/6.jpg" alt="">
				</div>
			</div>


			<div class="bloc">
				<a class="thumb" href="#projet07">
					<img src="img/note/7.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/7.jpg" alt="">
				</div>
			</div>


			<div class="bloc">
				<a class="thumb" href="#projet08">
					<img src="img/note/8.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/8.jpg" alt="">
				</div>
			</div>
	

	
	
	
	
	
	

</div>


</div>




	<div id="write">

		<div id="resultnote">
			<h2>Your note</h2>
		</div>

		<div id="canvasnote">
		<form id="bckgr">

			<textarea id="note" onclick="DisplayPopin('', '');"><?php echo "\r\r\r\rWhat would you like to note ". $_SESSION['designoteuser']."?";?></textarea>

		</form>

		</div>

		
		
		<div id="editcolor">

			<div id="picker"></div>
       
        </div>

        <div id="edittypo">

        	<a id="arial" href="javascript:ChangeTypo('arial');">Arial</a>
        	<a id="times" href="javascript:ChangeTypo('times');">Times</a>
        	<a id="alluraregular" href="javascript:ChangeTypo('alluraregular');">Allura</a>
			<a id="belligerent_madnessregular" href="javascript:ChangeTypo('belligerent_madnessregular');">Belligerent Madness</a>
			<a id="carbontyperegular" href="javascript:ChangeTypo('carbontyperegular');">Carbontype</a>
			<a id="distant_galaxyregular" href="javascript:ChangeTypo('distant_galaxyregular');">Distant Galaxy</a>

			<a id="flux_architectregular" href="javascript:ChangeTypo('flux_architectregular');">Flux Architectregular</a>
			<a id="gongnormal" href="javascript:ChangeTypo('gongnormal');">Gong</p>
			<a id="henny_pennyregular" href="javascript:ChangeTypo('henny_pennyregular');">Henny Penny</a>
			<a id="idolwildregular" href="javascript:ChangeTypo('idolwildregular');">Idolwild</a>

			<hr>
			<a id="up" href="javascript:FontSize('up');">Up font-size</a>
			<a id="down" href="javascript:FontSize('down');">Down font-size</a>

        </div>

        <div id="editbckgr">

        	<div id="pickerbckgr"></div>

			<div id="motif1" onclick="ChangeBckgr('1.jpg');"></div>
			<div id="motif2" onclick="ChangeBckgr('2.jpg');"></div>
			<div id="motif3" onclick="ChangeBckgr('3.jpg');"></div>
			<div id="motif4" onclick="ChangeBckgr('4.jpg');"></div>
			<div id="motif5" onclick="ChangeBckgr('5.jpg');"></div>
			<div id="motif6" onclick="ChangeBckgr('6.jpg');"></div>
			<div id="motif7" onclick="ChangeBckgr('7.jpg');"></div>
			<div id="motif8" onclick="ChangeBckgr('8.jpg');"></div>
			<div id="motif9" onclick="ChangeBckgr('9.jpg');"></div>

        </div>

        <div id="editframe">

        	<div id="orange" onclick="ChangeFrame('orange');"></div>
			<div id="redtriangle" onclick="ChangeFrame('redtriangle');"></div>
			<div id="black" onclick="ChangeFrame('black');"></div>
			<div id="blackshadow" onclick="ChangeFrame('blackshadow');"></div>
			<div id="bluedouble" onclick="ChangeFrame('bluedouble');"></div>
			<div id="simplewhite" onclick="ChangeFrame('simplewhite');"></div>
			<div id="none" onclick="ChangeFrame('none');"></div>

        </div>




	</div>


<div id="gallerie" class="clearfix page">
	<h2><img src="img/minigallery.png" width="20px">Gallery</h2>
	<div id="portfolio3">
		<div class="bloc">
				<a class="thumb" href="#projet01">
					<img src="img/note/1.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/1.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet02">
					<img src="img/note/1.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/1.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet03">
					<img src="img/note/2.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/2.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet04">
					<img src="img/note/3.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/3.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet05">
					<img src="img/note/4.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/4.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet06">
					<img src="img/note/5.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/5.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet07">
					<img src="img/note/6.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/6.jpg" alt="">
				</div>
			</div>
			
			<div class="bloc">
				<a class="thumb" href="#projet08">
					<img src="img/note/7.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/7.jpg" alt="">
				</div>
			</div>
	</div>
</div>


<div id="favorisuser" class="clearfix page">
	<h2><img src="img/coeur.png" width="20px">Favoris</h2>
	<div id="portfolio4">
		<div class="bloc">
				<a class="thumb" href="#projet01">
					<img src="img/note/1.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/1.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet02">
					<img src="img/note/1.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/1.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet03">
					<img src="img/note/2.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/2.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet04">
					<img src="img/note/3.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/3.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet05">
					<img src="img/note/4.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/4.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet06">
					<img src="img/note/5.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/5.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet07">
					<img src="img/note/6.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/6.jpg" alt="">
				</div>
			</div>
			
			<div class="bloc">
				<a class="thumb" href="#projet08">
					<img src="img/note/7.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/7.jpg" alt="">
				</div>
			</div>
	</div>
</div>


<div id="notesuser" class="clearfix page">
	<h2><img src="img/mininote.png" width="20px">My notes</h2>
	<div id="portfolio5">
		<div class="bloc">
				<a class="thumb" href="#projet01">
					<img src="img/note/1.jpg" alt="">
				</a>
				<div class="info">
					<img src="img/note/1.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet02">
					<img src="img/note/1.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/1.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet03">
					<img src="img/note/2.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/2.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet04">
					<img src="img/note/3.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/3.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet05">
					<img src="img/note/4.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/4.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet06">
					<img src="img/note/5.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/5.jpg" alt="">
				</div>
			</div>

			<div class="bloc">
				<a class="thumb" href="#projet07">
					<img src="img/note/6.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/6.jpg" alt="">
				</div>
			</div>
			
			<div class="bloc">
				<a class="thumb" href="#projet08">
					<img src="img/note/7.jpg" alt=""></a>
				<div class="info">
					<img src="img/note/7.jpg" alt="">
				</div>
			</div>
	</div>
</div>


<div id="aboutapp" class="page">


	<p class="logobleu">About DesigNote</p>
	<p class="version">Version beta</p>
	<p> DesigNote and DesigNote's logos are commercial property of DesigNote. All reserved rights.
		
	</p>
</div>


</div>

<div id="settingsuser" class="page">

	<h4>Settings</h4>

	
	<div id="avatar">
	  
	  
	  
	<?php echo "<img src='".$_SESSION['designoteimg']."'>"; ?>
  <?php echo "<h2>".$_SESSION['designoteuser']."</h2>"; ?>
  <?php echo "<h3>".$_SESSION['designotename']."</h3>"; ?>

	  
	  <p class='message' id='messagechange' style="margin: 30px 0; display:none;">Change carried out</p>
	 

		  <div id="changer">
		  
		  <a class="change" href="javascript:ChangeImg(<?php echo $_SESSION['designote']; ?>);"><p> Change avatar</p></a>
		  <a class="change" href="javascript:ChangeUsername(<?php echo $_SESSION['designote']; ?>);"><p> Change username</p></a>
		  </div>




	<script type="text/javascript">



	    function ChangeUsername(iduser) {

	    	var newpseudo = prompt('What your new username?');

	    	if(newpseudo.length>3) { 

	    		document.getElementById("messagechange").style.display="block";
			
				setTimeout(function(){
						window.location.href='?action=reloadname&newpseudo='+newpseudo+"&iduser="+iduser;
				}, 2000);

			}
		}


		function ChangeImg(iduser) {

	    	var newimg = prompt('Paste here the URL for the new picture');

	    	if(newimg.length>10) { 

	    		document.getElementById("messagechange").style.display="block";
			
				setTimeout(function(){
						window.location.href='?action=reloadimg&newimg='+newimg+"&iduser="+iduser;
				}, 2000);

			}
		}


	</script>
	  
	  
	  
	</div>
	

	<a id="supprimer" href="?action=deleteuser">Delete my account DesigNote</a>



</div>


 




	<nav class="" id="standard">
		<ul>
			<li id="homebas" class="active"><a href="javascript:DisplayPages('index', 'home');">Home</a></li>
			<li id="random"><a href="javascript:randomdisplay();" onclick="DisplayPages('searchrandom', 'random');">Random</a></li>
			<li id="add"><a href="javascript:DisplayPages('write', '');">Add</a></li>
			<li id="favoris"><a href="javascript:DisplayPages('favorisuser', 'favorites');">Rate</a></li>
			<li id="search"><a href="javascript:DisplayPages('searchnote', 'search');">Fav</a></li>
		</ul>
	</nav>

	<nav class="clearfix" id="edit">
		<ul>
			<li id="colors"><a href="javascript:DisplayPopin('editcolor', 'colors');">Colors</a></li>
			<li id="font"><a href="javascript:DisplayPopin('edittypo', 'font');">Font</a></li>
			<li id="validate"><a href="javascript:CanvasThis();">Validate</a></li>
			<li id="background"><a href="javascript:DisplayPopin('editbckgr', 'background');">Background</a></li>
			<li id="frames"><a href="javascript:DisplayPopin('editframe', 'frames');">Frames</a></li>
		</ul>
	</nav>

</div>
<?php
	}
?>

	<script type='text/javascript' src="js/masonry.js"></script>

    <script type="text/javascript" src="js/html2canvas.js"></script>
    <script type="text/javascript">
        function CanvasThis() {
        	html2canvas(document.getElementById("canvasnote"), {
            onrendered: function(canvas) {
            	document.getElementById("resultnote").style.display="block";
                document.getElementById("resultnote").appendChild(canvas);
            }
        });
        }
    </script>


<script src="js/jquery.touchwipe.js"></script>
 
<script>
      $(window).touchwipe({
        wipeLeft: function() {
          // Close
          $.sidr('close', 'sidr');
        },
        wipeRight: function() {
          // Open
          $.sidr('open', 'sidr');
        },
        preventDefaultEvents: false
      });

	$(document).ready(

	function() {
		$('#simple-menu').sidr();
    	$('#picker').farbtastic('#note');
    	$('#pickerbckgr').farbtasticbckgr('#bckgr');

	var portfolio = $('#portfolio, #portfolio2, #portfolio3, #portfolio4, #portfolio5');
	portfolio.masonry({
		isAnimated: true,
		itemSelector:'.bloc:not(.hidden)',
		isFitWidth:true,
		columnWidth:75
	});
	


/* Agrandir une image */

	/*var width = portfolio.find('bloc:first').width();
	var height = portfolio.find('bloc:first').height();
	var cssi = {width:width,height:height};*/

	portfolio.find('a.thumb').click(function(e){
		var elem = $(this);
		var cls = elem.attr('href').replace('#','');
		var fold = portfolio.find('.unfold').removeClass('unfold')/*.css(cssi)*/;
		var unfold = elem.parent().addClass('unfold');
		portfolio.masonry('reload');

		var widthf = unfold.width();
		var heightf = unfold.height();

		/*unfold.css(cssi).animate({
			width:widthf,
			height:heightf
		})*/
		location.hash = cls;
		e.preventDefault();
	})



/* Pour avoir la catégorie sélectionner grâce à l'url */
	
	if(location.hash != ''){
		$('a[href="'+location.hash+'"]').trigger('click');
	}
});

	
</script>


</body>
</html>

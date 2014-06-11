<?php
	 /*
ini_set('display_errors', 1);
	 error_reporting(E_ALL);
*/



	
try {
    $bdd = new PDO('mysql:host=localhost;dbname=jenniferdenis', 'jenniferdenis', 'SjwYCnv2tt29BqLd');
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

	<script src="http://www.nihilogic.dk/labs/canvas2image/base64.js"></script>
<script src="http://www.nihilogic.dk/labs/canvas2image/canvas2image.js"></script>

<script type="text/javascript">

// setup our test canvas
// and a simple drawing function
window.onload = function() {

	var bMouseIsDown = false;
	
	var oCanvas = document.getElementById("thecanvas1");
	var oCtx = oCanvas.getContext("2d");


	var iWidth = oCanvas.width;
	var iHeight = oCanvas.height;

	oCtx.fillStyle = "rgb(255,255,255)";
	oCtx.fillRect(0,0,iWidth,iHeight);

	oCtx.fillStyle = "rgb(255,0,0)";
	oCtx.fillRect(20,20,30,30);

	oCtx.fillStyle = "rgb(0,255,0)";
	oCtx.fillRect(60,60,30,30);

	oCtx.fillStyle = "rgb(0,0,255)";
	oCtx.fillRect(100,100,30,30);

	oCtx.beginPath();
	oCtx.strokeStyle = "rgb(255,0,255)";
	oCtx.strokeWidth = "4px";

	oCanvas.onmousedown = function(e) {
		bMouseIsDown = true;
		iLastX = e.clientX - oCanvas.offsetLeft + document.body.scrollLeft;
		iLastY = e.clientY - oCanvas.offsetTop + document.body.scrollTop;
	}
	oCanvas.onmouseup = function() {
		bMouseIsDown = false;
		iLastX = -1;
		iLastY = -1;
	}
	oCanvas.onmousemove = function(e) {
		if (bMouseIsDown) {
			var iX = e.clientX - oCanvas.offsetLeft + document.body.scrollLeft;
			var iY = e.clientY - oCanvas.offsetTop + document.body.scrollTop;
			oCtx.moveTo(iLastX, iLastY);
			oCtx.lineTo(iX, iY);
			oCtx.stroke();
			iLastX = iX;
			iLastY = iY;
		}
	}

	function showDownloadText() {
		document.getElementById("buttoncontainer").style.display = "none";
		document.getElementById("textdownload").style.display = "block";
	}

	function hideDownloadText() {
		document.getElementById("buttoncontainer").style.display = "block";
		document.getElementById("textdownload").style.display = "none";
	}

	function convertCanvas(strType) {
		if (strType == "PNG")
			var oImg = Canvas2Image.saveAsPNG(oCanvas, true);
		if (strType == "BMP")
			var oImg = Canvas2Image.saveAsBMP(oCanvas, true);
		if (strType == "JPEG")
			var oImg = Canvas2Image.saveAsJPEG(oCanvas, true);

		if (!oImg) {
			alert("Sorry, this browser is not capable of saving " + strType + " files!");
			return false;
		}

		oImg.id = "canvasimage";

		oImg.style.border = oCanvas.style.border;
		document.body.replaceChild(oImg, oCanvas);

		showDownloadText();
	}

	function saveCanvas(pCanvas, strType) {
		var bRes = false;
		if (strType == "PNG")
			bRes = Canvas2Image.saveAsPNG(oCanvas);
		if (strType == "BMP")
			bRes = Canvas2Image.saveAsBMP(oCanvas);
		if (strType == "JPEG")
			bRes = Canvas2Image.saveAsJPEG(oCanvas);

		if (!bRes) {
			alert("Sorry, this browser is not capable of saving " + strType + " files!");
			return false;
		}
	}

	document.getElementById("savepngbtn").onclick = function() {
		saveCanvas(oCanvas, "PNG");
	}
	document.getElementById("savebmpbtn").onclick = function() {
		saveCanvas(oCanvas, "BMP");
	}
	document.getElementById("savejpegbtn").onclick = function() {
		saveCanvas(oCanvas, "JPEG");
	}

	document.getElementById("convertpngbtn").onclick = function() {
		convertCanvas("PNG");
	}
	document.getElementById("convertbmpbtn").onclick = function() {
		convertCanvas("BMP");
	}
	document.getElementById("convertjpegbtn").onclick = function() {
		convertCanvas("JPEG");
	}

	document.getElementById("resetbtn").onclick = function() {
		var oImg = document.getElementById("canvasimage");
		document.body.replaceChild(oCanvas, oImg);

		hideDownloadText();
	}

}
</script>
  <link rel='stylesheet prefetch' href='http://dimsemenov-static.s3.amazonaws.com/dist/magnific-popup.css'>

  <script src="js/prefixfree.min.js"></script>
    <script src="js/hammer.min.js"></script>
	<script type="text/javascript">
		function writeNote() {
			var x = prompt('Ecrivez votre note!');

			document.getElementById("note").innerHTML=x;
		}


	</script>

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
	
	<a href="javascript:DisplayPages('accountuser', '');">
	<?php echo "<img src='".$_SESSION['designoteimg']."'>"; ?>

	<?php echo "<h2> ".$_SESSION['designoteuser']."</h2>"; ?>
	<?php echo "<h3> ".$_SESSION['designotename']."</h3>"; ?>
	</a>

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
		
		<script type="text/javascript">
		
		
			function FavoriteIt(id) { 
			alert('vous aimez ' + id);
			
	
				xhr.open("GET","favorites.php?id="+id,true);
				xhr.onreadystatechange=function(){
				  if(xhr.readyState==4)
				    if(xhr.status==200) {
						eval(xhr.responseText);
				    }
				}
	
				xhr.send();
				
		}
		
		
		</script>
	
	<?php
	
			$reponselatest= $bdd->query("SELECT * FROM notes ORDER BY date DESC");
	
			while ($donneeslatest = $reponselatest->fetch()) {
	
	?>
	
				<div class="bloc">
					<a class="thumb" href="#note<?php echo $donneeslatest['id']; ?>">
						<img src="<?php echo $donneeslatest['img']; ?>" alt=""></a>
					<div class="info">
						<a href="javascript:FavoriteIt(<?php echo $donneeslatest['id'] ?>);"><img src="<?php echo $donneeslatest['img']; ?>" alt=""></a>
					</div>
				</div>
	
	<?php
			}
	
	
	?>
				
		</div>		
		


		<h2 class="mostviewed"><img src="img/coeur.png"> Most Viewed</h2>
		<div id="portfolio2">
	
	<?php
	
			$reponseviewed= $bdd->query("SELECT * FROM notes ORDER BY favoris DESC");
	
			while ($donneesviewed = $reponseviewed->fetch()) {
	
	?>
	
				<div class="bloc">
					<a class="thumb" href="#note<?php echo $donneesviewed['id']; ?>">
						<img src="<?php echo $donneesviewed['img']; ?>" alt=""></a>
					<div class="info">
						<a href="javascript:FavoriteIt(<?php echo $donneesviewed['id'] ?>);"><img src="<?php echo $donneesviewed['img']; ?>" alt=""></a>
					</div>
				</div>
	
	<?php
			}
	
	
	?>
				
		</div>
			
			
	</div>

	</div>

	<div id="searchrandom">


		<h2><img src="img/minirandom.png" width="20px">Random</h2>


		<a id="randomid" href=""><img id="randomdisplay" src="" alt="random image"></a>

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

    function displaynoterandom(imgsrc, id){
    	
    	document.getElementById('randomdisplay').src=imgsrc;
    	document.getElementById('randomid').href="javascript:FavoriteIt("+id+");";
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

			<?php
		$iduser=$_SESSION['designote'];
		$reponsenombrenotes = $bdd->query("SELECT id FROM notes WHERE user_id=$iduser");
		
		$resultatsnombrenotes = $reponsenombrenotes->rowCount();
		

	?>


			<p class="nb"><?php echo $resultatsnombrenotes; ?></p>
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

			<canvas id="thecanvas1"></canvas>


<br/><br/>
<div id="textdownload" style="display:none;font-style:italic;">Now you can right click and download the image<br/>
<input type="button" id="resetbtn" value="Reset">
</div>

<div id="buttoncontainer" style="display:block;">
<input type="button" id="savepngbtn" value="Save PNG">
<input type="button" id="convertpngbtn" value="Convert to PNG">
<br/>
<input type="button" id="savebmpbtn" value="Save BMP">
<input type="button" id="convertbmpbtn" value="Convert to BMP">
<br/>
<input type="button" id="savejpegbtn" value="Save JPEG">
<input type="button" id="convertjpegbtn" value="Convert to JPEG">

</div>
		</div>
		<div id="canvasnote">
			<div id="bckgr">
		<p id="note" onclick="writeNote();DisplayPopin('', '');"><?php echo "\r\r\r\rWhat would you like to note ". $_SESSION['designoteuser']."?";?></p>

	</div>



		</div>
		
		
		<div id="editcolor">

			<div id="picker"></div>
       
        </div>

        <div id="edittypo">


				
				
				<div id="navtype" role="navigation">
				    <a href="#navtype" title="Show navigation">Show navigation</a>
				    <a href="#" title="Hide navigation">Hide navigation</a>
				   
				    <ul class="titrre">
				
				        <li>
				   
				           
				           
				            <ul class="second">
				                
				                
				                
				                
				                <li><a id="arial" href="javascript:ChangeTypo('arial');">Arial</a></li>
				                <li><a id="times" href="javascript:ChangeTypo('times');">Times</a></li>
				                <li><a id="alluraregular" href="javascript:ChangeTypo('alluraregular');">Allura</a></li>
								<li><a id="belligerent_madnessregular" href="javascript:ChangeTypo('belligerent_madnessregular');">Belligerent Madness</a></li>
								<li><a id="carbontyperegular" href="javascript:ChangeTypo('carbontyperegular');">Carbontype</a></li>
								<li><a id="distant_galaxyregular" href="javascript:ChangeTypo('distant_galaxyregular');">Distant Galaxy</a></li>
								<li><a id="flux_architectregular" href="javascript:ChangeTypo('flux_architectregular');">Flux Architectregular</a></li>
								<li><a id="gongnormal" href="javascript:ChangeTypo('gongnormal');">Gong</a></li>
								<li><a id="henny_pennyregular" href="javascript:ChangeTypo('henny_pennyregular');">Henny Penny</a></li>
								<li><a id="idolwildregular" href="javascript:ChangeTypo('idolwildregular');">Idolwild</a></li>
								
								
								
				            </ul>
				            
				                     <a href="#navtype" aria-haspopup="true">Typographies</a>
				         
				            
				        </li>
				
				    </ul>
				</div>





			<div id="choixtaille">
			<a id="up" href="javascript:FontSize('up');"><img src="img/up.png" width="30px" height="30px"/><span class="hidden">Up font-size</span></a>
			<a id="down" href="javascript:FontSize('down');"><img src="img/down.png" width="30px" height="30px"/><span class="hidden">Down font-size</span></a>
			<a id="marginup" href="javascript:Margin('up');"><img src="img/marginup.png" width="30px" height="30px"/><span class="hidden">Up margin</span></a>
			<a id="margindown" href="javascript:Margin('down');"><img src="img/margindown.png" width="30px" height="30px"/><span class="hidden">Down margin</span></a>
			</div>
			
			
			
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


<?php

		$reponsegallery = $bdd->query("SELECT * FROM notes ORDER BY date");

		while ($donneesgallery = $reponsegallery->fetch()) {

?>

			<div class="bloc">
				<a class="thumb" href="#note<?php echo $donneesgallery['id']; ?>">
					<img src="<?php echo $donneesgallery['img']; ?>" alt=""></a>
				<div class="info">
					<a href="javascript:FavoriteIt(<?php echo $donneesgallery['id'] ?>);"><img src="<?php echo $donneesgallery['img']; ?>" alt=""></a>
				</div>
			</div>

<?php
		}


?>
			
	</div>
</div>


<div id="favorisuser" class="clearfix page">
	<h2><img src="img/coeur.png" width="20px">Favoris</h2>
	<div id="portfolio4">

		<?php

		$reponsefavoris = $bdd->query("SELECT * FROM notes ORDER BY favoris DESC");

		while ($donneesfavoris = $reponsefavoris->fetch()) {

?>

			<div class="bloc">
				<a class="thumb" href="#favoris<?php echo $donneesfavoris['id']; ?>">
					<img src="<?php echo $donneesfavoris['img']; ?>" alt=""></a>
				<div class="info">
					<a href="javascript:FavoriteIt(<?php echo $donneesfavoris['id'] ?>);"><img src="<?php echo $donneesfavoris['img']; ?>" alt=""></a>
				</div>
			</div>

<?php
		}


		?>
			
	</div>
</div>


<div id="notesuser" class="clearfix page">
	<h2><img src="img/mininote.png" width="20px">My notes</h2>
	<div id="portfolio5">
				<?php

				$iduser=$_SESSION['designote'];

		$reponsenotesuser = $bdd->query("SELECT * FROM notes WHERE user_id=$iduser");

		// if (fetchColumn($reponsenotesuser)) {
			while ($donneesnotesuser = $reponsenotesuser->fetch()) {

?>

			<div class="bloc">
				<a class="thumb" href="#user<?php echo $donneesnotesuser['id']; ?>">
					<img src="<?php echo $donneesnotesuser['img']; ?>" alt=""></a>
				<div class="info">
					<img src="<?php echo $donneesnotesuser['img']; ?>" alt="">
				</div>
			</div>

<?php
		}

	// } else {
		// echo "<p>Create a note!</p>";
	// }

		?>
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
            	anchor=document.getElementById("thecanvas1");
                anchor.parentNode.replaceChild(canvas, anchor);
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
function activemenu() {

		var simplemenu = document.getElementById("simple-menu");

		if(simplemenu.className == "activemenu") {
			simplemenu.className = "";
		} else {
			simplemenu.className = "activemenu";
		}


	}

	var previous="";

		function ChangeTypo(typo) {
			document.getElementById("note").style.fontFamily=typo;
			
			// document.getElementById(typo).style.background="rgba(0,0,0,0.5)";

			// if(previous) {document.getElementById(previous).style.background="rgba(0,0,0,0)";}

			// previous = typo;
		}


	function ChangeBckgr(motif) {
	  	document.getElementById("bckgr").style.background = "url(img/motif/" + motif + ")";
	}

	function ChangeFrame(border) {
		document.getElementById("bckgr").className=border;
	}




		var CurrentPage = "index";
		var idMenuCurrent = "home";

		function DisplayPages(id, idMenu) {
			if(id=="write") {
				document.getElementById("standard").style.display = "none";
				document.getElementById("edit").style.display = "block";
			};

			if(id!="write") {
				document.getElementById("standard").style.display = "block";
				document.getElementById("edit").style.display = "none";
			};

			if (idMenu == "favorites") {
				document.getElementById("favoris").className= "active";
			} else {
				document.getElementById("favoris").className= "";
			}

			if (idMenu == "home") {
				document.getElementById("homebas").className= "active";
			} else {
				document.getElementById("homebas").className= "";
			}
			

			document.getElementById(CurrentPage).style.left = "-99999px";
			document.getElementById(CurrentPage).style.position = "absolute";
			if (idMenuCurrent) {document.getElementById(idMenuCurrent).className= "";}

			document.getElementById(id).style.left = "auto";
			document.getElementById(id).style.position = "static";
			if (idMenu) {document.getElementById(idMenu).className= "active";}

			CurrentPage = id;
			if (idMenu) {idMenuCurrent = idMenu;} else {idMenuCurrent= "";}


		}

		var idDivCurrentWriting = "";
		var idMenuCurrentWriting = "";

		function DisplayPopin(idDiv, idMenu) {

			if (idDivCurrentWriting) {
				document.getElementById(idDivCurrentWriting).style.display = "none";
			};

			if (idMenuCurrentWriting) {
				document.getElementById(idMenuCurrentWriting).className = "";
			};


			document.getElementById(idDiv).style.display = "block";
			document.getElementById(idMenu).className = "active";

			idDivCurrentWriting = idDiv;
			idMenuCurrentWriting = idMenu;

			

		}



	var size= 16;
	
	function FontSize(sens) {

		if(size<=6) {
			document.getElementById("down").innerHTML="Too small";
			document.getElementById("down").style.color="rgba(0,0,0,0.5)";
		} else {
			document.getElementById("down").innerHTML="Down font-size";
			document.getElementById("down").style.color="rgba(0,0,0,1)";
		}

		if(size>=50) {
			document.getElementById("up").innerHTML="Too large";
			document.getElementById("up").style.color="rgba(0,0,0,0.5)";
		} else {
			document.getElementById("up").innerHTML="Up font-size";
			document.getElementById("up").style.color="rgba(0,0,0,1)";
		}

		if(sens=="up" && size<50) {
			size++;
			document.getElementById("note").style.fontSize=size + "px";
		}

		if(sens=="down" && size>6) {
			size--;
			document.getElementById("note").style.fontSize=size + "px";
		}
		
	}

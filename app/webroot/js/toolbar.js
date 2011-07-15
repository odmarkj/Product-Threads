var fcontainer = "block";

function toggleFactivity(){
	document.getElementById('fcontainer').style.display = fcontainer;
	
	if(fcontainer == "block")
		fcontainer = "none";
	else
		fcontainer = "block";
}

function activateToolbar(){
	document.getElementById('toolbar').style.display = "block";
}
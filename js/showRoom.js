function showRoom(idBuildings){
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=(function()
	{	
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("room").innerHTML = xmlhttp.responseText;
			document.getElementById("room").style.display = "block";
		}
	});    	
	xmlhttp.open("GET",	"php/showRoom.php?idBuildings="+idBuildings,true);
	xmlhttp.send();	
}

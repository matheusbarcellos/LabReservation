function showProfessor(str){
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=(function()
	{	
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("professor").innerHTML = xmlhttp.responseText;
			document.getElementById("professor").style.display = "block";
		}
	});    	
	xmlhttp.open("GET",	"php/showProfessor.php?department="+str,true);
	xmlhttp.send();	
}









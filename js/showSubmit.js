function showSubmit(){
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=(function()
	{	
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("submit").innerHTML = xmlhttp.responseText;
			document.getElementById("submit").style.display = "block";
		}
	});    
	xmlhttp.open("GET", "php/showSubmit.php", true);
	xmlhttp.send();	
}

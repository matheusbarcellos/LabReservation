function home(){
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=(function()
	{	
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var str = xmlhttp.responseText;
			var res = str.split(" ");
			document.getElementById("welcome").innerHTML = xmlhttp.responseText;
			document.getElementById("welcome").style.display = "block";
		}
	});    
	xmlhttp.open("GET", "php/home.php", true);
	xmlhttp.send();	
}

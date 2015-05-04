function ReadButtons(){
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
			// res[0] = login state res[1] = email

			if ((res[0].localeCompare("0") == 1) && (res[0] != "Null")) {
				document.getElementById ("LB01").style.display ="none"; //Login button
				document.getElementById ("LB02").style.display ="none"; //Login button
				document.getElementById ("Reg1").style.display ="none"; //Registration button
				document.getElementById ("Reg2").style.display ="none";
				document.getElementById ("Home1").style.display ="block";
				document.getElementById ("Home2").style.display ="block";
				document.getElementById ("App1").style.display ="block";
				document.getElementById ("App2").style.display ="block";
				document.getElementById ("LB11").style.display ="block"; //Logout button
				document.getElementById ("LB12").style.display ="block"; //Logout button
				if (res[0] == "4") { //Admin
					document.getElementById ("New1").style.display ="block";
					document.getElementById ("New2").style.display ="block";
				}
			} else if ((res[0].localeCompare("0") == -1) || (res[0] == "Null")) { 
				document.getElementById ("LB01").style.display ="block"; //Login button
				document.getElementById ("LB02").style.display ="block"; //Login button
				document.getElementById ("Reg1").style.display ="block"; //Registration button
				document.getElementById ("Reg2").style.display ="block";
				document.getElementById ("Home1").style.display ="none";
				document.getElementById ("Home2").style.display ="none";
				document.getElementById ("App1").style.display ="none";
				document.getElementById ("App2").style.display ="none";
				document.getElementById ("LB11").style.display ="none"; //Logout button
				document.getElementById ("LB12").style.display ="none"; //Logout button
				document.getElementById ("New1").style.display ="none";
				document.getElementById ("New2").style.display ="none";
			}
		}
	});    	
	xmlhttp.open("GET",	"http://cis-linux2.temple.edu/~tuf82846/slidebars/php/readButtons.php",true);
	xmlhttp.send();	
}
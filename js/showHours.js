function showHours(id, str) {
	var date = $("#" + id).data("date");
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=(function()
	{	
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			if (document.getElementById(id).title == "Available Day") { 
				document.getElementById("hours").innerHTML = xmlhttp.responseText;
				document.getElementById("hours").style.display = "block";
				$("#dateSelected").show();
				$("#dateSelected").html('<div class="wrapper" style="display:none"><label class="professor"><span class="bg"><select name="dateClicked"> <option selected="'+date+'">'+date+'</option></select></span><span class="empty">*Required</span></label></div>');
			} else {
				$("#dateSelected").hide();
				document.getElementById("hours").style.display = "none";
			}
		}
	});
	xmlhttp.open("GET", "php/showHours.php?idusers=" + str + "&date=" + date, true);
	xmlhttp.send();
}			
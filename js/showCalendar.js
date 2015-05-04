function showCalendar(str){
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=(function()
	{	
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("calendar1").innerHTML = xmlhttp.responseText;
			document.getElementById("calendar1").style.display = "block";
			$(document).ready(function () {
				$('#my-calendar').zabuto_calendar({
					show_previous: false,
					show_next: 1,
					today: true,
					show_days: true,
					weekstartson: 0,
					ajax: {
						url: "php/showDate.php?professor=" + str
                    },
					action: function () {
                            return showHours(this.id, str);
                    },
					legend: [
						{type: "block", label: "Today", classname: "today"},
						{type: "block", label: "Available Days", classname: "logo"},
					]
				});
			});
		}
	});    	
	xmlhttp.open("GET", "php/showCalendar.php?idusers=" + str, true);
	xmlhttp.send();	
}
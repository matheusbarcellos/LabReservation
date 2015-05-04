function showBuildings(professor) {
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = (function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("buildings").innerHTML = xmlhttp.responseText;
            document.getElementById("buildings").style.display = "block";
        }
    });
    xmlhttp.open("GET", "php/showBuildings.php?professor=" + professor, true);
    xmlhttp.send();
}
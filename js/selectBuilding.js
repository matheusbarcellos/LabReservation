function selectBuilding() {
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = (function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("buildings2").innerHTML = xmlhttp.responseText;
            document.getElementById("buildings2").style.display = "block";
        }
    });
    xmlhttp.open("GET", "php/selectBuilding.php", true);
    xmlhttp.send();
}
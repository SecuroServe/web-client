var obj;

function httpGetAsync(theUrl, callback)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    xmlHttp.open("GET", theUrl, false);
    xmlHttp.send(null);
}

function callBack(data) {
	obj = JSON.parse(data);
}

function getAllCalamity(){
	httpGetAsync("../api/allcalamity", callBack);
	return obj;
}

function getCalamity(id){
	httpGetAsync("../api/calamitybyid?id=" + id, callBack);
	return obj;
}

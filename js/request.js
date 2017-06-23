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

function login(username, password){
	httpGetAsync("../api/login?username=" + username + "&password=" + password, callBack);
	return obj;
}

function getUser(token){
	httpGetAsync("../api/getuser?usertoken=" + token, callBack);
	createCookie("token", token, 900000);
	createCookie("username", obj.returnObject.username, 900000);
	createCookie("userid", obj.returnObject.id, 900000);
	return obj;
}

function addPost(token, userId, calamityId, post){
	httpGetAsync("../api/addpost?token=" + token + "&userId=" + userId + "&calamityId=" + calamityId + "&text=" + post, callBack);
	return obj;
}

function register(username, password1, password2, email, city){
	httpGetAsync("../api/register?username=" + username + "&password1=" + password1 + "&password2=" + password2 + "&email=" + email + "&city=" + city, callBack);
	return obj;
}

function addAlert(token, title, description, urgency, latitude, longitude, radius){
	httpGetAsync("../api/addalert?token=" + token + "&name=" + title + "&description=" + description + "&urgency=" + urgency + "&latitude=" + latitude + "&longitude=" + longitude + "&radius=" + radius, callBack);
	return obj;
}

function createCookie(name, value, timeout) {
   var date = new Date();
   date.setTime(date.getTime()+(timeout));
   var expires = "; expires="+date.toGMTString();

   document.cookie = name+"="+value+expires+"; path=/";
   location.reload();
}

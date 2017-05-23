<!DOCTYPE html>
<html lang="en">
<?php $id = $_GET["id"]; ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Pagina voor meer informatie voor een specifieke calamiteit">
    <meta name="author" content="">
	
	<!-- Favicons -->
	<link rel="apple-touch-icon" sizes="57x57" href="/img/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/img/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/img/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/img/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/img/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/img/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/img/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/img/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/img/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
	<link rel="manifest" href="/img/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/img/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

    <title>SecuroServe - Calamity</title>
	
    <script src="js/request.js"></script>

    <!-- Material Design fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Material Design -->
    <link href="css/bootstrap-material-design.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">

    <!-- Dropdown.js -->
    <link href="//cdn.rawgit.com/FezVrasta/dropdown.js/master/jquery.dropdown.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
	
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">SecuroServe</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="jumbotron jumbotron-static-height" id="map"></div>
    <div class="container">
      <!-- Example row of columns -->
	  <div class="well extra-info">
      <div class="row">
        <div class="col-md-4">
          <h3 id="title">Bericht</h3>
          <p id="message"></p>
        </div>
        <div class="col-md-4">
          <h3>Informatie</h3>
          <p id="time"></p>
          <p id="status"></p>
          <p id="confirmed"></p>
        </div>
        <div class="col-md-4">
          <h3>Hulpverlener</h3>
          <p id="user"></p>
        </div>
      </div>
      </div>
	  

    <footer>
      <p>© <?php echo date("Y"); ?> SecuroServe</p>
    </footer>
    </div>

	<script>
		var response = getCalamity(<?php echo $id; ?>);
		var object = response.returnObject;
		document.getElementById("title").innerHTML = "<strong>" + object.title + "</strong>";
		document.getElementById("message").innerHTML = object.message;
		document.getElementById("time").innerHTML = "Deze melding is op " + object.date + " aangemaakt.";
		document.getElementById("status").innerHTML = "Huidige status: " + (object.status ? "Gesloten" : "Open");
		document.getElementById("confirmed").innerHTML = "Deze melding is " + (object.confirmed ? "bevestigd" : "onbevestigd");
		document.getElementById("user").innerHTML = object.user.username + " uit " + object.user.city;
		
      function initMap() {
        var loc = {lat: object.location.latitude, lng: object.location.longitude};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 1,
          center: loc
        });
        var marker = new google.maps.Marker({
          position: loc,
          map: map
        });
		var circle = new google.maps.Circle({
			map: map,
			radius: object.location.radius,
			fillColor: 'red',
			strokeColor: 'white',
			strokeWeight: .5,
			strokeOpacity: 0
		});
		circle.bindTo('center', marker, 'position');
		map.fitBounds(circle.getBounds());
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaiJFppGbfSgV0lDHVF5OwZqy0wVhcVmo&callback=initMap">
    </script>
	<!-- Twitter Bootstrap -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<!-- Material Design for Bootstrap -->
	<script src="js/material.js"></script>
	<script src="js/ripples.min.js"></script>
	<script>
	  $.material.init();
	</script>
	<script>
		$('tr[data-href]').on("click", function() {
			document.location = $(this).data('href');
		});
	</script>
  </body>
</html>

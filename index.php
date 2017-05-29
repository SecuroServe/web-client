<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Op deze pagina worden alle calamiteiten weergegeven">
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

    <title>SecuroServe - Home</title>
	
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
            <li class="active"><a href="/">Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div id="map" class="calamity-map"></div>

    <div class="container">

	
	  <div class="well extra-info">
      <div class="row">
        <div class="col-md-3">
          <h3>SecuroServe</h3>
          <p>Welkom op de voorpagina van SecuroServe! Op deze pagina kunt U de verschillende huidige calamiteiten vinden met de desbetreffende informatie, om naar een specifieke calamiteit te gaan kunt U op de kaart, of op een item in de lijst hiernaast klikken.</p>
        </div>
        <div class="col-md-9">
			<table class="table table-hover"> 
				<thead> 
					<tr>
						<td class="col-md-1"><strong>Melding</strong></td> 
						<td class="col-md-6"><strong>Omschrijving</strong></td> 
					</tr> 
				</thead> 
		
				<tbody id="calamityData"></tbody>
			</table>
        </div>
      </div>
      </div>
	
	<footer>
      <p>© <?php echo date("Y"); ?> SecuroServe</p>
    </footer>

    </div> <!-- /container -->


	<script>
		var response = getAllCalamity();
		
		for(i = 0; i < response.returnObject.length; i++) {
			var obj = response.returnObject[i];
			if(obj.confirmed == true) {
				document.getElementById("calamityData").innerHTML += "<tr class='pointer' data-href='/calamity?id="+ obj.id + "'><td> " + obj.title + "</td> <td>" + obj.message + "</td></tr>";
			}
		}
		
	</script>
	
	<script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
			mapTypeId: google.maps.MapTypeId.ROADMAP
        });
		//create empty LatLngBounds object
		var bounds = new google.maps.LatLngBounds();
		var infowindow = new google.maps.InfoWindow({maxWidth: 200});    

		for (i = 0; i < response.returnObject.length; i++) {  
		  if(response.returnObject[i].confirmed){
			  var loc = {lat: response.returnObject[i].location.latitude, lng: response.returnObject[i].location.longitude};
			  var marker = new google.maps.Marker({
				position: new google.maps.LatLng(response.returnObject[i].location.latitude, response.returnObject[i].location.longitude),
				map: map
			  });
			  
			  var circle = new google.maps.Circle({
				map: map,
				radius: response.returnObject[i].location.radius,
				position: loc,
				center: loc,
				fillColor: 'red',
				strokeColor: 'white',
				strokeWeight: .5,
				strokeOpacity: 0
			  });
			  
			  //extend the bounds to include each marker's position
			  bounds.extend(marker.position);

			  google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
				  infowindow.setContent("<h4>" + response.returnObject[i].title + "</h4><p>" + response.returnObject[i].message + "</p><center><a href='/calamity?id="+ response.returnObject[i].id + "' class='btn'>Meer informatie</a></center>");
				  infowindow.open(map, marker);
				}
			  })(marker, i));
			  
			  google.maps.event.addListener(marker, 'dblclick', (function(marker, i) {
				return function() {
				  window.location.href = "/calamity?id="+ response.returnObject[i].id;
				}
			  })(marker, i));
		  }
		}

		//now fit the map to the newly inclusive bounds
		map.fitBounds(bounds);

		
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaiJFppGbfSgV0lDHVF5OwZqy0wVhcVmo&callback=initMap"
    async defer></script>
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

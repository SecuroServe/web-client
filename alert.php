<?php
include('inc/head.php'); 
$cookie_name = "token";
if(!isset($_COOKIE[$cookie_name])) {
?>
<script type="text/javascript">
document.location = 'https://www.securoserve.nl/login';
</script>
<?php
	}
?>
<script>document.title += "Melding maken";</script>


<div id="map" class="alert-map"></div>

<div class="container">
<div class="well extra-info">

  <?php 
	$cookie_name = "alertStatusSuccess";
	if(isset($_COOKIE[$cookie_name])) {
  ?>
	  <div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>De alert is toegevoegd. Bedankt voor het melden!</h4>
			<p><?php echo $_COOKIE['alertStatusSuccess']; ?></p>
	  </div>
  <?php
	}
  ?>

  <?php 
	$cookie_name = "alertStatus";
	if(isset($_COOKIE[$cookie_name])) {
  ?>
	  <div class="alert alert-dismissible alert-warning">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>Iets ging verkeerd!</h4>
			<p><?php echo $_COOKIE['alertStatus']; ?></p>
	  </div>
  <?php
	}
  ?>

<div class="row">
  <div class="col-md-4"><h1>Locatie</h1><p>Klik op de kaart om een locatie mee te sturen.<br>Latitude: <span id="latitude"></span><br>Longitude: <span id="longitude"></span></p></div>
  
  <form method="post" onsubmit="alertRequest()" name="postAlert" id="postAlert">
  <div class="col-md-4">
	<div class="form-group label-floating is-empty">
		<label for="i5i" class="control-label">Titel</label>
		<input type="text" class="form-control" id="title" required>
	</div>
	<div class="form-group label-floating is-empty">
			<label for="t1" class="control-label">Omschrijving</label>
			<textarea id="description" class="form-control description" required></textarea>
	</div>
  </div>
  <div class="col-md-4">
	<div class="form-group">
		<label for="urgence" class="col-md-2 control-label">Urgentie</label>

		<div class="col-md-10">
		  <select class="form-control" id="urgence">
			<option value="1">1 - Laagst</option>
			<option value="2">2 - Laag</option>
			<option value="3">3 - Middel</option>
			<option value="4">4 - Hoog</option>
			<option value="5">5 - Hoogst</option>
		  </select>
		</div>
	</div>
	<div class="form-group is-empty">
		<label for="inputRadius" class="col-md-2 control-label">Radius</label>

		<div class="col-md-10">
		  <input type="number" class="form-control" id="radius" placeholder="Radius" required>
		</div>
	</div>
	
	<input id="submitButton" class="btn btn-raised btn-default btn-block" type="submit" value="Melding maken" disabled>
  </div>
  </form>
</div>

</div>
</div>

<script>
      var map;
	  var marker;
	  var latitude = 51.4416420;
	  var longitude = 5.4697220;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 51.4416420, lng: 5.4697220},
          zoom: 10
        });
		
		google.maps.event.addListener(map, "click", function (e) {
			longitude = e.latLng.lng();
			latitude = e.latLng.lat();
			placeMarker(e.latLng);
			document.getElementById("latitude").innerHTML = latitude;
			document.getElementById("longitude").innerHTML = longitude;
		});
		
      }
	  
	  function placeMarker(location) {
		if(marker != null){
			marker.setPosition(location);
		} else {
			marker = new google.maps.Marker({
				position: location,
				map: map
			});
		}
	    document.getElementById("submitButton").disabled = false;
	  }
	  
	  function alertRequest(){
		var token = "<?php echo $_COOKIE['token'];?>";
		var title = document.getElementById("title").value;
		var description = document.getElementById("description").value;
		var urgence = document.getElementById("urgence").value;
		var radius = document.getElementById("radius").value;
		var alert = addAlert(token, title, description, urgence, latitude, longitude, radius);
		
		
		if(alert.status == "SUCCES"){
			createCookie('alertStatusSuccess', "De melding is aangemaakt!", 3000);
		} else {
			createCookie('alertStatus', "Bij het toevoegen ging iets fout!", 3000);
		}
		
		
		
	  }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaiJFppGbfSgV0lDHVF5OwZqy0wVhcVmo&callback=initMap"
    async defer></script>


<?php include('inc/end.php'); ?>
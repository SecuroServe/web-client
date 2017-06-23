<?php include('inc/head.php'); ?>
<?php 

$id = $_GET["id"]; 
if(!is_numeric($id)){
	?>
<script type="text/javascript">
document.location = 'https://www.securoserve.nl/';
</script>
<?php
}
?>
<script>
	var response = getCalamity(<?php echo $id; ?>);
	if(response == null){
		document.location = "/";
	}
	if(response.returnObject == null){
		document.location = "/";
	}
</script>

    <div class="jumbotron jumbotron-static-height" id="map"></div>
    <div class="container">
      <!-- Example row of columns -->
	  <div class="well extra-info">
      <div class="row">
        <div class="col-md-4">
          <h3 id="title">Bericht</h3>
          <p id="message"></p>
          <h3>Informatie</h3>
          <p id="time"></p>
          <p id="status"></p>
          <p id="confirmed"></p>
          <h3>Hulpverlener</h3>
          <p id="user"></p>
        </div>
        <div class="col-md-8">
          <h3>Reaguursels</h3>
		  <div id="reaguursels"></div>
			<?php 
				$cookie_name = "token";
				if(!isset($_COOKIE[$cookie_name])) {
					echo '<p>Je bent niet ingelogd. Snel, <a href="/login">doe er wat aan</a>, of <a href="/register">registreer een account</a>.</p>';
				} else {
			?>
			<form method="post" onsubmit="postRequest()" name="postForm" id="postForm">
				<div class="form-group label-floating is-empty">
						<label for="t1" class="control-label">Bericht</label>
						<textarea id="postMessage" class="form-control" required></textarea>
				</div>
				<input class="btn btn-raised btn-default" type="submit" value="Bericht plaatsen">
			</form>
			<?php
				}
			?>
        </div>
		
      </div>
      </div>
	  

    <footer>
      <p>© <?php echo date("Y"); ?> SecuroServe</p>
    </footer>
    </div>
	
	<?php 
	if(isset($_COOKIE[$cookie_name])) { ?>
		<script>
			function postRequest(){
				if(!document.getElementById("postMessage").value == ""){
					var post = document.getElementById("postMessage").value;
					var postResponse = addPost("<?php echo $_COOKIE['token'];?>", <?php echo $_COOKIE['userid'];?>, <?php echo $id; ?>, post);
				}
			}
		</script>
	<?php
	}
	?>

	<script>
		var object = response.returnObject;
		document.getElementById("title").innerHTML = "<strong>" + object.title + "</strong>";
		document.getElementById("message").innerHTML = object.message;
		document.getElementById("time").innerHTML = "Deze calamiteit is op " + object.date + " aangemaakt.";
		document.getElementById("status").innerHTML = "Huidige status: " + (object.status ? "Gesloten" : "Open");
		document.getElementById("confirmed").innerHTML = "Deze calamiteit is " + (object.confirmed ? "bevestigd" : "onbevestigd");
		document.getElementById("user").innerHTML = (object.user == null ? "Aangemaakt door het systeem op basis van meldingen." : object.user.username + " uit " + object.user.city);
		
		if(object.posts.length < 1){
			document.getElementById("reaguursels").innerHTML += "<p>Er zijn nog geen reaguursels</p>";
		}
		
		if(object.status){
			document.getElementById("postForm").remove();
			document.getElementById("reaguursels").innerHTML += "<p>Deze calamiteit is gesloten! Het is niet meer mogelijk om hierop te reageren.</p>";
		}
		
		for(i = 0; i < response.returnObject.posts.length; i++) {
			var obj = response.returnObject.posts[i];
			var groupAttribute = "";
			switch(obj.user.userType.name) {
				case "Administrator":
					groupAttribute = "label-danger";
					break;
				case "Hulpverlener":
					groupAttribute = "label-info"
					break;
				case "Burger":
					groupAttribute = "label-success";
					break;
				default:
					groupAttribute = "label-success";
			}
			document.getElementById("reaguursels").innerHTML += "<div class='panel'><div class='panel-heading'><h3 class='panel-title'><span class='label " + groupAttribute + "' style='border-radius: 4px;'>" + obj.user.userType.name + "</span> " + obj.user.username + "</h3></div><div class='panel-body'>" + obj.text + "</div></div>";
		}
		
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
	  
	  $(document).ready(function() {
        document.title += object.title;
	  });
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaiJFppGbfSgV0lDHVF5OwZqy0wVhcVmo&callback=initMap">
    </script>
	<?php include('inc/end.php'); ?>
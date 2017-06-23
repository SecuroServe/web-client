<?php include('inc/head.php'); ?>
	<script>document.title += "Home";</script>
	
	<div id="map" class="calamity-map"></div>

    <div class="container">

	
	  <div class="well extra-info">
      <div class="row">
        <div class="col-md-3">
          <h3>SecuroServe</h3>
          <p class="justify">Welkom op de voorpagina van SecuroServe! Op deze pagina kunt U de verschillende huidige calamiteiten vinden met de desbetreffende informatie, om naar een specifieke calamiteit te gaan kunt U op de kaart, of op een item in de lijst hiernaast klikken.</p>
        </div>
        <div class="col-md-9">
			<table class="table table-hover"> 
				<thead> 
					<tr>
						<td class="col-md-1"><strong>Calamiteit</strong></td> 
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
			if(obj.confirmed && !obj.status) {
				document.getElementById("calamityData").innerHTML += "<tr class='pointer' data-href='/calamity/"+ obj.id + "'><td> " + obj.title + "</td> <td class='justify'>" + obj.message + "</td></tr>";
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
		  if(response.returnObject[i].confirmed && !response.returnObject[i].status){
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
	<script>
		$('tr[data-href]').on("click", function() {
			document.location = $(this).data('href');
		});
	</script>

	<?php include('inc/end.php'); ?>
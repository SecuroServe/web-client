<?php include('inc/head.php'); ?>
<script>document.title += "Zoeken";</script>

<div class="container">
<div class="row">
  <div class="col-md-4">
	<div class="well search">
	
	<p id="feedback">Vul een zoekterm in.</p>
	<div class="form-group label-floating is-empty">
		<label for="i5i" class="control-label"><i class="fa fa-search" aria-hidden="true"></i> Zoekterm</label>
		<input type="text" class="form-control" id="searchTerm" required">
	</div>
	
	
	<p>Vul in het bovenstaande vakje een zoekterm in en druk op enter!</p>
	</div>
  </div>
  <div class="col-md-8">
	<div class="well search">
		<div id="calamities">
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
</div>

<footer>
  <p>© <?php echo date("Y"); ?> SecuroServe</p>
</footer>
</div>

<script>
document.getElementById("searchTerm").focus();
document.getElementById("searchTerm").addEventListener("keydown", function(e) {
    if (!e) { var e = window.event; }
    if (e.keyCode == 13) { 
		if(document.getElementById("searchTerm").value == ""){
			document.getElementById("feedback").innerHTML = "Vul een zoekterm in.";
		} else if(document.getElementById("searchTerm").value.length < 5){
			document.getElementById("feedback").innerHTML = "Je zoekterm moet op z'n minst 5 karakters lang zijn!";
		} else {
			search(); 
		}
	}
}, false);

function search(){
	document.getElementById("calamityData").innerHTML = "";
	document.getElementById("feedback").innerHTML = "";
	var sTerm = document.getElementById("searchTerm").value;
	var sTermSplit = sTerm.split(" ");
	var response = getAllCalamity();
	var isAlreadyPicked = false;
	var foundSomething = false;
		
		for(i = 0; i < response.returnObject.length; i++) {
			isAlreadyPicked = false;
			var tags = response.returnObject[i].tags;
			var obj = response.returnObject[i];
			for(j = 0; j < tags.length; j++){
				for(k = 0; k < sTermSplit.length; k++){
					if(sTermSplit[k].toUpperCase() === tags[j].toUpperCase()){
						if(!isAlreadyPicked) {
							document.getElementById("calamityData").innerHTML += "<tr class='pointer' data-href='/calamity/"+ obj.id + "'><td> " + obj.title + "</td> <td class='justify'>" + obj.message + "</td></tr>";
							isAlreadyPicked = true;
							foundSomething = true;
						}
					}
				}
			}
		}
	if(!foundSomething){
		document.getElementById("feedback").innerHTML = "Geen resultaten!";
	}
		
	$('tr[data-href]').on("click", function() {
		document.location = $(this).data('href');
	});
	
}

</script>

<?php include('inc/end.php'); ?>
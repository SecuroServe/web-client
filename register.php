<?php include('inc/head.php'); ?>
<?php 
	if(isset($_COOKIE['token'])) {
?>
<script type="text/javascript">
document.location = 'https://www.securoserve.nl/';
</script>
<?php
	}
?>
<script>document.title += "Registreren";</script>
<div class="container">

<div class="row">
  <div class="col-md-6 col-md-offset-3">
  <div class="well register">
  <h1>Registreren</h1>
  <?php 
	if(isset($_COOKIE['loginStatus'])) {
  ?>
	  <div class="alert alert-dismissible alert-warning">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>Iets ging verkeerd!</h4>
			<p><?php echo $_COOKIE['loginStatus']; ?></p>
	  </div>
  <?php
	}
  ?>
  <form method="post" onsubmit="registerRequest()" name="registerForm" id="registerForm">
	<div class="form-group label-floating is-empty">
		<input id="username" type="text" class="form-control" required>
		<label class="control-label"><i class="fa fa-user" aria-hidden="true"></i> Gebruikersnaam</label>
	</div>
	<div class="form-group label-floating is-empty">
		<input id="password1" type="password" class="form-control" required>
		<label class="control-label"><i class="fa fa-lock" aria-hidden="true"></i> Wachtwoord</label>
	</div>
	<div class="form-group label-floating is-empty">
		<input id="password2" type="password" class="form-control" required>
		<label class="control-label"><i class="fa fa-lock" aria-hidden="true"></i> Wachtwoord bevestigen</label>
	</div>
	<div class="form-group label-floating is-empty">
		<input id="email" type="email" class="form-control" required>
		<label class="control-label"><i class="fa fa-envelope" aria-hidden="true"></i> Email</label>
	</div>
	<div class="form-group label-floating is-empty">
		<input id="city" type="text" class="form-control" required>
		<label class="control-label"><i class="fa fa-building" aria-hidden="true"></i> Woonplaats</label>
	</div>
	<div class="row">
		<div class="col-xs-6 col-md-4"><input class="btn btn-raised btn-default btn-block" type="submit" value="Registreer"></div>
		<div class="col-xs-12 col-md-8"><p style="margin-top: 18px;">Toch wel al een account? Snel, <a href="/login">log hier in</a>.</p></div>	
	</div>
  </form>
  </div>
  <footer>
  <p>© <?php echo date("Y"); ?> SecuroServe</p>
</footer>

</div>
</div>
</div>

<script>
function registerRequest(){
	var username = document.getElementById("username").value;
	var password1 = document.getElementById("password1").value;
	var password2 = document.getElementById("password2").value;
	var email = document.getElementById("email").value;
	var city = document.getElementById("city").value;
	var response = register(username, password1, password2, email, city);
	if(response.status === "SUCCES"){
		var token = response.returnObject.token;
		var user = getUser(token);
		document.location = 'https://www.securoserve.nl/';
	} else if(response.status === "ERROR"){
		createCookie('loginStatus', response.returnObject.message, 3000);
	}
}
</script>


<?php include('inc/end.php'); ?>
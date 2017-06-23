<?php include('inc/head.php'); ?>
<?php 
	$cookie_name = "token";
	if(isset($_COOKIE[$cookie_name])) {
		?>
<script type="text/javascript">
document.location = 'https://www.securoserve.nl/';
</script>
<?php
	}
?>
<script>document.title += "Inloggen";</script>
<div class="container">

<div class="row">
  <div class="col-md-6 col-md-offset-3">
  <div class="well login">
  <h1>Inloggen</h1>
  <?php 
	$cookie_name = "loginStatus";
	if(isset($_COOKIE[$cookie_name])) {
  ?>
	  <div class="alert alert-dismissible alert-warning">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>Iets ging verkeerd!</h4>
			<p><?php echo $_COOKIE['loginStatus']; ?></p>
	  </div>
  <?php
	}
  ?>
  <form method="post" onsubmit="loginRequest()" name="loginForm" id="loginForm">
	<div class="form-group label-floating is-empty">
		<input id="username" type="text" class="form-control" required>
		<label class="control-label"><i class="fa fa-user" aria-hidden="true"></i> Gebruikersnaam</label>
	</div>
	<div class="form-group label-floating is-empty">
		<input id="password" type="password" class="form-control" required>
		<label class="control-label"><i class="fa fa-lock" aria-hidden="true"></i> Wachtwoord</label>
	</div>
	<p>Na een inactiviteit van 15 minuten wordt U vanzelf uitgelogd.</p>
	<div class="row">
		<div class="col-xs-6 col-md-4"><input class="btn btn-raised btn-default btn-block" type="submit" value="Inloggen"></div>
		<div class="col-xs-12 col-md-8"><p style="margin-top: 18px;">Nog geen account? Snel, <a href="/register">doe er wat aan</a>.</p></div>	
	</div>
  </form>
  </div>
  <footer>
  <p>© <?php echo date("Y"); ?> SecuroServe</p>
</footer>

</div>
</div>

<script>
function loginRequest(){
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;
		var response = login(username, password);
		if(response.status == "SUCCES"){
			var token = response.returnObject;
			var user = getUser(token);
			window.location = "/";
		} else {
			createCookie('loginStatus', response.returnObject.message, 3000);
		}
}
</script>


<?php include('inc/end.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	
	<!-- Favicons -->
	<link rel="apple-touch-icon" sizes="57x57" href="https://www.securoserve.nl//img/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="https://www.securoserve.nl//img/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="https://www.securoserve.nl//img/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="https://www.securoserve.nl//img/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="https://www.securoserve.nl//img/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="https://www.securoserve.nl//img/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="https://www.securoserve.nl//img/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="https://www.securoserve.nl//img/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="https://www.securoserve.nl//img/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="https://www.securoserve.nl//img/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="https://www.securoserve.nl//img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="https://www.securoserve.nl//img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="https://www.securoserve.nl//img/favicon-16x16.png">
	<link rel="manifest" href="https://www.securoserve.nl//img/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="https://www.securoserve.nl//img/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<meta http-equiv="refresh" content="900">

    <title>SecuroServe -&nbsp;</title>
	
    <script src="https://www.securoserve.nl/js/request.js"></script>

    <!-- Material Design fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<!-- FontAwesome -->
	<link rel="stylesheet" href="https://www.securoserve.nl/css/font-awesome.min.css">

    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Material Design -->
    <link href="https://www.securoserve.nl/css/bootstrap-material-design.css" rel="stylesheet">
    <link href="https://www.securoserve.nl/css/ripples.min.css" rel="stylesheet">

    <!-- Dropdown.js -->
    <link href="//cdn.rawgit.com/FezVrasta/dropdown.js/master/jquery.dropdown.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<!-- Twitter Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="https://www.securoserve.nl/css/custom.css" rel="stylesheet">
	
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
            <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li><a href="/alert"><i class="fa fa-plus" aria-hidden="true"></i> Melding maken</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
<?php 
					$cookie_name = "token";
					if(!isset($_COOKIE[$cookie_name])) {
						echo '<li><a href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i> Inloggen</a></li>';
						echo '<li><a href="/register"><i class="fa fa-user-plus" aria-hidden="true"></i> Registreren</a></li>';
					} else {
						echo '<li><p class="navbar-text"><i class="fa fa-user" aria-hidden="true"></i> ' . $_COOKIE['username'] . '</p></li>';
						echo '<li><a href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Uitloggen</a></li>';
					}
?>

            <li><a href="/search"><i class="fa fa-search" aria-hidden="true"></i> Zoeken</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
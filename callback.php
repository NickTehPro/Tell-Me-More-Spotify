<?php
require_once 'Request.php';
require_once 'Session.php';
require_once 'SpotifyWebAPI.php';
require_once 'SpotifyWebAPIException.php';

$session = new SpotifyWebAPI\Session('CLIENTID', 'CLIENT_SECRET', 'https://example.com/callback.php');
$api = new SpotifyWebAPI\SpotifyWebAPI();

// Request a access token using the code from Spotify
$session->requestAccessToken($_GET['code']);
$accessToken = $session->getAccessToken();

// Set the access token on the API wrapper
$api->setAccessToken($accessToken);

// Start using the API!

// Get the dictionaries.
$adjectives = file('adjectives.txt');
$keyNr = array_rand($adjectives, 1);

//Get the data from from spotify.
$me = $api->me();

$tracks = $api->getMyTop('tracks', [
    'limit' => 1,
]);

?>
<html>
	<head>
		<title>Spotify Web Story Teller</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.html">Spotify Web Story Teller</a></h1>
					</header>

				<!-- Main -->
					<article id="main">
						<header>
							<h2>Your Story:</h2>
							<p> Hello, <?php echo $me->display_name; ?>. You're favorite track so far is <?php print $tracks->name; ?> and that tells me that you are </p>

						</header>
					</article>

				<!-- Footer -->
					<footer id="footer">
				
						<ul class="copyright">
							<li>&copy; NickTehPro</li><li> Support this awesome project on <a href="https://github.com/NickTehPro/Tell-Me-More-Spotify">Github</a></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
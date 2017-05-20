<?php
require_once 'Request.php';
require_once 'Session.php';
require_once 'SpotifyWebAPI.php';
require_once 'SpotifyWebAPIException.php';

$session = new SpotifyWebAPI\Session('CLIENTID', 'CLIENTSECRET', 'https://example.com/callback.php');


$scopes = array(
    'playlist-read-private',
    'user-read-private',
	'user-top-read',
	'user-read-birthdate',
	'user-library-read'
);

$authorizeUrl = $session->getAuthorizeUrl(array(
    'scope' => $scopes
));

header('Location: ' . $authorizeUrl);
die();
?>
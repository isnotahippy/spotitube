<?php
require('pusher.php'); // Pusher PHP Library

// Pusher API access
$pusher_key = "0b58d519bc309ee3e986";
$pusher_secret = "4939abde63fccb31d533";
$pusher_appID = "37610";

// Youtube endpoint
$youtube_endpoint = "https://gdata.youtube.com/feeds/api/videos";

// Pusher feed object
$pusher_feed = new Pusher($pusher_key, $pusher_secret, $pusher_appID);

// Check the request has provided track and artist strings
if(isset($_GET['track']) && isset($_GET['artist'])) {

	// Flags request json response, and exclude restricted videos, using API v2
	$flags = "&alt=json&safeSearch=strict&v=2&format=1,5"; 

	// Build Youtube API query, append flags to query string
	$query = "?q="
			 . urlencode($_GET['artist']) . '+'
			 . 	urlencode($_GET['track']) . "+video" . $flags;

	// Build and execute curl request
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $youtube_endpoint . $query);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($ch);
	curl_close($ch);

	// Get PHP object from json response
	$response_json = json_decode($response);

	// Pull video ID from response
	$video_url = preg_match(
		'/[^:]+$/', 
		$response_json->feed->entry[0]->id->{'$t'}, 
		$ids
	);

	// Send ID in push message 
	$pusher_feed->trigger('messages', 'test_message', $ids[0]);

	// Signal finish
	print 'DONE';
}


?>
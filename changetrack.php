<?php
require('pusher.php');

$feeder = new Pusher("0b58d519bc309ee3e986", "4939abde63fccb31d533", "37610");

if(isset($_GET['track']) && isset($_GET['artist'])) {

	$query = "?q=" . urlencode($_GET['artist']) . '+' . urlencode($_GET['track']) . "+video&alt=json&safeSearch=strict&v=2&format=1,5";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://gdata.youtube.com/feeds/api/videos' . $query);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($ch);
	curl_close($ch);

	$response_json = json_decode($response);

	$video_url = preg_match('/[^:]+$/', $response_json->feed->entry[0]->id->{'$t'}, $ids);
	print_r($response_json->feed->entry->{'yt$accessControl'});
	$feeder->trigger('messages', 'test_message', $ids[0]);
	print 'sent';
}

print 'done';


?>
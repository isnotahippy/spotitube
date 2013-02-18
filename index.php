<!doctype html>
<html>
<head>
	<title>Youtube player</title>

	<style>
		html, body, #player { margin: 0; width: 100%; height: 100%; }
	</style>

	<script src="js/jquery.js"></script>
	<script src="js/pusher.js"></script>
	<script>
		var feeder = new Pusher("0b58d519bc309ee3e986");
		var messages = feeder.subscribe('messages');

		messages.bind('test_message', function(data) {
			player.loadVideoById(data);
			player.mute();
		});
	</script>
</head>
<body>
	<div id="player"></div>
	<script>
	// Youtube iframe API JS

	// 2. This code loads the IFrame Player API code asynchronously.
	var tag = document.createElement('script');

	// This is a protocol-relative URL as described here:
	//     http://paulirish.com/2010/the-protocol-relative-url/
	// If you're testing a local page accessed via a file:/// URL, please set tag.src to
	//     "https://www.youtube.com/iframe_api" instead.
	tag.src = "//www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	// 3. This function creates an <iframe> (and YouTube player)
	//    after the API code downloads.
	var player;
	function onYouTubeIframeAPIReady() {
	player = new YT.Player('player', {
	  videoId: 'u1zgFlCw8Aw',
	  events: {
	    'onReady': onPlayerReady,
	    'onStateChange': onPlayerStateChange
	  }
	});
	}

	// 4. The API will call this function when the video player is ready.
	function onPlayerReady(event) {
	event.target.playVideo();
	}
    </script>
</body>
</html>
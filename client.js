var feeder = new Pusher("0b58d519bc309ee3e986");
var messages = feeder.subscribe('messages');

messages.bind('test_message', function(data) {
	player.loadVideoById(data);
	player.mute();
});

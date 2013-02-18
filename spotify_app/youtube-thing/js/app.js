var App = {}; // namespace for App functions/variables
App.player = null;

// URL that handles pusher
App.pusher = "http://somewhere.com/changetrack.php"; 

// Callback for Spotify change event
App.update = function(e) { 

	// GET Request to pusher url, send track and artist as strings
	$.ajax({
		url: App.pusher,
		data: { 
			"track": App.player.track.data.name, 
			"artist": App.player.track.data.artists[0].name 
		},
		success: function() {
			console.log('Pushed track');
		}
	});
} 

window.onload = function() {

	// Set up spotify API
    var sp = getSpotifyApi(1);
    var models = sp.require('$api/models');

    // Get the Spotify player
    App.player = models.player;

    // Set up listener/observer for spotify change (change tracks, positions etc)
    App.player.observe(models.EVENT.CHANGE, function(event) {
		App.update(event);
	});
}
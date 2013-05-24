Spotitube
=========

This is a quick mash up of Spotify and Youtube, using Pusher to transfer real time information 
between displays. Hopefully it's contents are useful to someone.


Spotify App
===========

In spotify-app/youtube-thing you will find a small spotify App, this binds a 
callback to the Spotify change event. Whenever the track changes an AJAX
request is made to the URL defined by App.pusher in spotify-app/youtube-thing/js/app.js.
The request simply sends the track name and artist in a GET request.

App.Pusher should point to the url for changerequest.php in the PHP app.

PHP App
===========

The PHP app can be found in php_app/, there are 2 main files, changetrack.php and index.php.

Changetrack.php

This recieves get requests from the Spotify App, uses the information to lookup the Youtube
videos feed and extracts a useful Youtube video ID. It then sends a push message containing
this ID through a Pusher channel.

Index.php

Responsible for displaying the Youtube videos. Listens to the Pusher channel and when a new 
video ID is recieved it switches the Youtube player to that video.

Setup
=====

If you want to set this up there are a few things you will have to do.

1. Move the contents of spotify_app/ to ~/Spotify (Or it's Windows equivilant)
2. Edit spotify_app/youtube-thing/js/app.js and change the value of App.pusher to the correct
url for changetrack.php
3. Edit spotify_app/youtube-thing/manifest.json and add the domain hosting changetrack.php to 
"RequiredPermission", you can use 127.0.0.1 but Youtube blocks a lot of videos locally.
4. Edit php_app/changetrack.php and change the configuration variables for Pusher, you can sign 
up for a free Pusher sandbox account, create an app and enter the details in this file.
5. Modify the Pusher API Key in index.php
5. In spotify search for spotify:app:youtube-thing, this should start the app
6. Navigate to index.php and start changing the tracks, videos should start playing...

Hope it works...

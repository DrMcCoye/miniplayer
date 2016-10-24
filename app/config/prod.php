<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => '127.0.0.1',
    'port'     => '3306',
    'dbname'   => 'miniplayer',
    'user'     => 'miniplayer_user',
    'password' => 'secret',
);

// define log level
$app['monolog.level'] = 'WARNING';

//****CLEFS API****

//**DEEZER**
//Minidiz
//http://192.168.1.16/minideezer/
//Application id : 186864
//Secret Key : ec2ff18214e1dff4b3722e60f3691d90

//**LASTFM**
//Application name 	Minidiz
//API key 	83f54fdc5926e2c0a0c8fdcd3bcc7ed6
//Shared secret 	988a130a253c19d98518eadc11bef8eb
//Registered to 	DrMcCoye2

//url: http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=c2c&api_key=83f54fdc5926e2c0a0c8fdcd3bcc7ed6&format=json
//Reponse.artist.image.#text : https://lastfm-img2.akamaized.net/i/u/300x300/13ae0a00eb054e99988a84a4476c2de6.png
//Reponse.artist.image.size : extralarge
//Reponse.artist.bio.content

//**SPOTIFY**
//Minidiz
//Client ID: 6108da2b4efa4a338e7cf3d23a8f31ff
//Client Secret : 0c4fc0917d7a4b8caa7220514f991737

//https://api.spotify.com/v1/search?q=c2c&type=artist
//reponse.artists.items[0].images[0].url
<?php

require_once __DIR__ . '/../core/Router.php'; // Router-Klasse einbinden

$router = new Router(); // Neue Router-Instanz erstellen

// Definieren der Routen und der zugehörigen Aktionen
$router->add('/', 'MovieController@index'); // Startseite
$router->add('/movies/create', 'MovieController@create'); // Seite zum Erstellen eines neuen Films
$router->add('/movies/store', 'MovieController@store'); // Route zum Speichern eines neuen Films
$router->add('/movies/edit/{id}', 'MovieController@edit'); // Seite zum Bearbeiten eines Films
$router->add('/movies/update/{id}', 'MovieController@update'); // Route zum Aktualisieren eines Films
$router->add('/movies/delete/{id}', 'MovieController@delete'); // Route zum Löschen eines Films
$router->add('/movies/show/{id}', 'MovieController@show'); // Seite mit den Details eines Films
$router->add('/reviews/create/{movie_id}', 'ReviewController@create'); // Route zum Erstellen einer Bewertung
$router->add('/reviews/edit/{id}', 'ReviewController@edit'); // Seite zum Bearbeiten einer Bewertung
$router->add('/reviews/update/{id}', 'ReviewController@update'); // Route zum Aktualisieren einer Bewertung
$router->add('/reviews/delete/{id}', 'ReviewController@delete'); // Route zum Löschen einer Bewertung

// Aktuelle URI aus dem Query-Parameter 'route' lesen, Standard ist die Startseite ('/')
$uri = isset($_GET['route']) ? $_GET['route'] : '/';

// Dispatcher aufrufen, um die Anfrage an die passende Route weiterzuleiten
$router->dispatch($uri);

<?php

require_once __DIR__ . '/../../core/Controller.php'; // Basis-Controller-Klasse einbinden
require_once __DIR__ . '/../models/Movie.php'; // Movie-Modell einbinden
require_once __DIR__ . '/../Models/Review.php'; // Review-Modell einbinden

class MovieController extends Controller {
    // Methode zum Anzeigen der Filmübersicht
    public function index() {
        // Suchanfrage aus URL holen, Standard ist leer
        $searchQuery = $_GET['search'] ?? ''; 
        // Sortierkriterium aus URL holen, Standard ist 'avg_rating'
        $sortBy = $_GET['sort_by'] ?? 'avg_rating'; 
        // Sortierreihenfolge aus URL holen, Standard ist 'DESC'
        $order = $_GET['order'] ?? 'DESC';         

        // Alle Filme aus der Datenbank holen, sortiert nach $sortBy und $order
        $movies = Movie::all($sortBy, $order);

        // Wenn eine Suchanfrage vorliegt, Filme filtern
        if (!empty($searchQuery)) {
            $movies = array_filter($movies, function ($movie) use ($searchQuery) {
                // Titel durchsuchen (Case-Insensitive)
                return isset($movie['title']) && is_string($movie['title']) && stripos($movie['title'], $searchQuery) !== false;
            });
        }

        // View rendern und gefilterte Filme übergeben
        return $this->render('movies/index', [
            'movies' => $movies,
            'searchQuery' => $searchQuery,
            'sortBy' => $sortBy,
            'order' => $order,
        ]);
    }

    // Methode zum Anzeigen des Formulars für einen neuen Film
    public function create() {
        $this->render('movies/create'); // View rendern
    }

    // Methode zum Speichern eines neuen Films
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Überprüfen, ob die Anfrage eine POST-Anfrage ist
            $title = $_POST['title'] ?? null; // Titel aus Anfrage holen
            $actors = $_POST['actors'] ?? null; // Schauspieler aus Anfrage holen
            $description = $_POST['description'] ?? null; // Beschreibung aus Anfrage holen

            if ($title && $actors) { // Prüfen, ob Titel und Schauspieler vorhanden sind
                // Neuen Film in der Datenbank speichern
                Movie::create([
                    'title' => $title,
                    'actors' => $actors,
                    'description' => $description,
                ]);

                // Zur Hauptseite weiterleiten
                header('Location: /movie-reviews/public/index.php?route=/');
                exit();
            } else {
                echo "Title and Actors are required!"; // Fehlermeldung bei fehlenden Feldern
            }
        } else {
            echo "Invalid request method."; // Fehlermeldung bei ungültiger Anfrage
        }
    }  

    // Methode zum Bearbeiten eines Films
    public function edit($id) {
        $movie = Movie::find($id); // Film anhand der ID suchen
        if (!$movie) {
            throw new Exception("Movie not found"); // Fehler werfen, wenn Film nicht gefunden wird
        }

        // Bearbeitungs-View rendern und Film übergeben
        $this->render('movies/edit', ['movie' => $movie]);
    }

    // Methode zum Aktualisieren eines Films
    public function update($id) {
        $movie = Movie::find($id); // Film anhand der ID suchen

        if (!$movie) { // Prüfen, ob der Film existiert
            echo "Movie not found.";
            exit;
        }

        // Aktualisierte Daten aus Anfrage holen
        $data = [
            'title' => $_POST['title'] ?? $movie->title,
            'actors' => $_POST['actors'] ?? $movie->actors,
            'description' => $_POST['description'] ?? $movie->description,
        ];

        // Film aktualisieren und zur Detailansicht weiterleiten
        if ($movie->update($data)) {
            header("Location: /movie-reviews/public/index.php?route=/movies/show/$id");
            exit;
        } else {
            echo "Failed to update the movie."; // Fehlermeldung bei fehlgeschlagenem Update
        }
    }

    // Methode zum Löschen eines Films
    public function delete($id) {
        $movie = Movie::find($id); // Film anhand der ID suchen
        if (!$movie) {
            throw new Exception("Movie not found"); // Fehler werfen, wenn Film nicht gefunden wird
        }

        // Film aus der Datenbank löschen
        $movie->delete();
        header('Location: /movie-reviews/public/index.php'); // Zurück zur Hauptseite leiten
        exit;
    }

    // Methode zum Anzeigen der Details eines Films
    public function show($id) {
        $movie = Movie::find($id); // Film anhand der ID suchen
        if (!$movie) {
            throw new Exception("Movie not found"); // Fehler werfen, wenn Film nicht gefunden wird
        }

        // Alle zugehörigen Rezensionen abrufen
        $reviews = Review::allByMovie($id);

        // Detail-View rendern und Film sowie Rezensionen übergeben
        $this->render('movies/show', [
            'movie' => $movie,
            'reviews' => $reviews,
        ]);
    }
}

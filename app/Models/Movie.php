<?php
date_default_timezone_set('Europe/Berlin'); // Zeitzone auf Europa/Berlin setzen
require_once __DIR__ . '/../../core/Database.php'; // Datenbank-Klasse einbinden

class Movie {
    protected static $table = 'movies'; // Name der zugehörigen Tabelle

    // Eigenschaften der Movie-Klasse
    public $id;
    public $title;
    public $actors;
    public $description;
    public $created_at;
    public $updated_at;

    // Methode zum Erstellen eines neuen Films
    public static function create($data) {
        $db = Database::connect(); // Verbindung zur Datenbank herstellen
        $sql = "INSERT INTO " . static::$table . " (title, actors, description, created_at) 
                VALUES (:title, :actors, :description, :created_at)"; // SQL-Befehl zum Einfügen eines neuen Films
        $stmt = $db->prepare($sql); // SQL-Anweisung vorbereiten
        $stmt->execute([
            ':title' => $data['title'], // Titel binden
            ':actors' => $data['actors'], // Schauspieler binden
            ':description' => $data['description'], // Beschreibung binden
            ':created_at' => date('Y-m-d H:i:s'), // Aktuellen Zeitstempel binden
        ]);
    }    

    // Methode zum Abrufen aller Filme, optional sortiert
    public static function all($sortBy = 'average_rating', $order = 'DESC') {
        $db = Database::connect(); // Verbindung zur Datenbank herstellen
    
        // Erlaubte Sortier- und Reihenfolge-Werte
        $allowedSortBy = ['average_rating', 'title', 'created_at'];
        $allowedOrder = ['ASC', 'DESC'];
    
        // Überprüfen, ob Sortier- und Reihenfolge-Werte gültig sind
        $sortBy = in_array($sortBy, $allowedSortBy) ? $sortBy : 'average_rating';
        $order = in_array($order, $allowedOrder) ? $order : 'DESC';
    
        // SQL-Abfrage: Filme und durchschnittliche Bewertung abrufen, sortiert nach den angegebenen Kriterien
        $sql = "
            SELECT movies.*, 
                   COALESCE(AVG(reviews.stars), 0) AS average_rating
            FROM movies
            LEFT JOIN reviews ON movies.id = reviews.movie_id
            GROUP BY movies.id
            ORDER BY $sortBy $order
        ";
    
        $stmt = $db->query($sql); // Abfrage ausführen
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Ergebnisse als assoziatives Array zurückgeben
    }
    

    // Methode zum Finden eines Films anhand der ID
    public static function find($id) {
        $db = Database::connect(); // Verbindung zur Datenbank herstellen
        $stmt = $db->prepare('SELECT * FROM movies WHERE id = :id'); // SQL-Abfrage vorbereiten
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ID binden
        $stmt->execute(); // Abfrage ausführen
        $movieData = $stmt->fetch(PDO::FETCH_ASSOC); // Ergebnis abrufen
    
        if (!$movieData) {
            return null; // Wenn kein Film gefunden wurde, null zurückgeben
        }
    
        // Neues Movie-Objekt erstellen und Felder setzen
        $movie = new self();
        $movie->id = $movieData['id'];
        $movie->title = $movieData['title'];
        $movie->actors = $movieData['actors'];
        $movie->description = $movieData['description'];
        $movie->created_at = $movieData['created_at'];
        $movie->updated_at = $movieData['updated_at'];
    
        return $movie; // Movie-Objekt zurückgeben
    }  
    
    // Methode zum Aktualisieren eines Films
    public function update($data) {
        $db = Database::connect(); // Verbindung zur Datenbank herstellen
        $sql = 'UPDATE movies 
                SET title = :title, 
                    actors = :actors, 
                    description = :description, 
                    updated_at = :updated_at
                WHERE id = :id'; // SQL-Befehl zum Aktualisieren eines Films
        $stmt = $db->prepare($sql); // SQL-Anweisung vorbereiten
        $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR); // Titel binden
        $stmt->bindParam(':actors', $data['actors'], PDO::PARAM_STR); // Schauspieler binden
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR); // Beschreibung binden
        $stmt->bindParam(':updated_at', $updatedAt, PDO::PARAM_STR); // Aktualisierungszeit binden
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT); // ID binden
    
        // Setze den aktuellen Zeitstempel
        $updatedAt = date('Y-m-d H:i:s');
        
        return $stmt->execute(); // SQL-Befehl ausführen
    }
    
    // Methode zum Löschen eines Films
    public function delete() {
        $db = Database::connect(); // Verbindung zur Datenbank herstellen
        $stmt = $db->prepare('DELETE FROM movies WHERE id = :id'); // SQL-Befehl zum Löschen eines Films
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT); // ID binden
        return $stmt->execute(); // SQL-Befehl ausführen
    }    
}

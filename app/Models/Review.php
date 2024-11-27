<?php
date_default_timezone_set('Europe/Berlin'); // Zeitzone auf Europa/Berlin setzen
require_once __DIR__ . '/../../core/Database.php'; // Datenbank-Klasse einbinden

class Review {
    protected $table = 'reviews'; // Name der zugehörigen Tabelle

    // Eigenschaften der Review-Klasse
    public $id;
    public $content;
    public $movie_id;
    public $created_at;
    public $updated_at;

    // Methode zum Abrufen aller Rezensionen zu einem Film
    public static function allByMovie($movie_id) {
        $db = Database::connect(); // Verbindung zur Datenbank herstellen
        $stmt = $db->prepare('SELECT * FROM reviews WHERE movie_id = :movie_id ORDER BY created_at DESC'); // SQL-Abfrage vorbereiten
        $stmt->bindParam(':movie_id', $movie_id, PDO::PARAM_INT); // Film-ID binden
        $stmt->execute(); // Abfrage ausführen
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: []; // Ergebnisse als Array zurückgeben oder leeres Array
    }   

    // Methode zum Erstellen einer neuen Rezension
    public static function create($movie_id, $stars, $review_text) {
        $db = Database::connect(); // Verbindung zur Datenbank herstellen
        $stmt = $db->prepare('INSERT INTO reviews (movie_id, stars, review_text) VALUES (:movie_id, :stars, :review_text)'); // SQL-Befehl vorbereiten
        $stmt->bindParam(':movie_id', $movie_id, PDO::PARAM_INT); // Film-ID binden
        $stmt->bindParam(':stars', $stars, PDO::PARAM_INT); // Sternebewertung binden
        $stmt->bindParam(':review_text', $review_text, PDO::PARAM_STR); // Rezensionstext binden
        return $stmt->execute(); // SQL-Befehl ausführen
    }

    // Methode zum Aktualisieren einer Rezension
    public static function update($id, $stars, $review_text) {
        $db = Database::connect(); // Verbindung zur Datenbank herstellen
        $stmt = $db->prepare('
            UPDATE reviews 
            SET stars = :stars, 
                review_text = :review_text, 
                updated_at = :updated_at 
            WHERE id = :id
        '); // SQL-Befehl vorbereiten, um die Rezension zu aktualisieren

        $currentTimestamp = date('Y-m-d H:i:s'); // Aktuellen Zeitstempel setzen
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Rezension-ID binden
        $stmt->bindParam(':stars', $stars, PDO::PARAM_INT); // Sternebewertung binden
        $stmt->bindParam(':review_text', $review_text, PDO::PARAM_STR); // Rezensionstext binden
        $stmt->bindParam(':updated_at', $currentTimestamp, PDO::PARAM_STR); // Aktualisierungszeit binden
        
        return $stmt->execute(); // SQL-Befehl ausführen
    }

    // Methode zum Löschen einer Rezension
    public static function delete($id) {
        $db = Database::connect(); // Verbindung zur Datenbank herstellen
        $stmt = $db->prepare('DELETE FROM reviews WHERE id = :id'); // SQL-Befehl vorbereiten
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Rezension-ID binden
        return $stmt->execute(); // SQL-Befehl ausführen
    }

    // Methode zum Finden einer Rezension anhand der ID
    public static function find($id) {
        $db = Database::connect(); // Verbindung zur Datenbank herstellen
        $stmt = $db->prepare('SELECT * FROM reviews WHERE id = :id'); // SQL-Abfrage vorbereiten
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Rezension-ID binden
        $stmt->execute(); // Abfrage ausführen
        return $stmt->fetch(PDO::FETCH_ASSOC); // Rezension als assoziatives Array zurückgeben
    }
}

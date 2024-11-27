<?php

require_once __DIR__ . '/../Models/Review.php'; // Review-Modell einbinden

class ReviewController {
    // Methode zum Erstellen einer neuen Rezension
    public function create($movie_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Überprüfen, ob die Anfrage eine POST-Anfrage ist
            $stars = $_POST['stars'] ?? null; // Bewertung aus Anfrage holen
            $review_text = $_POST['review_text'] ?? null; // Rezensionstext aus Anfrage holen

            if ($stars && $review_text) { // Überprüfen, ob beide Felder ausgefüllt sind
                // Neue Rezension erstellen und speichern
                Review::create($movie_id, $stars, $review_text);
                // Zurück zur Detailseite des Films weiterleiten
                header("Location: /movie-reviews/public/index.php?route=/movies/show/$movie_id");
                exit;
            }
        }
    }    

    // Methode zum Bearbeiten einer Rezension
    public function edit($id) {
        $review = Review::find($id); // Rezension anhand der ID suchen
        if (!$review) {
            throw new Exception("Review not found"); // Fehler werfen, wenn Rezension nicht gefunden wird
        }

        // Bearbeitungs-View einbinden
        require_once __DIR__ . '/../Views/reviews/edit.php';
    }    

    // Methode zum Aktualisieren einer Rezension
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Überprüfen, ob die Anfrage eine POST-Anfrage ist
            $stars = $_POST['stars'] ?? null; // Bewertung aus Anfrage holen
            $review_text = $_POST['review_text'] ?? null; // Rezensionstext aus Anfrage holen
            $review = Review::find($id); // Rezension anhand der ID suchen

            if ($stars && $review_text && $review) { // Prüfen, ob die Felder ausgefüllt sind und die Rezension existiert
                // Rezension aktualisieren
                $review['stars'] = $stars;
                $review['review_text'] = $review_text;
                $review['updated_at'] = date('Y-m-d H:i:s'); // Aktualisierungszeit setzen

                // Änderungen in der Datenbank speichern
                Review::update($id, $stars, $review_text, $review['updated_at']);

                // Zurück zur Detailseite des zugehörigen Films weiterleiten
                header("Location: /movie-reviews/public/index.php?route=/movies/show/{$review['movie_id']}");
                exit;
            }
        }
    }

    // Methode zum Löschen einer Rezension
    public function delete($id) {
        $review = Review::find($id); // Rezension anhand der ID suchen
        if ($review) {
            // Rezension aus der Datenbank löschen
            Review::delete($id);
        }

        // Zurück zur Detailseite des zugehörigen Films weiterleiten
        header("Location: /movie-reviews/public/index.php?route=/movies/show/{$review['movie_id']}");
        exit;
    }    
}

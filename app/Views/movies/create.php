<?php ob_start(); // Output-Buffering starten, um den Inhalt in einer Variablen zu speichern ?>
<div class="movie-create-box">
    <h1>Füge einen neuen Film hinzu</h1>
    <form method="POST" action="/movie-reviews/public/index.php?route=/movies/store" class="movie-form">
        <!-- Eingabefeld für den Titel des Films -->
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" class="form-input" required>

        <!-- Eingabefeld für die Schauspieler des Films -->
        <label for="actors">Schauspieler:</label>
        <textarea id="actors" name="actors" class="form-input" required></textarea>

        <!-- Eingabefeld für die Beschreibung des Films -->
        <label for="description">Beschreibung:</label>
        <textarea id="description" name="description" class="form-input"></textarea>

        <!-- Button zum Absenden des Formulars -->
        <button type="submit" class="btn btn-submit">Speichern</button>
    </form>
</div>
<?php 
$content = ob_get_clean(); // Puffer leeren und Inhalt in der Variable $content speichern
?>
<?php include __DIR__ . '/../layout.php'; // Hauptlayout einbinden, das $content verwendet ?>

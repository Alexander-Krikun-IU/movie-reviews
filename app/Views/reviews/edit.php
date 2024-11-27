<?php ob_start(); // Output-Buffering starten, um den Inhalt in einer Variablen zu speichern ?>
<h1>Bearbeite deine Bewertung</h1>

<!-- Formular zum Bearbeiten einer Bewertung -->
<form action="/movie-reviews/public/index.php?route=/reviews/update/<?= $review['id'] ?>" method="POST" class="review-form">
    <!-- Dropdown für die Auswahl der Sternebewertung -->
    <label for="stars">Sterne (1-5):</label>
    <select id="stars" name="stars" class="form-input" required>
        <?php for ($i = 1; $i <= 5; $i++): // Generiere Optionen für die Sternebewertung ?>
            <option value="<?= $i ?>" <?= $i == $review['stars'] ? 'selected' : '' ?>><?= $i ?></option>
        <?php endfor; ?>
    </select>

    <!-- Eingabefeld für den Bewertungstext -->
    <label for="review_text">Bewertungstext:</label>
    <textarea id="review_text" name="review_text" class="form-input" required><?= htmlspecialchars($review['review_text']) ?></textarea>

    <!-- Button zum Speichern der Änderungen -->
    <button type="submit" class="btn btn-submit">Änderungen speichern</button>
</form>

<!-- Link zurück zur Filmliste -->
<a href="/movie-reviews/public/index.php" class="btn btn-back">Zurück zur Filmliste</a>

<?php 
$content = ob_get_clean(); // Puffer leeren und Inhalt in der Variable $content speichern
?>
<?php include __DIR__ . '/../layout.php'; // Hauptlayout einbinden, das $content verwendet ?>

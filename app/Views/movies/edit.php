<?php ob_start(); // Output-Buffering starten, um den Inhalt in einer Variablen zu speichern ?>
<h1>Bearbeite einen Film</h1>
<?php if ($movie): // Überprüfen, ob der Film existiert ?>
    <form action="/movie-reviews/public/index.php?route=/movies/update/<?= $movie->id ?>" method="POST" class="movie-form">
        <!-- Eingabefeld für den Titel des Films -->
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" class="form-input" 
               value="<?= htmlspecialchars($movie->title ?? '') ?>" required>

        <!-- Eingabefeld für die Darsteller des Films -->
        <label for="actors">Darsteller:</label>
        <input type="text" id="actors" name="actors" class="form-input" 
               value="<?= htmlspecialchars($movie->actors ?? '') ?>" required>

        <!-- Eingabefeld für die Beschreibung des Films -->
        <label for="description">Beschreibung:</label>
        <textarea id="description" name="description" class="form-input"><?= htmlspecialchars($movie->description ?? '') ?></textarea>

        <!-- Button zum Speichern der Änderungen -->
        <button type="submit" class="btn btn-submit">Änderungen speichern</button>
    </form>
<?php else: // Wenn der Film nicht gefunden wurde ?>
    <p>Film nicht gefunden.</p>
<?php endif; ?>
<!-- Link zurück zur Filmliste -->
<a href="/movie-reviews/public/index.php" class="btn btn-back">Zurück zur Filmliste</a>
<?php 
$content = ob_get_clean(); // Puffer leeren und Inhalt in der Variable $content speichern
?>
<?php include __DIR__ . '/../layout.php'; // Hauptlayout einbinden, das $content verwendet ?>
<?php ob_start(); // Output-Buffering starten, um den Inhalt in einer Variablen zu speichern ?>
<div class="movie-details-box">
    <!-- Titel des Films anzeigen -->
    <h1><?= htmlspecialchars($movie->title) ?></h1>

    <div class="movie-details">
        <!-- Darsteller anzeigen -->
        <p><strong>Darsteller:</strong> <?= htmlspecialchars($movie->actors) ?></p>
        <!-- Beschreibung des Films anzeigen -->
        <p><strong>Beschreibung:</strong> <?= htmlspecialchars($movie->description) ?></p>
        <!-- Erstellungsdatum des Films anzeigen -->
        <p><strong>Erstellt am:</strong> <?= (new DateTime($movie->created_at))->format('Y-m-d H:i:s') ?></p>
        <?php 
            // Prüfen, ob der Film bearbeitet wurde, und das Bearbeitungsdatum anzeigen
            $createdAt = (new DateTime($movie->created_at))->format('Y-m-d H:i:s');
            $updatedAt = (new DateTime($movie->updated_at))->format('Y-m-d H:i:s');
            if ($updatedAt !== $createdAt): 
        ?>
            <p><strong>Bearbeitet am:</strong> <?= (new DateTime($movie->updated_at))->format('Y-m-d H:i:s') ?></p>
        <?php endif; ?>
    </div>

    <!-- Aktionen für den Film -->
    <div class="movie-actions">
        <!-- Bearbeiten-Button -->
        <a href="/movie-reviews/public/index.php?route=/movies/edit/<?= $movie->id ?>" class="btn">Bearbeiten</a>
        <!-- Löschen-Button mit Bestätigungsdialog -->
        <a href="/movie-reviews/public/index.php?route=/movies/delete/<?= $movie->id ?>" 
           class="btn btn-danger" 
           onclick="return confirm('Sind Sie sicher, dass Sie diesen Film löschen möchten?');">Löschen</a>
    </div>
</div>

<!-- Rezensionen anzeigen -->
<?php include __DIR__ . '/../../Views/reviews/show.php'; ?>
<!-- Formular zum Erstellen einer neuen Rezension -->
<?php include __DIR__ . '/../../Views/reviews/create.php'; ?>
<!-- Link zurück zur Filmliste -->
<a href="/movie-reviews/public/index.php" class="btn">Zurück zur Filmliste</a>
<?php 
$content = ob_get_clean(); // Puffer leeren und Inhalt in der Variable $content speichern
?>
<?php include __DIR__ . '/../layout.php'; // Hauptlayout einbinden, das $content verwendet ?>

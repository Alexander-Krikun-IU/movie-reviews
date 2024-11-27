<?php ob_start(); // Output-Buffering starten, um den Inhalt in einer Variablen zu speichern ?>

<div class="">
    <h1>Filme</h1>

    <!-- Suchleiste -->
    <div class="search-bar">
        <form method="GET" action="/movie-reviews/public/index.php">
            <!-- Suchfeld für Filme -->
            <input type="text" name="search" class="search-input" placeholder="Suche nach einem Film..." 
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button type="submit" class="btn btn-search">Suchen</button>
        </form>
    </div>

    <!-- Sortierungsoptionen -->
    <div class="sorting-options">
        <form method="GET" action="index.php" class="sort-form">
            <!-- Sortieren nach Feld -->
            <div class="form-group me-3">
                <label for="sort_by" class="form-label">Sortieren nach:</label>
                <select name="sort_by" id="sort_by" class="form-select rounded" onchange="document.getElementById('sortForm').submit()">
                    <option value="average_rating" <?= ($sortBy === 'average_rating') ? 'selected' : '' ?>>Bewertung</option>
                    <option value="title" <?= ($sortBy === 'title') ? 'selected' : '' ?>>Titel</option>
                    <option value="created_at" <?= ($sortBy === 'created_at') ? 'selected' : '' ?>>Hinzugefügt am</option>
                </select>
            </div>
            <!-- Reihenfolge auswählen -->
            <div class="form-group me-3">
                <label for="order" class="form-label">Reihenfolge:</label>
                <select name="order" id="order" class="form-select rounded" onchange="document.getElementById('sortForm').submit()">
                    <option value="DESC" <?= ($order === 'DESC') ? 'selected' : '' ?>>Absteigend</option>
                    <option value="ASC" <?= ($order === 'ASC') ? 'selected' : '' ?>>Aufsteigend</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary rounded">Anwenden</button>
        </form>
    </div>

    <!-- Filmübersicht -->
    <div class="movie-grid">
        <?php if (!empty($movies) && is_array($movies)): // Überprüfen, ob Filme vorhanden sind ?>
            <?php foreach ($movies as $movie): // Durch die Liste der Filme iterieren ?>
                <div class="movie-card">
                    <!-- Link zu den Filmdetails -->
                    <a href="/movie-reviews/public/index.php?route=/movies/show/<?= $movie['id'] ?>" class="btn-card">
                        <div class="card-header">
                            <h3><?= htmlspecialchars($movie['title']) ?></h3> <!-- Filmname anzeigen -->
                            <div class="rating-circle">
                                <?php 
                                // Durchschnittliche Bewertung anzeigen oder "N/A", wenn keine Bewertung existiert
                                if (!empty($movie['average_rating'])) {
                                    echo number_format($movie['average_rating'], 1);
                                } else {
                                    echo 'N/A';
                                }
                                ?>
                            </div>
                        </div>
                        <p>Mehr Details</p>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: // Wenn keine Filme gefunden wurden ?>
            <p>Kein Film gefunden der deinen Suchanforderungen entspricht</p>
        <?php endif; ?>

        <!-- Karte zum Hinzufügen eines neuen Films -->
        <div class="movie-card add-movie-card">
            <a href="/movie-reviews/public/index.php?route=/movies/create">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>
</div>
<?php 
$content = ob_get_clean(); // Puffer leeren und Inhalt in der Variable $content speichern
?>
<?php include __DIR__ . '/../layout.php'; // Hauptlayout einbinden, das $content verwendet ?>

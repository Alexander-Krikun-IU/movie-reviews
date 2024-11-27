<hr>
<div class="reviews-box">
    <!-- Überschrift für den Bewertungsbereich -->
    <h2>Bewertungen</h2>
    <ul class="reviews">
        <?php if (!empty($reviews)): // Überprüfen, ob Bewertungen vorhanden sind ?>
            <?php foreach ($reviews as $review): // Durch die Liste der Bewertungen iterieren ?>
                <br>
                <li>
                    <div class="review">
                        <!-- Sternebewertung anzeigen -->
                        <strong>Sterne:</strong> <?= htmlspecialchars($review['stars']) ?>/5<br>
                        <!-- Bewertungstext anzeigen -->
                        <p><?= htmlspecialchars($review['review_text']) ?></p>
                        <!-- Erstellungs- und ggf. Bearbeitungsdatum anzeigen -->
                        <small>
                            Geschrieben am: <?= date('Y-m-d H:i:s', strtotime($review['created_at'])) ?>
                            <?php if ($review['updated_at'] !== $review['created_at']): // Prüfen, ob die Bewertung bearbeitet wurde ?>
                                (Bearbeitet am: <?= date('Y-m-d H:i:s', strtotime($review['updated_at'])) ?>)
                            <?php endif; ?>
                        </small>
                        <div class="review-actions">
                            <!-- Bearbeiten-Button -->
                            <a href="/movie-reviews/public/index.php?route=/reviews/edit/<?= $review['id'] ?>" class="btn">Bearbeiten</a>
                            <!-- Löschen-Button mit Bestätigungsdialog -->
                            <a href="/movie-reviews/public/index.php?route=/reviews/delete/<?= $review['id'] ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Sind Sie sicher, dass Sie diese Bewertung löschen möchten?');">Löschen</a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php else: // Wenn keine Bewertungen vorhanden sind ?>
            <li>Noch keine Bewertungen</li>
        <?php endif; ?>
    </ul>
</div>

<hr>
<div class="create-rating-box">
    <!-- Überschrift für das Hinzufügen einer neuen Bewertung -->
    <h3>Füge eine neue Bewertung hinzu</h3>
    
    <!-- Formular zum Erstellen einer neuen Bewertung -->
    <form action="/movie-reviews/public/index.php?route=/reviews/create/<?= $movie->id ?>" method="POST" class="review-form">
        <div class="rating">
            <!-- Dropdown für die Auswahl der Bewertung (1-5) -->
            <label for="stars">Bewertung (1-5):</label>
            <select id="stars" name="stars" required>
                <?php for ($i = 1; $i <= 5; $i++): // Bewertung von 1 bis 5 generieren ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div> 
        <br>
        
        <!-- Eingabefeld für den Kommentar -->
        <label for="review_text">Kommentar:</label>
        <textarea id="review_text" name="review_text" required></textarea>
        <br>
        
        <!-- Button zum Absenden der Bewertung -->
        <button type="submit" class="btn">Veröffentlichen</button>
    </form>
</div>

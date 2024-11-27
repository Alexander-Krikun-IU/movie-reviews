<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Zeichencodierung setzen -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsives Design ermöglichen -->
    <title>Film Bewertungen</title> <!-- Titel der Seite -->
    
    <!-- Google Fonts einbinden -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons einbinden -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Eigene CSS-Datei einbinden -->
    <link rel="stylesheet" href="/movie-reviews/public/css/styles.css">
</head>
<body class="layout mobile-wrapper"> <!-- Hauptlayout-Klasse für die Seite -->
    <header>
        <nav>
            <!-- Navigation mit Links -->
            <ul>
                <!-- Link zur Startseite mit Haus-Icon -->
                <li><a href="/movie-reviews/public/index.php?route=/"><i class="fa-solid fa-house"></i></a></li>
                <!-- Link zum Erstellen eines neuen Films mit Plus-Icon -->
                <li><a href="/movie-reviews/public/index.php?route=/movies/create"><i class="fas fa-plus"></i></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Dynamischer Inhalt der Seite -->
        <?= $content ?? '' ?>
    </main>
</body>
</html>

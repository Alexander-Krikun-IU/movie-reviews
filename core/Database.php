<?php

class Database {
    // Statische Eigenschaft für die PDO-Verbindung
    private static $pdo;

    /**
     * Stellt eine Verbindung zur Datenbank her und gibt die PDO-Instanz zurück.
     *
     * @return PDO Die Datenbankverbindung.
     */
    public static function connect() {
        // Prüfen, ob die Verbindung bereits besteht
        if (!self::$pdo) {
            // Umgebungsvariablen aus einer .env-Datei laden
            $env = parse_ini_file(__DIR__ . '/../.env');
            
            // Datenbank-DSN (Data Source Name) erstellen
            $dsn = "pgsql:host={$env['DB_HOST']};dbname={$env['DB_NAME']}";
            try {
                // Neue PDO-Instanz erstellen und mit den Umgebungsvariablen verbinden
                self::$pdo = new PDO($dsn, $env['DB_USER'], $env['DB_PASS']);
                
                // PDO-Fehlermodus auf Exceptions setzen
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Fehler beim Verbindungsaufbau behandeln
                die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
            }
        }
        // Verbindung zurückgeben
        return self::$pdo;
    }
}

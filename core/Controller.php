<?php

class Controller {
    /**
     * Rendert eine View-Datei und übergibt Daten an diese.
     *
     * @param string $view Der Name der View-Datei (ohne .php-Erweiterung).
     * @param array $data Ein assoziatives Array von Daten, die in der View verfügbar gemacht werden.
     */
    public function render($view, $data = []) {
        extract($data); // Wandelt das assoziative Array $data in einzelne Variablen um
        require __DIR__ . '/../app/views/' . $view . '.php'; // Bindet die View-Datei ein
    }
}

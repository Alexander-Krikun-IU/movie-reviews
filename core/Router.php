<?php

class Router {
    // Array zur Speicherung der Routen und ihrer zugehörigen Aktionen
    private $routes = [];

    /**
     * Fügt eine neue Route und die zugehörige Aktion hinzu.
     *
     * @param string $route Die Route, z. B. '/movies/{id}'.
     * @param string $action Die Aktion im Format 'Controller@Methode'.
     */
    public function add($route, $action) {
        $this->routes[$route] = $action;
    }

    /**
     * Übernimmt die Verarbeitung einer Anfrage-URI und leitet sie an die passende Aktion weiter.
     *
     * @param string $uri Die aktuelle Anfrage-URI.
     */
    public function dispatch($uri) {
        foreach ($this->routes as $route => $action) {
            // Platzhalter (z. B. {id}) durch reguläre Ausdrücke ersetzen
            $routePattern = preg_replace('/\{[a-z_]+\}/', '(\d+)', $route);
            $routePattern = '#^' . $routePattern . '$#';

            // Prüfen, ob die URI mit der aktuellen Route übereinstimmt
            if (preg_match($routePattern, $uri, $matches)) {
                array_shift($matches); // Das erste Element ($matches[0]) entfernen, da es die gesamte Übereinstimmung enthält
                [$controller, $method] = explode('@', $action); // Controller und Methode aus der Aktion extrahieren

                // Controller-Datei einbinden
                require_once __DIR__ . '/../app/controllers/' . $controller . '.php';

                // Controller-Instanz erstellen und Methode aufrufen
                $controllerInstance = new $controller();
                return call_user_func_array([$controllerInstance, $method], $matches); // Argumente an die Methode übergeben
            }
        }

        // Wenn keine Route übereinstimmt, 404-Fehler ausgeben
        http_response_code(404);
        echo "404 - Page Not Found";
    }
}

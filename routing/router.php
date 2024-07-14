<?php

class Router {

    protected $routes = [];

    /* -------------
    Metodi di aggiunta delle routes, ognuno con un determinato metodo HTTP
    --------------*/

    // Aggiunge una Route all'array Routes
    private function addRoute($uri, $controller, $method) {
        // Accoda l'array appena creato nell'array routes
        array_push($this->routes, [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
        ]);
    }

    public function get($uri, $controller) {
        $this->addRoute($uri, $controller, 'GET');
    }

    public function post($uri, $controller) {
        $this->addRoute($uri, $controller, 'POST');
    }

    public function delete($uri, $controller) {
        $this->addRoute($uri, $controller, 'DELETE');
    }

    public function update($uri, $controller) {
        $this->addRoute($uri, $controller, 'UPDATE');
    }

    public function route($uri, $method) {
        foreach ($this->routes as $route) {
            if ($uri === $route["uri"] && strtoupper($method) === $route["method"]) {
                return require $_SERVER['DOCUMENT_ROOT'] . $route["controller"];
            }
        }

        $this->abort();
    }

    // Risponde con un codice di errore alla richiesta (default: 404)
    protected function abort($code = 404) {
        http_response_code($code);

        include_once $_SERVER['DOCUMENT_ROOT'] . ("/views/dashboard/{$code}.php");

        die();
    }

}

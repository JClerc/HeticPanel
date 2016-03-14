<?php

class Router {

    private $request = [];

    public function parse($route) {

        // Remove leading slash
        $route = ltrim(urldecode($route), '/');

        // If app is in folder, remove from route
        if (strlen(ROOT) and strpos($route, ROOT) === 0) {
            $route = substr($route, strlen(ROOT));
        }

        // If we have GET: ?key=value
        if (strlen($_SERVER['QUERY_STRING'])) {
            // Remove length of query string + "?"
            $route = substr($route, 0, -strlen($_SERVER['QUERY_STRING']) - 1);
        }

        // Remove trailing slash
        $route = rtrim($route, '/');

        // Get request parts of URL
        $request = explode('/', $route);

        // Define default request 
        if (empty($request[0])) $request[0] = 'index';
        if (empty($request[1])) $request[1] = 'index';

        // If request is not alpha, go to error
        if (!ctype_alnum($request[0]) or !ctype_alnum($request[1])) {
            $request = ['error', '404'];
        }

        // Save request to object variable
        $this->setRequest($request);

    }

    public function setRequest($request) {
        return $this->request = $request;
    }

    public function getRequest() {
        return $this->request;
    }

    public function go($path = null, $queryString = null) {
        // Header location
        $location = 'Location: ' . HTTP_ROOT;

        // Add path to location
        if (!empty($path)) $location .= trim($path, '/') . '/';

        // Add query string if any
        if (!empty($queryString)) $location .= $queryString;

        // And redirect
        header($location);

        // Stop current script
        exit;
    }

}

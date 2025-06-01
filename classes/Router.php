<?php

namespace classes;

use controllers\ErrorController;

class Router
{
    private $uri = [];

    public function __construct() {}

    public function route()
    {
        $this->filterRequest();

        $controllerName = $this->getController();
        $methodName     = $this->getMethod();
        $params         = $this->getParams();

        if (!class_exists($controllerName)) {
            $this->handleNotFound();
            return;
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $methodName)) {
            $this->handleMethodNotExists();
            return;
        }

        call_user_func_array([$controller, $methodName], $params);
    }

    private function filterRequest()
    {
        $petition = filter_input(INPUT_GET, 'uri', FILTER_SANITIZE_URL);
        if ($petition) {
            $petition = rtrim($petition, '/');
            $this->uri = explode('/', $petition);
        }
    }

    private function getController()
    {
        $defaultController = 'Home';

        $folder = $this->uri[0] ?? null;
        $controller = $this->uri[1] ?? $defaultController;

        if ($folder && $controller && is_dir(CONTROLLERS . $folder)) {
            unset($this->uri[0], $this->uri[1]);
            return 'controllers\\' . $folder . '\\' . ucfirst($controller) . 'Controller';
        }

        $controller = $folder ?? $defaultController;
        unset($this->uri[0]);
        return 'controllers\\' . ucfirst($controller) . 'Controller';
    }

    private function getMethod()
    {
        $defaultMethod = 'index';

        $method = $this->uri[2] ?? $defaultMethod;
        unset($this->uri[2]);

        return $method;
    }

    private function getParams()
    {
        return array_values($this->uri);
    }

    private function handleNotFound()
    {
        $error = new ErrorController();
        $error->notFound();
    }

    private function handleMethodNotExists()
    {
        $error = new ErrorController();
        $error->methodNotExists();
    }
}

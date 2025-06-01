<?php

namespace classes;

class View {
    public function __construct() {}

    public static function render($view, $data = []) 
    {
        extract($data);

        // Ruta a la vista
        $viewPath = dirname(__DIR__) . '/resources/views/' . $view . '.view.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "<h3>Error: La vista <code>$view</code> no fue encontrada.</h3>";
        }
    }
}

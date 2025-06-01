<?php
namespace classes;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    private static function autoload($class)
    {
        // Reemplazar \ por separador de directorio y agregar ROOT
        $file = ROOT . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

        if (file_exists($file)) {
            require_once $file;
            return true;
        } else {
            error_log("Clase no encontrada: $class en $file");
            return false;
        }
    }
}

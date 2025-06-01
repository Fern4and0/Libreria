<?php
namespace controllers;

use models\Libro;

class LibroController
{
    private $model;

    public function __construct()
    {
        // NO necesitas pasar $db porque en el modelo ya se conecta solo.
        $this->model = new Libro();
    }

    public function index()
    {
        $libros = $this->model->obtenerTodos();
        require VIEWS . 'home.view.php';
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'titulo' => $_POST['titulo'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'autor_id' => $_POST['autor_id'] ?? 0,
                'genero_id' => $_POST['genero_id'] ?? 0,
                'disponibilidad' => $_POST['disponibilidad'] ?? 'sala',
                'imagen_url' => $_POST['imagen_url'] ?? ''
            ];
            $this->model->crear($datos);
            header('Location: ?uri=Libro/index');
            exit;
        }

        // Si quieres, agrega métodos para traer autores y géneros aquí
        // Por ejemplo: $autores = $this->model->obtenerAutores(); 
        // Si no los tienes implementados, quita esas líneas.

        require VIEWS . 'home.view.php';
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'titulo' => $_POST['titulo'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'autor_id' => $_POST['autor_id'] ?? 0,
                'genero_id' => $_POST['genero_id'] ?? 0,
                'disponibilidad' => $_POST['disponibilidad'] ?? 'sala',
                'imagen_url' => $_POST['imagen_url'] ?? ''
            ];
            $this->model->actualizar($id, $datos);
            header('Location: ?uri=Libro/index');
            exit;
        }

        $libro = $this->model->obtenerPorId($id);

        // Igual aquí, si tienes métodos para autores y géneros, úsalos, si no, quita.
        // $autores = $this->model->obtenerAutores();
        // $generos = $this->model->obtenerGeneros();

        require VIEWS . 'home.view.php';
    }

    public function eliminar($id)
    {
        $this->model->eliminar($id);
        header('Location: ?uri=Libro/index');
        exit;
    }
}

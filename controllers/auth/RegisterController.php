<?php

namespace controllers\auth;

use controllers\Controller;
use classes\View;
use models\Usuario;

class RegisterController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registerForm($params = null)
    {
        $response = [
            'ua'    => ['sv' => 0],
            'title' => 'Registro',
            'code'  => 200
        ];

        View::render('auth/register', $response);
    }

    public function registerUser()
    {
        $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        if (
            empty($datos['nombre']) ||
            empty($datos['email']) ||
            empty($datos['contraseña'])
        ) {
            echo json_encode(['r' => false, 'msg' => 'Campos incompletos']);
            return;
        }

        $ModelUser = new Usuario();

        // Verificar si ya existe ese email
        $existente = $ModelUser->where([['email', $datos['email']]]);
        if (count($existente) > 0) {
            echo json_encode(['r' => false, 'msg' => 'El email ya está registrado']);
            return;
        }

        // Crear usuario
        $nuevo = $ModelUser->nuevoUsuario($datos);

        if ($nuevo) {
            // Iniciar sesión automáticamente
            $usuario = $ModelUser->where([['email', $datos['email']]])[0];
            session_start();
            $_SESSION['sv']     = true;
            $_SESSION['IP']     = $_SERVER['REMOTE_ADDR'];
            $_SESSION['id']     = $usuario->id;
            $_SESSION['nombre'] = $usuario->nombre;
            $_SESSION['email'] = $usuario->email;
            $_SESSION['rol']    = $usuario->rol;
            session_write_close();

            header("Location: /Libreria/public/index.php?uri=home");
            exit();
        }

        echo json_encode(['r' => false, 'msg' => 'Error al crear usuario']);
    }
}
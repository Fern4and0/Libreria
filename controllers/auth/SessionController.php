<?php

namespace controllers\auth;

use controllers\Controller;
use classes\View;
use models\Usuario;

class SessionController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function iniSession($params = null)
    {
        $session = self::sessionValidate();
        
        if ($session && $session['sv']) {
            // Ya hay sesión activa, redirigir al home directamente
            header("Location: /Libreria/public/index.php?uri=home");
            exit();
        }

        // No hay sesión, mostrar el login
        $response = [
            'ua'    => ['sv' => 0],
            'title' => "Iniciar sesión",
            'code'  => 200
        ];

        View::render('auth/inisession', $response);
    }

    public function userAuth() {
        $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        $usuarioModel = new Usuario();
        $email = $datos['email'] ?? '';
        $password = $datos['contraseña'] ?? '';

        // Buscar al usuario por email
        $result = $usuarioModel->where([['email', $email]]);
        $usuarios = $result;

        if (count($usuarios) > 0) {
            $usuario = $usuarios[0];

            // Verificar la contraseña con password_verify
            if (password_verify($password, $usuario->contraseña)) {
                $this->sessionRegister($usuario);
                header("Location: /Libreria/public/index.php?uri=home"); 
                exit();
            }
        }

        self::sessionDestroy();
        echo json_encode(["r" => false]);
    }

    private function sessionRegister($usuario) {
        session_start();
        $_SESSION['sv']     = true;
        $_SESSION['IP']     = $_SERVER['REMOTE_ADDR'];
        $_SESSION['id']     = $usuario->id;
        $_SESSION['nombre'] = $usuario->nombre;
        $_SESSION['email'] = $usuario->email;
        $_SESSION['rol']    = $usuario->rol;
        session_write_close();

        return json_encode(["r" => true]);
    }

    public static function sessionValidate() {
        $usuarioModel = new Usuario();
        session_start();

        if (isset($_SESSION['sv']) && $_SESSION['sv'] == true) {
            $email = $_SESSION['email'] ?? '';
            $id     = $_SESSION['id'] ?? '';
            $ip     = $_SERVER['REMOTE_ADDR'];

            $result = $usuarioModel->where([['email', $email]]);
            $usuarios = $result;

            if (count($usuarios) > 0 && $ip === $_SESSION['IP']) {
                $usuario = $usuarios[0];

                session_write_close();
                return [
                    'sv'     => true,
                    'id'     => $usuario->id,
                    'nombre' => $usuario->nombre,
                    'email' => $usuario->email,
                    'rol'    => $usuario->rol
                ];
            }
        }

        session_write_close();
        self::sessionDestroy();
        return null;
    }

    private static function sessionDestroy() {
        session_start();
        $_SESSION = ['sv' => false];
        session_destroy();
        session_write_close();
    }

    public function logout() {
        $this->sessionDestroy();
        header("Location: /"); // Redirecciona a home, puedes cambiar la ruta
        exit();
    }
}
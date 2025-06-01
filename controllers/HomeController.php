<?php

namespace controllers;

use classes\View;
use controllers\auth\SessionController as SC;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($params = [])
    {
        $userSession = SC::sessionValidate();

        // Redirige si no hay sesión activa
        if (empty($userSession) || empty($userSession['sv'])) {
            header("Location: /Libreria/public/index.php?uri=auth/session/inisession");
            exit();
        }

        // Si hay sesión válida, cargar la vista Home
        $data = [
            'ua'    => $userSession,
            'title' => 'Libreria',
            'code'  => 200
        ];

        View::render('home', $data);
    }
}

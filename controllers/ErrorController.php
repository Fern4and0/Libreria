<?php

namespace controllers;

class ErrorController
{
    public function __construct() {}

    public function notFound()
    {
        http_response_code(404);
        echo $this->showErrorPage("404 - Recurso no encontrado", "Lo sentimos, la página solicitada no está disponible.");
    }

    public function methodNotExists()
    {
        http_response_code(500);
        echo $this->showErrorPage("Error del sistema", "El método que estás tratando de ejecutar no está definido.");
    }

    private function showErrorPage($titulo, $detalle)
    {
        return "
            <!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>$titulo</title>
                <style>
                    body {
                        margin: 0;
                        padding: 0;
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        background: linear-gradient(to right, #e0eafc, #cfdef3);
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        color: #333;
                    }
                    .container {
                        text-align: center;
                        background-color: white;
                        padding: 40px;
                        border-radius: 12px;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                    }
                    h1 {
                        font-size: 2.5rem;
                        color: #e74c3c;
                        margin-bottom: 10px;
                    }
                    p {
                        font-size: 1.2rem;
                        margin-top: 0;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>$titulo</h1>
                    <p>$detalle</p>
                </div>
            </body>
            </html>
        ";
    }
}

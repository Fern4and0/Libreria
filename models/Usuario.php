<?php

namespace models;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['nombre', 'email', 'contraseña', 'rol'];

    public function __construct()
    {
        parent::__construct();
    }

    public function nuevoUsuario($datos)
    {
        $this->values = [
            $datos['nombre'],
            $datos['email'],
            password_hash($datos['contraseña'], PASSWORD_BCRYPT),
            'usuario'
        ];

        return $this->create();
    }
}

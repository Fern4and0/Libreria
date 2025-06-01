<?php

namespace models;

class Libro extends Model
{
    protected $table = 'libros';

    protected $fillable = ['titulo', 'descripcion', 'autor_id', 'genero_id', 'disponibilidad', 'imagen_url'];

    // Los valores se asignan a través de $this->values para el create

    public function obtenerTodos()
    {
        return $this->all();
    }

    public function obtenerPorId($id)
    {
        $resultado = $this->where([['id', $id]]);
        return $resultado ? $resultado[0] : null;
    }

    public function crear(array $datos)
    {
        // Asignamos los valores en el orden de $fillable
        $this->values = [];
        foreach ($this->fillable as $campo) {
            $this->values[] = $datos[$campo] ?? null;
        }

        return $this->create();
    }

    public function actualizar($id, array $datos)
    {
        $sql = "UPDATE {$this->table} SET 
            titulo = ?, 
            descripcion = ?, 
            autor_id = ?, 
            genero_id = ?, 
            disponibilidad = ?, 
            imagen_url = ? 
            WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $datos['titulo'] ?? null,
            $datos['descripcion'] ?? null,
            $datos['autor_id'] ?? null,
            $datos['genero_id'] ?? null,
            $datos['disponibilidad'] ?? 'sala',
            $datos['imagen_url'] ?? null,
            $id
        ]);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}

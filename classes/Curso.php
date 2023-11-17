<?php

namespace App;

class Curso extends ActiveRecord{
    protected static $tabla = 'curso';
    protected static $columnasDB = ['id', 'titulo', 'video', 'descripcion', 'creado', 'autor', 'pclave'];

    public $id;
    public $titulo;
    public $video;
    public $descripcion;
    public $creado;
    public $autor;
    public $pclave;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->video = $args['video'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->creado= date('Y/m/d');
        $this->autor = $args['autor'] ?? '';
        $this->pclave = $args['pclave'] ?? '';
    }
    
    public function validar(){
        if(!$this->titulo){
            self::$errores[] = 'Debes añadir un título'; 
        }
        if(!$this->video){
            self::$errores[] = 'Debes añadir un enlace del video'; 
        }
        if(!$this->autor){
            self::$errores[] = 'Debes añadir un autor'; 
        }
        if(strlen($this->descripcion) < 20){
            self::$errores[] = 'La descripción es obligatoria y debe tener al menos 20 caracteres'; 
        }
        if(!$this->pclave){
            self::$errores[] = 'Debe añadir palabras clave'; 
        }

        return self::$errores;
    }
}
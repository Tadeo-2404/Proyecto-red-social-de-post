<?php 

namespace Model;

class Post extends ActiveRecord {

    public $id;
    public $titulo;
    public $cuerpo;
    public $hora;
    public $fecha;
    public $autor;
    public $imagen;
    public $usuarioId;
    protected  static $tabla = 'post';
    protected static $columnasDB = ['id', 'titulo', 'cuerpo', 'hora', 'fecha', 'autor' , 'imagen','usuarioId'];


    public function __construct($titulo = '', $cuerpo = '', $autor = '' ,$usuarioId = '')
    {
        $this->id = $id ?? null;
        $this->titulo = $titulo?? '';
        $this->cuerpo = $cuerpo?? '';
        $this->hora = date("H:i");
        $this->fecha = date('Y/m/d');
        $this->autor = $autor ?? '';
        $this->imagen = $imagen ?? '';
        $this->usuarioId = $usuarioId ?? '';
    }

    public function validarErrores() {
        if(!$this->titulo) {
            self::$alertas['error'][] = "El titulo es obligatorio";
        }
        if(!$this->cuerpo) {
            self::$alertas['error'][] = "El cuerpo es obligatorio";
        }

        if(strlen($this->cuerpo) > 255) {
            self::$alertas['error'][] = "Maximo de 255 por post";
        }
        return self::$alertas;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    
    public function setCuerpo($cuerpo)
    {
        $this->cuerpo = $cuerpo;
    }

    public function setUsuarioId($usuarioId) {
        $this->usuarioId = $usuarioId;
    }
}
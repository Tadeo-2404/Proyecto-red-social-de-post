<?php

namespace Model;

class Usuario extends ActiveRecord {
    //base de datos
    protected  static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'imagen' ,'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $imagen;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? ''; 
        $this->imagen = $args['imagen'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? "";
    }

    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = "El nombre es obligatorio";
        }

        if(!$this->apellido) {
            self::$alertas['error'][] = "El apellido es obligatorio";
        }

        if(!$this->email) {
            self::$alertas['error'][] = "El email es obligatorio";
        }

        if(!$this->telefono) {
            self::$alertas['error'][] = "El telefono es obligatorio";
        }

        if(!$this->password) {
            self::$alertas['error'][] = "La contraseña es obligatoria";
        }

        return self::$alertas;
    }

    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        return self::$alertas;
    }

    public function verificarCorreo() {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        
        if($resultado->num_rows) {
            self::$alertas['error'][] = "El usuario ya esta registrado";
        }

        return $resultado;
    }

    public function hashpassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid($this->token);
    }

    public function validarLogin() {
        
        if(!$this->email) {
            self::$alertas['error'][] = "El email es obligatorio";
        }

        if(!$this->password) {
            self::$alertas['error'][] = "La contraseña es obligatoria";
        }

        return self::$alertas;
    }

    public function validarPassword($password) {
         $resultado = password_verify($password, $this->password);

         if(!$resultado) {
             self::$alertas['error'][] = 'Contraseña Incorrecta';
         } else {
             return true;
         }
    }

    public function estaConfirmado() {
        if(!$this->confirmado) {
            self::$alertas['error'][] = 'La cuenta no esta confirmada, puedes confirmarla dando click en el correo de verificacion';
        } else {
            return true;
        }
    }

    public function validarCambiosCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = "El nombre es obligatorio";
        }

        if(!$this->apellido) {
            self::$alertas['error'][] = "El apellido es obligatorio";
        }

        if(!$this->email) {
            self::$alertas['error'][] = "El email es obligatorio";
        }

        if(!$this->telefono) {
            self::$alertas['error'][] = "El telefono es obligatorio";
        }

        return self::$alertas;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setImagen($imagem) {
        $this->imagen = $imagem;
    }
}
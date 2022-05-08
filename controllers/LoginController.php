<?php

namespace Controller;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                
                if($usuario) {

                    $confirmarPassword = $usuario->validarPassword($auth->password);
                    
                    if($confirmarPassword) {
                    
                        $cuentaVerificada = $usuario->estaConfirmado();
                        
                        if($cuentaVerificada) {
                            
                            if(!isset($_SESSION)) {
                                session_start();
                            };
                            
                            $_SESSION['id'] = $usuario->id;
                            $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                            $_SESSION['email'] = $usuario->email;
                            $_SESSION['login'] = true;
    
                            if($usuario->admin === "1") {
                                $_SESSION['admin'] = $usuario->admin ?? null;
                                header('Location: /admin');
                            } else {
                                header('Location: /pagina-principal');
                            }
                            
                        }
                    }
            
                } else {
                    Usuario::setAlerta('error', 'Correo no registrado');
                }
            }
        }

        $alertas =  Usuario::getAlertas();
        $router->render('/views/layout.php','autenticacion/login', [
           'alertas' => $alertas
        ]);
    }

    public static function logout(Router $router) {
        $_SESSION = [];
        header('Location: /');
    }

    public static function crearCuenta(Router $router) {
        $usuario = new Usuario;
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            
            if(empty($alertas)) {
                $resultado = $usuario->verificarCorreo();

                if($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    $usuario->hashpassword();
                    $usuario->crearToken();
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $confirmado = $email->enviarConfirmacion();
                    $resultado = $usuario->guardar();

                    if($resultado) {
                        header('Location: /mensaje');
                    } else {
                        Usuario::setAlerta('error', 'Algo salio mal!!');
                    }
                }

            } 
        }

        $alertas = Usuario::getAlertas();
        $router->render('/views/layout.php','autenticacion/crear', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router) {
        $alertas = [];

        $token = $_GET['token'];
        $error = false;
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
           Usuario::setAlerta('error', 'Token no Valido');
           $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nuevaContraseña = $_POST['password'];
            $contraseñaConfirmar = $_POST['confirmarPassword'];

            if(!$nuevaContraseña || !$contraseñaConfirmar) {
                Usuario::setAlerta('error', 'Ambos Campos son Obligatorios');
                $alertas = Usuario::getAlertas();
            }

            if($nuevaContraseña != $contraseñaConfirmar) {
                Usuario::setAlerta('error', 'Las contraseñas no coinciden');
                $alertas = Usuario::getAlertas();
            }

            if(empty($alertas)) {
                $usuario->password = NULL;
                $usuario->password = $nuevaContraseña;
                $usuario->hashpassword();
                $usuario->token = "";
                $resultado = $usuario->guardar();

                if($resultado) {
                    header('Location: /mensajeRestablecido');
                } else {
                    Usuario::setAlerta('error', 'Algo salio mal!!');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('/views/layout.php','autenticacion/recuperar', [
             'alertas' => $alertas,
             'error' => $error
        ]);
    }

    public static function restablecer(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);

                if($usuario) {
                    
                    $cuentaVerificada = $usuario->estaConfirmado();

                    if ($cuentaVerificada) {

                        $usuario->crearToken();
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $confirmado = $email->enviarConfirmacionContraseña();
                        $resultado = $usuario->guardar();
                        
                        if($resultado) {
                            header('Location: /mensajeContraseña');
                        } else {
                            Usuario::setAlerta('error', 'Algo salio mal!!');
                        }

                    } else {
                        Usuario::setAlerta('error', 'La cuenta no esta confirmada, puedes confirmarla dando click en el correo de verificacion');
                    }

                } else {
                    Usuario::setAlerta('error', 'El Usuario no existe');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('/views/layout.php','autenticacion/restablecer', [
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('/views/layout.php','autenticacion/mensaje');
    }

    public static function mensajeContraseña(Router $router) {
        $router->render('/views/layout.php','autenticacion/mensajeContraseña');
    }

    public static function mensajeRestablecido(Router $router) {
        $router->render('/views/layout.php','autenticacion/mensajeRestablecido');
    }

    public static function confirmarCuenta(Router $router) {
        $alertas = [];

        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        
        
        if($usuario == NULL) {
            Usuario::setAlerta('error', 'Token no confirmado, intentalo de nuevo');
        } else {
            Usuario::setAlerta('exito', 'Token confirmado, ya puedes iniciar sesion');
            $usuario->token = "";
            $usuario->confirmado = "1";
            $usuario->guardar();
        }

        $alertas = Usuario::getAlertas();
        $router->render('/views/layout.php','autenticacion/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}
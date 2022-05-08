<?php 

require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controller\LoginController;
use Controller\ClienteController;


$router = new Router();

//login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

//logout
$router->get('/cerrar-sesion', [LoginController::class, 'logout']);

//crear cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crearCuenta']);
$router->post('/crear-cuenta', [LoginController::class, 'crearCuenta']);

//restablecer contraseña
$router->get('/restablecer', [LoginController::class, 'restablecer']);
$router->post('/restablecer', [LoginController::class, 'restablecer']);

//mensaje recuperar contraseña
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//confirmar
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmarCuenta']);

//mensaje
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//mensaje contraseña
$router->get('/mensajeContraseña', [LoginController::class, 'mensajeContraseña']);

//mensaje contraseña restablecida
$router->get('/mensajeRestablecido', [LoginController::class, 'mensajeRestablecido']);

//links privados
$router->get('/pagina-principal', [ClienteController::class, 'paginaPrincipal']);
$router->post('/pagina-principal', [ClienteController::class, 'paginaPrincipal']);
$router->get('/mi-cuenta', [ClienteController::class, 'miCuenta']);
$router->post('/mi-cuenta', [ClienteController::class, 'miCuenta']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
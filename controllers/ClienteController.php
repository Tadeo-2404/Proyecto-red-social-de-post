<?php

namespace Controller;

use Model\Post;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Usuario;

class ClienteController
{
    public static function paginaPrincipal(Router $router)
    {
        $alertas = [];
        $posts = Post::all();
        $post = new Post();
        $post->setUsuarioId($_SESSION['id']);
        $usuario = Usuario::where('id', $post->usuarioId);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $post->setAutor($usuario->nombre . " " . $usuario->apellido);
            $post->setTitulo($_POST['titulo']);
            $post->setCuerpo($_POST['cuerpo']);
            $image = $_FILES['imagen'];
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['imagen']['tmp_name']) {
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                $post->setImagen($nombreImagen);
            }

            $alertas = $post->validarErrores();
            
            if(empty($alertas))  {

             // Crear la carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                if ($_FILES['imagen']['tmp_name']) {
                  $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                
                
                if($post->guardar()) {
                    header('Location: /pagina-principal?exito=1');

                } else {
                    Post::setAlerta('error', 'No se ha publicado tu post');
                }
            }
        }

        if ( isset($_GET['exito']) && $_GET['exito'] == 1 )
        {
            Post::setAlerta('exito', 'Se ha publicado tu post');
        }

        $alertas = Post::getAlertas();
        estaAuntenticado();
        $router->render('/views/layout2.php', 'cliente/pagina-principal', [
            'usuario' => $usuario,
            'alertas' => $alertas,
            'posts' => $posts,
            'files' => $_FILES
        ]);
    }

    public static function miCuenta(Router $router) {
        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuarioAux = new Usuario($_POST);
            $alertas = $usuarioAux->validarCambiosCuenta();

            $image = $_FILES['imagen'];
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['imagen']['tmp_name']) {
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                $usuario->setImagen($nombreImagen);
            }
            
            if(empty($alertas)) {
                $usuario->setNombre($usuarioAux->nombre);
                $usuario->setApellido($usuarioAux->apellido);
                $usuario->setCorreo($usuarioAux->correo);
                
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                if ($_FILES['imagen']['tmp_name']) {
                  $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                if($usuario->guardar()) {
                    header('Location: /pagina-principal?exito=1');

                } else {
                    Post::setAlerta('error', 'No se han guardado tus cambios');
                }
            }
        }
        
        $alertas = Usuario::getAlertas();
        estaAuntenticado();
        $router->render('/views/layout2.php', 'cliente/mi-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    
}
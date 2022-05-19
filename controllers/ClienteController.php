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

        if ( isset($_GET['exito']) && $_GET['exito'] == 2 )
        {
            Post::setAlerta('exito', 'Se han guardado tus cambios');
        }

        if ( isset($_GET['exito']) && $_GET['exito'] == 3 )
        {
            Post::setAlerta('exito', 'Se ha actualizado tu post');
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
                    header('Location: /pagina-principal?exito=2');

                } else {
                    Post::setAlerta('error', 'No se han guardado tus cambios');
                }
            }
        }
        
        $alertas = Usuario::getAlertas();
        estaAuntenticado();
        $router->render('/views/layout2.php', 'cliente/mi-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas,
        ]);
    }

    public static function miCuentaPost(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if($_POST["delete"] ?? "") {
               $post = Post::where('id', $_POST["id"]);
               
               Usuario::setAlerta('error', 'Post eliminado');
               $post->eliminar();

            } else {
                $post = Post::where('id', $_POST["id"]);
                header("Location: /editar-post?post-id=$post->id");
            }

        }

        $alertas = Usuario::getAlertas();
        $router->render('/views/layout2.php', 'cliente/mi-cuenta-post', [
            'alertas' => $alertas
        ]);
    } 

    public static function editarPost(Router $router) {
        $alertas = [];

        $alertas = Post::getAlertas();
        $postID = $_GET["post-id"];
        $postIDint = intval($postID);
        $post = Post::find($postIDint);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $image = $_FILES['imagen'];
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($image['tmp_name']) {
                $image = Image::make($image['tmp_name'])->fit(800, 600);
                $post->setImagen($nombreImagen);
            }
        
            // Asignar los atributos
            $args = $_POST;
            $post->sincronizar($args);           
        
            // Validación 
            $errores = $post->validarErrores();     
        
            if( empty($errores) ) {
                // Almacenar la imagen 

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                if ($_FILES['imagen']['tmp_name']) {
                  $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                if($post->guardar()) {
                    header('Location: /pagina-principal?exito=3');

                } else {
                    Post::setAlerta('error', 'No se ha publicado tu post');
                }
        
            }
        }

        $alertas = Post::getAlertas();
        estaAuntenticado();
        $router->render('/views/layout2.php', 'cliente/editar-post', [
            'alertas' => $alertas
        ]);
    }

    public static function borrarCuenta(Router $router) {

        $usuario = Usuario::find($_SESSION['id']);
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
           
           
            $usuario->eliminar();
            $_SESSION = [];

            header('Location: /');
        }

        $router->render('/views/layout2.php', 'cliente/borrar-cuenta', [
            
        ]);
    }
}

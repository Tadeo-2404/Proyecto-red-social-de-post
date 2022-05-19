<?php

use Model\Post;
use Model\Usuario;
?>


<div class="post-wrapper">
    <h2 class="account-post-title">Tus Publicaciones</h2>
    <?php
    include_once __DIR__ . '/../alertas/alertas.php';
    ?>
    <div class="contenedor-posts">
        <?php $posts = Post::whereWithoutFormat('usuarioId', $_SESSION['id']); ?>
        <?php $usuario = Usuario::where('id', $_SESSION['id']); ?>
        <?php foreach ($posts as $post) : ?>
            <form action="/mis-post" method="POST" class="container-fluid form-post">
                <div class="post">
                    <div class="post-header">
                        <?php if ($usuario->imagen) : ?>
                            <img loading="lazy" src="/imagenes/<?php echo $usuario->imagen; ?>" alt="imagen-post" class="img-usuario img-responsive">
                        <?php endif ?>
                        <h2 class="autor-post"><?php echo $usuario->nombre . " " . $usuario->apellido; ?></h2>
                    </div>
                    <div class="post-body">
                        <h3 class="titulo"><?php echo $post->titulo; ?></h3>
                        <p class="cuerpo"><?php echo $post->cuerpo; ?></p>

                        <?php if ($post->imagen) : ?>
                            <img loading="lazy" src="/imagenes/<?php echo $post->imagen; ?>" alt="imagen-post" class="imagen-post img-responsive">
                        <?php endif ?>
                    </div>
                    <p class="fecha"><?php echo $post->fecha . " a las: " . $post->hora ?></p>
                </div>

                <div class="acciones">
                    <input type="submit" name="edit" class="boton" value="Editar">
                    <input type="submit" name="delete" class="boton-borrar" value="Borrar">
                    <input type="hidden" name="id" value="<?php echo $post->id ?>">
                </div>

            </form>
        <?php endforeach; ?>
    </div>
</div>
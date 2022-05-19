<?php

use Model\Post;
use Model\Usuario;
?>
<div class="wrapper_editar-publicacion">
    <?php $post = Post::find($_GET["post-id"]); ?>
    <?php $usuario = Usuario::where('id', $_SESSION['id']); ?>
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



    <div class="post_publicacion">
        <form enctype="multipart/form-data" method="POST" class=" form">
            <legend class="text-center">Editar tu Post</legend>
            <?php
            include_once __DIR__ . '/../alertas/alertas.php';
            ?>
            <fieldset class="campo ">
                <label for="titulo">Titulo de tu Publicacion</label>
                <input type="text" id="titulo" value="<?php echo $post->titulo ?>" placeholder="Tu titulo" name="titulo">
            </fieldset>

            <fieldset class="campo">
                <textarea class="form-control" name="cuerpo" id="post" cols="50" rows="10" placeholder="¿Que estas pensando?">
                <?php echo $post->cuerpo ?>
                </textarea>
            </fieldset>

            <div class="btn-area">
                <label class="custom-file-upload">
                    <input type="file" hidden name="imagen" accept="image/" />
                    <i class='bx bx-upload'></i>
                    <p>Subir Imagen</p>
                </label>
                <input type="submit" id="submit" value="Publicar" class="boton">
            </div>

        </form>
    </div>
</div>
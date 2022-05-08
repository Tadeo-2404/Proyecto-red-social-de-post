<?php
use Model\Usuario;
?>

<div class="contenedor-posts d-flex flex-column justify-content-center">
  <?php foreach ($posts as $post) : ?>
    <?php  $usuario = Usuario::where('id', $post->usuarioId) ?>
    <div class="post d-flex flex-column justifiy-content-center" data-id="<?php echo $post->id ?>">
      <div class="post-sub d-flex justify-content-start">
        <?php if ($usuario->imagen) : ?>
          <img loading="lazy" src="/imagenes/<?php echo $usuario->imagen; ?>" alt="imagen-post" class="img-usuario img-responsive">
        <?php endif ?>
        <h2 class="autor"><?php echo $usuario->nombre . " " . $usuario->apellido; ?></h2>
      </div>
      <div class="contenido-post">
        <h3 class="titulo"><?php echo $post->titulo; ?></h3>
        <p class="cuerpo"><?php echo $post->cuerpo; ?></p>

        <?php if ($post->imagen) : ?>
          <img loading="lazy" src="/imagenes/<?php echo $post->imagen; ?>" alt="imagen-post" class="imagen-post img-responsive">
        <?php endif ?>

      </div>
      <p class="fecha"><?php echo $post->fecha . " a las: " . $post->hora ?></p>
    </div>
    <!--post-->
  <?php endforeach; ?>
</div>
<!--.contenedor-pots-->
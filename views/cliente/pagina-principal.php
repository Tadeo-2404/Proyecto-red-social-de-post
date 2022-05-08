<div class="app container-fluid">
    <div class="post_bienvido_container container-fluid">
        <h1 class="post_bienvenido">Bienvenid@ <?php echo $usuario->nombre . " " . $usuario->apellido ?></h1>
    </div>
    <div class="wrapper-body row">
        <div class="post_publicacion col-sm-6">
            <form action="/pagina-principal" enctype="multipart/form-data" method="POST" class="d-flex flex-column form">
                <legend class="text-center">Publicar un Post</legend>
                <?php
                include_once __DIR__ . '/../alertas/alertas.php';
                ?>
                <fieldset class="campo d-flex flex-column">
                    <label for="titulo">Titulo de tu Publicacion</label>
                    <input type="text" id="titulo" placeholder="Tu titulo" name="titulo">
                </fieldset>
                <fieldset class="campo">
                    <textarea class="form-control" name="cuerpo" id="post" cols="50" rows="10" placeholder="¿Que estas pensando?"></textarea>
                </fieldset>

                <label class="custom-file-upload d-flex justify-content-around align-items-center">
                    <input type="file" hidden name="imagen" accept="image/" />
                    <i class='bx bx-upload'></i>
                    Subir Imagen
                </label>

                <input type="submit" id="submit" value="Publicar" class="boton">
            </form>
        </div>

        <div class="post_publicacion_otros d-flex flex-column col-sm-6">
            <div class="post_publicacion_body">
                <h2>Post de otros usuarios</h2>
                <div class="post_otros">
                    <?php
                    include 'listado.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

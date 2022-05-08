<div class="field-wrapper d-flex justify-content-center container-fluid">
    <div class="field-wrapper-body d-flex flex-column justify-content-center align-items-center">

        <h1 class="field-wrapper-title">Tu Cuenta</h1>

        <form class="form-cuenta container-fluid" action="/mi-cuenta" method="POST" enctype="multipart/form-data">
            <div class="field-cuenta d-flex flex-column justify-content-center align-items-center">
                <?php if ($usuario->imagen) : ?>
                    <span class="field-picture d-flex flex-column justify-content-center">
                        <img loading="lazy" src="/imagenes/<?php echo $usuario->imagen; ?>" alt="imagen-post" class="imagen-post img-responsive">
                        <label class="d-flex justify-content-around align-items-center">
                            <input type="file" hidden name="imagen" accept="image/" />
                            Editar Foto
                        </label>
                    </span>
                <?php endif ?>

                <?php if (!$usuario->imagen) : ?>
                    <span class="field-picture d-flex flex-column justify-content-center">
                        <img loading="lazy" src="../build/img/004-user.png" alt="imagen-post" class="imagen-post img-responsive">
                        <label class="d-flex justify-content-around align-items-center">
                            <input type="file" hidden name="imagen" accept="image/" />
                            Editar Foto
                        </label>
                    </span>
                <?php endif ?>

                <?php
                include_once __DIR__ . '/../alertas/alertas.php';
                ?>

                <div class="field d-flex justify-content-around align-items-center">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control form-control-lg" readonly value="<?php echo $usuario->nombre ?>" id="nombre">
                    <img src="../build/img/edit.png" class="edit-img">
                </div>

                <div class="field d-flex justify-content-around align-items-center">
                    <label class="form-label" for="apellido">Apellido</label>
                    <input type="text" name="apellido" class="form-control form-control-lg" readonly value="<?php echo $usuario->apellido ?>" id="apellido">
                    <img src="../build/img/edit.png" class="edit-img">
                </div>

                <div class="field d-flex justify-content-around align-items-center">
                    <label class="form-label" for="email">Email</label>
                    <input type="text" name="email" class="form-control form-control-lg" readonly value="<?php echo $usuario->email ?>" id="email">
                    <img src="../build/img/edit.png" class="edit-img">
                </div>

                <div class="field d-flex justify-content-around align-items-center">
                    <label class="form-label" for="telefono">Telefono</label>
                    <input type="text" name="telefono" class="form-control form-control-lg" readonly value="<?php echo $usuario->telefono ?>">
                    <img src="../build/img/edit.png" class="edit-img">
                </div>
            </div>
            <input type="submit" class="boton" value="Guardar Cambios">
        </form>
    </div>
</div>

<?php
$script = "

<script src='build/js/app.js'></script>
";

?>
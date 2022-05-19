<div class="wrapper-borrar">
<h1>Borrar Cuenta</h1>
<form action="/borrar-cuenta" class="form" method="POST">
    <legend>Al eliminar tu cuenta se eliminaran todas tus publicaciones ,esta accion no se puede deshacer, para confirmar escribe: Deseo eliminar mi cuenta</legend>
    <div class="campo">
        <input type="text" required placeholder="Deseo eliminar mi cuenta" class="validacion">
        <input type="submit" class="boton-eliminar" value="Borrar Cuenta">
    </div>
</form>
</div>

<?php
$script = "

<script src='build/js/app.js'></script>
";

?>
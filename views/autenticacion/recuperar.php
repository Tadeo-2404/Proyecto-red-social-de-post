<h1 class="titulo-pagina">Restablecer Contraseña</h1>
<p class="parrafo-pagina">Coloca tu nueva contraseña a continuacion</p>

<?php 
   include_once __DIR__ . '/../alertas/alertas.php';
?>

<?php if($error) return null; ?>
<form class="formulario" method="POST">
    <div class="field">
        <label for="password">Nueva Contraseña</label>
        <input type="password" placeholder="Tu Nueva Contraseña" id="password" name="password">
    </div>
    <div class="field">
        <label for="confirmarPassword">Confirma tu Contraseña</label>
        <input type="password" placeholder="Confirma tu Nueva Contraseña" id="confirmarPassword" name="confirmarPassword">
    </div>

    <input type="submit" id="submit" value="Cambiar Contraseña" class="boton">
</form>

<div class="form-links">
    <a href="/" class="form-link">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="/crear-cuenta" class="form-link">¿No tienes una cuenta? Crea una</a>
</div>
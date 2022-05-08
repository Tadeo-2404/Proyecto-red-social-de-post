<h1 class="titulo-pagina">Iniciar Sesion</h1>
<p class="parrafo-pagina">Inicia sesion introduciendo tu email y contraseña</p>

<?php 
   include_once __DIR__ . '/../alertas/alertas.php';
?>

<form action="/" class="formulario" method="POST">
    <div class="field">
        <label for="email">Correo</label>
        <input type="email" placeholder="Tu Email" id="email" name="email">
    </div>
    <div class="field">
        <label for="password">Contraseña</label>
        <input type="password" placeholder="Tu Contraseña" id="password" name="password">
    </div>

    <input type="submit" id="submit" value="Iniciar Sesion" class="boton">
</form>

<div class="form-links">
    <a href="/restablecer" class="form-link">¿Olvidaste tu contraseña?</a>
    <a href="/crear-cuenta" class="form-link">¿No tienes una cuenta? Crea una</a>
</div>
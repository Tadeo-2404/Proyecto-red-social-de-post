<h1 class="titulo-pagina">Restablecer Contraseña</h1>
<p class="parrafo-pagina">Introduce tu email para recibir un correo con las intrucciones a seguir</p>

<?php 
   include_once __DIR__ . '/../alertas/alertas.php';
?>

<form action="/restablecer" class="formulario" method="POST">
    <div class="field">
        <label for="email">Correo</label>
        <input type="email" placeholder="Tu Email" id="email" name="email">
    </div>

    <input type="submit" id="submit" value="Enviar Confirmacion" class="boton">
</form>

<div class="form-links">
    <a href="/" class="form-link">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="/crear-cuenta" class="form-link">¿No tienes una cuenta? Crea una</a>
</div>
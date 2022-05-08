<h1 class="titulo-pagina">Crear Cuenta</h1>
<p class="parrafo-pagina">Registrate introduciendo tus datos</p>

<?php 
   include_once __DIR__ . '/../alertas/alertas.php';
?>

<form action="/crear-cuenta" class="formulario" method="POST">
    <div class="field">
        <label for="nombre">Nombre</label>
        <input type="text" placeholder="Tu Nombre" name="nombre" id="nombre" value="<?php echo $usuario->nombre ?>">
    </div>
    <div class="field">
        <label for="apellido">Apellido</label>
        <input type="text" placeholder="Tu Apellido" name="apellido" id="apellido" value="<?php echo $usuario->apellido ?>">
    </div>
    <div class="field">
        <label for="email">Correo</label>
        <input type="email" placeholder="Tu Email" name="email" id="email" value="<?php echo $usuario->email ?>">
    </div>
    <div class="field">
        <label for="telefono">Telefono</label>
        <input type="tel" placeholder="Tu Telefono" name="telefono" id="telefono" value="<?php echo $usuario->telefono ?>">
    </div>
    <div class="field">
        <label for="contraseña">Contraseña</label>
        <input type="password" placeholder="Tu Contraseña" name="password" id="password">
    </div>

    <input type="submit" id="submit" value="Crear Cuenta" class="boton">
</form>

<div class="form-links">
    <a href="/restablecer" class="form-link">¿Olvidaste tu contraseña?</a>
    <a href="/" class="form-link">¿Ya tienes una cuenta? Inicia Sesion</a>
</div>
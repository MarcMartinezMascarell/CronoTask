<?php
    include 'inc/funciones/funciones.php';
    include 'inc/templates/header.php';

    session_start();
    if(isset($_GET['cerrar_sesion'])){
        $_SESSION = array();
		session_destroy();
		setcookie();
    }

?>
<div class="contenedor-formulario">
    <h1>CronoTask</h1>
    <form id="formulario" class="caja-login" method="post" autocomplete="off">
        <div class="campo">
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario" placeholder="Usuario">
        </div>
        <div class="campo">
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <div class="campo enviar">
            <input type="hidden" id="tipo" value="login">
            <input type="submit" class="boton" value="Iniciar Sesión">
        </div>

        <div class="campo">
            <a href="crear-cuenta.php" class="new_account">Crea una cuenta nueva</a>
        </div>
    </form>
</div>

<?php
        include 'inc/templates/footer.php';
?>
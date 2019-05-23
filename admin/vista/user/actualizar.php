<?php
session_start();
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE) {
    header("Location: /SistemaDeGestion/public/vista/login.html");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestion de Usuarios</title>
    <link href="../../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <header class="cab">
        <h1>Actualizar Datos Usuario</h1>
    </header>
    <form id="formulario01" method="POST" action="../../controladores/actualizar.php">
        <input type="hidden" id="codigo" name="codigo" value=" <?php echo $_GET["codigo"]; ?>" />
        <label for="cedula">Cedula (*)</label>
        <input type="text" id="cedula" name="cedula" value="<?php echo $_GET["cedula"]; ?>" />
        <br>
        <label for="nombres">Nombres (*)</label>
        <input type="text" id="nombres" name="nombres" value="<?php echo $_GET["nombres"]; ?>" />
        <br>
        <label for="apellidos">Apelidos (*)</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $_GET["apellidos"]; ?>" />
        <br>
        <label for="direccion">Dirección (*)</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo $_GET["direccion"]; ?>" />
        <br>
        <label for="telefono">Teléfono (*)</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $_GET["telefono"]; ?>" />
        <br>
        <label for="fecha">Fecha Nacimiento (*)</label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $_GET["fechaNacimiento"]; ?>" />
        <br>
        <label for="correo">Correo electrónico (*)</label>
        <input type="email" id="correo" name="correo" value="<?php echo $_GET["correo"]; ?>" />
        <br>
        <input type="submit" id="eliminar" name="eliminar " value="Actualizar" />
        <input type="reset" id="cancelar " name="cancelar" value="Cancelar" />
        <a href="cuenta.php"> Regresar </a>
    </form>

</body>

</html>
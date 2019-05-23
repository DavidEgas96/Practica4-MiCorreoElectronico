<?php
session_start();
$codigoui = $_SESSION['cod'];
$nombresui = explode(" ", $_SESSION['nom']);
$apellidosui =  explode(" ", $_SESSION['ape']);
$usurol = $_SESSION['rol'];
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

<body background="fondo.jpg">
    <?php
    include '../../../config/conexionBD.php';
    $sqlu = "SELECT * FROM usuario WHERE usu_codigo='$codigoui';";
    $resultu = $conn->query($sqlu);
    if ($resultu->num_rows > 0) {
        while ($row = $resultu->fetch_assoc()) {
            $codigo = $row["usu_codigo"];
            $cedula = $row["usu_cedula"];
            $nombres = $row["usu_nombres"];
            $apellidos = $row["usu_apellidos"];
            $direccion = $row["usu_direccion"];
            $telefono = $row["usu_telefono"];
            $correo = $row["usu_correo"];
            $fecha = $row["usu_fecha_nacimiento"];
            $contrasena = $row["usu_password"];
            $foto = $row["usu_foto"];
            $datos = $row["usu_foto"];
            $datos2 = base64_decode($datos);
            $minuscula=strtolower($correo);
        }
    }
    ?>

<?php

include '../../../config/conexionBD.php';
 $sql = "SELECT usu_foto from usuario WHERE usu_codigo='$codigoui';";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
       
        $datos = $row["usu_foto"];
        $datos2 = base64_decode($datos);
    }
    }

   
?>
   
    <header class="cab">
        <h2>Cuenta</h2>
        <nav class="navi">
            <ul id="menu">
            <li><a href="#"> <img id="imagen" src="../../../<?php echo $datos2?>"> <?php echo $nombresui[0] . ' ' . $apellidosui[0] ?>  
                    <ul>
                        <li><a href="actualizar.php?codigo=<?php echo $codigo; ?>&cedula=<?php echo $cedula; ?>&nombres=<?php echo $nombres; ?>&apellidos=<?php echo $apellidos; ?>&direccion=<?php echo $direccion; ?>&telefono=<?php echo $telefono; ?>&fechaNacimiento=<?php echo $fecha; ?>&correo=<?php echo $correo; ?>"> Modificar Datos</a></li>
                        <li><a href="cambiarContrasena.php?codigo=<?php echo $codigo; ?>"> Cambiar Contraseña</a></li>
                        <li><a href="../../../config/cerrarSesion.php"> Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    

        
        <a href='index.php'><button style="color: #003366; background-color: #99CCFF"  type="button" id="login" name="login" value="Ya tienes una cuenta Ingresa" />Inicio</button> </a>
                <a href='mensajenu.php'><button style="color: #003366; background-color: #99CCFF" type="button">Crear Mensaje</button></a>
                 <a href='mensajesen.php'><button style="color: #003366; background-color: #99CCFF" type="button">Elementos enviados </button></a> 
                <a href='cuenta.php'><button style="color: #003366; background-color: #99CCFF" type="button">Mi Perfil</button></a> 
                <br><br><br>

    </header>
    <form id="formulario01">
        <input type="hidden" id="codigo" name="codigo" value=" <?php echo $codigo ?>" />
        <label for="cedula">Cedula</label>
        <input type="text" id="cedula" name="cedula" value="<?php echo $cedula; ?>" disabled />
        <br>
        <label for="nombres">Nombres</label>
        <input type="text" id="nombres" name="nombres" value="<?php echo $nombres; ?>" disabled />
        <br>
        <label for="apellidos">Apelidos</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" disabled />
        <br>
        <label for="direccion">Dirección</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>" disabled />
        <br>
        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>" disabled />
        <br>
        <label for="fecha">Fecha Nacimiento</label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $fecha; ?>" disabled />
        <br>
        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo" value="<?php echo $minuscula; ?>" disabled />
        <img id="image" width="150" height="150"  src="../../../<?php echo $datos2?>" />
        <br>
    </form>
    <?php
    $conn->close();
    ?>
</body>

</html>
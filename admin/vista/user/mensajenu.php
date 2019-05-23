<?php
session_start();
$codigoui = $_SESSION['cod'];
$nombresui = explode(" ", $_SESSION['nom']);
$apellidosui =  explode(" ", $_SESSION['ape']);
$correoui = $_SESSION['cor'];
$usurol = $_SESSION['rol'];
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE) {
    header("Location: /SistemaDeGestion/public/vista/login.html");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Practica04</title>
    <link href="../../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
</head>

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

<body background="fondo.jpg">
    <header class="cabis">
        <h2>
            Crear mensaje:
        </h2>
        <nav class="navi">
            <ul id="menu">
            <li><a href="#"> <img id="imagen" src="../../../<?php echo $datos2?>"> <?php echo $nombresui[0] . ' ' . $apellidosui[0] ?>
          
                        
                    <ul>
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
    <form id="formulario01" method="POST" action="../../controladores/user/crearCorreo.php">
        <label for="destinatario">Destinatario:</label>
        <input type="text" id="destinatario" name="destinatario" value="" placeholder="Ingrese el correo del destinatario
                    ..." required />
        <br>
        <label for="asunto"> Asunto:</label>
        <input type="text" id="asunto" name="asunto" value="" placeholder="Ingrese el asunto
                        ..." required />
        <br>
        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" placeholder="Ingrese el mensaje..." required></textarea>
        <br>
        <input type="submit" id="crear" name="crear" value="Enviar" />
        <input type="reset" id="cancelar" name="cancelar" value="Cancelar" />



        <footer id="pie" >
    <div>   
        <a href="mailto:degasf@est.ups.edu.ec?subject=Questions">Correo de Contacto </a>
        <a>&nbsp;</a>
        <a href="tel:072801706">Telefono </a>
        </div> 
    <div  id="copyright">Página creada por David Fernando Egas Feijoo - <br /> 
            Universidad Politécnica Salesiana &#169; Todos los derechos reservados </div>
            </footer>
            
</body>

</html>
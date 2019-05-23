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
    <link href="../../../public/vista/css/stables.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../controladores/js/metodos.js"> </script>
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
            Bienvenido
        </h2>
     
        
       
        <nav class="navi">
            <ul id="menu">
                <li><a href="#"> <img id="imagen" src="../../../<?php echo $datos2?>"> <?php echo $nombresui[0] . ' ' . $apellidosui[0] ?>
              </a>
                    <ul>
                        <li><a href="../../../config/cerrarSesion.php"> Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
       
        <br>
                 <a href='index.php'><button style="color: #003366; background-color: #99CCFF"  type="button" id="login" name="login" value="Ya tienes una cuenta Ingresa" />Inicio</button> </a>
                <a href='mensajenu.php'><button style="color: #003366; background-color: #99CCFF" type="button">Crear Mensaje</button></a>
                 <a href='mensajesen.php'><button style="color: #003366; background-color: #99CCFF" type="button">Elementos enviados </button></a> 
                <a href='cuenta.php'><button style="color: #003366; background-color: #99CCFF" type="button">Mi Perfil</button></a> 
                <br><br><br>
                
       
        <h4>Buzon de entrada</h4>
        <nav id="foto"> 
        <input type="text" id="correo" name="correo" value="" placeholder="Buscar por correo" required onkeyup="buscarPorCorreo()"/>
        <img id="imagen2" src="../../../public/vista/imagenes/usu.png"></nav>

        <br>



    </header>
    <table id="tbl">
        
        <tr>
            <th>Fecha:</th>
            <th>Remitente:</th>
            <th>Asunto:</th>
            <th>Leer:</th>
        </tr>
        <?php
        $url = $_SERVER['REQUEST_URI'];
        
        
        include '../../../config/conexionBD.php';
        $sql = "SELECT * FROM correos WHERE cor_eliminado='N' AND cor_usu_destinatario=$codigoui ORDER BY cor_fecha_hora DESC;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $codigo = $row["cor_codigo"];
                $fecha = $row["cor_fecha_hora"];
                $asunto = $row["cor_asunto"];
                $correodes = "";
                $bus = "SELECT usu_correo FROM usuario WHERE usu_codigo='$row[cor_usu_remitente]';";
                $resultb = $conn->query($bus);
                if ($resultb->num_rows > 0) {
                    while ($row = $resultb->fetch_assoc()) {
                        $correodes = $row["usu_correo"];
                    }
                }
                echo "<tr>";
                echo "   <td>" . $fecha . "</td>";
                echo "   <td>" . $correodes . "</td>";
                echo "   <td>" . $asunto . "</td>";
                echo "   <td> <a href='../../controladores/user/lecturamen.php?codigo=$codigo&url=$url'> Ir </a> </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "   <td colspan='7'> No existen correos registrados al usuario </td>";
            echo "</tr>";
        }
        $conn->close();
        ?>
    </table>
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
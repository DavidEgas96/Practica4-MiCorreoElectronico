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
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Gestión de usuarios</title>
    <link href="../../../public/vista/css/stables.css" rel="stylesheet" type="text/css" />
    <link href="../../../public/vista/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body background="fondo.jpg">
    <header class="cabis">
        <h2> Listado de Usuarios </h2>
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
                <a href='listado.php'><button style="color: #003366; background-color: #99CCFF" type="button"> Usuarios</button></a>
                
    </header>
    <table id="tbl">
        <caption>
            <h4>Mensajes Electrónicos </h4>
        </caption>
        <tr>
            <th>Fecha</th>
            <th>Remitente</th>
            <th>Destinatario</th>
            <th>Asunto</th>
            <th>Eliminar</th>
        </tr>
        <?php
        include '../../../config/conexionBD.php';
        $sql = "SELECT * FROM correos WHERE cor_eliminado='N' ORDER BY cor_fecha_hora DESC;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $codigo = $row["cor_codigo"];
                $fecha = $row["cor_fecha_hora"];
                $asunto = $row["cor_asunto"];
                $array = array(0 => $row["cor_usu_remitente"], 1 => $row["cor_usu_destinatario"]);
                $array2 = [];
                foreach ($array as $i => $value) {
                    $bus = "SELECT * FROM usuario WHERE usu_codigo=$array[$i];";
                    $resultb = $conn->query($bus);
                    if ($resultb->num_rows > 0) {
                        while ($row = $resultb->fetch_assoc()) {
                            $array2[] = $row["usu_correo"];
                        }
                    }
                }
                echo "<tr>";
                echo "   <td>" . $fecha . "</td>";
                echo "   <td>" . $array2[0] . "</td>";
                echo "   <td>" . $array2[1] . "</td>";
                echo "   <td>" . $asunto . "</td>";
                echo "   <td> <a href='eliminarmen.php?codigo=$codigo'> Ir </a> </td>";
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
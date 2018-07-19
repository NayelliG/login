<?php session_start();

require("conexion_db.php");

if (isset($_SESSION['usuario'])) {
	header('Location: index.php');
}

$errores = '';
$id_ciudad = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password = hash('sha512', $password);
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];

    $_SESSION['usuario'] = $usuario;

    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = mysqli_query($conexion, $query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error());
    }

    $errores = '<li>Datos incorrectos</li>';

    if ($usuario !== "" or $password !== "") {

        while ($row = mysqli_fetch_array($result)) {
            $user = $row["usuario"];
            $pass = $row["pass"];
            $id_ciudaduser = $row["id_ciudad"];

            $_SESSION['id_ciudaduser'] = $id_ciudaduser;

            $querygls = "SELECT * FROM gls WHERE id_ciudad = '$id_ciudaduser'";
            $resultgls = mysqli_query($conexion, $querygls);
            if (!$resultgls) {
                die('Invalid query: ' . mysqli_error());
            }

            while ($row = mysqli_fetch_array($resultgls)) {
                $lat_min = $row["lat_min"];
                $lat_max = $row["lat_max"];
                $lng_min = $row["lng_min"];
                $lng_max = $row["lng_max"];
                $id_ciudadgl = $row["id_ciudad"];

                $_SESSION['id_ciudadgl'] = $id_ciudadgl;

                    if ($usuario == $user && $password == $pass) { //primer if
                        if ($lat >= $lat_min && $lat <= $lat_max && $lng <= $lng_min && $lng >= $lng_max) {
                            $_SESSION['usuario'] = $usuario;
                            header('Location: index.php');
                        } else {
                            $errores = '<li> Dirigete a un gl</li>';
                        }
                    } else { //else del primer if
                        $errores = '<li>Datos Incorrectos</li>';
                    }
                }
            }
        }
    }
    echo '<br/><a href="contenido.php"></a>';
    require 'views/login.view.php';


?>



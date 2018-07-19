<?php session_start();

require ("conexion_db.php");

$usuarioform = $_SESSION['usuario'];
$id_ciudaduser = $_SESSION['id_ciudaduser'];
$id_ciudadgl = $_SESSION['id_ciudadgl'];


$query = "SELECT * FROM usuarios WHERE usuario = '$usuarioform'";
$result = mysqli_query($conexion, $query);
if (!$result) {
    die('Invalid query: ' . mysqli_error());
}
    while ($row = mysqli_fetch_array($result)) {
        $usuario = $row["usuario"];
        $id_ciudadbase = $row["id_ciudad"];
    }

    if ($id_ciudaduser == $id_ciudadbase){
        echo "</br> perteneces a esta ciudad" . "</br>";
    }else{
        session_destroy();
        $_SESSION = array();
    }

    if (isset($_SESSION['usuario'])) {
        //echo "este es el id " .$id_ciudaduser;
        require 'views/contenido.view.php';
    } else {
        header('Location: login.php');
    }

?>
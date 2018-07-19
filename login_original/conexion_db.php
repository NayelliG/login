<?php
/**
 * Created by PhpStorm.
 * User: NAYELLI GONZALEZ
 * Date: 13/07/18
 * Time: 11:54
 */

$hostname="localhost";
$username="root";
$passworddb="";
$database="login_practica";

$conexion = mysqli_connect('localhost', $username, $passworddb);
if (!$conexion) {
    die('No conectado : ' . mysqli_connect_error());
}
$db_selected = mysqli_select_db($conexion, $database);
if (!$db_selected) {
    die ('No se puede usar la BD : ' . mysqli_connect_error());
}
?>
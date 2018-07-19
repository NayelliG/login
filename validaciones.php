<?php
/**
 * Created by PhpStorm.
 * User: NAYELLI GONZALEZ
 * Date: 11/07/18
 * Time: 18:20
 */

require("conexion_db.php");

$lat = $_GET['latphp'];
$lon = $_GET['lonphp'];
$lat_min = "";
$lat_max = "";
$lng_min = "";
$lng_max = "";

echo "Tu lat es: " . $lat . "</br>";
echo "Tu lng es: ". $lon . "</br>";


$connection=mysqli_connect('localhost', $username, $password);
if (!$connection) {
    die('No conectado : ' . mysqli_connect_error());
}
$db_selected = mysqli_select_db($connection, $database );
if (!$db_selected) {
    die ('No se puede usar la BD : ' . mysqli_connect_error());
}

// Select all the rows in the markers table
$query = "SELECT * FROM gls";
$result = mysqli_query($connection, $query);
if (!$result) {
    die('Invalid query: ' . mysqli_error());
}


while ($row = mysqli_fetch_array($result)) {
    $lat_min = $row["lat_min"];
    $lat_max = $row["lat_max"];
    $lng_min = $row["lng_min"];
    $lng_max = $row["lng_max"];

    /**echo $lat_min . ", ";
    echo $lat_max . ", ";
    echo $lng_min . ", ";
    echo $lng_max . ", ";*/

    if ($lat >= $lat_min && $lat <= $lat_max && $lon >= $lng_min && $lon <= $lng_max){
        $ok_valid = "Estas dentro de un GL ";
        break;
    }else{
        $ok_valid = "Dirigete a un GL";
    }
}

echo "</br>". $ok_valid;

//print_r($result);
//exit();

?>
<?php session_start();

$username="root";
$passworddb="";
$database="login_practica";


if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
}

$errores = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password = hash('sha512', $password);
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];

    echo $lat;
    echo $lng;

    /*try {
        $conexion = new PDO('mysql:host=localhost;dbname=login_practica', 'root', '');
    } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();;
    }*/

    $conexion=mysqli_connect('localhost', $username, $passworddb);
    if (!$conexion) {
        die('No conectado : ' . mysqli_connect_error());
    }
    $db_selected = mysqli_select_db($conexion, $database );
    if (!$db_selected) {
        die ('No se puede usar la BD : ' . mysqli_connect_error());
    }

    $statement = $conexion->prepare('
		SELECT * FROM usuarios WHERE usuario = :usuario AND pass = :password'
    );

    $statement->execute(array(
        ':usuario' => $usuario,
        ':password' => $password,

    ));

    $result = $statement->setFetchMode(PDO::FETCH_ASSOC);

    foreach(new TableRows(new RecursiveArrayIterator($statement->fetchAll())) as $k=>$v) {
        echo $v;
    }


    $resultado = $statement->fetch();
    if ($resultado !== false) {
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php');
    } else {
        $errores .= '<li>Datos Incorrectos</li>';
    }
}

require 'views/login.view.php';



/*require("conexion_db.php");

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

/* if ($lat >= $lat_min && $lat <= $lat_max && $lon >= $lng_min && $lon <= $lng_max){
     $ok_valid = "Estas dentro de un GL ";
     break;
 }else{
     $ok_valid = "Dirigete a un GL";
 }
}

echo "</br>". $ok_valid;

//print_r($result);
//exit();*/

?>



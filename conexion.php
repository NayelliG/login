<?php
$mysqli = new mysqli('localhost', 'root', '', 'ciudades');
?>

<?php
if (!$_POST) {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Demo de menú desplegable</title>
        <meta charset=utf-8"/>
    </head>
    <body>
    <div align="center">
        <p>Selecciona tu ciudad:</p>

        <form action="conexion.php" method="POST">
            <select name="ciudades">
                <option value="0">Seleccione:</option>
                <?php
                $query = $mysqli->query("SELECT * FROM ciudades_uber");
                while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="' . $valores[id_ciudad] . '">' . $valores[ciudad] . '</option>';
                }
                ?>
            </select>
            <input type="submit" value="Enviar datos!">
        </form>
    </div>
    </body>
    </html>

    <?php
}else {
    $ciudad = $_POST["ciudades"];
    echo $ciudad;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no,
	 initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <title>ciudad</title>

    <script type="text/javascript">
        var x = document.getElementById("sub");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(coordenadas);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function coordenadas(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            console.log(lat);
            console.log(lon);



            $.ajax({
                url: 'validaciones.php',
                type: 'GET',
                data: {latphp: lat, lonphp: lon},
                success: function (data) {
                    $('#result').html(data);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    //case error
                }
            });
        };

    </script>

</head>
<body onload="">
<div class="contenedor">
    <h1 class="titulo">Da clic en el boton</h1>
    <hr class="border">

    <form action="validaciones.php" method="POST"  class="formulario" name="login">
        <div class="form-group">
            <i class="submit-btn fa fa-arrow-right" id="sub" onclick="getLocation()"></i>
            <p id="result"></p>
        </div>
    </form>


</body>
</html>
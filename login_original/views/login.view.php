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
	<title>Iniciar Sesión</title>
    
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
            var lng = position.coords.longitude;

            //alert("lat: " + lat + "  lng: " + lng);

            $("#lat").val(lat);
            $("#lng").val(lng);

            valor = document.getElementById("usuario").value;
            if( valor != "" ) {
                $("#validar").submit();
            }else{
                alert('Es necesario llenar todos los campos');
            }
};



    </script>

</head>

<body>
	<div class="contenedor">
		<h1 class="titulo">Iniciar Sesión</h1>
		<hr class="border">

		<form id="validar" action="login.php" method="POST" class="formulario" name="login">
			<div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input id="usuario" type="text" name="usuario" class="usuario" placeholder="Usuario">
			</div>

			<div class="form-group">
				<i class="icono izquierda fa fa-lock"></i><input id="password" type="password" name="password" class="password_btn" placeholder="Contraseña">
                <input type="hidden" name="lat" id="lat" class="lat" value="">
                <input type="hidden" name="lng" id="lng" class="lng" value="">
                <input class="submit-btn" id="ocultar" type="button" name="otracosa" value="subir" onclick="getLocation()">
			</div>

			<?php if(!empty($errores)): ?>
				<div class="error">
					<ul>
						<?php echo $errores; ?>
					</ul>
				</div>
			<?php endif; ?>
		</form>

		<p class="texto-registrate">
			¿ Aun no tienes cuenta ?
			<a href="registrate.php">Regístrate</a>
		</p>
	</div>
</body>
</html>
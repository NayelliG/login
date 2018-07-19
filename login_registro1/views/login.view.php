<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no,
	 initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	 <link href='https://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	 <link rel="stylesheet" href="css/estilos.css">
	<title>Iniciar Sesión</title>
</head>
<body>
	<div class="contenedor">
		<h1 class="titulo">Iniciar Sesión</h1>
		<hr class="border">

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login">
			<div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input type="text" name="usuario" class="usuario" placeholder="Usuario">
			</div>

			<div class="form-group">
				<i class="icono izquierda fa fa-lock"></i><input type="password" name="password" class="password_btn" placeholder="Contraseña">
				<i class="submit-btn fa fa-arrow-right" id="sub" onclick="loc=localizacion();login.submit();"></i>
                <p id="result"></p>
            </div>

			<?php if(!empty($errores)): ?>
				<div class="error">
					<ul>
						<?php echo $errores; ?>
					</ul>
				</div>
			<?php endif; ?>
		</form>

        <script type="text/javascript">
            function localizacion() {
                loc = navigator.geolocation.getCurrentPosition(cordenadas);
            }

            function cordenadas(position) {

                var lat = position.coords.latitude;
                var lon = position.coords.longitude;
                console.log(lat);
                console.log(lon);

                $(document).ready(function() {
                    $('#sub').click(function() {
                        $.ajax({
                            url: 'validaciones.php',
                            type: 'GET',
                            data: { latphp: lat, lonphp: lon},
                            success: function(data) {
                                $('#result').html(data);
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                //case error
                            }
                        });
                    });
                });
            }
        </script>

		<p class="texto-registrate">
			¿ Aun no tienes cuenta ?
			<a href="registrate.php">Regístrate</a>
		</p>
	</div>
</body>
</html>
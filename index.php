<!DOCTYPE html>
<html lang="en">
<head>
<style>
	.rojo{color: red;}
	.verde{color: green;}
</style>
	<meta charset="UTF-8">
	<title>Viaje pokemon</title>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() { //cuando todo este listo, iniciara lo que esta adentro de la funcion
			$("#mostrar").hide(); //esconde el div mostrar al inicio

			$("#pedido").on("click", function() { //al hacer clic en el boton pedido hara lo que esta adentro de la funcion

				var formdata = $("#formulario").serialize(); //todos los datos capturados del formulario los convierte en un string para su entrada al post

				$("#mostrar").show();//muestra el div mostrar despues de apretar el boton pedido
				$.post("report.php",formdata,function(data) {
					    if(data.message == 'exito'){
					    	$("#formulario").hide();//esconde el formulario despues de aceptar y verficar lo que dicta el php

					    	$("#mostrar").addClass("verde");//pinta de verde el div mostrar
					        //alert("Has llenado los campos correctamente");

					    }else{
					    	$("#mostrar").addClass("rojo");//si lo de arriba no sucede pinta de rojo el div mostrar
					    }
					        $("#mostrar").html(data.msj);//imprime todo lo que interpreta del html que le hayas puesto en el jquery, en este caso el div mostrar aunque ya esta puesto, encima la informacion del json, si no esta estructurado como html usa los estilos default

					},'json');//tienes que ponerle esto del json para que jquery sepa que esta recibiendo datos desde uno

				//.post es una funcion de jquery, toma la informacion de formdata y la postea en report.php para que los beans la guarden y publiquen en la bd, tambien hara lo que esta adentro de la funcion

				return false; //sirve para detener el proceso
			});
		});
	</script>
</head>
<body>
	<form id="formulario">
		<fieldset>
			<legend>Entrenadores nuevos</legend>
			<h1>Bienvenido</h1>
			<h3>Por favor selecciona 3 pokemon, puedes escoger 1 de cada region:</h3>
			<p>Kanto</p>
			<select name="kanto" id="kan" required> <!-- el required se pone en el select tag -->
				<option disabled selected value>Selecciona una opcion</option>
				<option value="bulbasaur">Bulbasaur</option>
				<option value="squirtle">Squirtle</option>
				<option value="charmander">Charmander</option>
			</select>

			<p>Johto</p>
			<select name="johto" id="joh" required>
				<option disabled selected value>Selecciona una opcion</option>
				<option value="chicorita">Chicorita</option>
				<option value="cyndaquil">Cyndaquil</option>
				<option value="totodile">Totodile</option>
			</select>

			<p>Hoenn</p>
			<select name="hoenn" id="hoe" required>
				<option disabled selected value>Selecciona una opcion</option>
				<option value="treeko">Treeko</option>
				<option value="torchic">Torchic</option>
				<option value="mudkip">Mudkip</option>
			</select>
			
			<p>¿Que tipo de pokemon te gusta mas?</p>
			<label><input type="radio" name="favorito" value="electrico" required>Electrico</label><!-- el required se pone en el primer radio button -->
			<label><input type="radio" name="favorito" value="agua">Agua</label>
			<label><input type="radio" name="favorito" value="fantasma">Fantasma</label>
			<label><input type="radio" name="favorito" value="psiquico">Psiquico</label>

			<h4>¿Porque quieres ser un entrenador pokemon?</h4>
			<textarea name="trainer" id="respuesta" cols="50" rows="5" required></textarea><br>
			<input type="submit" value="Hacer pedido" id="pedido">
		</form>
	</fieldset>
	<div id="mostrar">
		<h1>Gracias por tus respuestas, las revisaremos y estaremos en contacto contigo muy pronto</h1>
	</div>
</body>
</html>
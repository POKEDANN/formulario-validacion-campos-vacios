<?php
	require('rb.php');//siempre requiere redbean

	R::setup( 'mysql:host=localhost;dbname=entrenador', 'root', '' );//primero se crea la BD
	//con todos sus datos correspondientes

	ini_set('display_errors', 1);
	error_reporting(E_ERROR);//esto ayuda a que te enseñe los errores de php que tienes, tambien puedes ponerle E_ALL

	$new_trainer = R::dispense('candidatos'); //crea un nuevo row en la tabla

	$kanto = $_POST['kanto'];
	$johto = $_POST['johto'];
	$hoenn = $_POST['hoenn'];
	$favorito = $_POST['favorito'];
	$trainer = $_POST['trainer'];

    $msj = array(
        "error" => "No has completado todos los campos",
        "exito" => "Has llenado los campos correctamente"
    );//aqui se hace el arreglo o json, de lo que va a enviar 

	if(empty($kanto) || empty($johto) || empty($hoenn) || empty($favorito) || empty($trainer)){
        #$data = array("error" => "No has completado todos los campos");
        $data = array("msj" => $msj['error']);
        // $data = array("message"=>"error");//aqui le dices directamente que mensaje dar, si exito o error sin ningun contenido
	} else {
		$new_trainer->kanto = $kanto; //asi se ponen los datos y como los guardara en el row
		$new_trainer->johto = $johto;
		$new_trainer->hoenn = $hoenn;
		$new_trainer->favorito = $favorito;
		$new_trainer->trainer = $trainer;
		//estas cosas se cambiaron aqui porque solo las hace si el data no da error
		
		R::store($new_trainer); //aqui almacena los datos en la BD, solo si data no da error

		#$data = array("exito" => "Has llenado los campos correctamente");

        $data = array("msj" => $msj['exito']);//aqui al igual que el de arriba le dices que accese a algun elemento del array, el cual contiene algo, en este caso un mensaje

        // $data = array("message"=>"exito");//aqui le dices directamente que mensaje dar, si exito o error sin ningun contenido
	}

	// echo 'kanto: ' . $kanto . '<br>';
	// echo 'johto: ' . $johto . '<br>';
	// echo 'hoenn: ' . $hoenn . '<br>';
	// echo 'favorito: ' . $favorito . '<br>';
	// echo 'trainer: ' . $trainer . '<br>';//esto era para imprimir lo que se guardo en esas variables pero con encode ya no es necesario

	echo json_encode($data);//encapsula la informacion de las variables que estan arriba y asi se pueden utilizar con jquery
?>
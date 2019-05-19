<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>REGISTRO DE VENTAS</h1>

<form method="post">
	
	<input type="text" placeholder="ID del producto" name="idRegistro" required>

	<input type="text" placeholder="Cantidad" name="cantidadRegistro" required>

	<input type="submit" value="Enviar">

</form>

<?php

$registro = new MvcController();
$registro -> registroVentaController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>

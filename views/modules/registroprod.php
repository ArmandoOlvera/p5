 

<h1>REGISTRO DE PRODUCTOS</h1>
 
<form method="post">
	
	<input type="text" placeholder="NombreProducto" name="productoRegistro" required>

	<input type="text" placeholder="Precio Sin decimales" name="precioRegistro" required> 

	<input type="button" class="button_active" onclick="location.href='usuarios.php';" />

</form>

<?php

$registro = new MvcController();
$registro -> registroProductoController();

if(isset($_GET["action"])){

	if($_GET["action"] == "registroprodK"){

		echo "Registro Exitoso";
	
	}

}

?>

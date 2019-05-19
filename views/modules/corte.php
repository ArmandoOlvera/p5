<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>VENTAS</h1>

	<table border="1">
		
		<thead>
			
			<tr>
				<th>Fecha</th>
				<th>IdProducto</th>
				<th>Nombre</th>
				<th>Cantidad Vendida HOy</th>
				<th>Precio Unitario</th>
				 
				 
			</tr>

		</thead>

		<tbody>
			
			<?php

			$vistaUsuario = new MvcController();
			$vistaUsuario -> vistaCorteController();
			$vistaUsuario -> borrarVentasController();

			?>

		</tbody>

	</table>

<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){

		echo "Cambio Exitoso";
	
	}

}

?>





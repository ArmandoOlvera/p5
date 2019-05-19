 

<h1>PRODUCTOS</h1>

	<table border="1">
		
		<thead>
			
			<tr>
				<th>Nombre</th>
				<th>Precio</th> 
				<th></th>
				<th></th>

			</tr>

		</thead>

		<tbody>
			
			<?php

			$vistaUsuario = new MvcController();
			$vistaUsuario -> vistaProductosController();
			$vistaUsuario -> borrarProductoController();

			?>

		</tbody>

	</table>

<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "editarproducto"){

		echo "Cambio Exitoso";
	
	}

}

?>





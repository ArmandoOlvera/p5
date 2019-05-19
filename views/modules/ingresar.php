 <h1>INGRESAR</h1>

	<form method="post">
		
		<input type="text" placeholder="Usuario" name="usuarioIngreso" required>

		<input type="password" placeholder="Contraseña" name="passwordIngreso" required>

		

		<input type="button" class="button_active" onclick="location.href='index.php?action=registro';" />

	</form>

<?php
//<input type="button" class="button_active" onclick="location.href='views/modules/usuarios.php';" />
$ingreso = new MvcController();
$ingreso -> ingresoUsuarioController();

if(isset($_GET["action"])){

	if($_GET["action"] == "fallo"){

		echo "Fallo al ingresar";
	
	}

}

?>
<?php
session_start();
if(!$_SESSION["validar"]){ ?>
	<nav>
	<ul>
		<li><a href="index.php?action=registro">Registro Users</a></li>
		<li><a href="index.php?action=registroprod">Registro Productos</a></li>
		<li><a href="index.php?action=registrovent">Registro Ventas</a></li>
		<li><a href="index.php?action=ingresar">Ingreso</a></li>
		<li><a href="index.php?action=usuarios">Usuarios</a></li>
		<li><a href="index.php?action=ventas">Ventas</a></li>
		<li><a href="index.php?action=productos">Productos</a></li>
		<li><a href="index.php?action=corte">Corte</a></li>
		<li><a href="index.php?action=salir">Salir</a></li>
	</ul>
</nav>
<?php } ?>
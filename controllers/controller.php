<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){	
		
		include "views/template.php";
	
	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){

		 

		if(isset( $_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}

		else{

			$enlaces = "index";
		}
		 

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}

	#REGISTRO DE USUARIOS
	#------------------------------------
	public function registroUsuarioController(){

		if(isset($_POST["usuarioRegistro"])){

			$datosController = array( "usuario"=>$_POST["usuarioRegistro"], 
								      "password"=>$_POST["passwordRegistro"],
								      "email"=>$_POST["emailRegistro"]);

			$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:index.php?action=ok");

			}

			else{

				header("location:index.php");
			}

		}

	}

	#REGISTRO DE VENTAS
	#------------------------------------
	public function registroVentaController(){

		if(isset($_POST["idRegistro"])){

			$datosController = array( "id"=>$_POST["idRegistro"], 
								      "cantidad"=>$_POST["cantidadRegistro"] );

			$respuesta = Datos::vistaVentasModel($datosController, "ventas");

			if($respuesta == "success"){

				header("location:index.php?action=ventas");

			}

			else{

				header("location:index.php");
			}

		}

	}

 


	#REGISTRO DE PRODUCTOS
	#------------------------------------
	public function registroProductoController(){

		if(isset($_POST["productoRegistro"])){

			$datosController = array( "nombre"=>$_POST["productoRegistro"], 
								      "precio"=>$_POST["precioRegistro"] );

			$respuesta = Datos::registroProductoModel($datosController, "productos");

			if($respuesta == "success"){

				header("location:index.php?action=registroprod");

			}

			else{

				header("location:index.php");
			}

		}

	}

	#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

			$datosController = array( "usuario"=>$_POST["usuarioIngreso"], 
								      "password"=>$_POST["passwordIngreso"]);
 
			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

			if($respuesta["user"] == $_POST["usuarioIngreso"] && $respuesta["pass"] == $_POST["passwordIngreso"]){
				//session_start();

				//$_SESSION["validar"] = true;

				header("location:index.php?action=usuarios");

			}

			else{

				header("location:index.php?action=fallo");

			}

		}	

	}

	#VISTA DE USUARIOS
	#------------------------------------

	public function vistaUsuariosController(){

		$respuesta = Datos::vistaUsuariosModel("usuarios");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["user"].'</td>
				<td>'.$item["pass"].'</td>
				<td>'.$item["email"].'</td>
				<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}

	#VISTA DE VENTAS
	#------------------------------------

	public function vistaVentasController(){

		$respuesta = Datos::vistaVentasModel("ventas");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["fecha"].'</td>
				<td>'.$item["idProducto"].'</td>
				<td>'.$item["cantidad"].'</td>
				<td><a href="index.php?action=ventas&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}


	#VISTA DE VENTAS
	#------------------------------------

	public function vistaCorteController(){

		$respuesta = Datos::vistaProductosModel("productos");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		$fecha=date("Y-m-d");
		$total=0;
		$cantidad=0;
		foreach($respuesta as $row => $item){
			$respuesta3 = Datos::vistaCortes3Model("ventas",$item["id"]);
				echo'<tr>
				<td>'.$fecha.'</td>
				<td>'.$item["id"].'</td>
				<td>'.$item["nombre"].'</td>';
			$respuesta2 = Datos::vistaCortesModel2("productos",$item["id"]);
			$cantidad=0;
			foreach($respuesta3 as $row3 => $item3){
				$cantidad=$cantidad+$item3["cantidad"];
			}
 
				foreach($respuesta2 as $row2 => $item2){
					$total=$total+($item2["precio"]*$cantidad);
					echo "<td>".$cantidad."</td>";
					echo " 
					<td>".$item2["precio"].'</td>
					 
					</tr>';

				}

			
			
		}

		echo "<center><h2>"."El total ganado fue de: ".$total."</h2></center>";
	}


	#VISTA DE PRODUCTOS
	#------------------------------------

	public function vistaProductosController(){

		$respuesta = Datos::vistaProductosModel("productos");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["nombre"].'</td>
				<td>'.$item["precio"].'</td> 
				<td><a href="index.php?action=editarproducto&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=productos&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}

	#EDITAR USUARIO
	#------------------------------------

	public function editarUsuarioController(){

		$datosController = $_GET["id"];
		$respuesta = Datos::editarUsuarioModel($datosController, "usuarios");

		echo'<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

			 <input type="text" value="'.$respuesta["user"].'" name="usuarioEditar" required>

			 <input type="text" value="'.$respuesta["pass"].'" name="passwordEditar" required>

			 <input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>

			 <input type="submit" value="Actualizar">';

	}


	#EDITAR producto
	#------------------------------------

	public function editarProductoController(){

		$datosController = $_GET["id"];
		$respuesta = Datos::editarProductoModel($datosController, "productos");

		echo'  <input type="hidden" value="'.$respuesta["id"].'" name="idEditar">
			 <input type="text" value="'.$respuesta["nombre"].'" name="nombreEditar" required>

			 <input type="text" value="'.$respuesta["precio"].'" name="precioEditar" required> 

			 <input type="submit" value="Actualizar">';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarUsuarioController(){

		if(isset($_POST["usuarioEditar"])){

			$datosController = array( "id"=>$_POST["idEditar"],
							          "usuario"=>$_POST["usuarioEditar"],
				                      "password"=>$_POST["passwordEditar"],
				                      "email"=>$_POST["emailEditar"]);
			
			$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:index.php?action=cambio");

			}

			else{

				echo "error";

			}

		}
	
	}


	#ACTUALIZAR PRODUCTO
	#------------------------------------
	public function actualizarProductoController(){

		if(isset($_POST["nombreEditar"])){

			$datosController = array( "id"=>$_POST["idEditar"],
							          "nombre"=>$_POST["nombreEditar"],
				                      "precio"=>$_POST["precioEditar"] );
			
			$respuesta = Datos::actualizarProductoModel($datosController, "productos");

			if($respuesta == "success"){

				header("location:index.php?action=productos");

			}

			else{

				echo "error";

			}

		}
	
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarVentasController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarProductoModel($datosController, "ventas");

			if($respuesta == "success"){

				header("location:index.php?action=ventas");
			
			}

		}

	}

#BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarProductoModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:index.php?action=usuarios");
			
			}

		}

	}

	#BORRAR VENTAS
	#------------------------------------
	public function borrarProductoController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarProductoModel($datosController, "ventas");

			if($respuesta == "success"){

				header("location:index.php?action=productos");
			
			}

		}

	}

}

?>
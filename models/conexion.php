<?php

class Conexion{

	public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=mario","root","tacosconsalsaverde123");
		return $link;

	}

}

?>

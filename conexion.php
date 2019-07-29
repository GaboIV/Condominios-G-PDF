<?php
	date_default_timezone_set('America/Caracas');
	function conectarse() {		
		$servidor = "localhost"; $usuario = "root"; $password = ""; $bd = "menegrande";
		$conectar = new mysqli($servidor, $usuario, $password, $bd);
		return $conectar; }
	$db = conectarse();
?>
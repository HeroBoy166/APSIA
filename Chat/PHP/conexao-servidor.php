<?php
	header("charset=utf-8");
	
	$servidor = "sql309.ezyro.com";
	$usuario = "ezyro_35239791";
	$senha = "214243a22";
	$banco = "ezyro_35239791_apsia";

	$mysqli = new mysqli($servidor, $usuario, $senha, $banco);
		$mysqli->set_charset("utf8");

	if ($mysqli ->connect_errno) {
		echo "Falha na conexão: (" . mysqli->connect_errno . ")" . $mysqli->connect_error;
	}
?>
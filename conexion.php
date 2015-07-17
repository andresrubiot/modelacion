<?php
	$hostname_conexion = "localhost";
	$database_conexion = "nogstadc_modelacion";
	$username_conexion = "nogstadc_demos";
	$password_conexion = "nogstad.91";
	$conexion = mysql_connect($hostname_conexion, $username_conexion, $password_conexion) or die ('Error en la Conexion. Causa: ' . mysql_error());
?>
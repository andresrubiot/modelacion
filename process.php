<?php 
	include("conexion.php");

	if ($_POST['nuevo']=='nuevo') {

		mysql_select_db($database_conexion,$conexion);
		echo $insert="INSERT INTO modelacion (K,D,H,a) VALUES ('".$_POST['K']."', '".$_POST['D']."', '".$_POST['H']."', '".$_POST['a']."' )";
		$query=mysql_query($insert,$conexion)or die(mysql_error());

		echo "<script>
			window.location.href='index.php';
		</script>";

	}

	if ($_POST[limite]='limite' && $_POST['A']!='') {
		mysql_select_db($database_conexion,$conexion);
			$update="UPDATE config SET area_maxima_inventario='".$_POST['A']."' WHERE id='1' ";
			$query=mysql_query($update,$conexion)or die(mysql_error());
			$i++;

			echo "<script>
				window.location.href='index.php';
			</script>";
	}

	if ($_GET[eliminar]!='') {
		mysql_select_db($database_conexion, $conexion);
		$delete="DELETE FROM modelacion WHERE id='".$_GET['eliminar']."'";
		$query=mysql_query($delete,$conexion)or die(mysql_error());

		echo "<script>
				window.location.href='index.php';
			</script>";

	}

?>
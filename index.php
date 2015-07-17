<?php 
  include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MODELACIÓN</title>

    <link href="images/favicon.jpg" rel="icon" type="image/x-icon" />

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

    <!-- JS -->
    <script type="text/javascript" src="js/script.js"></script>
    
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    .page-header {
      font-family: Comic Sans MS,arial,verdana;
      -moz-animation-duration: 3s;
      -webkit-animation-duration: 3s;
      -moz-animation-name: slidein;
      -webkit-animation-name: slidein;
    }
    
    @-moz-keyframes slidein {
      from {
        margin-left:100%;
        width:300%
      }
      
      to {
        margin-left:0%;
        width:100%;
      }
    }
    
    @-webkit-keyframes slidein {
      from {
        margin-left:100%;
        width:300%
      }
      
      to {
        margin-left:0%;
        width:100%;
      }
    }
  </style>
  </head>

  <body onload="document.getElementById('K').focus()">
    <div class="container">

      <div class="page-header">
        <h1>MODELACIÓN EOQ</h1>
        <p class="lead">EOQ de varios con limitación de almacen</p>
        <p><b>ELIANA LIZETH GÓMEZ CASTELLÓN</b></p>
      <p><b>319575</b></p>
      </div>


      <div class="row">
        <div class="col-md-9">
        	<table class="table table-striped table-hover">
            <form name="ingreso" id="ingreso" action="process.php" method="post">
          		<thead>
          			<tr>
          				<th>K</th>
                  <th>D</th>
                  <th>H</th>
                  <th>a</th>
                </tr>
              </thead>
              <tbody>
                <tr id="fila">
                	<td><input type="text" name="K" id="K" class="form-control" placeholder="Costo De Pedido" aria-describedby="basic-addon1" onKeyPress="return soloNumeros(event)" onkeyup="format(this)" onchange="format(this)"></td>
                	<td><input type="text" name="D" id="D" class="form-control" placeholder="Demanda" aria-describedby="basic-addon1" onKeyPress="return soloNumeros(event)" onkeyup="format(this)" onchange="format(this)"></td>
                	<td><input type="text" name="H" id="H" class="form-control" placeholder="Costo De Almacenamiento" aria-describedby="basic-addon1" onKeyPress="return soloNumeros(event)" onkeyup="format(this)" onchange="format(this)"></td>
                	<td><input type="text" name="a" id="a" class="form-control" placeholder="Área De Almacenamiento" aria-describedby="basic-addon1" onKeyPress="return soloNumeros(event)" onkeyup="format(this)" onchange="format(this)" onblur="this.form.submit();"></td>
                </tr>
              </tbody>
            <tr>
              <td colspan="4" class="right" style="text-align:right">
                <input type="hidden" name="CONT" id="CONT" value="0">
                <input type="hidden" name="nuevo" id="nuevo" value="nuevo">
              </td>
            </tr>
            </form>
          </table>
        </div>
        <div class="col-md-3">
        	<table class="table table-striped table-hover">
            <form action="process.php" method="post">
        		<thead>
        			<tr>
        				<th colspan="2">A</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php 
                  mysql_select_db($database_conexion, $conexion);
                  $query_config="SELECT * FROM config WHERE id='1'";
                  $config=mysql_query($query_config, $conexion)or die(mysql_error());
                  $row_config=mysql_fetch_assoc($config);
                ?>
              	<td>
                  <input type="text" name="A" id="A" class="form-control" placeholder="Área Máxima De Inventario" aria-describedby="basic-addon1" onKeyPress="return soloNumeros(event)" value="<?php echo $row_config['area_maxima_inventario'] ?>">
                  <input type="hidden" name="limite" id="limite" value="limite">
                </td>
              </tr>
              <tr>
              	<td><button type="submit" class="btn btn-default">Ingresar</button></td>
              </tr>
            </tbody>
            </form>
          </table>
	<?php
		mysql_select_db($database_conexion,$conexion);
		$query_datos="SELECT * FROM modelacion ORDER BY id";
		$datos=mysql_query($query_datos,$conexion);
    $datos2=mysql_query($query_datos,$conexion);
    $totalRows=mysql_num_rows($datos2);
	?>
          <table class="table table-striped table-hover">
        		<thead>
        			<tr>
                <th>Yi</th>
        				<th>K</th>
                <th>D</th>
                <th>H</th>
                <th colspan="2">a</th>
              </tr>
            </thead>
            <tbody>
	    <?php 
            $i=1;
            while($row_datos=mysql_fetch_assoc($datos)){ ?>
              <tr>
                <td><?php echo $i; ?></td>
              	<td><?php echo $row_datos['K']; ?></td>
              	<td><?php echo $row_datos['D']; ?></td>
              	<td><?php echo $row_datos['H']; ?></td>
              	<td><?php echo $row_datos['a']; ?></td>
                <td>
                  <a href="process.php?eliminar=<?php echo $row_datos['id']; ?>">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:#E74C3C"></span>
                  </a>
                </td>
              </tr>
             <?php $i++; } ?>
            </tbody>
          </table>

        </div>
      </div>
      <hr>

      <div class="page-header">
        <h3>Formulas</h3>
      </div>

      <div class="row">

        <div class="col-md-12">

          <div class="eq-c">
            <i>Yi</i> = 
            <span class="radical">&radic;</span><span class="radicand">
              2(Ki)(Di) / Hi
            </span>
          </div><br><br>

          <?php 
            $i=1;
            while ($row_dat=mysql_fetch_assoc($datos2)) { ?>
              <div class="eq-c col-md-3">
                <i>Y<?php echo $i; ?></i> = 
                <span class="radical">&radic;</span><span class="radicand">
                  2(<?php echo $row_dat['K'] ?>)(<?php echo $row_dat['D'] ?>) / <?php echo $row_dat['H'] ?>
                </span>
                <br>
                <i>Y<?php echo $i; ?></i> = 
                <?php echo $val=sqrt( (("2")*($row_dat['K'])*($row_dat['D']))/(str_replace(',', '.', $row_dat['H'])) ) ?>
              </div>
          <?php
            $i++;
            $sumatoria=$sumatoria+$val;
            }
          ?>

        </div>
        <div class="col-md-12">
          <?php 
            echo "<br>n<br>";
            echo "<b>&sum; = ".$sumatoria."</b><br>";
            echo "i=1";
           ?>
        </div>

        <div class="col-md-12"><br>
        <hr>

        <!-- Tabla de resultados -->
        <?php 
          $query_limite="SELECT * FROM config";
          $limite=mysql_query($query_limite, $conexion)or die(mysql_error());
          $row_limite=mysql_fetch_assoc($limite);
          $totalRowsLimite=mysql_num_rows($limite);
          if ($totalRowsLimite>'0') {
        ?>
          <div class="eq-c">
            <i>Yi*</i> = 
            <span class="radical">&radic;</span><span class="radicand">
              2(Ki)(Di) / Hi - 2 &lambda; ai 
            </span>
          </div><br><br>

          <table class="table table-striped table-hover table-bordered">
            <th><br>&lambda;</th>
            <?php 
              $i=1;
              while ($i <= $totalRows) {
                echo "<th class='text-center'><br>Y$i*</th>";
                $i++;
              } ?>
            <th>
              <?php 
                echo "n<br>";
                echo "&sum; = Yi*<br>";
                echo "i=1";
               ?>
            </th>
            <th>
              <?php 
                echo "n<br>";
                echo "&sum; = Yi-A<br>";
                echo "i=1";
               ?>
            </th>

            <?php 
              $i=0;
              $cont=0;
              while ($i < 99999) {
                $sum=0;
               ?>
                <tr>
                  <td><?php echo number_format($cont,3,',','.') ?></td>
                  
                    <?php 
                      $query_datos="SELECT * FROM modelacion ORDER BY id";
                      $datos=mysql_query($query_datos,$conexion);
                      while ($row_dato=mysql_fetch_assoc($datos)) {
                        echo "<td>".

                        $val=sqrt( (("2")*($row_dato['K'])*($row_dato['D']))
                          /
                          ( str_replace(',', '.', $row_dato['H']) -2 * ($cont) ) )

                        ."</td>";
                        $sum=$sum+$val;
                      }
                    ?>
                  <td><?php echo $sum;  ?></td>
                  <td><?php echo $sum-$row_config['area_maxima_inventario'] ?></td>
                </tr>
              <?php 
                $cont=$cont-'0.100';
                $i++;
                if ($sum<$row_config['area_maxima_inventario']) {
                  exit();
                }
              } 
            ?>

          </table>
          <?php }else{
            echo "<br><h2 class='btn-danger btn-lg btn-block'>No hay información de área máxima de inventario</h2><br><hr>";
            } ?>

        </div>

      </div>


    </div> <!-- /container -->
  </body>
</html>
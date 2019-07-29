<html>
<head>
    <title>Formar PDF para Andreina</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <div style="background: red; margin: 15px; padding: 15px; max-width: 400px;">
        <div style="text-align: center; font-size: 1.5em; ">Escribe tus datos Andreina</div><br>
        <form class="form-horizontal" action="ejemplo.php" method="post" enctype="application/x-www-form-urlencoded">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" name="nombre_tx" placeholder="Nombre">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">C&eacute;dula</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputPassword3" name="cedula_tx" placeholder="C.I. o RIF">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Direcci&oacute;n</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputPassword3" name="direccion_tx" placeholder="Direcci&oacute;n fiscal">
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Enviar datos</button>
        </div>
      </div>
    </form>
    </div>
    
</body>
</html>
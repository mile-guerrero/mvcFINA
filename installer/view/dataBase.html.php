<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--esta linea se puede omitir para hacer banda de hancho fijo del video 28-->
    <title>INSTALADOR</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.js" rel="stylesheet">
    <link href="bootstrap.min.js" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <div class="container container-fluid" id="cuerpo">
    <?php if (isset($_GET['error']) and $_GET['error'] === true): ?>
      Ocurrio un error
    <?php endif ?>
      
      
     
      <br><br><br><br><br>
      
      <h1>CONFIGURACION DE BASE DE DATOS</h1>
      <br>
      
    <form class="form-horizontal" role="form" action="index.php?step=3" method="POST">

      <div class="form-group">
        <div class="col-sm-10">
          <input class="form-control" value="<?php echo (isset($_POST['host'])) ? $_POST['host'] : '' ?>" type="text" name="host" placeholder="Inserte el host de la base de datos ejemplo localhost" required><br>
        </div>
        
       
        
        </div>
      
               
    

    <div class="form-group">
        <div class="col-sm-10">
      <select class="form-control" name="driver" required>
        <option value="">Seleccione un controlador</option>
        <option value="pgsql" <?php echo (isset($_POST['driver']) and $_POST['driver'] === 'pgsql') ? 'selected' : '' ?>>PostgreSQL</option>
        <option value="mysql" <?php echo (isset($_POST['driver']) and $_POST['driver'] === 'mysql') ? 'selected' : '' ?>>MySQL</option>
      </select><br>
      </div>
      </div>
      
       <div class="form-group">
        <div class="col-sm-10">
      <input  class="form-control" value="<?php echo (isset($_POST['port'])) ? $_POST['port'] : '' ?>" type="text" name="port" placeholder="Digite el puerto ejemplo 5432 " required><br>
      </div>
      </div>
      
       <div class="form-group">
        <div class="col-sm-10">
      <input  class="form-control" value="<?php echo (isset($_POST['dbName'])) ? $_POST['dbName'] : '' ?>" type="text" name="dbName" placeholder="Nombre de la base de datos ejemplo bdagricola" required><br>
      </div>
      </div>
      
       <div class="form-group">
        <div class="col-sm-10">
      <input  class="form-control" value="<?php echo (isset($_POST['dbUser'])) ? $_POST['dbUser'] : '' ?>" type="text" name="dbUser" placeholder="Usuario de la base de datos ejemplo postgres" required><br>
      </div>
      </div>
      
       <div class="form-group">
        <div class="col-sm-10">
      <input  class="form-control" value="<?php echo (isset($_POST['dbPass'])) ? $_POST['dbPass'] : '' ?>" type="password" name="dbPass" placeholder="Contraseña de la base de datos" required><br>
      </div>
      </div>
      
      <div class="form-group">
        <div class="col-sm-10">
      <input class="btn btn-lg btn-primary btn-xs" type="submit" value="Continuar">
      </div>
      </div>
      
    </form>
    <?php if (isset($_GET['error']) and $_GET['error'] === true): ?>
      <?php echo $_GET['error_message'] ?>
    <?php endif ?>
      
      
     
      </div>
  </body>
</html>

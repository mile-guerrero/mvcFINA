<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--esta linea se puede omitir para hacer banda de hancho fijo del video 28-->
    <title>INSTALADOR</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
     <nav class="navbar navbar-default" id="colordelmenu">
        <div class="container-fluid">
            <div class="navbar-header">
                
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">                 
              
                <li class="dropdown">
                  <h1></h1><span class="caret"></span></a>
                    
                </li>
                </ul>


            </div>
        </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->

    </nav>
    <div id="separasdor"> <br></div>
    <div id="separasdor"> <br></div>
<div id="separasdor2"> <br></div>
    <section  navbar-header id="contenido">

   
</section>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo2">
    
      <h2 class="form-signin-heading"><br>  </h2>
      <br><br>
   
  </div>

</div>
<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo2">
    
    <br><br>
    
      <br>
    <form   class="form-horizontal" role="form" action="index.php?step=4" method="POST">
      <div class="form-group">
        <div class="col-sm-12">
      <label>CONFIGURACION DEL SISTEMA</label>
       </div>
        </div>
      
      <div class="form-group">
        <div class="col-sm-10">
      <input class="form-control"  value="<?php echo (isset($_POST['RowGrid'])) ? $_POST['RowGrid'] : '' ?>" type="text" name="RowGrid" placeholder="Numero de lineas por regilla"><br>
      </div>
      </div>
      
      
      
      <div class="form-group">
        <div class="col-sm-10">
      <input class="form-control" value="<?php echo (isset($_POST['PathAbsolute'])) ? $_POST['PathAbsolute'] : '' ?>"  type="text" name="PathAbsolute" placeholder="Dirección en servidor de la carpeta raíz ejemplo /var/www/html/mvcfinal/"><br>
      </div>
      </div>
      
      
      <div class="form-group">
        <div class="col-sm-10">
      <input class="form-control" value="<?php echo (isset($_POST['UrlBase'])) ? $_POST['UrlBase'] : '' ?>" type="text" name="UrlBase" placeholder="Dirección de la web ejemplo http://www.agricontrol.com/"><br>
      </div>
      </div>
      
      
      
      <div class="form-group">
        <div class="col-sm-10">
      <select class="form-control" name="Scope">
        <option value="">Seleccione modo de instalación</option>
        <option value="dev">Desarrollo</option>
        <option value="prod">Producción</option>
      </select>
      </div>
      </div>
      
      <div class="form-group">
        <div class="col-sm-10">
      <select class="form-control" name="idioma">
        <option value="">Seleccione idioma</option>
        <option value="es">Español</option>
        <option value="en">English</option>
      </select><br>
      </div>
      </div>
      
      
      <div class="form-group">
        <div class="col-sm-10">
      <input  class="form-control" value="<?php echo (isset($_POST['FormatTimestamp'])) ? $_POST['FormatTimestamp'] : '' ?>" type="text" name="FormatTimestamp" value="Y-m-d H:i:s" placeholder="Formato de fecha y hora ejemplo Y-m-d H:i:s"><br>
      </div>
      </div>
      
      <div class="form-group">
        <div class="col-sm-10">
      <input class="btn btn-lg btn-primary btn-xs" type="submit" value="Instalar">
    </div>
      </div>
    
    </form>
      
      
      <br><br><br><br><br><br><br>
 
  </div>
  </div>
</div>
  </body>
</html>

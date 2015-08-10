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
    
    <br><br><br><br><br><br>
    
    
    <br>
    <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
        <th colspan="2">  <h1>COMPILACION DE PETICIONES</h1></th>
    <tr>
      <td> PHP 5.4 o superior </td><td><?php echo PHP_VERSION ?></td>
    </tr>
    <tr>
      <td>json </td> <td><?php echo get_loaded_extensions()[array_search('json', get_loaded_extensions())] ?></td>
    </tr>
    <tr>
      <td>PDO </td> <td><?php echo get_loaded_extensions()[array_search('PDO', get_loaded_extensions())] ?></td>
    </tr>
    <tr>
      <td>pdo_pgsql </td><td><?php echo get_loaded_extensions()[array_search('pdo_pgsql', get_loaded_extensions())] ?></td>
    </tr>
    <tr>
     <td> pdo_mysql  </td> <td><?php echo get_loaded_extensions()[array_search('pdo_mysql', get_loaded_extensions())] ?></td>
    </tr>
    <tr>
      <td colspan="2"><a href="index.php?step=2"><h1>Siguiente</h1></a></td>
    </tr>
    </table>
    </div>
     <br><br><br><br><br><br><br><br><br>
 
  </div>
  </div>
</div>
  </body>
</html>

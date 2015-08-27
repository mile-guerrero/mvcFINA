<?php
use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\config\configClass as config ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\i18n\i18nClass as i18n ?>


<header>

  <!--    <nav class="navbar navbar-default alert-success">-->
  <nav class="navbar navbar-default" id="colordelmenu">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button> 
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class=""><a href="<?php echo routing::getInstance()->getUrlWeb('principal', 'index') ?>"><i class="glyphicon glyphicon-home"></i></a></li>
          <li class=""><a id="colorletra" href="<?php echo routing::getInstance()->getUrlWeb('lote', 'indexLote') ?>"><?php echo i18n::__('lote') ?> <span class="sr-only">(current)</span></a></li>
          <li class="dropdown">
            <a href="#" id="colorletra" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18n::__('product') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class=""><a  href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexProductoInsumo') ?>"><?php echo i18n::__('insumo') ?></a></li>
<?php if (session::getInstance()->hasCredential('admin')): ?>
                <li><a  href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexTipoProductoInsumo') ?>"><?php echo i18n::__('tipo insumo') ?></a></li>
<?php endif ?>
              <li class="divider"></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('historial', 'index') ?>"><?php echo i18n::__('historial') ?></a></li>
              <li class="divider"></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexMaquina') ?>"><?php echo i18n::__('maquina') ?></a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a id="colorletra" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18n::__('personas') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
<?php if (session::getInstance()->hasCredential('admin')): ?>
                <li><a  href="<?php echo routing::getInstance()->getUrlWeb('default', 'index') ?>"><?php echo i18n::__('user') ?></a></li>
                <li class="divider"></li>
<?php endif ?>

              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index') ?>"><?php echo i18n::__('trabajador') ?></a></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'indexCliente') ?>"><?php echo i18n::__('cliente') ?></a></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexProveedor') ?>"><?php echo i18n::__('nomProveedor') ?></a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a id="colorletra" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18n::__('documentos') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>"><?php echo i18n::__('pagoTrabajador') ?></a></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', 'index') ?>"><?php echo i18n::__('solicitudInsumo') ?></a></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'index') ?>"><?php echo i18n::__('orden') ?></a></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'index') ?>"><?php echo i18n::__('pedido') ?></a></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('manoObra', 'index') ?>"><?php echo i18n::__('manoObra') ?></a></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('facturaVenta', 'index') ?>"><?php echo i18n::__('factura') ?></a></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('facturaCompra', 'index') ?>"><?php echo i18n::__('facturaCompra') ?></a></li>
              <li class="divider"></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('reportes', 'index') ?>"><?php echo i18n::__('reportes') ?></a></li>
           
            </ul>
          </li>


          <li class="dropdown">
            <a id="colorletra" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18n::__('otros') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <?php if (session::getInstance()->hasCredential('admin')): ?>
                <li><a  href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index') ?>"><?php echo i18n::__('usuarioCredencial') ?></a></li>
              <?php endif ?>
              <?php if (session::getInstance()->hasCredential('admin')): ?>
                <li><a  href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>"><?php echo i18n::__('credencial') ?></a></li>
<?php endif ?>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('cooperativa', 'index') ?>"><?php echo i18n::__('cooperativa') ?></a></li>
              <?php if (session::getInstance()->hasCredential('admin')): ?>
                <li><a  href="<?php echo routing::getInstance()->getUrlWeb('empresa', 'index') ?>"><?php echo i18n::__('empresa') ?></a></li>
<?php endif ?>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('labor', 'index') ?>"><?php echo i18n::__('labor') ?></a></li>
<?php if (session::getInstance()->hasCredential('admin')): ?>
                <li class="divider"></li>
                <li><a  href="<?php echo routing::getInstance()->getUrlWeb('enfermedad', 'index') ?>"><?php echo i18n::__('enfermedad') ?></a></li>
<?php endif ?>
            </ul>
          </li>

          <li class="dropdown">
            <a id="colorletra" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18n::__('subir archivos') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('archivo', 'index') ?>"><?php echo i18n::__('archivo de texto') ?></a></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('imagen', 'index') ?>"><?php echo i18n::__('imagen') ?></a></li>
              <li><a  href="<?php echo routing::getInstance()->getUrlWeb('video', 'index') ?>"><?php echo i18n::__('video') ?></a></li>
            </ul>
          </li>


        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a id="colorletra" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"> <?php echo session::getInstance()->getUserName() ?></i></a>
            <ul class="dropdown-menu" role="menu">
  
              <?php $hash = usuarioTableClass::HASH_IMAGEN ?>
              <?php $extencion = usuarioTableClass::EXTENCION_IMAGEN ?>
                <?php $usuario = usuarioTableClass::USUARIO ?>
              <?php $id = usuarioTableClass::ID ?>
              <?php 
              $fields = array(
          usuarioTableClass::ID,
          usuarioTableClass::USUARIO,
          usuarioTableClass::NOMBRE_IMAGEN,
          usuarioTableClass::EXTENCION_IMAGEN,
          usuarioTableClass::HASH_IMAGEN
      );
      
       $where =
               array(
         usuarioTableClass::USUARIO =>   session::getInstance()->getUserName() 
        );
      $objUsuarios = usuarioTableClass::getAll($fields, true, null, null, null, null, $where);
  ?>
              
<?php foreach ($objUsuarios as $key): ?> 
  <?php
  if ($key->$extencion == 'jpg' and   session::getInstance()->getUserName()  == session::getInstance()->getUserName()) {//para poner icono 
    echo '<img id="margenUsuario" src="' . routing::getInstance()->getUrlImg('../imgUsuario/' . $key->$hash) . '"/>';
  }
  ?> 
              
              <br>
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('default', 'edit',array(usuarioTableClass::ID => $key->$id)) ?>">Modificar perfil</a></li>
              
<?php endforeach; ?>      
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout') ?> "><?php echo i18n::__('cerrarSesion') ?></a></li>
          </li>
        </ul>
        <li class="dropdown">
          <a id="colorletra" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18n::__('idioma') ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'traductor', array('language' => 'es', 'PATH_INFO' => request::getInstance()->getServer('PATH_INFO'), 'QUERY_STRING' => htmlentities(request::getInstance()->getServer('QUERY_STRING')))) ?>"><img class="img-responsive"  id="imgespanol" src="" alt=" "></a></li>
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'traductor', array('language' => 'en', 'PATH_INFO' => request::getInstance()->getServer('PATH_INFO'), 'QUERY_STRING' => htmlentities(request::getInstance()->getServer('QUERY_STRING')))) ?>"><img class="img-responsive"  id="imgingles" src="" alt=" "></a></li>
          </ul>
        </li>
        </ul>


      </div>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->

  </nav>



</header>
<div id="separasdor"> <br></div>


<nav class="encabezado"> 
  <header>
    <div id="carousel-example-generic" class="carousel slide responcive" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        <li data-target="#carousel-example-generic" data-slide-to="4"></li>
        <li data-target="#carousel-example-generic" data-slide-to="5"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="img-responsive"  id="imgPortada" src="" alt="">
          <div class="carousel-caption">

          </div>
        </div>
        <div class="item">
          <img class="img-responsive"  id="imgPortada2" src="" alt="">
          <div class="carousel-caption">

          </div>
        </div>

        <div class="item">
          <img class="img-responsive"  id="imgPortadalogin4" src="" alt="">
          <div class="carousel-caption">

          </div>
        </div>

        <div class="item">
          <img class="img-responsive"  id="imgPortada3" src="" alt="">
          <div class="carousel-caption">

          </div>
        </div>
        
        <div class="item">
          <img class="img-responsive"  id="imgPortada4" src="" alt="">
          <div class="carousel-caption">

          </div>
        </div>
        
        <div class="item">
          <img class="img-responsive"  id="imgPortada5" src="" alt="">
          <div class="carousel-caption">

          </div>
        </div>

      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>


</nav>  

<div id="separasdor"> <br></div>
<div id="separasdor2"> <br></div>

<section  navbar-header id="contenido">

  <!--  <div class="btn-group-vertical" role="group" aria-label="...">
      <button type="button" class="btn btn-default">1</button>
      <button type="button" class="btn btn-default">2</button>
  
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          Dropdown
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#">Dropdown link</a></li>
          <li><a href="#">Dropdown link</a></li>
          <li><a href="#">Dropdown link</a></li>
        </ul>
      </div>
    </div>-->

</section>






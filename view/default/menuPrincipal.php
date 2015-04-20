<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\i18n\i18nClass as i18 ?>

<header>
    
    <nav class="navbar navbar-default alert-success">
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
          <li class=""><a href="<?php echo routing::getInstance()->getUrlWeb('lote', 'indexLote') ?>"><?php echo i18::__('lote') ?> <span class="sr-only">(current)</span></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18::__('product') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class=""><a href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexProductoInsumo') ?>"><?php echo i18::__('insumo') ?></a></li>
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexTipoProductoInsumo') ?>"><?php echo i18::__('tipo insumo') ?></a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18::__('personas') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'indexCliente') ?>"><?php echo i18::__('cliente') ?></a></li>
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexProveedor') ?>"><?php echo i18::__('nomProveedor') ?></a></li>
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>"><?php echo i18::__('credencial') ?></a></li>
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('default', 'index') ?>"><?php echo i18::__('user') ?></a></li>
              <li class="divider"></li>
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexMaquina') ?>"><?php echo i18::__('maquina') ?></a></li>
              <li class="divider"></li>
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'index') ?>"><?php echo i18::__('orden') ?></a></li>
            </ul>
          </li>


          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18::__('otros') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
               <li class="divider"></li>
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index') ?>"><?php echo i18::__('usuarioCredencial') ?></a></li>
            </ul>
          </li>


          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18::__('documentos') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index') ?>"><?php echo i18::__('trabajador') ?></a></li>
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>"><?php echo i18::__('pagoTrabajador') ?></a></li>
              <li><a href="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', 'index') ?>"><?php echo i18::__('solicitudInsumo') ?></a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>


        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><i class="glyphicon glyphicon-user"> <?php echo session::getInstance()->getUserName() ?></i></a></li>
          <li><a href="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout') ?> "><?php echo i18::__('cerrarSesion') ?></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18::__('idioma') ?><span class="caret"></span></a>
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




<nav class="encabezado"> 
  <header>
<div id="carousel-example-generic" class="carousel slide responcive" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img class="img-responsive"  id="imgPortada" src="" alt="portada1">
        <div class="carousel-caption">

        </div>
      </div>
      <div class="item">
        <img class="img-responsive"  id="imgPortada2" src="" alt="portada2">
        <div class="carousel-caption">

        </div>
      </div>
      
      <div class="item">
        <img class="img-responsive"  id="imgPortadalogin4" src="" alt="portada2">
        <div class="carousel-caption">

        </div>
      </div>
      
      <div class="item">
        <img class="img-responsive"  id="imgPortada3" src="" alt="portada3">
        <div class="carousel-caption">

        </div>
      </div>
      <div class="item">
        <img class="img-responsive"  id="imgPortada4" src="" alt="portada3">
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




<section id="contenido">
  
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
  <article id=''>

  </article>
</section>






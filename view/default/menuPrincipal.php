<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\request\requestClass as request ?>
  <header>
   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
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




<nav class=""> 
       
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
        <li class=""><a href="<?php echo routing::getInstance()->getUrlWeb('lote', 'indexLote') ?>">Lote <span class="sr-only">(current)</span></a></li>
        <li class=""><a href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexProductoInsumo') ?>">Insumo</a></li>
       
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Personas <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'indexCliente') ?>">Cliente</a></li>
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>">Credencial</a></li>
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('default', 'index') ?>">Usuario</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexMaquina') ?>">Maquina</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'index') ?>">Orden Servicio</a></li>
          </ul>
        </li>
        
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">otros <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'indexTipoId') ?>">tipoId</a></li>
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexTipoProductoInsumo') ?>">tipoProductoInsumo</a></li>
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexTipoUsoMaquina') ?>">tipoUsoMaquina</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexOrigenMaquina') ?>">origen</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index') ?>">usuario Credencial</a></li>
          </ul>
        </li>
        
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexProveedor') ?>">Proveedor</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        
        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout') ?> ">cerrar cesion</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Idioma<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            
          <div style=" margin: 10px 10px 10px 38px ;">
  <form id="frmTraductor" action="<?php echo routing::getInstance()->getUrlWeb('cliente', 'traductor')?>" method="POST">
    <select name="language" onchange="$('#frmTraductor').submit()">
    <option <?php echo (config::getDefaultCulture() == 'es') ? 'selected' : '' ?> value="es">Español</option>
    <option <?php echo (config::getDefaultCulture() == 'en') ? 'selected' : '' ?> value="en">English</option>
  </select>
    <input type="hidden" name="PATH_INFO" value="<?php echo request::getInstance()->getServer('PATH_INFO')?>">
</form>
  </div>
          
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  
</nav>

</nav>  

  
 

<section id="contenido">
  
  <div class="btn-group-vertical" role="group" aria-label="...">
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
</div>


  <article id=''>

  </article>
</section>




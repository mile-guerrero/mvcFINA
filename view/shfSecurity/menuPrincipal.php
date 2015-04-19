<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\i18n\i18nClass as i18n?>
<!--<header>
   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
   Indicators 
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

   Wrapper for slides 
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img class="img-responsive"  id="imgPortadalogin4" src="" alt="portada1">
      <div class="carousel-caption">
      
      </div>
    </div>
    
	
  
  </div>

   Controls 
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

    
    
    
    
    
     Collect the nav links, forms, and other content for toggling 
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        
        <li class="dropdown">
         
        </li>
        
        
        <li class="dropdown">
          
        </li>
        
        
        <li class="dropdown">
          
        </li>
        
        
        <li class="dropdown">
          
        </li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><?php echo i18n::__('crearCuenta') ?></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18n::__('idioma') ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <a href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'traductor', array('language' => 'es', 'PATH_INFO' => request::getInstance()->getServer('PATH_INFO'), 'QUERY_STRING' => htmlentities(request::getInstance()->getServer('QUERY_STRING')) ))?>"><img class="img-responsive"  id="imgespanol" src="" alt=" "></a>
            <a href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'traductor', array('language' => 'en', 'PATH_INFO' => request::getInstance()->getServer('PATH_INFO'), 'QUERY_STRING' => htmlentities(request::getInstance()->getServer('QUERY_STRING')) ))?>"><img class="img-responsive"  id="imgingles" src="" alt=" "></a>
 
          </ul>
        </li>
      </ul>
    </div> /.navbar-collapse 
  </div> /.container-fluid 
  
</nav>

</nav>  

  
 

<section id="">
  
  


  <article id=''>

  </article>
</section>-->


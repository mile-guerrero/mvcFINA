
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\i18n\i18nClass as i18 ?>


<div class="responcive barraCorrediza">
  <nav class="navbar navbar-default " id="color1">
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
          <form id="formulario1" class="form-horizontal" role="form" action="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'login') ?>" method="POST">

            <div class="form-group"> 
              <div class="col-sm-10" id="letra">
                <a class="form-signin-heading" id="crear" href="<?php echo routing::getInstance()->getUrlWeb('crearUsuario', 'insert') ?>"><?php echo   i18::__('crearUsuario')?></a>
                
                <label  class="form-signin-heading"><?php echo i18n::__('identificacion') ?></label> 
                <label for="inputUser" class="sr-only">Email address</label>
                <input class="form-control-gonza1" type="text" id="inputUser" name="inputUser" class="form-control" placeholder="<?php echo i18n::__('user') ?>" required autofocus>
<!--                <label for="inputPassword" class="sr-only">Password</label>-->
                <input class="form-control-gonza2" type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="<?php echo i18n::__('pass') ?>" required>
                <input class="goncho1" type="checkbox" value="true" name="chkRememberMe"> <?php echo i18n::__('recordar') ?>
                <input  class="goncho2" type="submit" <?php echo i18n::__('entrar') ?> >

              </div>      
            </div>

            <?php if (session::getInstance()->hasError() or session::getInstance()->hasInformation() or session::getInstance()->hasSuccess() or session::getInstance()->hasWarning()): ?>
              <?php view::includeHandlerMessage() ?>
            <?php endif ?>

          </form> 
        </ul>
      </div>
    </div>
    
    
  </nav>




<div id="separasdor"> <br></div>


    <div class="container-fluid" id="Logeo">        
<!--      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">&nbsp;</div>-->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><img class="img-responsive"  id="imgLogo"  alt=" "></div>
    </div>


<div id="separasdor1"> <br></div>
<div id="separasdor2"> <br></div>


<header id="encabezado">
  <div id="carousel-example-generic" class="carousel slide responcive" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      <li data-target="#carousel-example-generic" data-slide-to="3"></li>
      <li data-target="#carousel-example-generic" data-slide-to="4"></li>
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
     </div>



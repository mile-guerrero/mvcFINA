<?php mvc\view\viewClass::includePartial('shfSecurity/menuPrincipal') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\i18n\i18nClass as i18n ?>

 <div class="container container-fluid" id="cuerpoLogeo">
  <header id="encabezado">
   
 <form class="form-horizontal" role="form" action="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'login') ?>" method="POST">

      <div class="form-group"> 
        <div class="col-sm-10">
          <label class="form-signin-heading"><?php echo i18n::__('identificacion') ?></label> 
          <label for="inputUser" class="sr-only">Email address</label>
          <input class="form-control-gonza1" type="text" id="inputUser" name="inputUser" class="form-control" placeholder="<?php echo i18n::__('user') ?>" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input class="form-control-gonza2" type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="<?php echo i18n::__('pass') ?>" required>
          <input class="goncho1" type="checkbox" value="true" name="chkRememberMe"> <?php echo i18n::__('recordar') ?>
          <input  class="goncho2" type="submit" <?php echo i18n::__('entrar') ?> >
          
        </div>      
      </div>
      
      <?php if (session::getInstance()->hasError() or session::getInstance()->hasInformation() or session::getInstance()->hasSuccess() or session::getInstance()->hasWarning()): ?>
        <?php view::includeHandlerMessage() ?>
      <?php endif ?>
      
       </form>          


  </article>

</div>

  </header>
  <nav id="barramenu">


  </nav>
  <section id="contenido">
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
  </section>
  <article id='derecha'>

    <!-- /container -->
      
<!--          <div class="checkbox">
            <label>
              <input  type="checkbox" value="true" name="chkRememberMe"> <?php echo i18n::__('recordar') ?> 
            </label> 
            <button  class="btn btn-lg btn-primary btn-block-gonzalo1" type="submit"><?php echo i18n::__('entrar') ?></button> 
          
          </div>-->
            

      
   
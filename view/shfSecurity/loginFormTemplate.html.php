<?php mvc\view\viewClass::includePartial('shfSecurity/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<div class="container container-fluid" id="cuerpoLogeo">
 
  <header id="encabezado">

    
  </header>
  <nav id="barramenu">
 
  
  </nav>
  <section id="contenido">

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  
   </section>
    <article id='derecha'>
       
 <form class="form-signin" role="form" action="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'login') ?>" method="POST">
    <h2 class="form-signin-heading"><?php echo i18n::__('identificacion') ?></h2>
    <label for="inputUser" class="sr-only">Email address</label>
    <input type="text" id="inputUser" name="inputUser" class="form-control" placeholder="<?php echo i18n::__('user') ?>" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="<?php echo i18n::__('pass') ?>" required>
    <div class="checkbox">
      <label>
        <input type="checkbox" value="true" name="chkRememberMe"> <?php echo i18n::__('recordar') ?>
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo i18n::__('entrar') ?></button>
    <?php if (session::getInstance()->hasError() or session::getInstance()->hasInformation() or session::getInstance()->hasSuccess() or session::getInstance()->hasWarning()): ?>
    <?php view::includeHandlerMessage() ?>
    <?php endif ?>
  </form>          
        

    </article>
 
</div> <!-- /container -->
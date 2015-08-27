<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>


<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo4">
  <div class="center-block" id="cuerpo2">
  <header id="">

  </header>
  <nav id=""> 

  </nav>
  <section id=""></section>
  <article id='derecha'>

    <h3></h3>       
  </article>
 
  <article id='derecha'>
    <br>
    <br>
    <br>
    <br>
    <br>
    <form enctype="multipart/form-data"  class="form-horizontal"  class="form-horizontal" role="form"  method="post" action="<?php echo routing::getInstance()->getUrlWeb('imagen', ((isset($objUsuarios)) ? 'update' : 'index')) ?>">
  
 <?php view::includeHandlerMessage()?> 
  
  
  <div class="form-group">
      <label for="" class="col-sm-2"> <?php echo i18n::__('subir imagen') ?>:</label>     
      <div class="col-sm-10">
               <input class="form-control"  value=""  type="file" name="<?php echo imagenTableClass::getNameField(imagenTableClass::NOMBRE, true) ?>" required>
     </div>
  </div>  
  
 
  
    
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objImagen)) ? 'update' : 'register')) ?>">
   
<a class="btn btn-lg btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('imagen', 'ver') ?>" ><?php echo i18n::__('ver') ?></a>
   
   
   
  </form>
   <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  </article>
  </div>
  </div>
 </div>
  </div>

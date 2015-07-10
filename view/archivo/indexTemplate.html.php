<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>


<div class="container container-fluid" id="cuerpo">
  <header id="">

  </header>
  <nav id=""> 

  </nav>
  <section id=""></section>
  <article id='derecha'>

    <h3></h3>       
  </article>
 
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
    <form enctype="multipart/form-data"  class="form-horizontal"  class="form-horizontal" role="form"  method="post" action="<?php echo routing::getInstance()->getUrlWeb('archivo', ((isset($objUsuarios)) ? 'update' : 'index')) ?>">
  
 
  
  <?php view::includeHandlerMessage()?> 
  <div class="form-group">
      <label for="" class="col-sm-2"> <?php echo i18n::__('subir archivos') ?>:</label>     
      <div class="col-sm-10">
        <input class="form-control"  value=""  type="file" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USUARIO, true) ?>" required>
     </div>
  </div>  
  
 
  
    
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objUsuarios)) ? 'update' : 'register')) ?>">
   <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('archivo', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
   <a class="btn btn-lg btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('archivo', 'ver') ?>" ><?php echo i18n::__('ver') ?></a>
   
   
  </form>
  </article>
  
  </div>
 
<!--<div>
 <?php
  if ($directorio = opendir("./uploadArchivo")){ //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if ($archivo != '.' && $archivo != '..')//verificamos si es o no un directorio
    {
     echo "Archivo: <strong>  $archivo </strong><br />" ; 
       }

     }
  
    }
  ?>
</div>-->

<!--<p>Cargando en un iframe<br />
<a href="pdf/pdf.php?archivo=Sqlite" target="visor">ver pdf</a>
</p>
<iframe name="visor" width="600" height="400" src="about:blank"></iframe>-->
  </div>

<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = manoObraTableClass::ID ?>
<?php $cantidad = manoObraTableClass::CANTIDAD_HORA ?>
<?php $valor = manoObraTableClass::VALOR_HORA ?>
<?php $created_at = manoObraTableClass::CREATED_AT ?>
<?php $updated_at = manoObraTableClass::UPDATED_AT ?>
<?php $idCooperativa = manoObraTableClass::COOPERATIVA_ID ?>
<?php $idLabor = manoObraTableClass::LABOR_ID ?>
<?php $idMaquina = manoObraTableClass::MAQUINA_ID ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo6">
  <div class="center-block" id="cuerpo2">
  <header id="">
  </header>

  <nav id="">
  </nav>
  <section id="contenido">

  </section>

  <article id='derecha'>  
    <br><br>
        <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('manoObra', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
        <br>
        <br>
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objManoObra as $key): ?>
            
            <tr>
            <td><?php echo i18n::__('cooperativa') ?></td>       
          <td><?php echo cooperativaTableClass::getNameCooperativa($key->$idCooperativa) ?></td>
          </tr>
            <tr>
               <td><?php echo i18n::__('labor') ?></td>   
              <td><?php echo laborTableClass::getNameLabor($key->$idLabor) ?></td>
            </tr>
            <tr>
              <td><?php echo i18n::__('maquina') ?></td>      
              <td><?php echo maquinaTableClass::getNameMaquina($key->$idMaquina) ?></td>
            </tr>
            <tr>
             <td><?php echo i18n::__('cantidad') ?></td>    
              <td><?php echo $key->$cantidad ?></td>
            </tr>
            <tr>
            <td><?php echo i18n::__('valor') ?></td>   
              <td><?php echo $key->$valor ?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
      </table>
      </div>
  </div>
    <br><br><br><br><br><br><br><br><br><br><br>
</div>
  
 </div>

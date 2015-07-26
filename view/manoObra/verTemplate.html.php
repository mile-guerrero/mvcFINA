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
        <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('manoObra', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
        <br>
        <br>
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objManoObra as $key): ?>
            <tr>
              <th>cantidad</th>      
              <td><?php echo $key->$cantidad ?></td>
            </tr>
            <tr>
              <th> valor</th>      
              <td><?php echo $key->$valor ?></td>
            </tr>
            
<?php endforeach; ?>
             <?php foreach ($objManoObra as $cooperativa): ?>
          <tr>
          <th>Trabajador</th>      
          <td><?php echo cooperativaTableClass::getNameCooperativa($cooperativa->$idCooperativa) ?></td>
          </tr>
<?php endforeach; ?>
            
             <?php foreach ($objManoObra as $labor): ?>
            <tr>
              <th>Insumo</th>      
              <td><?php echo laborTableClass::getNameLabor($labor->$idLabor) ?></td>
            </tr>
            
<?php endforeach; ?>
            
   
             <?php foreach ($objManoObra as $maquina): ?>
            <tr>
              <th>Maquina</th>      
              <td><?php echo maquinaTableClass::getNameMaquina($maquina->$idMaquina) ?></td>
            </tr>
            
<?php endforeach; ?>
            
        </tbody>
      </table>

  </div>
    <br><br>
</div>
  
 </div>

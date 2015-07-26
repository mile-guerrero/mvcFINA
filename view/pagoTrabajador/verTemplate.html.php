<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $fechaIni = pagoTrabajadorTableClass::FECHA_INICIAL ?>
<?php $fechaFin = pagoTrabajadorTableClass::FECHA_FINAL ?>
<?php $idEmpresa = pagoTrabajadorTableClass::EMPRESA_ID?>
<?php $idTrabajador = pagoTrabajadorTableClass::TRABAJADOR_ID ?>
<?php $valor = pagoTrabajadorTableClass::VALOR_SALARIO ?>
<?php $cantidad = pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS?>
<?php $valorHoras = pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS ?>
<?php $horas = pagoTrabajadorTableClass::HORAS_PERDIDAS?>
<?php $total = pagoTrabajadorTableClass::TOTAL_PAGAR ?>

<?php $id = pagoTrabajadorTableClass::ID ?>


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
       <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
        <br><br> 
       
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objPT as $key): ?>
             <tr> 
              <th><?php echo i18n::__('valor') ?></th>                   
              <td><?php echo $key->$valor ?></td>
            </tr>
            <tr>
              <th><?php echo i18n::__('cantidad') ?></th> 
              <td><?php echo $key->$cantidad ?></td>
            </tr>
             <tr> 
              <th><?php echo i18n::__('horasExtras') ?></th>                   
              <td><?php echo $key->$valorHoras ?></td>
            </tr>
            <tr>
              <th><?php echo i18n::__('horasPerdidas') ?></th> 
              <td><?php echo $key->$horas ?></td>
            </tr>
             <tr> 
              <th><?php echo i18n::__('totalPagar') ?></th>                   
              <td><?php echo $key->$total ?></td>
            </tr>

<?php endforeach; ?>
            
<?php foreach ($objPT as $empresa): ?>
          <tr>
          <th>Empresa</th>      
          <td><?php echo empresaTableClass::getNameEmpresa($empresa->$idEmpresa) ?></td>
          </tr>
          
<?php endforeach; ?>
          
          <?php foreach ($objPT as $trabajador): ?>
          <tr>
          <th>Trabajador</th>      
          <td><?php echo trabajadorTableClass::getNameTrabajador($trabajador->$idTrabajador) ?></td>
          </tr>
          
<?php endforeach; ?>
        </tbody>
      </table>
    </article>
  </div>
    <br><br>
</div>
  
 </div> 


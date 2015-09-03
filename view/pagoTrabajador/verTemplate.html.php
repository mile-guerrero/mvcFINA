<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $fechaIni = pagoTrabajadorTableClass::FECHA_INICIAL ?>
<?php $fechaFin = pagoTrabajadorTableClass::FECHA_FINAL ?>
<?php $idEmpresa = pagoTrabajadorTableClass::EMPRESA_ID?>
<?php $idTrabajador = pagoTrabajadorTableClass::TRABAJADOR_ID ?>
<?php $valor = pagoTrabajadorTableClass::VALOR_SALARIO ?>
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
       <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
        <br><br> 
       
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objPT as $key): ?>
           <tr>
          <td><?php echo i18n::__('empresa') ?></td> 
          <td><?php echo empresaTableClass::getNameEmpresa($key->$idEmpresa) ?></td>
          </tr>
          <tr>
         <td><?php echo i18n::__('trabajador') ?></td>   
          <td><?php echo trabajadorTableClass::getNameTrabajador($key->$idTrabajador) ?></td>
          </tr>
          
             <tr> 
              <td><?php echo i18n::__('valor') ?></td>                   
              <td><?php echo '$' . number_format($key->$valor, 0, ',', '.') ?></td>
            </tr>
           
            <tr>
              <td><?php echo i18n::__('horasPerdidas') ?></td> 
              <td><?php echo '$' . number_format($key->$horas, 0, ',', '.') ?></td>
            </tr>
             <tr> 
              <td><?php echo i18n::__('totalPagar') ?></td>                   
              <td><?php echo '$' . number_format($key->$total, 0, ',', '.') ?></td>
            </tr>

<?php endforeach; ?>


        </tbody>
      </table>
        </div>
    </article>
  </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
  
 </div> 


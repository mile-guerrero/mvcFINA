<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\request\requestClass as request ?>
<?php $id = detallePagoTrabajadorTableClass::ID ?>
<?php $salario = detallePagoTrabajadorTableClass::VALOR_SALARIO ?>
<?php $cantHoras = detallePagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS ?>
<?php $valorHoras = detallePagoTrabajadorTableClass::VALOR_HORAS_EXTRAS ?>
<?php $horas = detallePagoTrabajadorTableClass::HORAS_PERDIDAS ?>
<?php $total = detallePagoTrabajadorTableClass::TOTAL_PAGAR ?>
<?php $pago = detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID ?>
<?php $idPago = pagoTrabajadorTableClass::ID ?>
<?php $idTrabajador = detallePagoTrabajadorBaseTableClass::TRABAJADOR_ID ?>
<?php $nomTrabajador = trabajadorTableClass::NOMBRET ?>
<?php $idEmpresa = empresaTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
  <article id="derecha">
    <table class="table table-bordered table-responsive">
      <tr>
      <thead>
      <th colspan="2"><?php echo i18n::__('datos') ?></th>
      </thead>
      </tr>
      <tbody>
        <?php foreach ($objDPT as $pagoT): ?>
          <tr>
            <th>Pago Trabajador</th>      
            <td><?php echo pagoTrabajadorTableClass::getNamePagoTrabajador($pagoT->$pago) ?></td>
          </tr>

<?php endforeach; ?>
      </tbody>
    </table>
  </article>
</div>


<div class="container container-fluid" id="cuerpo">
  <header id="">

  </header>
  <nav id="">

  </nav>
  <section id="">

  </section>
  <article id='derecha'>

    <h1><?php echo i18n::__('detallePago') ?></h1> 
    <ul>      
      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detallePagoTrabajador', 'insert', array(detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID, true) => request::getInstance()->getGet(detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID, true)))) ?>"><?php echo i18n::__('nuevo') ?></a> 
      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFiltres"><?php echo i18n::__('filtros') ?></button>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('detallePagoTrabajador', 'index') ?>" class="btn btn-default btn-xs" ><?php echo i18n::__('eFiltros') ?></a>             
    </ul> 


    <!-- Modal -->



    <form class="form-signin">        
<?php view::includeHandlerMessage() ?>        
      <table class="table table-bordered table-responsive">
        <thead>
          <tr>
            <th>
              Trabajador
            </th>
            <th>
              Cantidad
            </th>
            <th>
              Horas Extras
            </th>
            <th>
              Perdidas
            </th>
            <th>
              Total
            </th>
            <th>
              Salario
            </th>
            <th>
          <?php echo i18n::__('acciones') ?>
            </th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($objDPT as $key): ?>
            <tr>
              <td>
                <?php echo trabajadorTableClass::getNameTrabajador($key->$idTrabajador) ?>
              </td>                          
              <td>
                <?php echo $key->$salario ?>
              </td>
              <td>
                <?php echo $key->$cantHoras ?>
              </td>
              <td>
                <?php echo $key->$valorHoras ?>
              </td>
              <td>
                <?php echo $key->$horas ?>
              </td>
              <td>
               <?php echo $key->$total ?>
              </td>
              <td>
                <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detallePagoTrabajador', 'ver', array(detallePagoTrabajadorTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a>
                <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detallePagoTrabajador', 'edit' , array(detallePagoTrabajadorTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?></a>
              </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </form> 
    <div class="text-right">
      Pagina <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('detallePagoTrabajador', 'index') ?>')">
<?php for ($x = 1; $x <= $cntPages; $x++): ?>
          <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
<?php endfor; ?>
      </select> <?php echo i18n::__('of') ?> <?php echo $cntPages ?>
    </div>
  </article>
</div>




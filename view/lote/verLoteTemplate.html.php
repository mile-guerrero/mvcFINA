<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = loteTableClass::ID ?>
<?php $ubicacion = loteTableClass::UBICACION ?>
<?php $descripcion = loteTableClass::DESCRIPCION ?>
<?php $tamano = loteTableClass::TAMANO ?>
<?php $fechaS = loteTableClass::FECHA_INICIO_SIEMBRA ?>
<?php $fechaRiego = loteTableClass::FECHA_RIEGO ?>
<?php $numeroP = loteTableClass::NUMERO_PLANTULAS ?>
<?php $presu = loteTableClass::PRESUPUESTO ?>
<?php $produccion = loteTableClass::PRODUCCION ?>
<?php $nombre_ciudad = loteTableClass::ID_CIUDAD ?>
<?php $nombreInsumo = loteTableClass::PRODUCTO_INSUMO_ID ?>
 <?php $desUnidadMedida = loteTableClass::UNIDAD_MEDIDA_ID ?>
 <?php $desUnidadDis = loteTableClass::UNIDAD_DISTANCIA_ID ?>

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
      <a class="btn btn-success btn-xs " href="<?php echo routing::getInstance()->getUrlWeb('lote', 'indexLote') ?>" > <?php echo i18n::__('atras') ?></a>
      <br><br>
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objLote as $key): ?>
            <tr>
              <td><?php echo i18n::__('ubicacion') ?></td>      
              <td><?php echo $key->$ubicacion ?></td>
            </tr>
            <tr>
              <td><?php echo i18n::__('ciudad') ?></td>      
              <td><?php echo ciudadTableClass::getNameCiudad($key->$nombre_ciudad) ?></td>
            </tr>
           
             <tr>
              <td><?php echo i18n::__('tamano') ?></td>      
              <td>
             <?php if (($key->$desUnidadDis) === null){        
               echo $key->$tamano .' '.'La unidad de distancia no fue seleccionada';
             }else{
                echo $key->$tamano .' '. unidadDistanciaTableClass::getNameUnidadDistancia($key->$desUnidadDis);
             }
               ?>   
              </td>
            </tr>
            <tr>
              <td><?php echo i18n::__('des') ?></td>      
              <td><?php echo $key->$descripcion ?></td>
            </tr>
            
            <tr>
              <td><?php echo i18n::__('fecha siembra') ?></td>      
              <td><?php echo $key->$fechaS ?></td>
            </tr>
            <tr>
              <td><?php echo i18n::__('numero') ?></td>      
              <td><?php echo $key->$numeroP ?></td>
            </tr>
            <tr>
              <td><?php echo i18n::__('insumo') ?></td>      
              <td>
                <?php if (($key->$nombreInsumo) === null){        
               echo 'El insumo  no fue seleccionado';
             }else{
                echo  productoInsumoTableClass::getNameProductoInsumo($key->$nombreInsumo);
             }
               ?>
              </td>
            </tr>
            
            <tr>
              <td><?php echo i18n::__('presupuesto') ?></td>      
              <td><?php echo $key->$presu ?></td>
            </tr>
            <tr>
              <td><?php echo i18n::__('fecha riego') ?></td>      
              <td><?php echo $key->$fechaRiego ?></td>
            </tr>
            <tr>
              <td><?php echo i18n::__('produccion') ?></td>      
              <td>
             <?php if (($key->$desUnidadMedida) === null){        
               echo $key->$produccion .' '.'La unidad de peso no fue seleccionada';
             }else{
                echo $key->$produccion .' '. unidadMedidaTableClass::getNameUnidadMedida($key->$desUnidadMedida);
             }
               ?>   
              </td>
            </tr>
            
         
<?php endforeach; ?>
      
        </tbody>
      </table>
      </div>
    </article>

</div>
    <br><br>
</div>
  
 </div> 
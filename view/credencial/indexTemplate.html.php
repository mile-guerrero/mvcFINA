<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $nom = credencialTableClass::NOMBRE ?>
<?php $id = credencialTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
   
  </header>
  <nav id="">
   
  </nav>
  <section id="">
    
      </section>
    <article id='derecha'>
      
      <h1><?php echo i18n::__('credencial') ?></h1> 
       <ul>      
      <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'insert') ?>"><?php echo i18n::__('nuevo') ?></a> <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" id="btnDeleteMasivo"><?php echo i18n::__('eliminar en masa') ?> </a> <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFiltres"><?php echo i18n::__('filtros') ?></button>  <a href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>" class="btn btn-default btn-xs" ><?php echo i18n::__('eFiltros') ?></a> <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'report') ?>"><?php echo i18n::__('informe') ?></a>            
    </ul> 


    <!-- Modal -->
    <div class="modal fade" id="myModalFiltres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>" method="POST">
              <div class="form-group">
                <label for="filterNombre" class="col-sm-2 control-label"><?php echo i18n::__('nom') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filterNombre" name="filter[nombre]" placeholder="Nombre">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="filterFechaIni" name="filter[fechaIni]" >
                </div>
              </div>

              <div class="form-group">
                <label  class="col-sm-2 control-label"><?php echo i18n::__('fecha fin') ?></label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="filterFechaFin" name="filter[fechaFin]" >
                </div>
              </div>

            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
            <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary"><?php echo i18n::__('filtrar') ?></button>
          </div>
        </div>
      </div>
    </div>             
    
      <form class="form-signin" id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('credencial', 'deleteSelect') ?>" method="POST">        
        <?php view::includeHandlerMessage()?>
      <table class="table table-bordered table-responsive">
          <tr>
          <thead>
          <th>
            <input type="checkbox" id="chkAll">
          </th>
          <th>
            <?php echo i18n::__('nom') ?>
          </th>              
          <th>
<?php echo i18n::__('aciones') ?>
          </th>              
          </tr>
          </thead>
          <tbody>
<?php foreach ($objCredencial as $key): ?>
              <tr>
                <th>
                  <input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>">
                </th>
                <th>
  <?php echo $key->$nom ?>
                </th>

                <th>
                  <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'ver', array(credencialTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a> - <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'edit', array(credencialTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?></a>- <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"><?php echo i18n::__('eliminar') ?></a>
                </th>
 </tr>
  <div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmar eliminar') ?></h4>
      </div>
      <div class="modal-body">
        <?php echo i18n::__('Desea  eliminar este campo') ?> <?php echo $key->$nom ?><?php echo i18n::__('?') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $key->$id ?>,'<?php echo credencialTableClass::getNameField(credencialTableClass::ID, true) ?>','<?php echo routing::getInstance()->getUrlWeb('credencial', 'delete') ?>')"><?php echo i18n::__('eliminar') ?></button>
      </div>
    </div>
  </div>
</div> 

<?php endforeach; ?>
          </tbody>
        </table>
      </form> 
      <div class="text-right">
        Pagina <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('credencial', 'index')?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected': '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
      </div>
      <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('credencial', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo credencialTableClass::getNameField(credencialTableClass::ID, true) ?>">
      </form>

    </article>

</div>

<div class="modal fade" id="myModalDeleteMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('eliminar en masa') ?></h4>
      </div>
      <div class="modal-body">
        <?php echo i18n::__('eliminar en masa') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
        <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('eliminar') ?></button>
      </div>
    </div>
  </div>
</div>


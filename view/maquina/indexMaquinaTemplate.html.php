<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session?>

<?php $id = maquinaTableClass::ID ?>
<?php $nombre = maquinaTableClass::NOMBRE ?>
<?php $idorigen= origenMaquinaTableClass::ID ?>
<?php $desorigen= origenMaquinaTableClass::DESCRIPCION ?>
<?php $idtipo= tipoUsoMaquinaTableClass::ID ?>
<?php $destipo= tipoUsoMaquinaTableClass::DESCRIPCION ?>
<?php $idpro= proveedorTableClass::ID ?>
<?php $despro= proveedorTableClass::NOMBREP ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
    
  </header>
  <nav id="">
               

  </nav>
  <section id="">
     </section>
     <article id='derecha'>
<h1><?php echo i18n::__('maquina') ?></h1>
       <ul>
      <?php if(session::getInstance()->hasCredential('admin')):?>
      <a class="btn  btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'insertMaquina') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('nuevo') ?></a> 
      <a href="javascript:eliminarMasivo()" class="btn  btn-xs" id="btnDeleteMasivo"><img class="img-responsive"  id="imgmasivo" src="" alt=" "><?php echo i18n::__('eliminar en masa') ?></a> 
      <?php endif?>
      <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalFiltres"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexMaquina') ?>" class="btn btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a> 
      <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>           
   </ul> 
<!---Informes--->
       <div class="modal fade" id="myModalReport" tabindex="-1" role="modal" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('informe') ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('maquina', 'reportMaquina')?>">
          <div class="form-group">
    <label for="reportNombre" class="col-sm-2 control-label"><?php echo i18n::__('nom') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="reportNombre" name="report[nombre]" placeholder="Nombre">
    </div>
  </div>
           
  <div class="form-group">
    <label for="filterCiudad" class="col-sm-2 control-label"><?php echo i18n::__('origenM') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="filterCiudad" name="filter[origen]">
        <option value=""><?php echo i18n::__('selectOrigen') ?></option>
<?php foreach ($objMOM as $ciudad): ?>
            <option value="<?php echo $ciudad->$idorigen ?>"><?php echo $ciudad->$desorigen ?></option>
<?php endforeach; ?>
          </select>
    </div>
  </div>
    
  <div class="form-group">
    <label for="filterCiudad" class="col-sm-2 control-label"><?php echo i18n::__('tipo uso') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="filterCiudad" name="filter[tipo]">
        <option value=""><?php echo i18n::__('selectTipoUso') ?></option>
<?php foreach ($objMTUM as $ciudad): ?>
            <option value="<?php echo $ciudad->$idtipo ?>"><?php echo $ciudad->$destipo ?></option>
<?php endforeach; ?>
          </select>
    </div>
  </div>            
            
   <div class="form-group">
    <label for="filterCiudad" class="col-sm-2 control-label"><?php echo i18n::__('nomProveedor') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="filterCiudad" name="filter[proveedor]">
        <option value=""><?php echo i18n::__('selectProveedor') ?></option>
<?php foreach ($objMP as $ciudad): ?>
            <option value="<?php echo $ciudad->$idpro ?>"><?php echo $ciudad->$despro ?></option>
<?php endforeach; ?>
          </select>
    </div>
  </div>         
          
          
  <div class="form-group">
    <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="reportFecha1" name="report[fecha1]">
      <br>
       <input type="date" class="form-control" id="reportFecha2" name="report[fecha2]">
    </div>
  </div>
</form>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn btn-xs" data-dismiss="modal">  <?php echo i18n::__('cerrar') ?></button>
        <button type="button" onclick="$('#reportForm').submit()" class="btn btn-warning btn btn-xs"><?php echo i18n::__('informe') ?></button>
      </div>
    </div>
  </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="myModalFiltres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexMaquina') ?>" method="POST">

              <div class="form-group">
                <label for="filterNombre" class="col-sm-2 control-label"><?php echo i18n::__('nom') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filterNombre" name="filter[nombre]" placeholder="<?php echo i18n::__('nom') ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="filterDescripcion" class="col-sm-2 control-label"><?php echo i18n::__('des') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filterDescripcion" name="filter[descripcion]" placeholder="<?php echo i18n::__('des') ?>">
                </div>
              </div>
              
<div class="form-group">
    <label for="filterCiudad" class="col-sm-2 control-label"><?php echo i18n::__('origenM') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="filterCiudad" name="filter[origen]">
        <option value=""><?php echo i18n::__('selectOrigen') ?></option>
<?php foreach ($objMOM as $ciudad): ?>
            <option value="<?php echo $ciudad->$idorigen ?>"><?php echo $ciudad->$desorigen ?></option>
<?php endforeach; ?>
          </select>
    </div>
  </div>
    
  <div class="form-group">
    <label for="filterCiudad" class="col-sm-2 control-label"><?php echo i18n::__('tipo uso') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="filterCiudad" name="filter[tipo]">
        <option value=""><?php echo i18n::__('selectTipoUso') ?></option>
<?php foreach ($objMTUM as $ciudad): ?>
            <option value="<?php echo $ciudad->$idtipo ?>"><?php echo $ciudad->$destipo ?></option>
<?php endforeach; ?>
          </select>
    </div>
  </div>            
            
   <div class="form-group">
    <label for="filterCiudad" class="col-sm-2 control-label"><?php echo i18n::__('nomProveedor') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="filterCiudad" name="filter[proveedor]">
        <option value=""><?php echo i18n::__('selectProveedor') ?></option>
<?php foreach ($objMP as $ciudad): ?>
            <option value="<?php echo $ciudad->$idpro ?>"><?php echo $ciudad->$despro ?></option>
<?php endforeach; ?>
          </select>
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
            <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
            <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary btn-xs"><?php echo i18n::__('filtrar') ?></button>
          </div>
        </div>
      </div>
    </div>  
      <form class="form-signin" id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('maquina', 'deleteSelectMaquina') ?>" method="POST">        
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
            <?php echo i18n::__('acciones') ?>
          </th>

          </tr>
          </thead>
          <tbody>
            <?php foreach ($objMaquina as $key): ?>
              <tr>

                <th>
                  <input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>">
                </th>
                <td>
                  <?php echo $key->$nombre ?>
                </td>

                <th>
                  <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'verMaquina', array(maquinaTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a> 
                  <?php if(session::getInstance()->hasCredential('admin')):?>
                  <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'editMaquina', array(maquinaTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?> </a> 
                  <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"><?php echo i18n::__('eliminar') ?></a>
                <?php endif?>
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
                    <?php echo i18n::__('Desea  eliminar este campo') ?> <?php echo $key->$nombre ?><?php echo i18n::__('?') ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
                    <button type="button" class="btn btn-danger btn-xs" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo maquinaTableClass::getNameField(maquinaTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('maquina', 'deleteMaquina') ?>')"><?php echo i18n::__('eliminar') ?></button>
                  </div>
                </div>
              </div>
            </div>   
          <?php endforeach; ?>
          </tbody>
        </table>
      </form> 
      
      <div class="text-right">
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexMaquina')?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected': '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
      </div>
      <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('maquina', 'deleteMaquina') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::ID, true) ?>">
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
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
        <button type="button" class="btn btn-danger btn-xs" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('eliminar') ?></button>
      </div>
    </div>
  </div>
</div>
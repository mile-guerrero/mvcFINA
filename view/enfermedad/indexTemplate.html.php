<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $nombre = enfermedadTableClass::NOMBRE ?>
<?php $descripcion = enfermedadTableClass::DESCRIPCION ?>
<?php $tratamiento = enfermedadTableClass::TRATAMIENTO ?>
<?php $id = enfermedadTableClass::ID ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo4">
  <div class="center-block" id="cuerpo2">
  <header id="">
   
  </header>
  <nav id="barramenu">
    
  </nav>
  <section id="">
    
  </section>
    <article id='derecha'>
       <h1><?php echo i18n::__('enfermedad') ?></h1>
      <ul>
     <?php if (session::getInstance()->hasCredential('admin')):?>
        <a class="btn btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('enfermedad', 'insert') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('nuevo') ?></a> 
        <a href="javascript:eliminarMasivo()" class="btn  btn btn-xs" id="btnDeleteMasivo"><img class="img-responsive"  id="imgmasivo" src="" alt=" "><?php echo i18n::__('eliminar en masa') ?></a> 
        <?php endif?>
        <a type="button" class="btn  btn btn-xs" data-toggle="modal" data-target="#myModalFilters"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>
        <a href="<?php echo routing::getInstance()->getUrlWeb('enfermedad', 'index') ?>" class="btn  btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>
        <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>          
    </ul>
       
       
       
       
       <!--Filtros-->
      <div class="modal fade" id="myModalFilters" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="filterForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('enfermedad', 'index')?>">
          
          
          <div class="form-group">
    <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
    <div class="col-sm-10">
      <input type="date" class="form-control-filtro1" id="filterFecha1" name="filter[fecha1]">
      
       <input type="date" class="form-control-filtro2" id="filterFecha2" name="filter[fecha2]">
    </div>
  </div>
          
              
          

          <div class="form-group">
    <label for="filterNombre" class="col-sm-2 control-label"><?php echo i18n::__('nom') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="filterNombre" name="filter[nombre]" placeholder="buscar por nombre">
    </div>
  </div>
          
     
         
  <div class="form-group">
    <label for="filterDescripcion" class="col-sm-2 control-label"><?php echo i18n::__('des') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="filterDescripcion" name="filter[descripcion]" placeholder="buscar por descripcion">
    </div>
  </div>
          
          <div class="form-group">
    <label for="filterTratamiento" class="col-sm-2 control-label"><?php echo i18n::__('tratamiento') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="filterTratamiento" name="filter[tratamiento]" placeholder="buscar por tratamiento">
    </div>
  </div>
          
          
          
          
  </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn btn-xs" data-dismiss="modal">  <?php echo i18n::__('cancel') ?></button>
        <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary btn btn-xs"><?php echo i18n::__('filtros') ?></button>
      </div>
    </div>
  </div>
</div>
       
       

<!---Informes--->
       <div class="modal fade" id="myModalReport" tabindex="-1" role="modal" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('informe') ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('enfermedad', 'report')?>">
          
         
    
         <div class="form-group">
    <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
    <div class="col-sm-10">
      <input type="date" class="form-control-filtro1" id="reportFecha1" name="report[fecha1]">
      
       <input type="date" class="form-control-filtro2" id="reportFecha2" name="report[fecha2]">
    </div>
  </div>
          
              
          

          <div class="form-group">
    <label for="reportNombre" class="col-sm-2 control-label"><?php echo i18n::__('nom') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="reportNombre" name="report[nombre]" placeholder="buscar por nombre">
    </div>
  </div>
          
     
         
  <div class="form-group">
    <label for="reportDescripcion" class="col-sm-2 control-label"><?php echo i18n::__('des') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="reportDescripcion" name="report[descripcion]" placeholder="buscar por descripcion">
    </div>
  </div>
          
          <div class="form-group">
    <label for="reportTratamiento" class="col-sm-2 control-label"><?php echo i18n::__('tratamiento') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="reportTratamiento" name="report[tratamiento]" placeholder="buscar por tratamiento">
    </div>
  </div>
         
  
      </div>
       </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn btn-xs" data-dismiss="modal">  <?php echo i18n::__('cerrar') ?></button>
        <button type="button" onclick="$('#reportForm').submit()" class="btn btn-warning btn btn-xs"><?php echo i18n::__('informe') ?></button>
      </div>          
    </div>
  </div>
</div>
        
       
       
       
       
       
        
    
      
      <form class="form-signin" id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('enfermedad', 'deleteSelect') ?>" method="POST">        
        <?php view::includeHandlerMessage()?>       
          <br>
        <table id="tabla" class="table table-bordered table-responsive">
          <tr>
          <thead>
          <th id="cuadrito">
            <input type="checkbox" id="chkAll">
          </th>
          <th>
            <?php echo i18n::__('nom') ?>
          </th>
          <th>
            <?php echo i18n::__('des') ?>
          </th>          
          <th id="acciones">
            <?php echo i18n::__('acciones') ?>
          </th>
          </tr>
          </thead>
          <tbody>
<?php foreach ($objEnfermedad as $key): ?>
              <tr>
                <th>
                  <input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>">
                </th>
                <td>
                  <?php echo $key->$nombre ?>
                </td>
                <td>
                  <?php echo $key->$descripcion ?>
                </td>
                
                <th>
                  <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('enfermedad', 'ver', array(enfermedadTableClass::ID => $key->$id)) ?>" > <?php echo i18n::__('ver') ?></a>
                  <?php if (session::getInstance()->hasCredential('admin')):?>
                  <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('enfermedad', 'edit', array(enfermedadTableClass::ID => $key->$id)) ?>"> <?php echo i18n::__('modificar') ?> </a>
                  <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"> <?php echo i18n::__('eliminar') ?></a>
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
        <?php echo i18n::__('Desea  eliminar este campo') ?><?php echo $key->$nombre ?><?php echo i18n::__('?') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
        <button type="button" class="btn btn-danger btn-xs" onclick="eliminar(<?php echo $key->$id ?>,'<?php echo enfermedadTableClass::getNameField(enfermedadTableClass::ID, true) ?>','<?php echo routing::getInstance()->getUrlWeb('enfermedad', 'delete') ?>')"><?php echo i18n::__('eliminar') ?></button>
      </div>
    </div>
  </div>
</div>           
<?php endforeach; ?>
          </tbody>
        </table>
      </form> 
      
      <div class="text-right">
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('enfermedad', 'index')?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected': '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
      </div>
      <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('enfermedad', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo enfermedadTableClass::getNameField(enfermedadTableClass::ID, true) ?>">
      </form>

    </article>
  
</div>
    <br><br><br><br><br><br><br><br>
</div>
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
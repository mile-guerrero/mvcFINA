<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\session\sessionClass as session ?>

<?php $id = laborTableClass::ID ?>
<?php $descripcion = laborTableClass::DESCRIPCION ?>
<?php $valor = laborTableClass::VALOR ?>


<div class="container container-fluid" id="cuerpo">
  <header id="">

  </header>
  <nav id="">

  </nav>
  <section id="">

  </section>
  <article id='derecha'>
    <h1><?php echo i18n::__('labor') ?></h1> 
    <ul>
      <?php if (session::getInstance()->hasCredential('admin')): ?>  
        <a class="btn  btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('labor', 'insert') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('nuevo') ?></a> 

      <?php endif ?>
      <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalFilters"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('labor', 'index') ?>" class="btn  btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a> 
      <a type="button" class="btn btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>           
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
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('labor', 'index') ?>"  method="POST" >

              <div class="form-group">
                <label for="filterDescripcion" class="col-sm-2 control-label"><?php echo i18n::__('des') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filterDescripcion" name="filter[descripcion]" placeholder="Descripcion">
                </div>
              </div>

              <div class="form-group">
                <label for="filterValor" class="col-sm-2 control-label"><?php echo i18n::__('valor') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filterValor" name="filter[valor]" placeholder="Valor">
                </div>
              </div>



              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="filterFecha1" name="filter[fechaIni]">
                  <br>
                  <input type="date" class="form-control" id="filterFecha2" name="filter[fechaFin]">
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
    <!---fin filtros--->
    <!---Informes--->
    <div class="modal fade" id="myModalReport" tabindex="-1" role="modal" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('informe') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('labor', 'report') ?>">
              <div class="form-group">
                <label for="reportDescripcion" class="col-sm-2 control-label"><?php echo i18n::__('des') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="reportDescripcion" name="report[descripcion]" placeholder="Descripcion">
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
    <!---fin Informes--->   



    <?php view::includeHandlerMessage() ?>
    <table class="table table-bordered table-responsive">
      <tr>
      <thead>

      <th>
        <?php echo i18n::__('des') ?>
      </th>             
      <th id="acciones">
        <?php echo i18n::__('acciones') ?>
      </th>
      </tr>
      </thead>
      <tbody>
        <?php foreach ($objLabor as $key): ?>
          <tr>              
            <td>
              <?php echo $key->$descripcion ?> 
            </td>     
                          
              <th>  
               <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('labor', 'ver', array(laborTableClass::ID => $key->$id)) ?>" > <?php echo i18n::__('ver') ?></a> 
              <?php if (session::getInstance()->hasCredential('admin')): ?>
                  <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('labor', 'edit', array(laborTableClass::ID => $key->$id)) ?>"> <?php echo i18n::__('modificar') ?> </a>
                  
             <?php endif ?>
              </th> 
            </th>                                                       
          </tr>
    
     <?php endforeach; ?>
         </table> 
         <div class="text-right">
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('labor', 'index') ?>')">
          <?php for ($x = 1; $x <= $cntPages; $x++): ?>
            <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor; ?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
         </div>

  </article>

</div>


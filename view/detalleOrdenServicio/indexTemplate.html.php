<pre>
  <?php use mvc\routing\routingClass as routing ?>
  <?php $id = detalleOrdenServicioTableClass::ID ?>
<div id=''>
  <header id="">
    <h1>DETALLE ORDEN SERVICIO</h1>
    </header>
	<nav id="">
	<ul>
      
    <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleOrdenServicio', 'insert') ?>">Nuevo</a>             
     </ul> 
</nav>
    <section id="">
    <article id=''>
              
        <table class="table table-bordered table-responsive">
          <tr>
            <thead>
              
              <th>
                 Numero Orden
              </th>
              <th>
                Codigo Producto
              </th>
              <th>
                Cantidad
              </th>
              <th>
                 Valor
              </th>
              <th>
                Codigo Maquina
              </th>
               <th>
                Aciones
              </th>
    </tr>
    </thead>
	<tbody>
              <?php foreach ($objDOS as $key): ?>
                  <tr>
                         
                   <th><?php echo $key->orden_servicio_id ?></th>
                   
                     
                         
                   <th><?php echo $key->producto_insumo_id ?></th>
                    
                                       
                     <th><?php echo $key->cantidad ?></th>
                        
                         
                         <th><?php echo $key->valor ?></th>
                         
                    
                         
                         <th><?php echo $key->maquina_id ?></th>
                         <th> 
                      <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleOrdenServicio', 'ver', array(detalleOrdenServicioTableClass::ID => $key->$id)) ?>" >Ver</a> - <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleOrdenServicio', 'edit', array(detalleOrdenServicioTableClass::ID => $key->$id)) ?>">Modificar </a>
                      </th> 
                      </tr>
                <?php endforeach; ?>
           </tbody>
	    </table>
      
</div>
	  </article>
    </section>
</pre>



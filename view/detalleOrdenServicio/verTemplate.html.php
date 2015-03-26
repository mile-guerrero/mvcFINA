<pre>
  <?php

  use mvc\routing\routingClass as routing ?>
<div id=''>
  <header id="">
    </header>
	<nav id="">
</nav>
    <section id="">
    <article id=''>
      <table class="table table-bordered table-responsive">
          <tr>
            <thead>
            <th colspan="2">DATOS</th>
    </thead>
    </tr>
	<tbody>
            <?php foreach ($objDOS as $key): ?>
                  <tr>
                    <th>numero orden</th>      
                   <th><?php echo $key->orden_servicio_id ?></th>
                    </tr>
                    <tr>
                     <tr>
                    <th>codigo producto</th>      
                   <th><?php echo $key->producto_insumo_id ?></th>
                    </tr>
                    <tr> 
                     <th>cantidad</th>                   
                     <th><?php echo $key->cantidad ?></th>
                         </tr>
                         <tr>
                         <th>valor</th> 
                         <th><?php echo $key->valor ?></th>
                         </tr>
                    <tr>
                         <th>codigo maquina</th> 
                         <th><?php echo $key->maquina_id ?></th>
                         </tr> 
                    <tr>
                       <th>fecha creacion</th> 
                       <th><?php echo $key->created_at ?></th>
                       </tr>     
                         <tr>
                         <th>fecha modificacion</th> 
                         <th><?php echo $key->updated_at ?></th>
                         </tr>
                                                
          <?php endforeach; ?>
           </tbody>
	    </table>
</div>
	  </article>
    </section>
</pre>

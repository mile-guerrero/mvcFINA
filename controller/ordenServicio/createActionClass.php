<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\ordenServicioValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $fecha = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::FECHA_MANTENIMIENTO, true));
        $trabajador = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::TRABAJADOR_ID, true));
        $cantidad = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::CANTIDAD, true));
        $valor = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::VALOR, true));
        $lote = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::LOTE_ID, true));
        $maquina = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::MAQUINA_ID, true));

        validator::validateInsert();
        
        if($cantidad <= 0){
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputCantidad');
                routing::getInstance()->forward('ordenServicio', 'insert');
            }
        
        if($valor <= 0){
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputValor');
                routing::getInstance()->forward('ordenServicio', 'insert');
            }

        $data = array(
            ordenServicioTableClass::FECHA_MANTENIMIENTO => $fecha,
            ordenServicioTableClass::TRABAJADOR_ID => $trabajador,
            ordenServicioTableClass::CANTIDAD => $cantidad,
            ordenServicioTableClass::VALOR => $valor,
            ordenServicioTableClass::LOTE_ID => $lote,            
            ordenServicioTableClass::MAQUINA_ID => $maquina,
            '__sequence' => 'orden_servicio_id_seq'
            
        );
        $id = ordenServicioTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando un nuevo orden servicio';
        log::register('Insertar', ordenServicioTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('ordenServicio', 'index');
      } else {
        routing::getInstance()->redirect('ordenServicio', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('ordenServicio', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }
  }
}






 

        
            
           
        
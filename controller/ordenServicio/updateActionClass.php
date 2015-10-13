
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\ordenServicioValidatorUpdateClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::ID, true));
        $fecha = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::FECHA_MANTENIMIENTO, true));
        $trabajador = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::TRABAJADOR_ID, true));
        $cantidad = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::CANTIDAD, true));
        $valor = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::VALOR, true));
        $lote = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::LOTE_ID, true));
        $maquina = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::MAQUINA_ID, true));
        $unidadDistancia = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::UNIDAD_DISTANCIA_ID, true));
        
        validator::validateUpdate();
        
        if($cantidad <= 0){
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputCantidad');
                request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\ordenServicioTableClass::ID => request::getInstance()->getPost(\ordenServicioTableClass::getNameField(\ordenServicioTableClass::ID, true))));
                routing::getInstance()->forward('ordenServicio', 'edit');
            }
            
        if($valor <= 0){
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputValor');
                request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\ordenServicioTableClass::ID => request::getInstance()->getPost(\ordenServicioTableClass::getNameField(\ordenServicioTableClass::ID, true))));
                routing::getInstance()->forward('ordenServicio', 'edit');
            }
        
        $ids = array(
            ordenServicioTableClass::ID => $id
        );
        $data = array(
            ordenServicioTableClass::FECHA_MANTENIMIENTO => $fecha,
            ordenServicioTableClass::TRABAJADOR_ID => $trabajador,
            ordenServicioTableClass::CANTIDAD => $cantidad,
            ordenServicioTableClass::VALOR => $valor,
            ordenServicioTableClass::LOTE_ID => $lote,            
            ordenServicioTableClass::MAQUINA_ID => $maquina,
            ordenServicioTableClass::UNIDAD_DISTANCIA_ID => $unidadDistancia
        );
        ordenServicioTableClass::update($ids, $data);
        session::getInstance()->setSuccess('La actualizacion fue correcta');
        $observacion ='se ha modificado la orden servicio';
        log::register('Modificar', ordenServicioTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('ordenServicio', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('ordenServicio', 'edit');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}

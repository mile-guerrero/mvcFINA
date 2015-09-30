
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\viveroValidatorUpdateClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::ID, true));
        $fechaInicial = request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::FECHA_INICIAL, true));
        $fechaFinal = request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::FECHA_FINAL, true));
        $cantidad = request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::CANTIDAD, true));
        $idProducto = request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::PRODUCTO_INSUMO_ID, true));
        

        validator::validateUpdate();
        
        if($fechaFinal < $fechaInicial){
                session::getInstance()->setFlash('selectFechaInicial', true);
                session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'selectFechaInicial');
                request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\viveroTableClass::ID => request::getInstance()->getPost(\viveroTableClass::getNameField(\viveroTableClass::ID, true))));
                routing::getInstance()->forward('vivero', 'edit');
            }elseif($fechaFinal == $fechaInicial){
                session::getInstance()->setFlash('selectFechaInicial', true);
                session::getInstance()->setError('La fecha final es igual a la actual', 'selectFechaInicial');
                request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\viveroTableClass::ID => request::getInstance()->getPost(\viveroTableClass::getNameField(\viveroTableClass::ID, true))));
                routing::getInstance()->forward('vivero', 'edit');
            }
        
        if($cantidad <= 0){
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputCantidad');
                request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\viveroTableClass::ID => request::getInstance()->getPost(\viveroTableClass::getNameField(\viveroTableClass::ID, true))));
                routing::getInstance()->forward('vivero', 'edit');
            }
        
        $ids = array(
            viveroTableClass::ID => $id
        );
        $data = array(
            viveroTableClass::FECHA_INICIAL => $fechaInicial,
            viveroTableClass::FECHA_FINAL => $fechaFinal,
            viveroTableClass::CANTIDAD => $cantidad,
            viveroTableClass::PRODUCTO_INSUMO_ID => $idProducto
            
        );
        viveroTableClass::update($ids, $data);
        session::getInstance()->setSuccess('La actualizacion fue correcta');
        $observacion ='se ha modificado el vivero';
        log::register('Modificar', viveroTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('vivero', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('vivero', 'edit');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}


<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\solicitudInsumoValidatorUpdateClass as validator;
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
        $id = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::ID, true));
        $fecha = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::FECHA_HORA, true));
        $idTrabajador = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::TRABAJADOR_ID, true));
        $cantidad = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CANTIDAD, true));
        $idProducto = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true));
        $idLote = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::LOTE_ID, true));
        $idUnidadMedida = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::UNIDAD_MEDIDA_ID, true));

        validator::validateUpdate();
        
        if($cantidad <= 0){
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputCantidad');
                request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\solicitudInsumoTableClass::ID => request::getInstance()->getPost(\solicitudInsumoTableClass::getNameField(\solicitudInsumoTableClass::ID, true))));
                routing::getInstance()->forward('solicitudInsumo', 'edit');
            }
        
        $ids = array(
            solicitudInsumoTableClass::ID => $id
        );
        $data = array(
            solicitudInsumoTableClass::FECHA_HORA => $fecha,
            solicitudInsumoTableClass::TRABAJADOR_ID => $idTrabajador,
            solicitudInsumoTableClass::CANTIDAD => $cantidad,
            solicitudInsumoTableClass::PRODUCTO_INSUMO_ID => $idProducto,
            solicitudInsumoTableClass::LOTE_ID => $idLote,
            solicitudInsumoTableClass::UNIDAD_MEDIDA_ID => $idUnidadMedida
        );
        solicitudInsumoTableClass::update($ids, $data);
         session::getInstance()->setSuccess('La actualizacion fue correcta');
         $observacion ='se ha modificado la solicitud insumo';
        log::register('Modificar', solicitudInsumoTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('solicitudInsumo', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('solicitudInsumo', 'edit');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}

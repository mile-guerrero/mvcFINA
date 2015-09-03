<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\loteValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de maquina.
 */
class createLoteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
       
        $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
        $tamano = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::TAMANO, true));
        $unidadDistancia = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UNIDAD_DISTANCIA_ID, true));
        $descripcion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESCRIPCION, true));
//        $fechaSiembra = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_INICIO_SIEMBRA, true));
//        $numero = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::NUMERO_PLANTULAS, true));
//        $presupuesto = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRESUPUESTO, true));
//        $insumo = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRODUCTO_INSUMO_ID, true));
        $idCiudad = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true));
       
          if($tamano < 0){
                session::getInstance()->setFlash('inputTamano', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputTamano');
                routing::getInstance()->forward('lote', 'insertLote');
            }
        validator::validateInsert();
//        $this->validate($ubicacion, $tamano, $descripcion);


        loteTableClass::loteInsert($ubicacion,$idCiudad,$tamano,$descripcion,$unidadDistancia);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando un nuevo lote';
        log::register('Insertar', loteTableClass::getNameTable(),$observacion,null);
        routing::getInstance()->redirect('lote', 'indexLote');
      } else {
        routing::getInstance()->redirect('lote', 'indexLote');
      }
    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
     }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase



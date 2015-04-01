<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author 
 */
class insertActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $fields = array(
          trabajadorTableClass::ID,
          trabajadorTableClass::NOMBRET
      );
      $orderBy = array(
          trabajadorTableClass::NOMBRET
      );
      $this->objTrabajador = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(
            pagoTrabajadorTableClass::ID,
            pagoTrabajadorTableClass::FECHA_INICIAL
        );
        $orderBy = array(
            pagoTrabajadorTableClass::FECHA_INICIAL
        );
        $this->objPT = pagoTrabajadorTableClass::getAll($fields, false, $orderBy, 'ASC');
           
        $fields = array(
                pagoTrabajadorTableClass::ID
        );
    
        $this->objDPTT = pagoTrabajadorTableClass::getAll($fields, false);
           
        $this->mensaje ="";
            $this->defineView('insert', 'detallePagoTrabajador', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo $exc->getTraceAsString();
        }


        //$this->defineView('ejemplo', 'default', session::getInstance()->getFormatOutput());
    }

}

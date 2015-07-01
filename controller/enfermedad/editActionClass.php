<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
* @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
* @date: fecha de inicio del desarrollo.
* @category: modulo de cliente.
*/
class editActionClass extends controllerClass implements controllerActionInterface {

  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   clienteTableClass::ID retorna (integer),
            clienteTableClass::NOMBRE retorna (string),
            clienteTableClass::APELLIDO retorna (string),
            clienteTableClass::DOCUMENTO retorna  (integer),
            clienteTableClass::DIRECCION retorna (string),
            clienteTableClass::TELEFONO retorna  (integer),
            clienteTableClass::ID_TIPO_ID retorna  (integer),
            clienteTableClass::ID_CIUDAD retorna  (integer),
 * estos datos retornan en la variable $fields y el Id en la variable $WHERE
*/
  public function execute() {
    try {

      if (request::getInstance()->hasGet(enfermedadTableClass::ID)) {
       $fields = array(
          enfermedadTableClass::ID,
          enfermedadTableClass::NOMBRE,
          enfermedadTableClass::DESCRIPCION,
          enfermedadTableClass::TRATAMIENTO
        );
        $where = array(
            enfermedadTableClass::ID => request::getInstance()->getGet(enfermedadTableClass::ID)
        );
        $this->objEnfermedad = enfermedadTableClass::getAll($fields, true, null, null, null, null, $where);
               
        $this->defineView('edit', 'enfermedad', session::getInstance()->getFormatOutput());
        
      }//cierre del if existencia de id
       else{
        routing::getInstance()->redirect('enfermedad', 'index');
      }//cierre del else

    }//cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
  }//cierre de la funcion execute

}//cierre de la clase

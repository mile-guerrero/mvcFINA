<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\model\modelClass as model;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class filtroLoteActionClass extends controllerClass implements controllerActionInterface {

  

  public function execute() {
    try {
//      $where = null;
//     
//      if (request::getInstance()->hasPost('filter')) {
//        $filter = request::getInstance()->getPost('filter');
//        //validar
//         
//        if (isset($filter['ubicacion']) and $filter['ubicacion'] !== null and $filter['ubicacion'] !== "") {
//          $where[loteTableClass::UBICACION] = $filter['ubicacion'];
//        }
//        if (isset($filter['tamano']) and $filter['tamano'] !== null and $filter['tamano'] !== "") {
//          $where[loteTableClass::TAMANO] = $filter['tamano'];
//        }
//        if (isset($filter['descripcion']) and $filter['descripcion'] !== null and $filter['descripcion'] !== "") {
//          $where[loteTableClass::DESCRIPCION] = $filter['descripcion'];
//        }
//        if (isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== "") {
//          $where[loteTableClass::ID_CIUDAD] = $filter['ciudad'];
//        }
//
//        if ((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and ( isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )) {
//          $where[loteTableClass::CREATED_AT] = array(
//              date(config::getFormatTimestamp(), strtotime($filter['fechaIni'] . ' 00:00:00')),
//              date(config::getFormatTimestamp(), strtotime($filter['fechaFin'] . ' 23:59:59'))
//          );
//        }
     

//        $sql = 'SELECT ' . loteTableClass::UBICACION . '  as ubicacion '
//                . 'FROM' . '  ' . loteTableClass::getNameTable() . '  '
//                . '  WHERE ' . '  ' . loteTableClass::UBICACION . '  ' . 'LIKE' . '   ' . ':name1' . '   '
//                . 'OR' . '   ' . loteTableClass::UBICACION . '   ' . 'LIKE' . '   ' . ':name2' . '   '
//                . 'OR' . '   ' . loteTableClass::UBICACION . '   ' . 'LIKE' . '   ' . ':name3';
//
//        $params = array(
//            ':name1' => $filter['ubicacion'] . '%',
//            ':name2' => '%' . $filter['ubicacion'] . '%',
//            ':name3' => '%' . $filter['ubicacion']
//        );
//
//        $answer = model::getInstance()->prepare($sql);
//        $answer->execute($params);
//        $answer = $answer->fetchAll(PDO::FETCH_OBJ);
////      echo ($answer[0]->ubicacion);
////      exit();
//        //SELECT ubicacion as descripcion FROM lote WHERE ubicacion LIKE :name1 OR ubicacion LIKE :name2 OR ubicacion LIKE :name3
//        return ($answer[0]->ubicacion);
//       $fil=$filter['ubicacion'];
//       
//       $this->objLoteFiltro = loteTableClass::loteFiltro($fil,$fields);
  //    }
    
  if (request::getInstance()->isMethod('POST')) {
       
       $fil = $_POST['ubicacion'];
       $campo= loteTableClass::UBICACION;
        

        $objLote = loteTableClass::loteFiltro($fil,$campo);
        session::getInstance()->setFlash($objLote, 'filtroLote');
        routing::getInstance()->forward('lote', 'indexLote');
        //session::getInstance()->setSuccess('El registro fue exitoso');
        //routing::getInstance()->redirect('lote', 'indexLote');
      } else {
        routing::getInstance()->redirect('lote', 'indexLote');
      }   
     
//       routing::getInstance()->redirect('lote', 'indexLote');
      
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}

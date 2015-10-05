<?php

use mvc\model\table\tableBaseClass;

/**
 * Description of ordenServicioBaseTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class ordenServicioBaseTableClass extends tableBaseClass {

 private $id;
 private $fechaMantenimiento;
 private $trabajadorId; 
 private $cantidad;
 private $valor;
 private $loteId;
 private $maquinaId;
 private $createdAt;
 private $updatedAt;


  const ID = 'id';  
  const FECHA_MANTENIMIENTO = 'fecha_mantenimiento';
  const TRABAJADOR_ID = 'trabajador_id';
  const CANTIDAD = 'cantidad';
  const CANTIDAD_LENGTH = 30;
  const VALOR = 'valor';  
  const VALOR_LENGTH = 30;
  const LOTE_ID = 'lote_id';
  const MAQUINA_ID = 'maquina_id';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  
  public function getId() {
    return $this->id;
  }

  public function getFechaMantenimiento() {
    return $this->fechaMantenimiento;
  }

  public function getTrabajadorId() {
    return $this->trabajadorId;
  }
  
  public function get_cantidad() {
    return $this->cantidad;
  }

  public function get_valor() {
    return $this->valor;
  }
  
  public function get_loteId() {
    return $this->loteId;
  }

  public function get_maquinaId() {
    return $this->maquinaId;
  }
  
  public function getCreatedAt() {
    return $this->createdAt;
  }

  public function getUpdatedAt() {
    return $this->updatedAt;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setFechaMantenimiento($fechaMantenimiento) {
    $this->fechaMantenimiento = $fechaMantenimiento;
  }

  public function setTrabajadorId($trabajadorId) {
    $this->trabajadorId = $trabajadorId;
  }
  
  public function set_cantidad($cantidad) {
    $this->cantidad = $cantidad;
  }

  public function set_valor($valor) {
    $this->valor = $valor;
  }
  
  public function set_loteId($loteId) {
    $this->loteId = $loteId;
  }

  public function set_maquinaId($maquinaId) {
    $this->maquinaId = $maquinaId;
  }
  
  public function setCreatedAt($createdAt) {
    $this->createdAt = $createdAt;
  }

  public function setUpdatedAt($updatedAt) {
    $this->updatedAt = $updatedAt;
  }

   /**
   * Obtiene el nombre de la tabla
   * @return string
   */
  static public function getNameTable() {
    return 'orden_servicio';
  }

  /**
   * Método para obtener el nombre del campo más la tabla ya sea en formato
   * DB (.) o en formato HTML (_)
   *
   * @param string $field Nombre del campo
   * @param string $html [optional] Por defecto traerá el nombre del campo en
   * versión DB
   * @return string
   */
  public static function getNameField($field, $html = false, $table = null) {
    return parent::getNameField($field, self::getNameTable(), $html);
  }

  /**
   * Método para borrar un registro de una tabla X en la base de datos
   *
   * @param array $ids Array con los campos por posiciones
   * asociativas y los valores por valores a tener en cuenta para el borrado.
   * Ejemplo $fieldsAndValues['id'] = 1
   * @param boolean $deletedLogical [optional] Borrado lógico o
   * borrado físico [por defecto] de un registro en una tabla de la base de datos
   * @return \PDOException|boolean
   */
  public static function delete($ids, $deletedLogical = true, $table = null) {
    return parent::delete($ids, $deletedLogical, self::getNameTable());
  }

  /**
   * Método para insertar en una tabla usuario
   *
   * @param array $data Array asociativo donde las claves son los nombres de
   * los campos y su valor sería el valor a insertar. Ejemplo:
   * $data['nombre'] = 'Erika'; $data['apellido'] = 'Galindo';
   * @return \PDOException|boolean
   */
  public static function insert($data, $table = null) {
    return parent::insert(self::getNameTable(), $data);
  }

  /**
   * Método para leer todos los registros de una tabla
   *
   * @param array $fields Array con los nombres de los campos a solicitar
   * @param boolean $deletedLogical [optional] Indicación de borrado lógico
   * o borrado físico
   * @param array $orderBy [optional] Array con el o los nombres de los campos
   * por los cuales se ordenará la consulta
   * @param string $order [optional] Forma de ordenar la consulta
   * (por defecto NULL), pude ser ASC o DESC
   * @param integer $limit [optional] Cantidad de resultados a mostrar
   * @param integer $offset [optional] Página solicitadad sobre la cantidad
   * de datos a mostrar
   * @return mixed una instancia de una clase estandar, la cual tendrá como
   * variables publica los nombres de las columnas de la consulta o una
   * instancia de \PDOException en caso de fracaso.
   */
  public static function getAll($fields, $deletedLogical = true, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null) {
    return parent::getAll(self::getNameTable(), $fields, $deletedLogical, $orderBy, $order, $limit, $offset, $where, $table);
  }

  /**
   * Método para actualizar un registro en una tabla de una base de datos
   *
   * @param array $ids Array asociativo con las posiciones por nombres de los
   * campos y los valores son quienes serían las llaves a buscar.
   * @param array $data Array asociativo con los datos a modificar,
   * las posiciones por nombres de las columnas con los valores por los nuevos
   * datos a escribir
   * @return \PDOException|boolean
   */
  public static function update($ids, $data, $table = null) {
    return parent::update($ids, $data, self::getNameTable());
  }

}

<?php

class mdlEstudiante
{
  public $idEstudiante;
  public $documento;
  public $nombres;
  public $correo;
  public $db;

  public function __construct($db){
    try {
      $this->db = $db;

    } catch (PDOException $e) {
      exit("No se pudo conectar con la base de datos ".$e->getMessage());

    }

  }

  public function __SET($atributo, $valor){
      $this->$atributo = $valor;
  }

  public function __GET($atributo){
      return $this->$atributo;
  }

  public function crearEstudiante(){
    $sql = "CALL sp_insertarEstudiante(?,?,?)";
    $consulta = $this->db->prepare($sql);
    $consulta->bindParam(1, $this->documento);
    $consulta->bindParam(2, $this->nombres);
    $consulta->bindParam(3, $this->correo);
    $res = $consulta->execute();
    return $res;
  }

  public function listaEstudiantes(){
    $sql = "CALL sp_listaEstudiantes()";
    $consulta = $this->db->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
  }

  public function editarEstudiante(){
    $sql = "CALL sp_editarEstudiante(?,?,?)";
    $consulta = $this->db->prepare($sql);
    $consulta->bindParam(1, $this->idEstudiante);
    $consulta->bindParam(2, $this->nombres);
    $consulta->bindParam(3, $this->correo);
    $res = $consulta->execute();
    return $res;
  }

  public function eliminarE(){
    $sql = "CALL sp_eliminarEstudiante(?)";
    $consulta = $this->db->prepare($sql);
    $consulta->bindParam(1, $this->idEstudiante);
    $res = $consulta->execute();
    return $res;
  }

}

 ?>

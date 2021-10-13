<?php
class Cursos extends Controller
{
  public $modeloCurso;
  public function __construct(){
    $this->modeloCurso = $this->loadModel("mdlCursos");
  }
  public function adminCursos()
  {
      if (isset($_POST['btnGuardar'])) {
      $this->modeloCurso->__SET('curso', $_POST['txtCurso']);
      $this->modeloCurso->__SET('horas', $_POST['txtHoras']);
      $this->modeloCurso->__SET('nivel', $_POST['txtNivel']);
      $this->modeloCurso->__SET('valorCurso', $_POST['txtCosto']);

      //var_dump( $_POST['txtUsuario'], $_POST['txtClave'], $_POST['txtNombres'], $_POST['txtCorreo'], $linea,$estado, $_POST['selRoles'], $_POST['txtDocumento']); exit;
      $insert = $this->modeloCurso->crearCurso();
      // var_dump($insert);
      // exit;
      if ($insert == true){
        $_SESSION['alerta'] ='
                swal({
                    title: "Registro exitoso",
                    text: "El curso  ha sido registrado correctamente",
                    type: "success",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                  });
            ';
            header("Location:".URL."Cursos/adminCursos");
            exit();
      }else{
        $_SESSION['alerta'] ='
        swal({
            title: "Error",
            text: "Ha ocurrido un error al registrar por favor comuniquese a soporte tecnico",
            type: "error",
            confirmButtonText: "Aceptar",
            closeOnConfirm: false,
            closeOnCancel: false
          });
    ';

        header("Location:".URL."Cursos/adminCursos");
        exit();
      }


    }

    if (isset($_POST['btnActualizarC'])) {
      $this->modeloCurso->__SET('horas', $_POST['txtHorasC']);
      $this->modeloCurso->__SET('nivel', $_POST['txtNivelC']);
      $this->modeloCurso->__SET('valorCurso', $_POST['txtCostoC']);
      $this->modeloCurso->__SET('idCurso', $_POST['txtIdCursoC']);
      $up = $this->modeloCurso->editarCurso();

      if ($up == true){
        $_SESSION['alerta'] ='
                swal({
                    title: "Actualización exitosa",
                    text: "El curso ha sido actualizado correctamente",
                    type: "success",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                  });
            ';
            header("Location:".URL."Cursos/adminCursos");
            exit();
      }else{
        $_SESSION['alerta'] ='
        swal({
            title: "Error",
            text: "Ha ocurrido un error al editar por favor comuniquese a soporte tecnico",
            type: "error",
            confirmButtonText: "Aceptar",
            closeOnConfirm: false,
            closeOnCancel: false
          });
    ';

        header("Location:".URL."Cursos/adminCursos");
        exit();
      }

    }

    $cursos = $this->modeloCurso->listaCursos();
    require APP . 'view/_templates/header.php';
    require APP . 'view/cursos/adminCursos.php';
    require APP . 'view/_templates/footer.php';


  }

  public function eliminarC(){
    $this->modeloCurso->__SET("idCurso", $_POST['id']);
    $del = $this->modeloCurso->eliminarC();
    if ($del) {
      echo "1";
    }else{
      echo "0";
    }

  }

}

 ?>

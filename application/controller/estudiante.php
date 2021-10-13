<?php
class Estudiante extends Controller
{
  public $modeloEstudiante;
  public function __construct(){
    $this->modeloEstudiante = $this->loadModel("mdlEstudiante");
  }
  public function adminEstudiantes()
  {
    if (isset($_POST['btnGuardar'])) {
    $this->modeloEstudiante->__SET('documento', $_POST['txtDocumento']);
    $this->modeloEstudiante->__SET('nombres', $_POST['txtNombres']);
    $this->modeloEstudiante->__SET('correo', $_POST['txtCorreo']);

    //var_dump( $_POST['txtUsuario'], $_POST['txtClave'], $_POST['txtNombres'], $_POST['txtCorreo'], $linea,$estado, $_POST['selRoles'], $_POST['txtDocumento']); exit;
    $insert = $this->modeloEstudiante->crearEstudiante();
    // var_dump($insert);
    // exit;
    if ($insert == true){
      $_SESSION['alerta'] ='
              swal({
                  title: "Registro exitoso",
                  text: "El estudiante ha sido registrado correctamente",
                  type: "success",
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false,
                  closeOnCancel: false
                });
          ';
          header("Location:".URL."Estudiante/adminEstudiantes");
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

      header("Location:".URL."Estudiante/adminEstudiantes");
      exit();
    }


  }

  if (isset($_POST['btnActualizarE'])) {
    $this->modeloEstudiante->__SET('documento', $_POST['txtDocumentoE']);
    $this->modeloEstudiante->__SET('nombres', $_POST['txtNombresE']);
    $this->modeloEstudiante->__SET('correo', $_POST['txtCorreoE']);
    $this->modeloEstudiante->__SET('idEstudiante', $_POST['txtIdEstudianteE']);
    $up = $this->modeloEstudiante->editarEstudiante();

    if ($up == true){
      $_SESSION['alerta'] ='
              swal({
                  title: "Actualización exitosa",
                  text: "El estudiante ha sido actualizado correctamente",
                  type: "success",
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false,
                  closeOnCancel: false
                });
          ';
          header("Location:".URL."Estudiante/adminEstudiantes");
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

      header("Location:".URL."Estudiante/adminEstudiantes");
      exit();
    }

  }

    $estudiantes = $this->modeloEstudiante->listaEstudiantes();
    require APP . 'view/_templates/header.php';
    require APP . 'view/estudiantes/adminEstudiantes.php';
    require APP . 'view/_templates/footer.php';

  }

  public function eliminarE(){
    $this->modeloEstudiante->__SET("idEstudiante", $_POST['id']);
    $del = $this->modeloEstudiante->eliminarE();
    if ($del) {
      echo "1";
    }else{
      echo "0";
    }

  }

}

 ?>

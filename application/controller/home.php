<?php

class Home extends Controller
{
    public $modeloUsuario;
    public function __construct(){
      $this->modeloUsuario = $this->loadModel("mdlUsuario");
    }
    public function index()
    {
      if (isset($_SESSION['sesion_iniciada']) && $_SESSION['sesion_iniciada'] == true) {
        header("Location:".URL."Home/principal");
        exit();
      }

        if (isset($_POST['btnIngresar'])) {
            $this->modeloUsuario->__SET("usuario", trim($_POST['txtUsuario']));
            $this->modeloUsuario->__SET("clave", trim(sha1(md5($_POST['txtClave']))));
            $in = $this->modeloUsuario->validarUsuario();
            if ($in) {
              $_SESSION['sesion_iniciada'] = true;
              $_SESSION['usuario'] = $in['Usuario'];
              $_SESSION['nombreCompleto'] = $in['NombreCompleto'];
              $_SESSION['estado'] = $in['Estado'];
              $_SESSION['idUsuario'] = $in['IdUsuario'];
              $this->modeloUsuario->__SET("idUsuario", $_SESSION['idUsuario']);


              header("Location:".URL."Home/principal");
              exit();
            }else{
              echo "Usuario y/o contraseña incorrectos";
            }
        }
        require APP . 'view/home/login.php';
        //require APP . 'view/_templates/footer.php';
    }

    public function principal()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function cerrarSesion(){
      $this->modeloUsuario->__SET("idUsuario", $_SESSION['idUsuario']);
      session_unset();
      session_destroy();
      $_SESSION['sesion_iniciada']=false;
      if ($_SESSION['sesion_iniciada']==true) {
        header("Location:".URL."Home/principal");
        exit();
      }else{
        header("Location:".URL."Home/index");
        exit();

      }
    }

    public function adminUsuario(){
      if (isset($_POST['btnGuardar'])) {
        $estado = 1;
        $this->modeloUsuario->__SET('usuario', $_POST['txtUsuario']);
        $this->modeloUsuario->__SET('clave',trim(sha1(md5($_POST['txtClave']))));
        $this->modeloUsuario->__SET('nombreCompleto', $_POST['txtNombres']);
        $this->modeloUsuario->__SET('estado', $estado);

        //var_dump( $_POST['txtUsuario'], $_POST['txtClave'], $_POST['txtNombres'], $_POST['txtCorreo'], $linea,$estado, $_POST['selRoles'], $_POST['txtDocumento']); exit;
        $insert = $this->modeloUsuario->crearUsuario();
        if ($insert == true){
          $_SESSION['alerta'] ='
                  swal({
                      title: "Registro exitoso",
                      text: "El usuario  ha sido registrado correctamente",
                      type: "success",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: false,
                      closeOnCancel: false
                    });
              ';
              header("Location:".URL."Home/adminUsuario");
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

          header("Location:".URL."Home/adminUsuario");
          exit();
        }

      }
      if (isset($_POST['btnActualizar'])) {
        $this->modeloUsuario->__SET('usuario', $_POST['txtUsuarioE']);
        $this->modeloUsuario->__SET('nombreCompleto', $_POST['txtNombresE']);
        $this->modeloUsuario->__SET('idUsuario', $_POST['txtIdUsuarioE']);
        $up = $this->modeloUsuario->editarUsuario();

        if ($up == true){
          $_SESSION['alerta'] ='
                  swal({
                      title: "Actualización exitosa",
                      text: "El usuario ha sido actualizado correctamente",
                      type: "success",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: false,
                      closeOnCancel: false
                    });
              ';
              header("Location:".URL."Home/adminUsuario");
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

          header("Location:".URL."Home/adminUsuario");
          exit();
        }

      }


      $usuarios = $this->modeloUsuario->listaUsuarios();
      require APP . 'view/_templates/header.php';
      require APP . 'view/home/adminUsuario.php';
      require APP . 'view/_templates/footer.php';
    }

    public function cambiarEstado(){
      $this->modeloUsuario->__SET("idUsuario", $_POST['id']);
      $es = $this->modeloUsuario->cambiarEstado();
      if ($es) {
        echo "1";
      }else{
        echo "0";
      }

    }

    public function eliminarU(){
      $this->modeloUsuario->__SET("idUsuario", $_POST['id']);
      $del = $this->modeloUsuario->eliminarU();
      if ($del) {
        echo "1";
      }else{
        echo "0";
      }

    }

}

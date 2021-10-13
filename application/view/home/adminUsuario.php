

<div class="box box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de usuarios</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="box-group" id="accordion">
      <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
      <div class="panel box box-primary">
        <div class="box-header with-border">
          <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
              Registrar Usuario
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
          <div class="box-body">
            <form class="" method="post">

            <div class="row">
              <div class="col-md-6">

                <div class="from-group">
                  <label for="txtNombres">Nombres </label>
                  <input type="text" name="txtNombres" class="form-control" value="" required>
                </div>



                <div class="from-group">
                  <label for="txtUsuario">Usuario</label>
                  <input type="text" name="txtUsuario" class="form-control" value="" required>
                </div>
                <div class="from-group">
                  <label for="txtClave">Contraseña </label>
                  <input type="password" name="txtClave" id="password1" class="form-control" value="" required>
                </div>
                <div class="from-group">
                  <label for="txtClave">Confirmar contraseña</label>
                  <input type="password" name="txtClave" id="password2" class="form-control" value="" required>
                </div>
                <br>
                <div class="form-group">
                  <button type="submit" class="btn btn-success" name="btnGuardar">Guardar</button>
                  <button type="button" class="btn btn-default" name="btnCancelar">Cancelar</button>
                </div>

              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
      <div class="panel box box-primary">
        <div class="box-header with-border">
          <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
              Lista de usuarios
            </a>
          </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
          <div class="box-body">
            <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <th>Id Usuario</th>
                          <th>Nombres</th>
                          <th>Usuario</th>
                          <th>Estado</th>
                          <th>Opciones</th>
                        </thead>
                        <tbody>
                  <?php foreach ($usuarios as $data): ?>
                      <tr>
                        <td><?= $data["IdUsuario"]; ?></td>
                        <td><?= $data["NombreCompleto"]; ?></td>
                        <td><?= $data["Usuario"]; ?></td>
                        <td><?php if ($data["Estado"]==1) : ?>
                          <label class="label label-success">Activo</label>
                        <?php else: ?>
                            <label class="label label-danger">Inactivo</label>
                          <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-xs" title="Editar" onclick="editar('<?= $data["IdUsuario"]; ?>','<?=  $data["NombreCompleto"]; ?>','<?=  $data["Usuario"]; ?>');" data-toggle="modal" data-target="#modal-editar"><i class="fa fa-edit"></i> </button>
                            <button type="button" class="btn btn-info btn-xs"  title="Cambiar Estado" onclick="cambiarEstado('<?= $data["IdUsuario"]; ?>');"><i class="fa fa-exchange"></i> </button>
                            <button type="button" class="btn btn-danger btn-xs"  title="Eliminar" onclick="EliminarU('<?= $data["IdUsuario"]; ?>');"><i class="fa fa-trash"></i> </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>

          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- /.box-body -->
</div>
</div>

<div class="modal fade" id="modal-editar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Default Modal</h4>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="container-fluid">
            <div class="form-group">


            </div>
            <div class="form-group">
              <label for="">Nombres</label>
              <input type="text" name="txtNombresE" id="txtNombresE" class="form-control">
              <input type="text" name="txtIdUsuarioE" id="txtIdUsuarioE"  hidden>
            </div>



            <div class="form-group">
              <label for="">Usuario</label>
              <input type="text" name="txtUsuarioE" id="txtUsuarioE" class="form-control">
            </div>


          </div>

        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" name="btnActualizar" class="btn btn-primary">Guardar Cambios</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  var pass1, pass2;
  pass1 = document.getElementById('password1');
  pass2 = document.getElementById('password2');

  pass1.onchange = pass2.onkeyup = passwordMatch

  function passwordMatch(){
    if (pass1.value !== pass2.value) {
      pass2.setCustomValidity("Las contraseñas no coinciden");
    }
    else{
      pass2.setCustomValidity("");
    }
  }

</script>

<script type="text/javascript">
function editar(id, nom, usuario){
  $('#txtIdUsuarioE').val(id);
  $('#txtNombresE').val(nom);
  $('#txtUsuarioE').val(usuario);

  }

</script>

<script type="text/javascript">
//Cambiar Estado
function cambiarEstado(id){
  //alert(id);
  swal({
    title: "¿Esta seguro de cambiar el estado del usuario?",
    type: "warning",
    cancelButtonText: "Cancelar",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Aceptar",
    closeOnConfirm: false
  },
  function(isConfirm){
    if (isConfirm){
      swal({
        title: "Estado cambiado",
        type: "success",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        $.ajax({
            type: "POST",
            url: url+"Home/cambiarEstado",
            data: {'id': id}
        }).done(function(respuesta){
          if(respuesta == "1"){
            window.location = url+"Home/adminUsuario";
          }else{
            sweetAlert("Error al cambiar el estado");
          }

        }).fail(function(error){
          console.log("Error: "+error)

        });
      }

    );

    }

  }
);
}

</script>

<script type="text/javascript">
//Cambiar Estado
function EliminarU(id){
  //alert(id+"Eliminar");
  swal({
    title: "¿Esta seguro de eliminar el usuario?",
    type: "warning",
    cancelButtonText: "Cancelar",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Aceptar",
    closeOnConfirm: false
  },
  function(isConfirm){
    if (isConfirm){
      swal({
        title: "Usuario eliminado",
        type: "success",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        $.ajax({
            type: "POST",
            url: url+"Home/eliminarU",
            data: {'id': id}
        }).done(function(respuesta){
          if(respuesta == "1"){
            window.location = url+"Home/adminUsuario";
          }else{
            sweetAlert("Error al eliminar el usuario");
          }

        }).fail(function(error){
          console.log("Error: "+error)

        });
      }

    );

    }

  }
);
}


</script>

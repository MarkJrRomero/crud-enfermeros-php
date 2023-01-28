<?php
	session_start();
	require '../config/conex.php';
	
	if(!isset($_SESSION['id'])){
		header("Location: ../index.html");
	}
	

	$sql = "SELECT * FROM usuarios";
	$resultado = $mysqli->query($sql);
	
	
?>

<div class="card mb-4">
  <div class="card-header"><i class="fas fa-table mr-1"></i>Lista de empleados</div>
  <div class="card-body">
      <div class="table-responsive text-nowrap">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>EDIT</th>
                      <th>DELETE</th>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Cedula</th>
                      <th>Fecha de Nacimiento</th>
                      <th>Email</th>
                      <th>Telefono</th>
                      <th>Rol</th>
                      <th>Usuario</th>
                      <th>Password</th>
                      <th hidden>Profesiones</th>
                  </tr>
              </thead>
              <tbody>
                  <?php while($row = $resultado->fetch_assoc()) { ?>
                      
                      <tr>
                          <td><?php echo "<button onclick=\"editEmplado(".$row['id'].",'".$row['nombre']."','".$row['cedula']."','".$row['fecha_nacimiento']."','".$row['email']."',
                          '".$row['telefono']."','".$row['usuario']."','".$row['password']."','".
                          
                          str_replace("\"" , '', $row['profesiones'])

                          ."')\" type='button' class='btn btn-primary'>E</button>" ?></td>
                          <td><?php echo "<button onclick='deleteEmpleado(".$row['id'].")' type='button' class='btn btn-danger'>D</button>" ?></td>

                          <td><?php echo $row['id']; ?></td>
                          <td><?php echo $row['nombre']; ?></td>
                          <td><?php echo $row['cedula']; ?></td>
                          <td><?php echo $row['fecha_nacimiento']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['telefono']; ?></td>
                          <td><?php echo $row['role']; ?></td>
                          <td><?php echo $row['usuario']; ?></td>
                          <td><?php echo $row['password']; ?></td>
                          <td hidden><?php echo $row['profesiones']; ?></td>
                          
                          
                      </tr>
                  <?php } ?>
              </tbody>
          </table>
      </div>
  </div>
</div>

<div class="modal fade show" id="modalUpdate" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Actualizacion de usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="../php/updateEmpl.php">

        <div class="row mb-3" hidden>
            <label class="col-sm-2 col-form-label" for="idUser">Id</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="idUser" name="idUser" placeholder="name">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="nombre">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="name">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="cedula">Cedula</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="cedula" name="cedula" placeholder="1402186737">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="date">Fecha de nacimiento</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="date" id="date" name="date" class="form-control" >
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="email">Email</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="email" id="email" name="email" class="form-control" placeholder="email@example.com" aria-label="email@example.com" aria-describedby="email2">
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="telefono">Telefono</label>
            <div class="col-sm-10">
              <input type="text" id="telefono" name="telefono" class="form-control phone-mask" placeholder="301 204 6175" aria-label="301 204 6175" aria-describedby="telefono">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="user">Usuario de ingreso</label>
            <div class="col-sm-10">
              <input type="text" id="user" name="user" class="form-control phone-mask" placeholder="user" aria-label="301 204 6175" aria-describedby="telefono">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="pass">Contraseña de ingreso</label>
            <div class="col-sm-10">
              <input type="text" id="pass" name="pass" class="form-control phone-mask" placeholder="pass" aria-label="301 204 6175" aria-describedby="telefono">
            </div>
          </div>

          <div class="row mb-3">
          <small class="text-light fw-semibold">Profesiones </small>

          <div class="form-check col-sm-10 ms-3">
            <input class="form-check-input" type="checkbox"  id="enfermeria" name="enfermeria">
            <label class="form-check-label" for="enfermeria"> Enfermeria </label>
          </div>

          <div class="form-check col-sm-10 ms-3">
            <input class="form-check-input" type="checkbox"  id="odontologia" name="odontologia">
            <label class="form-check-label" for="odontologia"> Odontologia </label>
          </div>

          <div class="form-check col-sm-10 ms-3">
            <input class="form-check-input" type="checkbox"  id="nutricion" name="nutricion">
            <label class="form-check-label" for="nutricion"> Nutricion </label>
          </div>

        </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
          </div>
          </form>
      </div>
    </div>
  </div>
</div>

    <script>
      function deleteEmpleado(id){
          $.ajax({
          method: "POST",
          url: "../php/deleteEmpl.php",
          data: {id}
          }).done(function( response ) {
              if(response == 1){
                  alert('Se elimino el empleado correctamente!');
                  location.reload();
              }else{
                  alert('Error al eliminar el empleado!');
                  location.reload();
              }
          });
      }
    
      function editEmplado(id, nombre, cedula, fecha_nacimiento, email, telefono, usuario, password, profesiones){
          
          console.log(profesiones);

          if(profesiones.includes('enfe')){
            $('#enfermeria').prop('checked', true);
          }

          if(profesiones.includes('odon')){
            $('#odontologia').prop('checked', true);
          }

          if(profesiones.includes('nutri')){
            $('#nutricion').prop('checked', true);
          }

          $('#idUser').val(id);
          $('#nombre').val(nombre);
          $('#cedula').val(cedula);
          $('#date').val(fecha_nacimiento);
          $('#email').val(email);
          $('#telefono').val(telefono);
          $('#user').val(usuario);
          $('#pass').val(password);
          $('#modalUpdate').modal('show');
      }
    </script>

<script src="../assets/table/datatables-demo.js"></script>
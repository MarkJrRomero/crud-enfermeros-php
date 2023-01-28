<?php

	session_start();
	$roleSession = $_SESSION['role'];
	require "../config/conex.php";
    
	if($_POST){

        $characters = array("#", "'", ";", "|", "-","$",".","{","}");

        if (isset($_POST['enfermeria'])) {
			$enfermeria = 'enfe';
		}else{
			$enfermeria = '';
		}
		if (isset($_POST['odontologia'])) {
			$odontologia = 'odon';
		}else{
			$odontologia = '';
		}
		if (isset($_POST['nutricion'])) {
			$nutricion = 'nutri';
		}else{
			$nutricion = '';
		}

		$profesiones = $enfermeria . "-" . $odontologia . "-" . $nutricion;

        $id = str_replace($characters, '', $_POST['idUser']);
        $usuario = str_replace($characters, '', $_POST['user']);
		$password = str_replace($characters, '', $_POST['pass']);
		$nombre = str_replace($characters, '',$_POST['nombre']);
        $cedula = str_replace($characters, '',$_POST['cedula']);
		$fecha_nacimiento = str_replace($characters, '',$_POST['date']);
        $email = str_replace($characters, '',$_POST['email']);
		$telefono = str_replace($characters, '',$_POST['telefono']);

		$sql = "UPDATE pgfacture_mark.usuarios
            SET
                usuario = '$usuario',
                password = '$password',
                nombre = '$nombre',
                cedula = '$cedula',
                fecha_nacimiento = '$fecha_nacimiento',
                email = '$email',
                telefono = $telefono,
                profesiones = '$profesiones'
            WHERE id = $id;";

        // echo $sql;
	
		if($result=$mysqli->query($sql)){     
            echo "<script type='text/javascript'>
                alert('Empleado actualizado correctamente!');
                window.location= '../menu/$roleSession.php'
                </script>";
		} else {
			echo "<script type='text/javascript'>
				alert('Error al actualizar el empleado! error: $result');
				window.location= '../menu/$roleSession.php'
				</script>";
		}
		
		
		
	}
	
	
	
?>
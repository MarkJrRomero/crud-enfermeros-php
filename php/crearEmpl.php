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

		$profesionesEncode = json_encode($profesiones);
		

        $usuario = str_replace($characters , '', $_POST['user']);
		$password = str_replace($characters , '', $_POST['pass']);
		$nombre = str_replace($characters , '',$_POST['nombre']);
        $cedula = str_replace($characters , '',$_POST['cedula']);
		$fecha_nacimiento = str_replace($characters , '',$_POST['date']);
        $email = str_replace($characters , '',$_POST['email']);
		$telefono = str_replace($characters , '',$_POST['telefono']);
		$role = 'enfermero';

		$sql = "INSERT INTO pgfacture_mark.usuarios
        (usuario, password, nombre, cedula, fecha_nacimiento, email, telefono, role, profesiones)
        VALUES 
            ('$usuario', '$password', '$nombre', '$cedula', '$fecha_nacimiento' , '$email', $telefono, '$role', '$profesionesEncode');";
		// echo $sql;
		if($result=$mysqli->query($sql)){     
            echo "<script type='text/javascript'>
                alert('Usuario creado correctamente!');
                window.location= '../menu/$roleSession.php'
                </script>";
		} else {
			echo "<script type='text/javascript'>
				alert('Error al guardar el empleado! error: $result');
				window.location= '../menu/$roleSession.php'
				</script>";
		}
		
		
		
	}
	
	
	
?>
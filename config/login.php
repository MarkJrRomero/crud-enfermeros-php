<?php
	
	require "conex.php";
	
	session_start();
	
	if($_POST){
		
		$characters = array("#", "'", ";", "|", "-","$",".","{","}");

		$usuario = str_replace($characters, '' , $_POST['usuario']);
		$password = str_replace($characters, '' , $_POST['password']);
		
		$sql = "SELECT id, password, nombre, role FROM pgfacture_mark.usuarios WHERE usuario='$usuario';";
		// echo $sql;
		$resultado = $mysqli->query($sql);
		$num = $resultado->num_rows;
		
		if($num>0){
			$row = $resultado->fetch_assoc();
			$password_bd = trim($row['password']);
			
			$pass_c = trim($password);
			// echo $password_bd;
			// echo $pass_c;
			if($password_bd == $pass_c){
				
				$_SESSION['id'] = $row['id'];
				$_SESSION['nombre'] = $row['nombre'];
				$_SESSION['role'] = $row['role'];
				
				$role = $row['role'];

				header("Location: ../menu/$role.php");
				
			} else {
			
				echo "<script type='text/javascript'>
				alert('La contraseña no coincide!');
                window.location= '../index.html'
				</script>";
			
			}
			
			
			} else {
				echo "<script type='text/javascript'>
					  alert('No existe el usuario!');
                      window.location= '../index.html'
				      </script>";
		}
		
		
		
	}
	
	
	
?>
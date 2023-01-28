<?php
	
	require "../config/conex.php";
	
	if($_POST){
		
		$characters = array("#", "'", ";", "|", "-","$",".","{","}");
		
        $id = str_replace($characters, '',$_POST['id']);
		

		$sql = "DELETE FROM pgfacture_mark.usuarios WHERE id = $id;";
	
		if($result=$mysqli->query($sql)){     
            echo $result;
		} 
		
	}
	
	
	
?>
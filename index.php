<?php
include 'conexion.php'; 
function permisos() {  
    if (isset($_SERVER['HTTP_ORIGIN'])){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Credentials: true');      
    }  
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
      if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))          
          header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
      if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
          header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
      exit(0);
    }
  }
  permisos();

$PDO = new Conexion();


if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {

 
    if ( isset( $_GET['id_denuncia'] ) ) {
        $consulta = $PDO->prepare( "SELECT *FROM bvmsi8xlfpo4eoqm8huh WHERE id_denuncia=:id_denuncia" );
        $consulta->bindValue( ':id_denuncia', $_GET['id_denuncia'] );
        $consulta->execute();
        $consulta->setFetchMode( PDO::FETCH_ASSOC );
        header( "HTTP/1.1 200 Datos Obtenidos Especificos" );
        echo json_encode( $consulta->fetchAll() );
        exit();

    } else {
        $consulta = $PDO->prepare( "SELECT *FROM bvmsi8xlfpo4eoqm8huh" );
        $consulta->execute();
        $consulta->setFetchMode( PDO::FETCH_ASSOC );
        header( "HTTP/1.1 200 Datos Obtenidos general" );
        echo json_encode( $consulta->fetchAll() );
        exit();

    }
}


    if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$queryInsert = "INSERT INTO bvmsi8xlfpo4eoqm8huh (servidor_denunciado, entidad_perteneciente, lugar_echos, descripcion_evento) 
        VALUES(:servidor_denunciado, :entidad_perteneciente, :lugar_echos, :descripcion_evento)";
		$insertar = $PDO->prepare($queryInsert);
	
		$insertar->bindValue(':servidor_denunciado', $_POST['servidor_denunciado']);
		$insertar->bindValue(':entidad_perteneciente', $_POST['entidad_perteneciente']);
        $insertar->bindValue(':lugar_echos', $_POST['lugar_echos']);
        $insertar->bindValue(':descripcion_evento', $_POST['descripcion_evento']);
    
		$insertar->execute();
		$idPost = $PDO->lastInsertId(); 
		if($idPost)
		{
			header("HTTP/1.1 200 Ok Modificado");
			echo json_encode($idPost);
			exit;
		}
	}

    if($_SERVER['REQUEST_METHOD'] == 'PUT')
	{		
		$query = "UPDATE bvmsi8xlfpo4eoqm8huh SET servidor_denunciado=:servidor_denunciado, 
        entidad_perteneciente=:entidad_perteneciente, lugar_echos=:lugar_echos, 
        descripcion_evento=:descripcion_evento WHERE id_denuncia=:id_denuncia";

		$actualizar = $PDO->prepare($query);
        $actualizar->bindValue(':servidor_denunciado', $_GET['servidor_denunciado']);
		$actualizar->bindValue(':entidad_perteneciente', $_GET['entidad_perteneciente']);
        $actualizar->bindValue(':lugar_echos', $_GET['lugar_echos']);
        $actualizar->bindValue(':descripcion_evento', $_GET['descripcion_evento']);
		$actualizar->bindValue(':id_denuncia', $_GET['id_denuncia']);
		$actualizar->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}


    if($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    $query = "DELETE FROM bvmsi8xlfpo4eoqm8huh WHERE id_denuncia=:id_denuncia";
    $eliminar = $PDO->prepare($query);
    $eliminar->bindValue(':id_denuncia', $_GET['id_denuncia']);
    $eliminar->execute();

    header("HTTP/1.1 200 Ok Eliminado");
    exit;
}


header("HTTP/1.1 400 Bad Request");



?>

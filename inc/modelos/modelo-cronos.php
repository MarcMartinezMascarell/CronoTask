<?php

$id_tarea = (int) $_POST['idTarea'];
$accion = $_POST['accion'];

$date = date("Y-m-d H:i:s");

if($accion === 'start'){
    //Import Conection
    include '../funciones/conexion.php';

    try{
        //Realizar consulta base de datos
        $stmt = $conn->prepare("INSERT INTO cronos (id_task, startTime) VALUES (?, now())");
        $stmt->bind_param('i', $id_tarea);
        $stmt->execute();
        if($stmt->affected_rows > 0){
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => $accion,
                'tiempo' => $date
            );
        } else{
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
		

        $stmt->close();
        $conn->close();


    } catch(Exception $e) {
        //En caso de error, hacer excepcion
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);
    
}

if($accion === 'pause'){
    //Import Conection
    include '../funciones/conexion.php';

    try{
        //Realizar consulta base de datos
        $stmt = $conn->prepare("UPDATE cronos set endTime = now(), totalSeconds = TIME_TO_SEC(TIMEDIFF(now(), startTime)) WHERE id_task = ?");
		$stmt->bind_param('i', $id_tarea);
        $stmt->execute();
        if($stmt->affected_rows > 0){
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => $accion,
                'tiempo' => $date
            );
        } else{
            $respuesta = array(
                'respuesta' => 'error'
            );
        }

        $stmt->close();
        $conn->close();


    } catch(Exception $e) {
        //En caso de error, hacer excepcion
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);
    
}
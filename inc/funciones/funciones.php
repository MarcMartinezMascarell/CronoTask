<?php
//Obtain page
function obtenerPaginaActual(){
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);
    return $pagina;
}

//Obtain all Projects
function obtenerProyectos(){
    include 'conexion.php';

    try{
        return $conn->query('SELECT id, nombre FROM proyectos');
    } catch(Exception $e){
        echo "Error! : " . $e->getMessage();
        return false;
    }
}

//Obtain Project Name

function obtenerNombreProyecto($id = null){
    include 'conexion.php';

    try{
        return $conn->query("SELECT nombre FROM proyectos WHERE id = {$id}");
    } catch(Exception $e){
        echo "Error! : " . $e->getMessage();
        return false;
    }
}

//Obtain Project Tasks

function obtenerTareasProyecto($id = null){
    include 'conexion.php';

    try{
        return $conn->query("SELECT id, nombre, estado FROM tareas WHERE id_proyecto = {$id}");
    } catch(Exception $e){
        echo "Error! : " . $e->getMessage();
        return false;
    }
}

//Sum task times
function sumTiemposTarea($id = null){
    include 'conexion.php';

    try{
        return $conn->query("SELECT SUM(totalTime) FROM cronos WHERE id_task = {$id}");
    } catch(Exception $e){
        echo "Error! : " . $e->getMessage();
        return false;
    }
}
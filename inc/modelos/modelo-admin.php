<?php
$accion = $_POST['accion'];
$password = $_POST['password'];
$usuario = $_POST['usuario'];


//REGISTRO
if($accion === 'crear'){
    //Create Admins
    //Hash pass
    $opciones = array(
        'cost' => 12
    );
    $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
    //Import Conection
    include '../funciones/conexion.php';

    try{
        //Realizar consulta base de datos
        $stmt = $conn->prepare("INSERT INTO usuarios (usuario, password) VALUES (?, ?)");
        $stmt->bind_param('ss', $usuario, $hash_password);
        $stmt->execute();
        if($stmt->affected_rows > 0){
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => $acion
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

//LOGIN

if($accion === 'login'){
    //Login Admins
    include '../funciones/conexion.php';

    try{
        //Select admin from DB
        $stmt = $conn->prepare("SELECT usuario, id, password FROM usuarios WHERE usuario = ?");
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        //Login user
        $stmt->bind_result($nombre_usuario, $id_usuario, $pass_usuario);
        $stmt->fetch();
        if($nombre_usuario){
            //User exists, verify password
            if(password_verify($password, $pass_usuario)){
                //Correct Login
                //iniciar la sesion
                session_start();
                $_SESSION['nombre'] = $usuario;
                $_SESSION['id'] = $id_usuario;
                $_SESSION['login'] = true;
                
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'nombre' => $nombre_usuario,
                    'tipo' => $accion
                );
            } else{
                //Login not correct
                $respuesta = array(
                    'resultado' => 'Password Incorrecto'
                );
            }
            
        } else {
            $respuesta = array(
                'error' => 'User doesnt Exist'
            );
        }
        $stmt->close();
        $conn->close();

    } catch(Exception $e) {
        //En caso de error, hacer excepcion
        $respuesta = array(
            'pass' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);
}
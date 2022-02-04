<?php
    
    header("Content-Type: application/json");
    include_once("../clases/class-usuario.php");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'),true);
            $usuario = new Usuario($_POST["name"], $_POST["lastName"],$_POST["phone"]);
            $usuario->saveUser();
            $resultado["mensaje"] = "Guardar usuario, informacion: ". json_encode($_POST);
            echo json_encode($resultado);
        break;
        case 'GET':
            if(isset($_GET['id'])){
                Usuario::gettUser($_GET['id']);
            }else{
                Usuario::gettUsers();
            }
        break;
        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'),true);
            $usuario = new Usuario($_PUT['name'],$_PUT['lastName'],$_PUT['phone']);
            $usuario->updateUser($_GET['id']);
            $resultado["mensaje"] = "Actualizar un usuario con el id: " .$_GET['id'].", Informacion a actualizar: ". json_encode($_PUT);
            echo json_encode($resultado);
        break;
        case 'DELETE':
            Usuario::deleteUser($_GET['id']);
            $resultado["mensaje"] = "Eliminar un usuario con el id: ".$_GET['id'];
            echo json_encode($resultado);
        break;
    }


?>
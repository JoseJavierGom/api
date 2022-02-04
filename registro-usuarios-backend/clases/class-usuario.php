<?php

class Usuario{
    private $name;
    private $lastName;
    private $phone;

    public function __construct($name,$lastName,$phone){
        $this->name = $name;
        $this->lastName = $lastName;
        $this->phone = $phone;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function setLastName($lastName){
        $this->lastName = $lastName;
        return $this;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function setPhone($phone){
        $this->phone = $phone;
        return $this;
    }

    public function __toString(){
        return $this->name ." ".$this->lastName." ".$this->phone;
    }

    //CRUD
    public function saveUser(){
        $contenidoArchivo = file_get_contents("../data/usuarios.json");
        $usuarios = json_decode($contenidoArchivo, true);
        $usuarios[] = array(
            "name"=> $this->name,
            "lastName"=> $this->lastName,
            "phone"=> $this->phone
        );
        $archivo = fopen("../data/usuarios.json","w");
        fwrite($archivo, json_encode($usuarios));
        fclose($archivo);
    }
    public static function gettUsers(){
        $contenidoArchivo = file_get_contents("../data/usuarios.json");
        echo $contenidoArchivo;
    }

    public static function gettUser($indice){
        $contenidoArchivo = file_get_contents("../data/usuarios.json");
        $usuarios = json_decode($contenidoArchivo, true);
        echo json_encode($usuarios[$indice]);
    }
    public function updateUser($indice){
        $contenidoArchivo = file_get_contents("../data/usuarios.json");
        $usuarios = json_decode($contenidoArchivo, true);
        $usuario = array(
            'name'=> $this->name,
            'lastName'=> $this->lastName,
            'phone'=> $this->phone
        );
        $usuarios[$indice] = $usuario;
        $archivo = fopen('../data/usuarios.json', 'w');
        fwrite($archivo, json_encode($usuarios));
        fclose($archivo);
    }
    public static function deleteUser($indice){
        $contenidoArchivo = file_get_contents("../data/usuarios.json");
        $usuarios = json_decode($contenidoArchivo, true);
        array_splice($usuarios, $indice, 1);
        $archivo = fopen('../data/usuarios.json', 'w');
        fwrite($archivo, json_encode($usuarios));
        fclose($archivo);
    }
}

?>
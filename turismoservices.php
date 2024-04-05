<?php
    require_once 'conexion.php';
    require_once 'lib/nusoap.php';
    function obtenerstios_turisticos(){
        try{
            $conexion=new conexion();
            $consulta=$conexion->prepare("SELECT * From stios_turisticos");
            $consulta->execute();
            $datos=$consulta->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($datos);
        } catch (Exception $ex){
            echo json_encode(false);
        }
    }
    function insertarstios_turisticos($nombre,$ubicacion,$descripcion){
        try{
            $conexion=new conexion();
            $consulta=$conexion->prepare("INSERT INTO stios_turisticos(
                Nombre,Ubicacion,Descripcion) 
                Values(:nombre,:ubicacion,:descripcion)");
            $consulta->bindParam(':nombre',$nombre,PDO::PARAM_STR);
            $consulta->bindParam(':ubicacion',$ubicacion,PDO::PARAM_STR);
            $consulta->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
            $consulta->execute();
            $ultimoID= $conexion->lastInsertId();
            return join(",",array($ultimoID));
        }catch (Exception $ex){
            return join(",",array(false));
        }
    }

     function modificarstios_turisticos($id, $nombre, $ubicacion, $descripcion){
    try{
        $conexion=new conexion();
        $consulta=$conexion->prepare("UPDATE stios_turisticos SET Nombre=:nombre, Ubicacion=:ubicacion,  	Descripcion=:descripcion WHERE Id=:id");
        $consulta->bindParam(':id',$id,PDO::PARAM_INT);
        $consulta->bindParam(':nombre',$nombre,PDO::PARAM_STR);
        $consulta->bindParam(':ubicacion',$ubicacion,PDO::PARAM_STR);
        $consulta->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
        $consulta->execute();
        return json_encode(true);
    }catch (Exception $ex){
        return json_encode(false);
    }
}

function eliminarstios_turisticos($id){
    try{
        $conexion=new conexion();
        $consulta=$conexion->prepare("DELETE FROM stios_turisticos WHERE Id=:id");
        $consulta->bindParam(':id',$id,PDO::PARAM_INT);
        $consulta->execute();
        return json_encode(true);
    }catch (Exception $ex){
        return json_encode(false);
    }
}

    //definicion del servicio
    $server=new nusoap_server();
    $server->configureWSDL("turismoservice","urn:turismoservice");
    //registrar metodos
    $server->register("obtenerstios_turisticos",
    array(),
    array("return"=>"xsd:string"),
    "urn:turismoservice",
    "urn:turismoservice#obtenerstios_turisticos",
    "rpc",
    "encode",
    "Metodo para consultar turismo"
    );
    $server->register("insertarstios_turisticos",
    array("nombre"=>"xsd:string","ubicacion"=>"xsd:string","descripcion"=>"xsd:string"),
    array("return"=>"xsd:string"),
    "urn:turismoservice",
    "urn:turismoservice#insertarstios_turisticos",
    "rpc",
    "encode",
    "Metodo para insertar nuevo turismo"
    );

$server->register("modificarstios_turisticos",
    array("id"=>"xsd:int", "nombre"=>"xsd:string", "ubicacion"=>"xsd:string", "descripcion"=>"xsd:string"),
    array("return"=>"xsd:string"),
    "urn:turismoservice",
    "urn:turismoservice#modificarstios_turisticos",
    "rpc",
    "encode",
    "Método para modificar un sitio turístico"
);

$server->register("eliminarstios_turisticos",
    array("id"=>"xsd:int"),
    array("return"=>"xsd:string"),
    "urn:turismoservice",
    "urn:turismoservice#eliminarstios_turisticos",
    "rpc",
    "encode",
    "Método para eliminar un sitio turístico"
);

    $post=file_get_contents('php://input');
    $server->service($post);
?>
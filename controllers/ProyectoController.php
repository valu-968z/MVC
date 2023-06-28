<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

require_once $_SERVER['DOCUMENT_ROOT']. "/" . $rutaProyecto[1] .'/models/ProyectoModel.php';



class ProyectoController extends Connection
{
    public function crear($pro_ID,$Nombre_proyecto,$Descripcion)
    {
        $proyecto_obj = new Proyecto($pro_ID,$Nombre_proyecto,$Descripcion);
        $proyecto = $proyecto_obj->crear();
        return $proyecto;
    }

    public function editar($pro_ID, $Nombre_proyecto, $Descripcion)
    {
        $proyecto_obj = new Proyecto($pro_ID, $Nombre_proyecto, $Descripcion);
        $proyecto = $proyecto_obj->editar($pro_ID);
        return $proyecto;
    }

    public function borrar($id)
    {
       $proyecto_obj = new Proyecto($id);
       $proyecto=$proyecto_obj->borrar();
       return $proyecto;
    }


    public function listar_proyectos()
    {
        $proyecto_obj=new Proyecto();
        $proyectos= $proyecto_obj->listar_proyectos();
        return $proyectos;
    }


    public function select_proyectos($pro_ID)
    {
        // FETCH_OBJ
        $sql = $this->dbConnection->prepare("SELECT * FROM proyectos WHERE pro_ID = ?");
        $sql->bindParam(1, $pro_ID);

        // Ejecutamos
        $sql->execute();

        // Ahora vamos a indicar el fetch mode cuando llamamos a fetch:
        if($row = $sql->fetch(PDO::FETCH_OBJ)) {
            // Creacion de objeto de la clase Proyecto
            $pro_obj = new Proyecto($row->pro_ID, $row->Nombre_proyecto, $row->Descripcion);
        }else{
            $pro_obj = null;
        }
        return $pro_obj; // Se retorna el objeto de proyectos


    }
}



?>
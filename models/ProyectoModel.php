<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

require_once $_SERVER['DOCUMENT_ROOT']. "/" . $rutaProyecto[1] .'/core/Connection.php';


class Proyecto extends Connection
{
    private $pro_ID;
    private $Nombre_proyecto;
    private $Descripcion;

    public function __construct($pro_ID=null, $Nombre_proyecto=null, $Descripcion=null)
    {
        $this->pro_ID=$pro_ID;
        $this->Nombre_proyecto=$Nombre_proyecto;
        $this->Descripcion=$Descripcion;
        parent::__construct();
    }

    public function listar_proyectos()
    {
        try
        {
            // FETCH_OBJ
            $sql=$this->dbConnection->prepare("SELECT * FROM proyectos");

            //ejecutamos
            $sql->execute();
            $resultSet=null;

            //Ahora indicamos el fetch mode cuando llamamos a fetch:
            while($row=$sql->fetch(PDO::FETCH_OBJ))
            {
                $resultSet[]=$row;
            }

            return $resultSet;
        }catch(PDOException $ex){   
            echo '<div class="alert alert-danger container text-center" role="alert">
            <strong>ERROR EN SISTEMA CONSULTE A SU TI MAS CERCANO</strong>
            </div>';
            die();
        }
    }

    public function crear()
    {
        try
        {
            $sql = $this->dbConnection->prepare("INSERT INTO proyectos (pro_ID, Nombre_proyecto, Descripcion)
            values(?,?,?)");
            $sql->bindParam(1, $this->pro_ID);
            $sql->bindParam(2, $this->Nombre_proyecto);
            $sql->bindParam(3, $this->Descripcion);
            //ejetecutamos
            $sql->execute();
            return $sql;
        }catch(PDOException $ex){
            echo $ex->getMessage();
            die();
        }
    }

    public function editar($pro_ID)
    {
        try
        {
            $dbproyecto = $this->dbConnection->prepare("UPDATE proyectos SET Nombre_proyecto=:Nombre_proyecto,
            Descripcion=:Descripcion WHERE pro_ID=:pro_ID");
            $dbproyecto->bindParam(":pro_ID", $this->pro_ID);
            $dbproyecto->bindParam(":Nombre_proyecto", $this->Nombre_proyecto);
            $dbproyecto->bindParam(":Descripcion", $this->Descripcion);

            $dbproyecto->execute();
            return $dbproyecto;
        }catch(PDOException $ex){
            echo $ex->getMessage();
            die();
        }
        
    }

    public function borrar()
    {
        try
        {
            $dbproyecto = $this->dbConnection->prepare("DELETE FROM proyectos where pro_ID=:pro_ID");
            $dbproyecto->bindParam(":pro_ID", $this->pro_ID);
            $dbproyecto->execute();
            return $dbproyecto;
        }catch(PDOException $ex){
            echo $ex->getMessage();
            die();
        }
    }

    //funciones get y set de los atributos

    public function getpro_ID()
    {
        return $this->pro_ID;
    }
    public function setpro_ID($pro_ID)
    {
        $this->pro_ID=$pro_ID;
        return $this;
    }

    public function getNombre()
    {
        return $this->Nombre_proyecto;
    }

    public function setNombre($Nombre_proyecto)
    {
        $this->Nombre_proyecto=$Nombre_proyecto;
        return $this;
    }

    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    public function setDescripcion($Descripcion)
    {
        $this->Descripcion=$Descripcion;
        return $this;
    }
}


?>
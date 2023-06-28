<?php
    include_once '../proyectos/header.php';
    include_once '../../controllers/ProyectoController.php';
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <title>Proyectos</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
</head>
<body>
    <?php
        // Se crea una instancia de la clase ProyectoController
        $proyecto_obj = new ProyectoController();
        // Se llama al método que lista a todos los proyectos
        $proyectos = $proyecto_obj->listar_proyectos();
        $pro = new ProyectoController();
    ?>
    <div class="container">
        <h1>Gestionar Proyectos</h1>
        
        <div class="row">
            <div class="col-1">ID</div>
            <div class="col-3">Nombre</div>
            <div class="col-4">Descripcion</div>
            <div class="col-3">Opciones</div>
        </div><br>
        <form method="post">
        <div class="row">
            <div class="col-1">
                <input type="number" class="form-control" name="pro_ID">
            </div>
            <div class="col-3">
                <input type="text" class="form-control" name="Nombre_proyecto">
            </div>
            <div class="col-4">
                <input type="text" class="form-control" name="Descripcion">
            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-success" name="crear"><img src="../../images/agregar.png" width="24"></button>
            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-warning" name="ver"><img src="../../images/ver.png" width="24"></button>
            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-primary" name="editar"><img src="../../images/editar.png" width="24"></button>
            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-danger" name="borrar"><img src="../../images/basura.png" width="24"></button>
            </div>
        </div><br>
        <?php foreach ($proyectos as $item) {?>
        <div class="row">
            <div class="col-1"><?php echo $item->pro_ID; ?></div>
            <div class="col-3"><?php echo $item->Nombre_proyecto; ?></div>
            <div class="col-4"><?php echo $item->Descripcion; ?></div>
        </div><br>
        <?php }?>
        </form>
        <?php
            if(isset($_POST['crear']))
            {
                $pro->crear($_POST['pro_ID'],$_POST['Nombre_proyecto'],$_POST['Descripcion']);
                echo "<script>alert('Proyecto creado exitosamente')</script>";
            }
            if(isset($_POST['editar']))
            {
                $pro->editar($_POST['pro_ID'],$_POST['Nombre_proyecto'],$_POST['Descripcion']);
                echo "<script>alert('Proyecto actualizado exitosamente')</script>";
            }
            if(isset($_POST['borrar']))
            {
                $pro->borrar($_POST['pro_ID']);
                echo "<script>alert('El proyecto ha sido eliminado')</script>";
            }
        ?>
    </div>
    <br>
    <div class="container-fluid backg1"></div>

    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>

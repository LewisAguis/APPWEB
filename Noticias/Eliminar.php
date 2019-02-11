<!DOCTYPE html>
<html>
<head>
	<title>Eliminar</title>
	<link rel="stylesheet" type="text/css" href="Noticias/css/bootstrap.css">
    <ul class="nav  justify-content-center">
        
        <li class="nav-item">
            <a class="nav-link " href="Menu.php">Regresar a menu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="PortalNoticias.php">Inicio</a>
        </li>
    </ul>
</head>
<body>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Otras opciones </div>
      <div class="list-group list-group-flush">
         <a href="ValidarNoticias.php" class="list-group-item list-group-item-action bg-light">Nueva Noticia</a>
        <a href="ActualizarNoticia.php" class="list-group-item list-group-item-action bg-light">Modificar Noticia</a>
        <a href="VerNoticias.php" class="list-group-item list-group-item-action bg-light">Todas las Noticias</a>
     
      </div>
    </div>
    <!-- /#sidebar-wrapper -->


<div class="d-flex flex-column bd-highlight mb-3 ">
        
  <?php
        require_once "Conectar.php";
        $db = conectaDB();
       
      
        $datos;
        $consulta = "SELECT * FROM Noticias";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } else {
            foreach ($result as $valor) {
                $datos[]=$valor;
            }
        }

        $db = null;
   
        
    $filas= sizeof($datos);
    
    ?>
    

    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Autor</th>
                <th scope="col">Fecha</th>
              
            </tr>
        </thead>
        <tbody>
            <?php
            
            
            for ($i = 0; $i < $filas; $i++) {
                $id=$datos[$i]["Id"];
                $nom=$datos[$i]["NOMBRE"];
                $Aut=$datos[$i]["AUTOR"];
                $fech=$datos[$i]["FECHA"];
               print "<tr><th scope='row'>$id</th><td>$nom</td><td>$Aut</td><td>$fech</td></tr>";
            }
            
           
            ?>
</table>

</div>
<div class="container-fluid">
<div class="d-flex p-2 bd-highlight d-flex justify-content-center align-items-center">  

    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>
            <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                     <div class="form-group">
                            <label for="formGroupExampleInput">Id</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Id" name="Id">
                    </div>
 
                <button type="submit" class="btn btn-primary">Eliminar Noticia</button>
            </form>
             
        <?php } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
            

          

            $id=$_POST["Id"];
        
            require_once "Conectar.php";
            $db = conectaDB();
        
            $consulta="DELETE FROM `Noticias` where id=$id" ;
         
             $result = $db->query($consulta);
             $ult=$result->fetch(PDO::FETCH_NUM);
          
            if (!$result) {
                        print "    <p>Error,Id no existente</p>\n";
                    } else {
                        $db = null;
                         print "    <p>Exito</p>\n";
                        
                    }
            print "<a class='btn btn-primary' href='Eliminar.php' role='button'>Regresar</a>";
                    
                
        } else {
                die("This script only works with GET and POST requests.");
        }       
             
        
        ?>
            
            
</div>

</div>

</body>
</html>
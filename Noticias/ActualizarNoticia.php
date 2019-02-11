<!DOCTYPE html>
<html>
<head>
	<title>Modificar Noticia</title>
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
        <a href="Eliminar.php" class="list-group-item list-group-item-action bg-light">Eliminar Noticia</a>
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
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Titulo" name="Id">
                    </div>
 
                    <div class="form-group">
                            <label for="formGroupExampleInput">Titulo</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Titulo" name="Titulo">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Autor</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Autor" name="Autor">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Descripcion</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Descripcion" name="Descripcion">
                    </div>
                
        
               

                    <div class="form-group">
                        <label for="formGroupExampleInput">URL</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="URL" name="URL">
                    </div>
        
        
                    <div class="form-group col-md-4">
                        <label for="inputState">Categoria</label>
                        <select id="inputState" class="form-control" name="Categoria">
                            <option selected>Deporte</option>
                            <option selected>Politica</option>
                            <option selected>Cultura</option>
                            <option selected>Entretenimiento</option>
                        </select>
                    </div>
                </div>
    
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Noticia</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="Noticia"></textarea>
                </div>
        
       
                <div class="form-group">
                    <label for="exampleFormControlFile1">Imagen</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="Imagen">
                </div>

                <button type="submit" class="btn btn-primary">Validar Noticia</button>
            </form>
             
        <?php } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
            $uploadedfileload="true";
            $uploadedfile_size=$_FILES['Imagen'][size];
            $file_name=$_FILES["Imagen"][name];
            print "$file_name";
            if ($_FILES["Imagen"][size]>2000000){
                $msg=$msg."El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>";
                $uploadedfileload="false";
                
            }

            if (!($_FILES["Imagen"][type] =="image/pjpeg" OR $_FILES["Imagen"][type] =="image/gif" OR $_FILES["Imagen"][type] =="image/pjpg" OR $_FILES["Imagen"][type] =="image/jpeg" OR $_FILES["Imagen"][type] =="image/jpg")){
                $msg=$msg." Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos<BR>";
                $uploadedfileload="false";
            }

            $file_name=$_FILES["Imagen"][name];
            $add="Imagenes/$file_name";
            if($uploadedfileload=="true"){

                if(move_uploaded_file ($_FILES["Imagen"][tmp_name], $add)){
                    echo " Ha sido subido satisfactoriamente";
                }else{
                    echo "Error al subir el archivo";}

            }else{
                echo $msg;
                
            }


            print "<a class='btn btn-primary' href='pruebas.php' role='button'>Regresar</a>";

            $titulo=$_POST["Titulo"];
            $Autor=$_POST["Autor"];
            $Url=$_POST["URL"];
            $Categoria=$_POST["Categoria"];
            $Descripcion=$_POST["Descripcion"];
            $Noticia=$_POST["Noticia"];
            $Imagen=$_POST["Imagen"];
            $hoy = date("Y-m-d"); 
            $Fecha=$hoy;
            $id=$_POST["Id"];
        
            require_once "Conectar.php";
            $db = conectaDB();
        
            $consulta="UPDATE `Noticias` SET `NOMBRE`='$titulo',`Categoria`='$Categoria',`AUTOR`='$Autor',`FECHA`='$Fecha',`Description`='$Descripcion',`Noticia`='$Noticia',`Imagen`='$file_name',`URL`='$Url' where id=$id" ;
         
             $result = $db->query($consulta);
             $ult=$result->fetch(PDO::FETCH_NUM);
          
            if ($utl==null) {
                        print "    <p>Error,Datos insertados incorrectos</p>\n";
                    } else {
                        $db = null;
                        print "\n<p>Redirigiendo</p>\n";
                echo "<script> window.location='PortalNoticias.php'; </script>";
                        
                    }
                    
                
        } else {
                die("This script only works with GET and POST requests.");
        }       
             
        
        ?>
            
            
</div>

</div>

</body>
</html>

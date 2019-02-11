<!DOCTYPE html>
<html>
<head>
	<title>Nueva Noticia</title>
	<link rel="stylesheet" type="text/css" href="Noticias/css/bootstrap.css">
<?php
require_once "Conectar.php";


?>
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
        <a href="ActualizarNoticia.php" class="list-group-item list-group-item-action bg-light">Modificar Noticia</a>
        <a href="Eliminar.php" class="list-group-item list-group-item-action bg-light">Eliminar Noticia</a>
        <a href="VerNoticias.php" class="list-group-item list-group-item-action bg-light">Todas las Noticias</a>
     
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

<div class="container-fluidr">
<div class="d-flex p-2 bd-highlight d-flex justify-content-center align-items-center">  
   
    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>
            <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-row">
 
                    <div class="form-group">
                            <label for="formGroupExampleInput">Titulo</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Titulo" name="Titulo">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Autor</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Autor" name="Autor">
                    </div>
        
                    <div class="form-group">
                        <label for="formGroupExampleInput">Descripcion</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Descripcion" name="Descripcion">
                    </div>
                </div>
        
        
                <div class="form-row">

                    <div class="form-group">
                        <label for="formGroupExampleInput">URL</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="URL" name="URL">
                    </div>
        
        
                    <div class="form-group col-md-4">
                        <label for="inputState">Categoria</label>
                        <select id="inputState" class="form-control" name="Categoria">
                            <option selected>Deporte</option>
                            <option selected>Local</option>
                            <option selected>Tecnologia</option>
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

        
            require_once "Conectar.php";
            $db = conectaDB();
        
        
            $consulta="INSERT INTO Noticias(`NOMBRE`, `Categoria`, `AUTOR`, `FECHA`, `LIKES`, `Description`, `Noticia`, `Imagen`, `URL`) VALUES ('$titulo','$Categoria','$Autor','$Fecha',0,'$Descripcion','$Noticia','$file_name','$Url')";
        
             $result = $db->query($consulta);
             $ult=$result->fetch(PDO::FETCH_NUM);
          
            if (!$result) {
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

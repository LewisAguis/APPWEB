<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Resultados</title>
    	<link rel="stylesheet" href="styles.css">

</head>
<body>
<div class="a1">

</div>
    
</body>

</html>

<style>
html{
    background: black;
}    
p{
    color: white;
    
}    
</style>



<?php

require_once "Conectar.php";
$db = conectaDB();


switch ($_REQUEST["boton"]) {
    case "crear":
        crearP($db,$_REQUEST);
        break;
    case "consulta":
        $consultaP ="SELECT * FROM personas where 1";
        consultaPersona($consultaP,$db);
        break;
    case "eliminar":
        elimP($_REQUEST,$db);
        break;
    case "modificar":
        modifP($_REQUEST,$db);
        break;
    
}


		
function consultaPersona($consultaP,$db){

    $result = $db->query($consultaP);

    if (!$result) {
        print "    <p>Error en la consulta. No se encontro a nadie</p>\n";
    } else {
        
        print "   <h> <p>Nombre  Apellido Sexo  Edad  Direccion</p></h>\n";
        
        foreach ($result as $valor) {
            print "    <p>$valor[nombre] $valor[apellido] $valor[sexo] $valor[edad] $valor[direccion]</p>\n";
        }
    }
}


function crearP($db,$Introducir){
    $Nom=$Introducir["Nombre"];
    $Ape=$Introducir["Apellido"];
    $S=$Introducir["Sexo"];  
    $ED=$Introducir["Edad"];
    $Dir=$Introducir["Direccion"];

   $crear="INSERT INTO personas(nombre, apellido,sexo,edad,direccion) VALUES ('$Nom','$Ape',$S,$ED,'$Dir')";
    
    $result=$db->query($crear);
    
    if (!$result) {
        print "    <p>Error al crear persona.</p>\n";
        print "    <p>.$db->error.</p>\n";
     
    } else {
        print "   <p> Exito</p>";
    }

}

function modifP($Introducir,$db){
    $Nom=$Introducir["Nombre"];
    $Ape=$Introducir["Apellido"];
    $S=$Introducir["Sexo"];  
    $ED=$Introducir["Edad"];
    $Dir=$Introducir["Direccion"];
    $id=$Introducir["id"];

        $Cons="SELECT * from personas where id=$id";
        $res = $db->query($Cons);
        $ult=$res->fetch(PDO::FETCH_NUM);
        
        
        if($ult==null){
             print " <p>$id no encontrado\n</p>";
            
        }else{
            $modi=	"UPDATE personas SET nombre = '$Nom', apellido = '$Ape', sexo= $S, edad=$ED, direccion='$Dir' WHERE id= $id ";
            $result = $db->query($modi);
      
            if(!$result){
                       print "    <p>Error, datos no insertados</p>\n";
          
            }else{
                  print " </p>  Exito<p>";
            }
        }
        
        
    


}

function elimP($IdElim,$db){
    $id=$IdElim["id"];
    $elim="DELETE FROM personas WHERE id=$id";
    $result = $db->query($elim);

    if (!$result) {
        print "    <p>Error al eliminar persona.</p>\n";
    } else {
        print "    <p>Exito</p>";
    }

}

$db = null;

?>

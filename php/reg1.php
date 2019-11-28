   
<?php

    require_once 'init.php';
    //var_dump($_POST); 
    $response = $recaptcha->verify($_POST['g-recaptcha-response']);

    if($response->isSuccess()){
        //conexion con la base de datos
        $link = mysql_connect("localhost","root","") or die ("<h2>No se encuentra el servidor</h2>");
        $db = mysql_select_db("DBDecoraespacios",$link) or die ("<h2>Error de coneccion</h2>");

//Obtenemos los valores del formulario
        $nombres = $_POST['nombresCliente'];        
        $email=$_POST['emailCliente'];
        $telefono=$_POST['telefonoCliente'];
        $mensaje=$_POST['mensajeCliente'];
        
        $req = (strlen($nombres)*strlen($email)*strlen($telefono)*strlen($mensaje)) or die("No se han encontrado todos los campos llenos<br><br><a href='..index.html'>volver</a>"); 
       
        mysql_query("INSERT INTO Clientes VALUES ('','$nombres','$email','$telefono','$mensaje')",$link) or die ("<h2>Error de envio de formulario</h2>");

        echo'<h2>Registro Completo</h2><a href="..\index.html">Volver</a>';
    } else{
        echo'<h2>Verifique la Captcha</h2><a href="..\index.html">Volver</a>';
    }


     
   ?> 

<?php
    //require("password.php");
    $connect = mysqli_connect(NULL, "root", "-myadmin-1488", "aquavital") or die("no conecta a la base");
    
    $id = '1';
    $dni = '33148074';
    $username = 'MATIMALDONADO10';
    $password = 'cueynceoe.a.2';

     function registerUser() {
       
        global $connect, $id, $dni, $username, $password;
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $statement = mysqli_prepare($connect, 'INSERT INTO supervisor (Persona_IdSupervisor, Persona_DNISupervisor, Usuario, Contraseña) VALUES (?,?,?,?)') or die("no prepara la sentencia");


        mysqli_stmt_bind_param($statement, 'iiii', $id, $dni, $username, $passwordHash) or die("ssss");
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);     
    }


    function usernameAvailable() {
        
        global $connect, $username;
        $statement = mysqli_prepare($connect, "SELECT * FROM supervisor WHERE Usuario = ?"); 
        
        mysqli_stmt_bind_param($statement, "s", $username);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 
        
        if ($count < 1){
            return true; 
        }else {
            return false; 
        }
    }
    
    //$response = array();
    //$response["success"] = false;  
    
    if (usernameAvailable()){
        registerUser();
     //   $response["success"] = true;  
    }
    
   //echo json_encode($response);
    //print(json_encode($response));
    mysqli_close($connect);

?>
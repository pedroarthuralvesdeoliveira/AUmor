<?php

function verificarLogin(){
   
    if(isset($_SESSION['idUsuario'])){
        return true;
    }else{
        return false;
    }
}


// function verificaStatusValidacao(){
//     require_once('../Model/usuario.class.php');
//     require_once('../Config/database.class.php');

//     $usuario = new Usuario();
//     if ($_SESSION['statusValidacao'] != 1) {
//         echo "valide seu e-mail";
//     }
// }

?>
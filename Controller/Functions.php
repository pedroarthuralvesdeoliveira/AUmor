<?php

function verificarLogin(){
    return false;

    if(isset($_SESSION['idUsuario'])){
        return true;
    }
}

?>
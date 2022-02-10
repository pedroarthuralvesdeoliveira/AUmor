<?php
session_start();
    CLASS UsuarioControllerLogin{
        public static function login(){
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            
            require_once('../Model/usuario.class.php');
            require_once('../DAO/usuariodao.class.php');
            require_once('../Config/database.class.php');
            
            $db = new Database();
            $dao = new UsuarioDAO($db);

            $usuario = new Usuario();

            if ($_GET['acao'] == "sair") {
                
                session_reset();
                session_destroy();
               
                header('Location:../View/index.html');
                
            } elseif ($_POST) {
                $usuario->setEmail(addslashes($_POST["email"]));
                $usuario->setSenha(addslashes(md5($_POST["senha"]))); 
            }
            
            if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["senha"]) && !empty($_POST["senha"])) { 
                $dao->Login($usuario);
            }            
        }
    }
    UsuarioControllerLogin::login();
?>
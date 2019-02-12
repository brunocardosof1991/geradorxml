<?php
use App\Model\Usuario;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
if(isset($_POST['email']) && ($_POST['senha']))
{
    $login = $_POST['email'];
    $senha = $_POST['senha'];
    $usuario = new Usuario();
        $logado = $usuario->logar($login, $senha);
        if(!empty($logado))
        {       
            session_start();        
            $_SESSION["logado"] = TRUE;
            $_SESSION['id'] = $logado[0]['id'];
            $_SESSION['usuario'] = $logado[0]['usuario']; 
            $_SESSION['status'] = $logado[0]['status']; 
            echo json_encode($_SESSION['usuario']);
        }
}
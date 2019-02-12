<?php
use App\Model\Usuario;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
if(isset($_POST['email']))
{
    $email = $_POST['email'];
    $usuario = new Usuario();
    $validateEmail = $usuario->validateLogin($email);
}
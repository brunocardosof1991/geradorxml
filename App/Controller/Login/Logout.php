<?php
use App\Model\Usuario;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
if(isset($_GET['logout']))
{
    $usuario = new Usuario();
    $usuario = $usuario->logout();
}
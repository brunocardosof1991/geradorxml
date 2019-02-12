<?php
use App\Model\Usuario;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
if(isset($_POST['senha']))
{
    $senha = $_POST['senha'];
    $usuario = new Usuario();
    $validateSenha = $usuario->validateSenha($senha);
}
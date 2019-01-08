<?php
use App\Model\Cliente;
use App\Model\Produto;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
$id = 19;
$cliente = new Produto();
$all = $cliente->getAllProdutos($id);
var_dump($all);

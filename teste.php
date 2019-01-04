<?php
use App\Model\Conexao;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
$file = file_get_contents("teste.json");
$produto = json_decode($file,true);
$produtoOut = array();
for($i=0; $i<count($produto);$i++)
{
    $filtered = array_filter($produto[$i], function($v,$k) {
        return $k !== "NCM" && $k !== "CFOP" && $k !== "produto" && $k !== "preco" && $k !== "CFOP";
    }, ARRAY_FILTER_USE_BOTH);
    array_push($produtoOut,$filtered);
}
print_r($produtoOut); 
    // begin the sql statement
    $sql = "INSERT INTO saidaproduto (idproduto, quantidade ) VALUES ";
    
    $total = count($produtoOut);
    
    // this is where the magic happens
    $it = new ArrayIterator( $produtoOut );
    
    // Iterate over the values in the ArrayObject:
    while($it->valid()){
        $currentItem = $it->current();
        $sql .='('.$currentItem['id'].','.$currentItem['quantidade'].')';
        $it->next();
        $sql .= $it->key() ? ',' : ';';
    }
    $conn = new Conexao();
    $a = $conn->consultar($sql);
?>
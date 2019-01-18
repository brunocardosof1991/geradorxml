<?php

$json = '[
    {"ncm":"84714900","CFOP":"5103","UN":"UN","Descricao":"NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL","Codigo":"111111115","Qtd":"2","Vl Unit":"96.28","Vl Total":192.56},
    {"ncm":"84714900","CFOP":"5103","UN":"UN","Descricao":"NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL","Codigo":"111111112","Qtd":"3","Vl Unit":"185.37","Vl Total":556.11},
    {"ncm":"84714900","CFOP":"5103","UN":"UN","Descricao":"NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL","Codigo":"111111113","Qtd":"4","Vl Unit":"184.38","Vl Total":737.52}]';
$produto = json_decode($json,true);
$sum = 0;
foreach ($produto as $item) {
    $sum += $item['Qtd'];
}
//print_r($sum);
array_push($produto,$sum);
print_r($produto);
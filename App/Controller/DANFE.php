<?php
if(isset($_GET['DANFE']))
{
    $dhEmi = file_get_contents("../public/dhEmi.txt");
    //O que substituir
    $search = ["T","-02:00"];
    //Pelo que substituir
    $replace = ["",""];
    $str_replace = str_replace($search,$replace,$dhEmi);
    //Pegar somente a data da string
    $data = substr($str_replace,0,10);
    //Pegar somente a hora da string
    $hora = substr($str_replace,10,18);
    //Separar a data para poder inverter
    $explode = explode("-", $data);
    //Montar novamente a string com data no formato dia/mes/ano 
    $dhEmi = $explode[2].'-'.$explode[1].'-'.$explode[0].' '.$hora;
    $info = file_get_contents("../public/info.json");
    $infoArray = json_decode($info ,true);
    $produto = file_get_contents("../public/produto.json");
    $produtoArray = json_decode($produto,true);
    $qrcode = file_get_contents("../public/qrcode.txt");
    $nNF = file_get_contents("../public/nNF.txt");
    $protocolo = file_get_contents("/App/public/protocolo.txt");
    $serie = file_get_contents("../public/serie.txt");
    $array = array
    (
        'info'=>$infoArray,
        'produto'=>$produtoArray,
        'qrcode'=>$qrcode,
        'nNF'=>$nNF,
        'protocolo'=>$protocolo,
        'dhEmi'=>$dhEmi,
        'serie'=>$serie
    );
    echo json_encode($array);    
}
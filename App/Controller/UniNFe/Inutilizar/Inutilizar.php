<?php
use App\Model\Xml;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
if(isset($_POST['inicio']) && $_POST['fim'] && $_POST['just'])
{ 
    $xml = new Xml();
    $inicio = $_POST['inicio'];
    $fim = $_POST['fim'];
    $just = $_POST['just'];
    $inutilizacao = array
    (
        'inicio' => $inicio,
        'fim' => $fim
    );
    $xml->inutilizarXml($inicio,$fim,$just);
    //Codigo IBGE ESTADO + ANO + CNPJ Emissor + Modelo da NOTA FISCAL + serie + inicio e fim
    $file = $xml->ide['cUF'].date('y').$xml->emit['CNPJ'].$xml->ide['mod'].$xml->ide['serie'].$inicio.$fim;
    file_put_contents($_SERVER['DOCUMENT_ROOT'] .'/geradorxml/app/public/chaveDeAcesso.txt',$file);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] .'/geradorxml/app/public/inicioFim.json',json_encode($inutilizacao));
    echo json_encode('{"Enviado para o Sefaz"}');
    echo exec('move c:\xampp\htdocs\geradorXml\App\Controller\UniNFe\Inutilizar\*-ped-inu.xml c:\Unimake\UniNFe\12291758000105\nfce\Envio > nul');
}
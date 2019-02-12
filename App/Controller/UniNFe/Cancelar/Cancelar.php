<?php
use App\Model\Xml;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
if(isset($_POST['chave']) && ($_POST['protocolo']))
{
    $xml = new Xml();
    $protocolo = $_POST['protocolo'];
    $chave = $_POST['chave'];
    $xml->cancelarXml($protocolo, $chave);
    echo json_encode('{"Enviado para o Sefaz"}');
    file_put_contents($_SERVER['DOCUMENT_ROOT']  . '/geradorxml/app/public/chaveDeAcesso.txt',substr_replace($chave,'', 0, 3));
    echo exec('move c:\xampp\htdocs\geradorXml\App\Controller\UniNFe\Cancelar\*-ped-eve.xml c:\Unimake\UniNFe\12291758000105\nfce\Envio > nul');
}
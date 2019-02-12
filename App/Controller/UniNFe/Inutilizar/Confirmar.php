<?php
use App\Model\Xml;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
if(isset($_POST['chaveDeAcesso']))
{
    $data = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));
    $YM = substr_replace($data->format('Y-m'), '', -3, -2);
    //Coletar a chave de acesso salva na rota /autirzarXml 
    $chave = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/geradorxml/app/public/chaveDeAcesso.txt');
    $chave .= '-procInutNFe.xml';
    $xmlAutorizado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chave");
    $xmlAutorizado2 = end($xmlAutorizado);
    $xmlAutorizadoToString = print_r($xmlAutorizado2,true);
    $data = array();
    //Se a NFC-e foi inutilizada...
    if(!empty($xmlAutorizadoToString)) {
        $xml = new Xml();
        $data = 'success';
    } else {        
        $data = 'error';
    }
    echo json_encode($data);
}
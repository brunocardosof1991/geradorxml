<?php
use App\Model\NF;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
if(isset($_POST['commit']))
{      
    $data = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));
    $YM = substr_replace($data->format('Y-m'), '', -3, -2);
    $chaveCancelado = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/geradorxml/app/public/chaveDeAcesso.txt');
    $chaveCancelado = 'NFe'.$chaveCancelado.'-procNFe.xml';
    $xmlCancelado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chaveCancelado");   
    $xmlCancelado2 = end($xmlCancelado);
    $xmlCanceladoToString = print_r($xmlCancelado2,true);
                            //\\
    $chaveAutorizado = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/geradorxml/app/public/chaveDeAcesso.txt');
    $chaveAutorizado .= '_110111_01-procEventoNFe.xml';
    $xmlAutorizado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chaveAutorizado");
    $xmlAutorizado2 = end($xmlAutorizado);
    $xmlAutorizadoToString = print_r($xmlAutorizado2,true);
    $data = array();
    //Se a NFC-e foi cancelada...
    if(!empty($xmlAutorizadoToString) && !empty($xmlCanceladoToString)) {
        //Colocar toda NFC-e Autorizada em uma variável (Pegar o link do QR-Code)
        $NFCe = file_get_contents($xmlCancelado2);
        //Coletar o qrcode da NFC-e autorizada
        //Começo da coleta
        $from = "<qrCode>";
        //Fim da coleta
        $to = "</qrCode>";
        function getQRCode($NFCe,$from,$to)
        {
            $sub = substr($NFCe, strpos($NFCe,$from)+strlen($from),strlen($NFCe));
            return substr($sub,0,strpos($sub,$to));
        } 
        $qrCode = getQRCode($NFCe,$from,$to);
        $NF = new NF();
        $xmlCancelado2 = 'file:///'.$xmlCancelado2;
        $NF->salvarNFCancelada($xmlCancelado2,$qrCode);
        echo exec('del /f "C:\xampp\htdocs\geradorXml\App\public\chaveDeAcesso.txt"');
        $data = 'success';
    } else {        
        $data = 'error';
    }
    echo json_encode($data);
}
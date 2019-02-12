<?php
use App\Model\Xml;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
if(isset($_POST['chaveDeAcesso']))
{ 
    $data = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));
    $YM = substr_replace($data->format('Y-m'), '', -3, -2);
    //Coletar a chave de acesso salva na rota /autirzarXml 
    $chave = file_get_contents($_SERVER['DOCUMENT_ROOT'] ."/geradorxml/app/public/chaveDeAcesso.txt");
    $chave .= '-procNFe.xml';
    $xmlAutorizado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chave");
    $xmlAutorizado2 = end($xmlAutorizado);
    //Guardar o arquivo na sessão, pois o unimake esta dando erro ao tentar enviar o arquivo após a confirmação de autorização
    //da nfc-e, erro informando que o arquivo esta sendo usado 
    session_start();
    $_SESSION['XML'] = "C:/Backup XML/Autorizados/$YM/$chave";
    $xmlAutorizadoToString = print_r($xmlAutorizado2,true);
    $data = array();
    //Se a NFC-e foi autorizada...
    if(!empty($xmlAutorizadoToString)) {
        //Colocar toda NFC-e em uma variável
        $NFCe = file_get_contents($xmlAutorizado2);
        //Coletar informações da NFC-e autorizada para preenchimento da DANFE
        //Começo da coleta
        $fromS = "<serie>";
        //Fim da coleta
        $toS = "</serie>";
        function getSerie($NFCe,$fromS,$toS)
        {
            $sub = substr($NFCe, strpos($NFCe,$fromS)+strlen($fromS),strlen($NFCe));
            return substr($sub,0,strpos($sub,$toS));
        }
        //Começo da coleta
        $fromD = "<dhEmi>";
        //Fim da coleta
        $toD = "</dhEmi>";
        function getdhEmi($NFCe,$fromD,$toD)
        {
            $sub = substr($NFCe, strpos($NFCe,$fromD)+strlen($fromD),strlen($NFCe));
            return substr($sub,0,strpos($sub,$toD));
        }
        //Começo da coleta
        $fromN = "<nNF>";
        //Fim da coleta
        $toN = "</nNF>";
        function getnNF($NFCe,$fromN,$toN)
        {
            $sub = substr($NFCe, strpos($NFCe,$fromN)+strlen($fromN),strlen($NFCe));
            return substr($sub,0,strpos($sub,$toN));
        }
        //Começo da coleta
        $fromP = "<nProt>";
        //Fim da coleta
        $toP = "</nProt>";
        function getProtocolo($NFCe,$fromP,$toP)
        {
            $sub = substr($NFCe, strpos($NFCe,$fromP)+strlen($fromP),strlen($NFCe));
            return substr($sub,0,strpos($sub,$toP));
        }
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
        $protocolo = getProtocolo($NFCe,$fromP,$toP);
        $nNF = getnNF($NFCe,$fromN,$toN);
        $dhEmi = getdhEmi($NFCe,$fromD,$toD);
        $serie = getSerie($NFCe,$fromS,$toS);
        file_put_contents('C:/xampp/htdocs/geradorxml/app/public/qrcode.txt',$qrCode);
        file_put_contents('C:/xampp/htdocs/geradorxml/app/public/protocolo.txt',$protocolo);
        file_put_contents('C:/xampp/htdocs/geradorxml/app/public/nNF.txt',$nNF);
        file_put_contents('C:/xampp/htdocs/geradorxml/app/public/dhEmi.txt',$dhEmi);
        file_put_contents('C:/xampp/htdocs/geradorxml/app/public/serie.txt',$serie);
        $xml = new Xml();
        $xml->salvarNF($protocolo);
        echo exec('del /f "C:/xampp/htdocs/geradorXml/App/public/chaveDeAcesso.txt"');
        $data = 'success';
    } else {        
        $data = 'error';
    }
    echo json_encode($data);
}
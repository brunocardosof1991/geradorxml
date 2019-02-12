<?php
if(isset($_GET['chave']))
{    
    $chave = $_GET['chave'];
    $data = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));
    $YM = substr_replace($data->format('Y-m'), '', -3, -2);
    $xmlAutorizado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chave-procNFe.xml");
    $xmlAutorizado2 = end($xmlAutorizado);
    $xmlAutorizadoToString = print_r($xmlAutorizado2,true);
    //Se a NFC-e foi autorizada...
    if(!empty($xmlAutorizadoToString)) 
    {        
        $NFCe = file_get_contents($xmlAutorizado2);
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
        echo json_encode($qrCode);
    } else {echo json_encode('NFC-e Não Existe!');} 
}
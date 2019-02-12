<?php
if(isset($_POST['xMotivo']))
{
    // .xml
    $chave = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/geradorxml/app/public/chaveDeAcesso.txt'); 
    $xmlInutilizado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Retorno/$chave-inu.xml");   
    $xmlInutilizado2 = end($xmlInutilizado);
    $xmlInutilizadoToString = print_r($xmlInutilizado2,true);
    // .err
    $xmlInutilizadoErr = glob("C:/Unimake/UniNFe/12291758000105/nfce/Retorno/$chave-inu.err");   
    $xmlInutilizado2Err = end($xmlInutilizadoErr);
    $xmlInutilizadoToStringErr = print_r($xmlInutilizado2Err,true);
    //Se a NFC-e foi cancelada...
    if(!empty($xmlInutilizadoToString)) 
    {  
        $NFCe = file_get_contents($xmlInutilizado2);     
        //Começo da coleta
        $from = "<xMotivo>";
        //Fim da coleta
        $to = "</xMotivo>";
        function getxMotivo($NFCe,$from,$to)
        {
            $sub = substr($NFCe, strpos($NFCe,$from)+strlen($from),strlen($NFCe));
            return substr($sub,0,strpos($sub,$to));
        } 
        $xMotivo = getxMotivo($NFCe,$from,$to); 
        echo json_encode($xMotivo);
    }
    if(!empty($xmlInutilizadoToStringErr)) 
    {
        echo json_encode('Verifique Sua Conexão Com a Internet');  
    }
}
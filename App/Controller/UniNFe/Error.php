<?php
    if(isset($_POST['cancelar']))
    {
        // .xml
        $chave = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/geradorxml/app/public/chaveDeAcesso.txt'); 
        $path = glob("C:/Unimake/UniNFe/12291758000105/nfce/Retorno/NFe$chave-eve.xml");   
        $pathEnd = end($path);
        $pathToString = print_r($pathEnd,true);
        // .err
        $pathErr = glob("C:/Unimake/UniNFe/12291758000105/nfce/Retorno/NFe$chave-eve.err");   
        $pathEndErr = end($pathErr);
        $pathToStringErr = print_r($pathEndErr,true);
        //Se a NFC-e foi cancelada...
        if(!empty($pathToString)) 
        {  
            $XML = file_get_contents($pathEnd);
            echo json_encode($XML);
        }
        if(!empty($pathToStringErr)) 
        {
            $XML = file_get_contents($pathEndErr);
            echo json_encode($XML);
        }
    }
    if(isset($_POST['inutilizar']))
    {
        // .xml
        $chave = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/geradorxml/app/public/chaveDeAcesso.txt'); 
        $path = glob("C:/Unimake/UniNFe/12291758000105/nfce/Retorno/$chave-inu.xml");   
        $pathEnd = end($path);
        $pathToString = print_r($pathEnd,true);
        // .err
        $pathErr = glob("C:/Unimake/UniNFe/12291758000105/nfce/Retorno/$chave-inu.err");   
        $pathEndErr = end($pathErr);
        $pathToStringErr = print_r($pathEndErr,true);
        //Se a NFC-e foi cancelada...
        if(!empty($pathToString)) 
        {  
            $XML = file_get_contents($pathEnd);
            echo json_encode($XML);
        }
        if(!empty($pathToStringErr)) 
        {
            $XML = file_get_contents($pathEndErr);
            echo json_encode($XML);
        }
    }
    /* Autorizar */
    if(isset($_POST['autorizar']))
    {
        // .xml
        $chave = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/geradorxml/app/public/chaveDeAcesso.txt'); 
        $pathLote = glob("C:/Unimake/UniNFe/12291758000105/nfce/Retorno/$chave-num-lot.xml");   
        $pathEndLote = end($pathLote);
        $pathToStringLote = print_r($pathEndLote,true);
        //Se a NFC-e foi cancelada...
        if(!empty($pathToStringLote)) 
        {  
            //Colocar toda NFC-e em uma variável
            $NFCe = file_get_contents($pathEndLote);
            //Coletar informações da NFC-e autorizada para preenchimento da DANFE
            //Começo da coleta
            $from = "<NumeroLoteGerado>";
            //Fim da coleta
            $to = "</NumeroLoteGerado>";
            function getLote($NFCe,$from,$to)
            {
                $sub = substr($NFCe, strpos($NFCe,$from)+strlen($from),strlen($NFCe));
                return substr($sub,0,strpos($sub,$to));
            }
            $lote = getLote($NFCe,$from,$to);  
            //*rec.xml
            $pathRec = glob("C:/Unimake/UniNFe/12291758000105/nfce/Retorno/*$lote-rec.xml");   
            $pathEndRec = end($pathRec);
            //Colocar toda NFC-e em uma variável
            $NFCeRec = file_get_contents($pathEndRec);
            //Coletar informações da NFC-e autorizada para preenchimento da DANFE
            //Começo da coleta
            $fromRec = "<nRec>";
            //Fim da coleta
            $toRec = "</nRec>";
            function getRec($NFCeRec,$fromRec,$toRec)
            {
                $sub = substr($NFCeRec, strpos($NFCeRec,$fromRec)+strlen($fromRec),strlen($NFCeRec));
                return substr($sub,0,strpos($sub,$toRec));
            }
            $rec = getRec($NFCeRec,$fromRec,$toRec);  
            //-pro-rec.xml
            $pathProRec = glob("C:/Unimake/UniNFe/12291758000105/nfce/Retorno/$rec-pro-rec.xml");   
            $pathEndProRec = end($pathProRec);
            $NFCeProRec = file_get_contents($pathEndProRec);
            echo json_encode($NFCeProRec);
        }/* 
        // .err
        $pathErr = glob("C:/Unimake/UniNFe/12291758000105/nfce/Retorno/$chave-nfe.err");   
        $pathEndErr = end($pathErr);
        $pathToStringErr = print_r($pathEndErr,true);
        if(!empty($pathToStringErr)) 
        {
            $XML = file_get_contents($pathEndErr);
            echo json_encode($XML);
        } */
    }
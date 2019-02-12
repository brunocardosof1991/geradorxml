<?php
if(isset($_GET['chave']))
{   
    $chave = $_GET['chave'];
    $chave .= '-procNFe.xml';
    $data = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));
    $YM = substr_replace($data->format('Y-m'), '', -3, -2);
    $xml = "C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chave";
    //echo exec(`c:/unimake/uninfe/UniDANFE.exe a="C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/{$YM}/{$chave}"`);
    echo system("cmd /c C:[/xampp/htdocs/geradorXml/unidanfe.txt]");
}
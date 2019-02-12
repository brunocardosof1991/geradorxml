<?php
use App\Model\NF;
require_once $_SERVER['DOCUMENT_ROOT'] . '/geradorxml/vendor/autoload.php';
if(isset($_POST['commit']))
{     
    $data = new DateTime('now', new DateTimeZone( 'America/Sao_Paulo'));
    $YM = substr_replace($data->format('Y-m'), '', -3, -2);
    $chaveInutilizado = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/geradorxml/app/public/chaveDeAcesso.txt');
    $arrayInicioFimNumeracao = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/geradorxml/app/public/inicioFim.json');
    $xmlInutilizado = glob("C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/$YM/$chaveInutilizado-procInutNFe.xml");   
    $xmlInutilizado2 = end($xmlInutilizado);
    $xmlInutilizadoToString = print_r($xmlInutilizado2,true);
    $data = array();
    //Se a NFC-e foi cancelada...
    if(!empty($xmlInutilizadoToString)) {  
        $xmlInutilizado2 = 'file:///'.$xmlInutilizado2;
        $jsonToArray = json_decode($arrayInicioFimNumeracao,true);
        $inicio = $jsonToArray['inicio'];
        $fim = $jsonToArray['fim'];
        $NF = new NF();
        $NF->salvarInutilizacao($xmlInutilizado2,$inicio,$fim);
        echo exec('del /f "C:\xampp\htdocs\geradorXml\App\public\chaveDeAcesso.txt"');
        echo exec('del /f "C:\xampp\htdocs\geradorXml\App\public\inicioFim.json"');
        $data = 'success';
    } else {        
        $data = 'error';
    }
    echo json_encode($data);
}
<?php
//Deletar arquivos temporarios
if(isset($_GET['deleteFile']))
{                
    //Arquivo passado da rota /autorizarNFCe para /autorizarNFCe/true
    //Arquivo utilizado para encontrar o xml autorizada na pasta /Enviado/Autorizados do UniNFe
    if(glob("C:/xampp/htdocs/geradorxml/app/public/chaveDeAcesso.txt"))
    {                
        unlink('C:/xampp/htdocs/geradorxml/app/public/chaveDeAcesso.txt');
    }
    //Arquivo com o inicio e fim da numeração inutilizada
    if(glob("C:/xampp/htdocs/geradorxml/app/public/inicioFim.json"))
    {                
        unlink('C:/xampp/htdocs/geradorxml/app/public/inicioFim.json');
    }
    //Arquivo com a data de autorização da NFC-e
    if(glob("C:/xampp/htdocs/geradorxml/app/public/dhEmi.txt"))
    {                
        unlink('C:/xampp/htdocs/geradorxml/app/public/dhEmi.txt');
    }
    //Informações para o preenchimento do XML, como, destinatario, formas de pagamento, etc... 
    if(glob("C:/xampp/htdocs/geradorxml/app/public/info.json"))
    {                
        unlink('C:/xampp/htdocs/geradorxml/app/public/info.json');
    }
    //nNF do XML
    if(glob("C:/xampp/htdocs/geradorxml/app/public/nNF.txt"))
    {                
        unlink('C:/xampp/htdocs/geradorxml/app/public/nNF.txt');
    }
    //Produtos Vendidos
    if(glob("C:/xampp/htdocs/geradorxml/app/public/produto.json"))
    {                
        unlink('C:/xampp/htdocs/geradorxml/app/public/produto.json');
    }
    //Protocolo de autorização
    if(glob("C:/xampp/htdocs/geradorxml/app/public/protocolo.txt"))
    {                
        unlink('C:/xampp/htdocs/geradorxml/app/public/protocolo.txt');
    }
    //Link do QR-Code
    if(glob("C:/xampp/htdocs/geradorxml/app/public/qrcode.txt"))
    {                
        unlink('C:/xampp/htdocs/geradorxml/app/public/qrcode.txt');
    }
    //serie XML
    if(glob("C:/xampp/htdocs/geradorxml/app/public/serie.txt"))
    {                
        unlink('C:/xampp/htdocs/geradorxml/app/public/serie.txt');
    }
}
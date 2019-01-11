<?php
namespace App\Model;
use App\Model\Conexao;
use PDO;

class Emissor {    
    private $connection = '';
    private $id;
    private $CNPJ;
    private $xNome;
    private $xFant;
    private $fone;
    private $CNAE;
    private $CRT;
    private $IM;
    private $IE;
    private $xLgr;
    private $xBairro;
    private $nro;
    private $CEP;
    private $cMun;
    private $xMun;
    private $UF;
    private $xPais;
    private $cPais;
    
    function __construct() 
    {
        $this->connection = new Conexao();
    }
    public function get()
    {        
        $sql = "SELECT * FROM emissor";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $emissor = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($emissor);
            $connection = null;
        }catch(PDOException $e){
            echo json_encode('{"error": '.$e->getMessage().'}');
        }
    }
    public function add($request)
    {
        $id = $request->getParam('id');
        $CNPJ = $request->getParam('CNPJ');
        $xNome = $request->getParam('xNome');
        $xLgr = $request->getParam('xLgr');
        $xFant = $request->getParam('xFant');
        $nro = $request->getParam('nro');
        $xBairro = $request->getParam('xBairro');    
        $cMun = $request->getParam('cMun');    
        $xMun = $request->getParam('xMun');    
        $UF = $request->getParam('UF');    
        $CEP = $request->getParam('CEP');    
        $cPais = $request->getParam('cPais');    
        $xPais = $request->getParam('xPais');    
        $fone = $request->getParam('fone');    
        $IE = $request->getParam('IE');    
        $IM = $request->getParam('IM');    
        $CRT = $request->getParam('CRT');    
        $CNAE = $request->getParam('CNAE');    
        $sql = "INSERT INTO emissor (id,CNPJ,xNome,xLgr,xFant,nro,xBairro,cMun,xMun,UF,CEP,cPais,xPais,fone,IE,IM,crt,cnae) VALUES
        (:id,:CNPJ,:xNome,:xLgr,:xFant,:nro,:xBairro,:cMun,:xMun,:UF,:CEP,:cPais,:xPais,:fone,:IE,:IM,:CRT,:CNAE)";    
        try{
            $connection = $this->connection->PDOConnect();      
            $stmt = $connection->prepare($sql);    
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':CNPJ',  $CNPJ);
            $stmt->bindParam(':xNome',      $xNome);
            $stmt->bindParam(':xLgr',      $xLgr);
            $stmt->bindParam(':xFant',    $xFant);
            $stmt->bindParam(':nro',       $nro);
            $stmt->bindParam(':xBairro',      $xBairro);    
            $stmt->bindParam(':cMun',      $cMun);    
            $stmt->bindParam(':xMun',      $xMun);    
            $stmt->bindParam(':UF',      $UF);    
            $stmt->bindParam(':CEP',      $CEP);    
            $stmt->bindParam(':cPais',      $cPais);    
            $stmt->bindParam(':xPais',      $xPais);    
            $stmt->bindParam(':fone',      $fone);    
            $stmt->bindParam(':IE',      $IE);    
            $stmt->bindParam(':IM',      $IM);    
            $stmt->bindParam(':CRT',      $CRT);    
            $stmt->bindParam(':CNAE',      $CNAE);    
            $stmt->execute();    
            echo json_encode('{"success": "Emissor Adicionado"}');    
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function update($request)
    {
        $id = $request->getParam('id');
        $CNPJ = $request->getParam('CNPJ');
        $xNome = $request->getParam('xNome');
        $xLgr = $request->getParam('xLgr');
        $xFant = $request->getParam('xFant');
        $nro = $request->getParam('nro');
        $xBairro = $request->getParam('xBairro');    
        $cMun = $request->getParam('cMun');    
        $xMun = $request->getParam('xMun');    
        $UF = $request->getParam('UF');    
        $CEP = $request->getParam('CEP');    
        $cPais = $request->getParam('cPais');    
        $xPais = $request->getParam('xPais');    
        $fone = $request->getParam('fone');    
        $IE = $request->getParam('IE');    
        $IM = $request->getParam('IM');    
        $CRT = $request->getParam('CRT');    
        $CNAE = $request->getParam('CNAE');     
        $sql = "UPDATE emissor SET
        id=:id,
        CNPJ=:CNPJ,
        xNome=:xNome,
        xLgr=:xLgr,
        xFant=:xFant,
        nro=:nro,
        xBairro=:xBairro,
        cMun=:cMun,
        xMun=:xMun,
        UF=:UF,
        CEP=:CEP,
        cPais=:cPais,
        xPais=:xPais,
        fone=:fone,
        IE=:IE,
        IM=:IM,
        CRT=:CRT,
        CNAE=:CNAE
                WHERE id = $id";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->prepare($sql);   
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':CNPJ',  $CNPJ);
            $stmt->bindParam(':xNome',      $xNome);
            $stmt->bindParam(':xLgr',      $xLgr);
            $stmt->bindParam(':xFant',    $xFant);
            $stmt->bindParam(':nro',       $nro);
            $stmt->bindParam(':xBairro',      $xBairro);    
            $stmt->bindParam(':cMun',      $cMun);    
            $stmt->bindParam(':xMun',      $xMun);    
            $stmt->bindParam(':UF',      $UF);    
            $stmt->bindParam(':CEP',      $CEP);    
            $stmt->bindParam(':cPais',      $cPais);    
            $stmt->bindParam(':xPais',      $xPais);    
            $stmt->bindParam(':fone',      $fone);    
            $stmt->bindParam(':IE',      $IE);    
            $stmt->bindParam(':IM',      $IM);    
            $stmt->bindParam(':CRT',      $CRT);    
            $stmt->bindParam(':CNAE',      $CNAE);    
            $stmt->execute();   
            echo json_encode('{"success": "Emissor Atualizado"}');    
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function delete($id)
    {    
        $sql = "DELETE FROM emissor WHERE id = $id";    
        try{
            $connection = $this->connection->PDOConnect();      
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $connection = null;
            echo '{"success": "Emissor Deletado"}';
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
}
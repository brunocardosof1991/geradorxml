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
    public function getIde()
    {      
        $sql = "SELECT * FROM ide";    
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
    public function addIde($request)
    {       
        $cUF = $request->getParam('cUF');
        $natOp = $request->getParam('natOp');
        $modelo = $request->getParam('modelo');
        $serie = $request->getParam('serie');
        $tpNF = $request->getParam('tpNF');
        $idDest = $request->getParam('idDest');
        $cMunFG = $request->getParam('cMunFG');
        $tpImp = $request->getParam('tpImp');
        $tpEmis = $request->getParam('tpEmis');
        $tpAmb = $request->getParam('tpAmb');
        $finNFe = $request->getParam('finNFe');
        $indFinal = $request->getParam('indFinal');
        $indPres = $request->getParam('indPres');
        $procEmi = $request->getParam('procEmi');      
        $sql = 'INSERT INTO ide (cUF,natOp,modelo,serie,tpNF,idDest,cMunFG,tpImp,tpEmis,tpAmb,finNFe,indFinal,indPres,procEmi) VALUES 
        (:cUF,:natOp,:modelo,:serie,:tpNF,:idDest,:cMunFG,:tpImp,:tpEmis,:tpAmb,:finNFe,:indFinal,:indPres,:procEmi)';
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':cUF',  $cUF);
            $stmt->bindParam(':natOp',      $natOp);
            $stmt->bindParam(':modelo',      $modelo);
            $stmt->bindParam(':serie',    $serie);
            $stmt->bindParam(':tpNF',       $tpNF);
            $stmt->bindParam(':idDest',      $idDest);
            $stmt->bindParam(':cMunFG',      $cMunFG);
            $stmt->bindParam(':tpImp',      $tpImp);
            $stmt->bindParam(':tpEmis',      $tpEmis);
            $stmt->bindParam(':tpAmb',      $tpAmb);
            $stmt->bindParam(':finNFe',      $finNFe);
            $stmt->bindParam(':indFinal',      $indFinal);
            $stmt->bindParam(':indPres',      $indPres);
            $stmt->bindParam(':procEmi',      $procEmi);
            $stmt->execute();
            $connection = null;
            echo json_encode('Success');
        } catch(PDOException $e){
            echo '{"Error": '.$e->getMessage().'}';
        }
    }
    public function updateIde($request)
    {       
        $cUF = $request->getParam('cUF');
        $natOp = $request->getParam('natOp');
        $modelo = $request->getParam('modelo');
        $serie = $request->getParam('serie');
        $tpNF = $request->getParam('tpNF');
        $idDest = $request->getParam('idDest');
        $cMunFG = $request->getParam('cMunFG');
        $tpImp = $request->getParam('tpImp');
        $tpEmis = $request->getParam('tpEmis');
        $tpAmb = $request->getParam('tpAmb');
        $finNFe = $request->getParam('finNFe');
        $indFinal = $request->getParam('indFinal');
        $indPres = $request->getParam('indPres');
        $procEmi = $request->getParam('procEmi');      
        $sql = "UPDATE ide SET
        cUF=:cUF,natOp=:natOp,modelo=:modelo,serie=:serie,tpNF=:tpNF,idDest=:idDest,cMunFG=:cMunFG,tpImp=:tpImp,tpEmis=:tpEmis,tpAmb=:tpAmb,
        finNFe=:finNFe,indFinal=:indFinal,indPres=:indPres,procEmi=:procEmi WHERE cUF = $cUF";
        
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':cUF',  $cUF);
            $stmt->bindParam(':natOp',      $natOp);
            $stmt->bindParam(':modelo',      $modelo);
            $stmt->bindParam(':serie',    $serie);
            $stmt->bindParam(':tpNF',       $tpNF);
            $stmt->bindParam(':idDest',      $idDest);
            $stmt->bindParam(':cMunFG',      $cMunFG);
            $stmt->bindParam(':tpImp',      $tpImp);
            $stmt->bindParam(':tpEmis',      $tpEmis);
            $stmt->bindParam(':tpAmb',      $tpAmb);
            $stmt->bindParam(':finNFe',      $finNFe);
            $stmt->bindParam(':indFinal',      $indFinal);
            $stmt->bindParam(':indPres',      $indPres);
            $stmt->bindParam(':procEmi',      $procEmi);
            $stmt->execute();
            $connection = null;
            echo json_encode('{"success": "Ide Atualizado"}');
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
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
        $sql = "INSERT INTO emissor (CNPJ,xNome,xLgr,xFant,nro,xBairro,cMun,xMun,UF,CEP,cPais,xPais,fone,IE,IM,CRT,CNAE) VALUES
        (:CNPJ,:xNome,:xLgr,:xFant,:nro,:xBairro,:cMun,:xMun,:UF,:CEP,:cPais,:xPais,:fone,:IE,:IM,:CRT,:CNAE)";    
        try{
            $connection = $this->connection->PDOConnect();      
            $stmt = $connection->prepare($sql);  
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

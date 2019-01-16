<?php
namespace App\Model;
use App\Model\Conexao;
use PDO;

class NF
{
    private $id;
    private $chave;
    private $cNF;
    private $nNF;
    private $dhEmi;
    private $protocolo;
    private $connection = '';

    function __construct()
    {
        $this->connection = new Conexao();    
    }
    public function salvarInutilizacao($xml,$inicio,$fim)
    {
        $sql = "INSERT INTO inutilizado (`xml`,inicio,fim) values ('".$xml."',$inicio,$fim )";
        try{
            $connection = $this->connection->PDOConnect();  
            $stmt = $connection->prepare($sql);   
            $stmt->execute();   
            $connection = null; 
            echo '{"success": "Registro salvo com sucesso"}';    
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function getAllInutilizadas()
    {       
        $sql = "SELECT * FROM inutilizado";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $NF = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($NF);            
            $connection = null;
        }catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function salvarNFCancelada($xml,$nf)
    {
        $sql = "INSERT INTO nfcancelada (`xml`,nf) values ('".$xml."','".$nf."' )";
        try{
            $connection = $this->connection->PDOConnect();  
            $stmt = $connection->prepare($sql);   
            $stmt->execute();   
            $connection = null; 
            echo '{"success": "Registro salvo com sucesso"}';    
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function getAllCanceladas()
    {       
        $sql = "SELECT * FROM nfcancelada";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $NF = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($NF);            
            $connection = null;
        }catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function getAll()
    {       
        $sql = "SELECT id, chave, dhEmi, protocolo FROM nf";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $NF = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($NF);            
            $connection = null;
        }catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function get($id)
    {
        $id = $request->getAttribute('id');    
        $sql = "SELECT * FROM nf WHERE id = {$id}";    
        try{
            $connection = $this->connection->PDOConnect();  
            $stmt = $connection->query($sql);
            $NF = $stmt->fetch(PDO::FETCH_OBJ);
            $connection = null;
            echo  json_encode($NF);
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function add($request)
    {
        $id = $request->getParam('id');
        $chave = $request->getParam('chave');
        $cNF = $request->getParam('cNF');
        $nNF = $request->getParam('nNF');
        $dhEmi = $request->getParam('dhEmi');  
        $sql = "INSERT INTO nf (id,chave,cNF,nNF,dhEmi) VALUES
        (:id,:chave,:cNF,:nNF,:dhEmi)";    
        try{
            $connection = $this->connection->PDOConnect();  
            $stmt = $connection->prepare($sql);    
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':chave',  $chave);
            $stmt->bindParam(':cNF',      $cNF);
            $stmt->bindParam(':nNF',      $nNF);
            $stmt->bindParam(':dhEmi',    $dhEmi);
            $stmt->execute();   
            $connection = null; 
            echo '{"success": "NF Adicionada"}';    
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function update($request)
    {
        $id = $request->getParam('id');
        $chave = $request->getParam('chave');
        $cNF = $request->getParam('cNF');
        $nNF = $request->getParam('nNF');
        $dhEmi = $request->getParam('dhEmi'); 
        $sql = "UPDATE nf SET
                    id 	= :id,
                    chave 	= :chave,
                    cNF		= :cNF,
                    nNF		= :nNF,
                    dhEmi 	= :dhEmi
                WHERE id = $id";    
        try{
            $connection = $this->connection->PDOConnect();  
            $stmt = $connection->prepare($sql);    
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':chave',  $chave);
            $stmt->bindParam(':cNF',      $cNF);
            $stmt->bindParam(':nNF',      $nNF);
            $stmt->bindParam(':dhEmi',    $dhEmi);
            $stmt->execute();    
            $connection = null;
            echo '{"success": "NF Atualizada"}';    
        } catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    }
    public function delete($id)
    {    
        $sql = "DELETE FROM nf WHERE id = {$id}";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $connection = null;
            echo '{"success": "NF Deletada"}';
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
}
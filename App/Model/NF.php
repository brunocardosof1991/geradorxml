<?php
namespace App\Model;
use App\Model\Conexao;
use PDO;

class NF
{
    public $id;
    public $chave;
    public $cNF;
    public $nNF;
    public $dhEmi;
    public $CNPJDestinatario;
    public $xNomeDestinatario;
    public $protocolo;
    private $connection = '';

    function __construct()
    {
        $this->connection = new Conexao();    
    }

    public function getAllNFCe()
    {       
        $sql = "SELECT * FROM nf";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $NF = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ($NF);
        }catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function getNFCe($id)
    {
        $id = $request->getAttribute('id');    
        $sql = "SELECT * FROM nf WHERE id = {$id}";    
        try{
            $connection = $this->connection->PDOConnect();  
            $stmt = $connection->query($sql);
            $NF = $stmt->fetch(PDO::FETCH_OBJ);
            $db = null;
            return ($NF);
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function addNFCe($request)
    {
        $id = $request->getParam('id');
        $chave = $request->getParam('chave');
        $cNF = $request->getParam('cNF');
        $nNF = $request->getParam('nNF');
        $dhEmi = $request->getParam('dhEmi');
        $CNPJDestinatario = $request->getParam('CNPJDestinatario');
        $xNomeDestinatario = $request->getParam('xNomeDestinatario');    
        $sql = "INSERT INTO nf (id,chave,cNF,nNF,dhEmi,CNPJDestinatario,xNomeDestinatario) VALUES
        (:id,:chave,:cNF,:nNF,:dhEmi,:CNPJDestinatario,:xNomeDestinatario)";    
        try{
            $connection = $this->connection->PDOConnect();  
            $stmt = $connection->prepare($sql);    
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':chave',  $chave);
            $stmt->bindParam(':cNF',      $cNF);
            $stmt->bindParam(':nNF',      $nNF);
            $stmt->bindParam(':dhEmi',    $dhEmi);
            $stmt->bindParam(':CNPJDestinatario',       $CNPJDestinatario);
            $stmt->bindParam(':xNomeDestinatario',      $xNomeDestinatario);    
            $stmt->execute();    
            echo '{"Aviso": {"text": "NF Adicionada"}';    
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function updateNFCe($request)
    {
        $id = $request->getParam('id');
        $chave = $request->getParam('chave');
        $cNF = $request->getParam('cNF');
        $nNF = $request->getParam('nNF');
        $dhEmi = $request->getParam('dhEmi');
        $CNPJDestinatario = $request->getParam('CNPJDestinatario');
        $xNomeDestinatario = $request->getParam('xNomeDestinatario');    
        $sql = "UPDATE nf SET
                    id 	= :id,
                    chave 	= :chave,
                    cNF		= :cNF,
                    nNF		= :nNF,
                    dhEmi 	= :dhEmi,
                    CNPJDestinatario 		= :CNPJDestinatario,
                    xNomeDestinatario		= :xNomeDestinatario
                WHERE id = $id";    
        try{
            $connection = $this->connection->PDOConnect();  
            $stmt = $connection->prepare($sql);    
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':chave',  $chave);
            $stmt->bindParam(':cNF',      $cNF);
            $stmt->bindParam(':nNF',      $nNF);
            $stmt->bindParam(':dhEmi',    $dhEmi);
            $stmt->bindParam(':CNPJDestinatario',       $CNPJDestinatario);
            $stmt->bindParam(':xNomeDestinatario',      $xNomeDestinatario);    
            $stmt->execute();    
            echo '{"Aviso": {"text": "NF Atualizada"}';    
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function deleteNFCe($id)
    {    
        $sql = "DELETE FROM nf WHERE id = {$id}";    
        try{
            // Get DB Object
            $db = new Conexao();
            // Connect
            $db = $db->PDOConnect();    
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $db = null;
            echo '{"Aviso": {"text": "NF Deletada"}';
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
}
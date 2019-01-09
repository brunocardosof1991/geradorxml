<?php
namespace App\Model;
use App\Model\Conexao;
use PDO;

class Produto {
    private $id;
    private $descricao;
    private $NCM;
    private $preco_custo;
    private $CFOP;
    private $connection = '';
    
    function __construct()
    {
        $this->connection = new Conexao();
    }

    public function getAllProdutos()
    {        
        $sql = "SELECT * FROM produto";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $produto = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode ($produto);            
            $connection = null;
        }catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function getProduto($id)
    {        
        $sql = "SELECT * FROM produto WHERE id = {$id}";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $produto = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ($produto);
        }catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function addProduto($request)
    {        
        $descricao = $request->getParam('descricao');
        $ncm = $request->getParam('ncm');
        $preco_custo = $request->getParam('preco_custo');
        $CFOP = $request->getParam('CFOP');
        $sql = "INSERT INTO produto (descricao,ncm,preco_custo,CFOP) VALUES
        (:descricao,:ncm,:preco_custo,:CFOP)";
        try{
            $connection = $this->connection->PDOConnect();  
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':descricao',  $descricao);
            $stmt->bindParam(':ncm',      $ncm);
            $stmt->bindParam(':preco_custo',    $preco_custo);
            $stmt->bindParam(':CFOP',       $CFOP);
            $stmt->execute();
            echo json_encode('{"Aviso": {"text": "Produto Adicionado"}');
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function updateProduto($request)
    {
        $id = $request->getParam('id');
        $descricao = $request->getParam('descricao');
        $ncm = $request->getParam('NCM');       
        $preco_custo = $request->getParam('preco_custo');     
        $CFOP = $request->getParam('CFOP');      
        $sql = "UPDATE produto SET
        id=:id,
        descricao=:descricao,
        NCM=:NCM,
        preco_custo=:preco_custo,
        CFOP=:CFOP
                WHERE id = $id";    
        try{
            $connection = $this->connection->PDOConnect();   
            $stmt = $connection->prepare($sql);  
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':descricao',  $descricao);
            $stmt->bindParam(':NCM',      $ncm);    
            $stmt->bindParam(':preco_custo',      $preco_custo); 
            $stmt->bindParam(':CFOP',      $CFOP);     
            $stmt->execute();   
            echo json_encode('{"Aviso": {"text": "Produto Atualizado"}');    
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function deleteProduto($id)
    {    
        $sql = "DELETE FROM produto WHERE id = {$id}";    
        try{
            $connection = $this->connection->PDOConnect();   
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $db = null;
            echo '{"Aviso": {"text": "Produto Deletado"}';
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
}
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

    public function getAll()
    {        
        $sql = "SELECT * FROM produto";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $produto = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode ($produto);            
            $connection = null;
        }catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function get($id)
    {       
        // 8 Dígitos === Código de Barras 'cEAN8'
        if(strlen($id) === 8)
        {
            $sql = "SELECT * FROM produto WHERE cEAN = {$id}";
        } else if(strlen($id) > 8)
        {
            $sql = "SELECT * FROM produto WHERE id = {$id}"; 
        }
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $produto = $stmt->fetchAll(PDO::FETCH_OBJ);
            $connection = null;
            echo json_encode($produto);
        }catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function getByDescricao($descricao)
    {      
    $sql = "SELECT * FROM produto WHERE descricao = '".$descricao."' ";
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $produto = $stmt->fetchAll(PDO::FETCH_OBJ);
            $connection = null;
            echo json_encode($produto);
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function add($request)
    {        
        $descricao = $request->getParam('descricao');
        $ncm = $request->getParam('ncm');
        $preco_custo = $request->getParam('preco_custo');
        $CFOP = $request->getParam('CFOP');
        $cEAN = $request->getParam('cEAN');
        $sql = "INSERT INTO produto (descricao,ncm,preco_custo,CFOP,cEAN) VALUES
        (:descricao,:ncm,:preco_custo,:CFOP,:cEAN)";
        try{
            $connection = $this->connection->PDOConnect();  
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':descricao',  $descricao);
            $stmt->bindParam(':ncm',      $ncm);
            $stmt->bindParam(':preco_custo',    $preco_custo);
            $stmt->bindParam(':CFOP',       $CFOP);
            $stmt->bindParam(':cEAN',       $cEAN);
            $stmt->execute();
            echo json_encode('{"success": "Produto Adicionado"}');
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function update($request)
    {
        $id = $request->getParam('id');
        $descricao = $request->getParam('descricao');
        $ncm = $request->getParam('NCM');       
        $preco_custo = $request->getParam('preco_custo');     
        $CFOP = $request->getParam('CFOP');      
        $cEAN = $request->getParam('cEAN');      
        $sql = "UPDATE produto SET
        id=:id,
        descricao=:descricao,
        NCM=:NCM,
        preco_custo=:preco_custo,
        CFOP=:CFOP,
        cEAN=:cEAN
        
                WHERE id = $id";    
        try{
            $connection = $this->connection->PDOConnect();   
            $stmt = $connection->prepare($sql);  
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':descricao',  $descricao);
            $stmt->bindParam(':NCM',      $ncm);    
            $stmt->bindParam(':preco_custo',      $preco_custo); 
            $stmt->bindParam(':CFOP',      $CFOP);     
            $stmt->bindParam(':cEAN',      $cEAN);     
            $stmt->execute(); 
            $connection = null;  
            echo json_encode('{"success": "Produto Atualizado"}');    
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
    public function delete($id)
    {    
        $sql = "DELETE FROM produto WHERE id = {$id}";    
        try{
            $connection = $this->connection->PDOConnect();   
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $connection = null;
            echo '{"success": "Produto Deletado"}';
        } catch(PDOException $e){
            echo '{"error": '.$e->getMessage().'}';
        }
    }
}
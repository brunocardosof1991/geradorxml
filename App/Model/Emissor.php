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
    public function getEmissor()
    {        
        $sql = "SELECT * FROM emissor";    
        try{
            $connection = $this->connection->PDOConnect();    
            $stmt = $connection->query($sql);
            $emissor = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ($emissor);
        }catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function addEmissor($request)
    {
        $descricao = $request->getParam('produto');
        $ncm = $request->getParam('NCM');  
        $preco_custo = $request->getParam('preco');  
        $CFOP = $request->getParam('CFOP');    
        $sql = "INSERT INTO produto (descricao,ncm, preco_custo,CFOP) 
        VALUES
        (:descricao,:ncm,:preco_custo,:CFOP)";    
        try{
            $connection = $this->connection->PDOConnect();     
            $stmt = $connection->prepare($sql);    
            $stmt->bindParam(':descricao',  $descricao);
            $stmt->bindParam(':ncm',      $ncm);  
            $stmt->bindParam(':preco_custo',      $preco_custo);    
            $stmt->bindParam(':CFOP',      $CFOP);    
            $stmt->execute();    
            echo json_encode('{"Aviso": {"text": "Produto Adicionado"}');    
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function updateEmissor($request)
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
    public function deleteEmissor($id)
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

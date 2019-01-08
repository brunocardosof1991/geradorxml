<?php
namespace App\Model;
use App\Model\Conexao;
use ArrayObject;
use PDO;

class Cliente {
    
    public $id;
    public $nome;
    public $CNPJ;
    public $endereco;
    public $numero;
    public $complemento;
    public $bairro;
    public $CEP;
    public $fone;
    private $connection = '';

   function __construct()
   {
       $this->connection = new Conexao();
   }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCNPJ() {
        return $this->CNPJ;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCEP() {
        return $this->CEP;
    }

    function getCelular() {
        return $this->celular;
    }
    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCNPJ($CNPJ) {
        $this->CNPJ = $CNPJ;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCEP($CEP) {
        $this->CEP = $CEP;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }
    public function getAllClients()
    {            
        $sql = "SELECT * FROM cliente";    
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->query($sql);
            $cliente = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ($cliente);
            $connection = null;
        } catch(PDOException $e){
            return '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }    
    public function getClient($id)
    {            
        $sql = "SELECT * FROM cliente WHERE id= {$id}";    
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->query($sql);
            $cliente = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ($cliente);
            $connection = null;
        } catch(PDOException $e){
            return '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function addClient($request)
    {        
        $nome = $request->getParam('nome');
        $CNPJ = $request->getParam('CNPJ');
        $endereco = $request->getParam('endereco');
        $numero = $request->getParam('numero');
        $complemento = $request->getParam('complemento');
        $bairro = $request->getParam('bairro');
        $CEP = $request->getParam('CEP');
        $fone = $request->getParam('fone');
        $sql = "INSERT INTO cliente (nome,CNPJ,endereco,numero,complemento,bairro,CEP,fone) VALUES
        (:nome,:CNPJ,:endereco,:numero,:complemento,:bairro,:CEP,:fone)";
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':nome',  $nome);
            $stmt->bindParam(':CNPJ',      $CNPJ);
            $stmt->bindParam(':endereco',      $endereco);
            $stmt->bindParam(':numero',    $numero);
            $stmt->bindParam(':complemento',       $complemento);
            $stmt->bindParam(':bairro',      $bairro);
            $stmt->bindParam(':CEP',      $CEP);
            $stmt->bindParam(':fone',      $fone);
            $stmt->execute();
            echo json_encode('{"Aviso": {"text": "Cliente Adicionado"}');
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function updateClient($request)
    {
        $id = $request->getParam('id');
        $nome = $request->getParam('nome');
        $CNPJ = $request->getParam('CNPJ');
        $endereco = $request->getParam('endereco');
        $numero = $request->getParam('numero');
        $complemento = $request->getParam('complemento');
        $bairro = $request->getParam('bairro');
        $CEP = $request->getParam('CEP');
        $fone = $request->getParam('fone');
        $sql = "UPDATE cliente SET
                    id 	 = :id,
                    nome = :nome,
                    CNPJ = :CNPJ,
                    endereco = :endereco,
                    numero 	= :numero,
                    complemento = :complemento,
                    bairro = :bairro,
                    CEP	= :CEP,
                    fone = :fone
                WHERE id = $id";
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome',  $nome);
            $stmt->bindParam(':CNPJ',      $CNPJ);
            $stmt->bindParam(':endereco',      $endereco);
            $stmt->bindParam(':numero',    $numero);
            $stmt->bindParam(':complemento',       $complemento);
            $stmt->bindParam(':bairro',      $bairro);
            $stmt->bindParam(':CEP',      $CEP);
            $stmt->bindParam(':fone',      $fone);
            $stmt->execute();
            echo json_encode('{"Aviso": {"text": "Cliente Atualizado"}');
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }
    }
    public function deleteClient($id)
    {
        $sql = "DELETE FROM cliente WHERE id = {$id}";
        try{
            $connection = $this->connection->PDOConnect();
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $connection = null;
            echo '{"Aviso": {"text": "Cliente Deletado"}';
        } catch(PDOException $e){
            echo '{"Erro": {"text": '.$e->getMessage().'}';
        }        
    }
}

?>

